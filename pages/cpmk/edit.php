<div class="content-wrapper">
<?php
$id = $_GET['id'] ?? '';
if (!$id) {
  header('Location: index.php?page=cpmk');
  exit;
}

// Ambil data CPMK berdasarkan ID
$cpmkData = $db->tampilData('cpmk', [
  'where' => 'id_cpmk = ? AND id_fakultas = ? AND id_program_studi = ?',
  'params' => [$id, $relo_id_fakultas, $relo_id_program_studi]
]);

$row = $cpmkData[0] ?? null;
if (!$row) {
  echo "<div class='alert alert-danger'>Data CPMK tidak ditemukan.</div>";
  exit;
}

// Ambil semua data CPL untuk dropdown
$dataCPL = $db->tampilData('capaian_pembelajaran_lulusan', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);

// Handle POST (proses update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_capaian_pembelajaran_lulusan = $_POST['id_capaian_pembelajaran_lulusan'] ?? '';
  $kode = trim($_POST['kode'] ?? '');
  $keterangan = trim($_POST['keterangan'] ?? '');

  // Validasi sederhana
  if (!$id_capaian_pembelajaran_lulusan || !$kode || !$keterangan) {
    echo "<div class='alert alert-danger'>Semua field wajib diisi.</div>";
  } else {
    $berhasil = $db->updateData(
      'cpmk',
      ['id_capaian_pembelajaran_lulusan', 'kode', 'keterangan'],
      'id_cpmk = ? AND id_fakultas = ? AND id_program_studi = ?',
      [$id_capaian_pembelajaran_lulusan, $kode, $keterangan, $id, $relo_id_fakultas, $relo_id_program_studi]
    );
    
    if ($berhasil) {
      echo $db->alert("Data CPMK berhasil diperbarui.", "index.php?page=cpmk");
      exit;
    } else {
      echo "<div class='alert alert-danger'>Gagal memperbarui data CPMK.</div>";
    }
  }
}
?>


  <section class="content-header">
    <h1>Edit CPMK</h1>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="id_capaian_pembelajaran_lulusan">CPL</label>
            <select name="id_capaian_pembelajaran_lulusan" id="id_capaian_pembelajaran_lulusan" class="form-control" required>
              <option value="">-- Pilih CPL --</option>
              <?php foreach ($dataCPL as $cpl): ?>
                <option value="<?= $cpl['id_capaian_pembelajaran_lulusan'] ?>"
                  <?= ($row['id_capaian_pembelajaran_lulusan'] == $cpl['id_capaian_pembelajaran_lulusan']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($cpl['kode'] . ' - ' . $cpl['keterangan']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="kode">Kode CPMK</label>
            <input type="text" name="kode" id="kode" class="form-control" required
              value="<?= htmlspecialchars($row['kode']) ?>">
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan CPMK</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="4" required><?= htmlspecialchars($row['keterangan']) ?></textarea>
          </div>
        </div>

        <div class="card-footer">
          <a href="index.php?page=cpmk" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </section>
</div>