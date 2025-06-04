<?php
// Ambil data fakultas untuk dropdown
$dataFakultas = $db->tampilData('fakultas', ['orderBy' => 'nama_fakultas']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_prodi = $_POST['nama_prodi'] ?? '';
    $id_fakultas = $_POST['id_fakultas'] ?? '';

    if ($nama_prodi && $id_fakultas) {
        $simpan = $db->insertData('program_studi', ['nama_prodi', 'id_fakultas'], [$nama_prodi, $id_fakultas]);

        if ($simpan) {
            echo $db->alert("Program Studi berhasil ditambahkan", "index.php?page=program_studi");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Semua field harus diisi</div>";
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Program Studi</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <form action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_prodi">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" id="nama_prodi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="id_fakultas">Fakultas</label>
                        <select name="id_fakultas" id="id_fakultas" class="form-control" required>
                            <option value="">-- Pilih Fakultas --</option>
                            <?php foreach ($dataFakultas as $fakultas): ?>
                                <option value="<?= $fakultas['id_fakultas'] ?>"><?= htmlspecialchars($fakultas['nama_fakultas']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=program_studi" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
