<?php
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php?page=profil_lulusan");
    exit;
}

// Ambil data profil lulusan berdasarkan id dan filter session
$dataProfil = $db->tampilData('profil_lulusan', [
    'where' => 'id_profil_lulusan = ? AND id_fakultas = ? AND id_program_studi = ?',
    'params' => [$id, $relo_id_fakultas, $relo_id_program_studi]
]);

if (empty($dataProfil)) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan atau Anda tidak memiliki akses.</div>";
    exit;
}

$profil = $dataProfil[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = trim($_POST['kode'] ?? '');
    $keterangan = trim($_POST['keterangan'] ?? '');

    if ($kode === '' || $keterangan === '') {
        echo "<div class='alert alert-danger'>Kode dan Keterangan tidak boleh kosong.</div>";
    } else {
        $update = $db->updateData(
            'profil_lulusan',
            ['kode', 'keterangan', 'id_fakultas', 'id_program_studi'],
            'id_profil_lulusan = ?',
            [$kode, $keterangan, $relo_id_fakultas, $relo_id_program_studi, $id]
        );

        if ($update) {
            echo $db->alert("Data berhasil diupdate", "index.php?page=profil_lulusan");
        } else {
            echo "<div class='alert alert-danger'>Gagal mengupdate data.</div>";
        }
    }
}
?>

<!-- Form Edit Profil Lulusan -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Profil Lulusan</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <form method="POST" action="">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control" value="<?= htmlspecialchars($profil['kode']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="4" required><?= htmlspecialchars($profil['keterangan']) ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=profil_lulusan" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>
</div>
