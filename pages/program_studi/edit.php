<?php
$id = $_GET['id'] ?? null;
if (!$id) {
    echo $db->alert("ID Program Studi tidak ditemukan", "index.php?page=program_studi");
    exit;
}

$dataProdi = $db->tampilData('program_studi', [
    'where'  => 'id_program_studi = ?',
    'params' => [$id]
]);

if (!$dataProdi) {
    echo $db->alert("Data Program Studi tidak ditemukan", "index.php?page=program_studi");
    exit;
}
$prodi = $dataProdi[0];

// Ambil fakultas untuk dropdown
$dataFakultas = $db->tampilData('fakultas', ['orderBy' => 'nama_fakultas']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_prodi = $_POST['nama_prodi'] ?? '';
    $id_fakultas = $_POST['id_fakultas'] ?? '';

    if ($nama_prodi && $id_fakultas) {
        $update = $db->updateData(
            'program_studi',
            ['nama_prodi', 'id_fakultas'],
            'id_program_studi = ?',
            [$nama_prodi, $id_fakultas, $id]
        );

        if ($update) {
            echo $db->alert("Data berhasil diupdate", "index.php?page=program_studi");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Gagal update data</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Semua field harus diisi</div>";
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Program Studi</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <form action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_prodi">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" id="nama_prodi" class="form-control" required
                            value="<?= htmlspecialchars($prodi['nama_prodi']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="id_fakultas">Fakultas</label>
                        <select name="id_fakultas" id="id_fakultas" class="form-control" required>
                            <option value="">-- Pilih Fakultas --</option>
                            <?php foreach ($dataFakultas as $fakultas): ?>
                                <option value="<?= $fakultas['id_fakultas'] ?>" 
                                    <?= $fakultas['id_fakultas'] == $prodi['id_fakultas'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($fakultas['nama_fakultas']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="index.php?page=program_studi" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>
</div>
