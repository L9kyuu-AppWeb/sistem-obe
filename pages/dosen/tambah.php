<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nidn = $_POST['nidn'];
  $nuptk = $_POST['nuptk'];
  $keterangan = $_POST['keterangan'];
  $status = $_POST['status'];

  $db->insertData('dosen', 
    ['nidn', 'nuptk', 'keterangan', 'status', 'id_fakultas', 'id_program_studi'], 
    [$nidn, $nuptk, $keterangan, $status, $relo_id_fakultas, $relo_id_program_studi]);

  echo $db->alert('Data dosen berhasil ditambahkan', 'index.php?page=dosen');
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Tambah Dosen</h1>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="nidn">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nuptk">NUPTK</label>
            <input type="text" name="nuptk" id="nuptk" class="form-control">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
              <option value="Internal">Internal</option>
              <option value="Eksternal">Eksternal</option>
            </select>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=dosen" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>
