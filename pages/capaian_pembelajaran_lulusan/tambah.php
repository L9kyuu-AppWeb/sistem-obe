<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = trim($_POST['kode'] ?? '');
    $keterangan = trim($_POST['keterangan'] ?? '');

    if ($kode === '' || $keterangan === '') {
        echo "<div class='alert alert-danger'>Kode dan Keterangan wajib diisi.</div>";
    } else {
        $simpan = $db->insertData('capaian_pembelajaran_lulusan',
            ['kode', 'keterangan', 'id_fakultas', 'id_program_studi'],
            [$kode, $keterangan, $relo_id_fakultas, $relo_id_program_studi]
        );
        echo $simpan
            ? $db->alert("Data berhasil disimpan", "index.php?page=capaian_pembelajaran_lulusan")
            : "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
    }
}
?>

<!-- Form -->
<div class="content-wrapper">
  <section class="content-header"><div class="container-fluid"><h1>Tambah CPL</h1></div></section>
  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="4" required></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=capaian_pembelajaran_lulusan" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>
