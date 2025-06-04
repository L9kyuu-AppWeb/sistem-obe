<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_fakultas'] ?? '';

    if (!empty($nama)) {
        $simpan = $db->insertData('fakultas', ['nama_fakultas'], [$nama]);

        if ($simpan) {
            echo $db->alert("Data berhasil disimpan", "index.php?page=fakultas");
        } else {
            echo $db->alert("Gagal menyimpan data", "index.php?page=fakultas&action=tambah");
        }
    } else {
        echo "<div class='alert alert-danger'>Nama fakultas tidak boleh kosong.</div>";
    }
}
?>

<!-- Form Tambah Fakultas -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Fakultas</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <form method="POST" action="">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_fakultas">Nama Fakultas</label>
                        <input type="text" name="nama_fakultas" id="nama_fakultas" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=fakultas" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>
