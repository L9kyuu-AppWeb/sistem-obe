<?php
$id = $_GET['id'] ?? '';
$dosen = $db->tampilData('dosen', [
  'where' => 'id_dosen = ?',
  'params' => [$id]
])[0] ?? null;

if (!$dosen) {
  echo $db->alert("Data dosen tidak ditemukan", "index.php?page=dosen");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nidn = $_POST['nidn'];
  $nuptk = $_POST['nuptk'];
  $keterangan = $_POST['keterangan'];
  $status = $_POST['status'];

  $db->updateData('dosen',
    ['nidn', 'nuptk', 'keterangan', 'status'],
    'id_dosen = ?',
    [$nidn, $nuptk, $keterangan, $status, $id]
  );

  echo $db->alert('Data dosen berhasil diupdate', 'index.php?page=dosen');
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Dosen</h1>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="nidn">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control" value="<?= htmlspecialchars($dosen['nidn']) ?>" required>
          </div>
          <div class="form-group">
            <label for="nuptk">NUPTK</label>
            <input type="text" name="nuptk" id="nuptk" class="form-control" value="<?= htmlspecialchars($dosen['nuptk']) ?>">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control"><?= htmlspecialchars($dosen['keterangan']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
              <option value="Internal" <?= $dosen['status'] === 'Internal' ? 'selected' : '' ?>>Internal</option>
              <option value="Eksternal" <?= $dosen['status'] === 'Eksternal' ? 'selected' : '' ?>>Eksternal</option>
            </select>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=dosen" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </section>
</div>
