<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $keterangan = $_POST['keterangan'];

  if (!empty($keterangan)) {
    $db->insertData(
      'organisasi_matakuliah',
      ['keterangan', 'id_fakultas', 'id_program_studi'],
      [$keterangan, $relo_id_fakultas, $relo_id_program_studi]
    );
    echo $db->alert('Data berhasil ditambahkan', 'index.php?page=organisasi_matakuliah');
  } else {
    echo "<div class='alert alert-danger'>Keterangan tidak boleh kosong.</div>";
  }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Tambah Organisasi Mata Kuliah</h1>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=organisasi_matakuliah" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>