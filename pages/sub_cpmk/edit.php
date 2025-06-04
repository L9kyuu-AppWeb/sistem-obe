<?php
$id = $_GET['id'] ?? '';
if (!$id) { header("Location: index.php?page=sub_cpmk"); exit; }

$row = $db->tampilData('sub_cpmk', [
  'where' => 'id_sub_cpmk = ? AND id_fakultas = ? AND id_program_studi = ?',
  'params' => [$id, $relo_id_fakultas, $relo_id_program_studi]
])[0] ?? null;

if (!$row) {
  echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
  exit;
}

$dataCPMK = $db->tampilData('cpmk', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi]
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_cpmk = $_POST['id_cpmk'] ?? '';
  $kode = $_POST['kode'] ?? '';
  $keterangan = $_POST['keterangan'] ?? '';

  if (!$id_cpmk || !$kode || !$keterangan) {
    echo "<div class='alert alert-danger'>Semua field wajib diisi.</div>";
  } else {
    $update = $db->updateData('sub_cpmk',
      ['id_cpmk', 'kode', 'keterangan'],
      'id_sub_cpmk = ? AND id_fakultas = ? AND id_program_studi = ?',
      [$id_cpmk, $kode, $keterangan, $id, $relo_id_fakultas, $relo_id_program_studi]
    );

    if ($update) {
      echo $db->alert("Data Sub-CPMK berhasil diperbarui.", "index.php?page=sub_cpmk");
    } else {
      echo "<div class='alert alert-danger'>Gagal mengubah data.</div>";
    }
  }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Sub-CPMK</h1>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label>CPMK</label>
            <select name="id_cpmk" class="form-control" required>
              <option value="">-- Pilih CPMK --</option>
              <?php foreach ($dataCPMK as $c): ?>
              <option value="<?= $c['id_cpmk'] ?>" <?= ($row['id_cpmk'] == $c['id_cpmk']) ? 'selected' : '' ?>>
                <?= $c['kode'] ?> - <?= $c['keterangan'] ?>
              </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($row['kode']) ?>" required>
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" required><?= htmlspecialchars($row['keterangan']) ?></textarea>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=sub_cpmk" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </section>
</div>
