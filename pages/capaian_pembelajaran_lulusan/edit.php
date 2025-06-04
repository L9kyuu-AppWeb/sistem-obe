<?php
$id = $_GET['id'] ?? null;
$data = $db->tampilData('capaian_pembelajaran_lulusan', [
  'where' => 'id_capaian_pembelajaran_lulusan = ? AND id_fakultas = ? AND id_program_studi = ?',
  'params' => [$id, $relo_id_fakultas, $relo_id_program_studi]
]);
if (empty($data)) {
  echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>"; exit;
}
$row = $data[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = $_POST['kode'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    if ($kode && $keterangan) {
        $update = $db->updateData(
            'capaian_pembelajaran_lulusan',
            ['kode', 'keterangan', 'id_fakultas', 'id_program_studi'],
            'id_capaian_pembelajaran_lulusan = ?',
            [$kode, $keterangan, $relo_id_fakultas, $relo_id_program_studi, $id]
        );
        echo $update
            ? $db->alert("Data berhasil diperbarui", "index.php?page=capaian_pembelajaran_lulusan")
            : "<div class='alert alert-danger'>Gagal update data.</div>";
    }
}
?>

<div class="content-wrapper">
  <section class="content-header"><div class="container-fluid"><h1>Edit CPL</h1></div></section>
  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label>Kode</label>
            <input type="text" name="kode" value="<?= htmlspecialchars($row['kode']) ?>" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="4" required><?= htmlspecialchars($row['keterangan']) ?></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=capaian_pembelajaran_lulusan" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </section>
</div>
