<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $kode = $_POST['kode'] ?? '';
  $keterangan = $_POST['keterangan'] ?? '';

  if ($kode && $keterangan) {
    $simpan = $db->insertData('bahan_kajian', ['kode', 'keterangan', 'id_fakultas', 'id_program_studi'], [$kode, $keterangan, $relo_id_fakultas, $relo_id_program_studi]);
    echo $simpan ? $db->alert('Data berhasil disimpan', 'index.php?page=bahan_kajian') : $db->alert('Gagal menyimpan data');
  }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid"><h1>Tambah Bahan Kajian</h1></div>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" required></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=bahan_kajian" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>
