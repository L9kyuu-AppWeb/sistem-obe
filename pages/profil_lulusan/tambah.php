<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = trim($_POST['kode'] ?? '');
    $keterangan = trim($_POST['keterangan'] ?? '');

    if ($kode === '' || $keterangan === '') {
        echo "<div class='alert alert-danger'>Kode dan Keterangan tidak boleh kosong.</div>";
    } elseif (!$relo_id_fakultas || !$relo_id_program_studi) {
        echo "<div class='alert alert-danger'>Data fakultas atau program studi tidak tersedia.</div>";
    } else {
        $simpan = $db->insertData(
            'profil_lulusan',
            ['kode', 'keterangan', 'id_fakultas', 'id_program_studi'],
            [$kode, $keterangan, $relo_id_fakultas, $relo_id_program_studi]
        );

        if ($simpan) {
            echo $db->alert("Profil lulusan berhasil disimpan", "index.php?page=profil_lulusan");
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
        }
    }
}
?>

<!-- Form Tambah Profil Lulusan -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Tambah Profil Lulusan</h1>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST" action="">
        <div class="card-body">
          <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" id="kode" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="4" required></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=profil_lulusan" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>
