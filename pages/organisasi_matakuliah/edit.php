<?php
$id = $_GET['id'] ?? '';
$data = $db->tampilData('organisasi_matakuliah', [
  'where' => 'id_organisasi_matakuliah = ?',
  'params' => [$id]
]);

if (!$data) {
  echo $db->alert('Data tidak ditemukan', 'index.php?page=organisasi_matakuliah');
  exit;
}

$row = $data[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $keterangan = $_POST['keterangan'];

  if (!empty($keterangan)) {
    $db->updateData('organisasi_matakuliah', ['keterangan'], 'id_organisasi_matakuliah = ?', [$keterangan, $id]);
    echo $db->alert('Data berhasil diupdate', 'index.php?page=organisasi_matakuliah');
  } else {
    echo "<div class='alert alert-danger'>Keterangan tidak boleh kosong.</div>";
  }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Organisasi Mata Kuliah</h1>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" required><?= htmlspecialchars($row['keterangan']) ?></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=organisasi_matakuliah" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </section>
</div>
