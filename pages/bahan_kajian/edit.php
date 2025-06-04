<?php
$id = $_GET['id'] ?? 0;
$data = $db->tampilData('bahan_kajian', [
  'where' => 'id_bahan_kajian = ? AND id_fakultas = ? AND id_program_studi = ?',
  'params' => [$id, $relo_id_fakultas, $relo_id_program_studi]
]);

if (!$data) die('Data tidak ditemukan');
$row = $data[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $kode = $_POST['kode'] ?? '';
  $keterangan = $_POST['keterangan'] ?? '';

  $update = $db->updateData('bahan_kajian', ['kode', 'keterangan'], 'id_bahan_kajian = ?', [$kode, $keterangan, $id]);
  echo $update ? $db->alert('Data berhasil diupdate', 'index.php?page=bahan_kajian') : $db->alert('Gagal mengupdate data');
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid"><h1>Edit Bahan Kajian</h1></div>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" class="form-control" value="<?= $row['kode'] ?>" required>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" required><?= $row['keterangan'] ?></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=bahan_kajian" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </section>
</div>
