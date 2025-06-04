<?php
// Ambil id dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo $db->alert("ID fakultas tidak ditemukan.", "index.php?page=fakultas");
    exit;
}

// Ambil data fakultas berdasarkan id
$data = $db->tampilData('fakultas', [
    'where' => 'id_fakultas = ?',
    'params' => [$id],
]);

if (!$data) {
    echo $db->alert("Data fakultas tidak ditemukan.", "index.php?page=fakultas");
    exit;
}

$fakultas = $data[0];

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_fakultas'] ?? '';

    if (!empty($nama)) {
        $update = $db->updateData(
            'fakultas',
            ['nama_fakultas'],   // fields yang diupdate
            'id_fakultas = ?',   // where clause
            [$nama, $id]         // params, urutan sesuai field dan where
        );

        if ($update) {
            echo $db->alert("Data berhasil diupdate.", "index.php?page=fakultas");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Gagal mengupdate data.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Nama fakultas tidak boleh kosong.</div>";
    }
}
?>

<!-- Form Edit Fakultas -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Fakultas</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <form method="POST" action="">
                <div class="card-body">
                    <input type="hidden" name="id_fakultas" value="<?= htmlspecialchars($fakultas['id_fakultas']) ?>">
                    <div class="form-group">
                        <label for="nama_fakultas">Nama Fakultas</label>
                        <input type="text" name="nama_fakultas" id="nama_fakultas" class="form-control" 
                               value="<?= htmlspecialchars($fakultas['nama_fakultas']) ?>" required>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=fakultas" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>
</div>
