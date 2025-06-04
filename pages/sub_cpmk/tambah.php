<?php
// Ambil data CPMK untuk pilihan dropdown
$dataCPMK = $db->tampilData('cpmk', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi]
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_cpmk = $_POST['id_cpmk'];
  $kode_list = $_POST['kode'] ?? [];
  $keterangan_list = $_POST['keterangan'] ?? [];

  foreach ($kode_list as $i => $kode) {
    $keterangan = $keterangan_list[$i] ?? '';
    $db->insertData('sub_cpmk', ['id_cpmk', 'kode', 'keterangan', 'id_fakultas', 'id_program_studi'], [
      $id_cpmk, $kode, $keterangan, $relo_id_fakultas, $relo_id_program_studi
    ]);
  }

  echo "<script>window.location.href = 'index.php?page=sub_cpmk';</script>";
  exit;
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Tambah Sub CPMK</h1>
  </section>

  <section class="content">
    <form method="post">
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label>Pilih CPMK</label>
            <select name="id_cpmk" class="form-control" required>
              <option value="">-- Pilih CPMK --</option>
              <?php foreach ($dataCPMK as $cpmk): ?>
                <option value="<?= $cpmk['id_cpmk'] ?>">
                  <?= htmlspecialchars($cpmk['kode']) ?> - <?= htmlspecialchars($cpmk['keterangan']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div id="sub-cpmk-wrapper">
            <div class="sub-cpmk-row border p-3 rounded mb-3">
              <div class="form-group">
                <label>Kode Sub CPMK</label>
                <input type="text" name="kode[]" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan[]" class="form-control" rows="2" required></textarea>
              </div>
              <button type="button" class="btn btn-danger btn-sm remove-sub-cpmk mt-2">Hapus</button>
            </div>
          </div>

          <button type="button" id="add-sub-cpmk" class="btn btn-secondary">+ Tambah Sub CPMK</button>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="index.php?page=sub_cpmk" class="btn btn-default">Batal</a>
        </div>
      </div>
    </form>
  </section>
</div>

<script>
// Tambah field Sub CPMK baru
document.getElementById('add-sub-cpmk').addEventListener('click', function () {
  const wrapper = document.getElementById('sub-cpmk-wrapper');
  const newRow = document.createElement('div');
  newRow.classList.add('sub-cpmk-row', 'border', 'p-3', 'rounded', 'mb-3');
  newRow.innerHTML = `
    <div class="form-group">
      <label>Kode Sub CPMK</label>
      <input type="text" name="kode[]" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea name="keterangan[]" class="form-control" rows="2" required></textarea>
    </div>
    <button type="button" class="btn btn-danger btn-sm remove-sub-cpmk mt-2">Hapus</button>
  `;
  wrapper.appendChild(newRow);
});

// Hapus field Sub CPMK
document.addEventListener('click', function (e) {
  if (e.target.classList.contains('remove-sub-cpmk')) {
    e.target.closest('.sub-cpmk-row').remove();
  }
});
</script>
