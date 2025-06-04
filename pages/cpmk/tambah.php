<?php
// Ambil data CPL untuk dropdown
$dataCPL = $db->tampilData('capaian_pembelajaran_lulusan', [
    'where' => 'id_fakultas = ? AND id_program_studi = ?',
    'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cpl = $_POST['id_capaian_pembelajaran_lulusan'] ?? '';
    $kode_list = $_POST['kode'] ?? [];
    $keterangan_list = $_POST['keterangan'] ?? [];

    if (!$id_cpl) {
        echo "<div class='alert alert-danger'>CPL wajib dipilih.</div>";
    } else {
        $sukses = true;
        foreach ($kode_list as $i => $kode) {
            $keterangan = $keterangan_list[$i] ?? '';
            if ($kode && $keterangan) {
                $insert = $db->insertData('cpmk', [
                    'id_capaian_pembelajaran_lulusan', 'kode', 'keterangan', 'id_fakultas', 'id_program_studi'
                ], [
                    $id_cpl, $kode, $keterangan, $relo_id_fakultas, $relo_id_program_studi
                ]);
                if (!$insert) {
                    $sukses = false;
                }
            }
        }

        if ($sukses) {
            echo $db->alert("Semua CPMK berhasil ditambahkan.", "index.php?page=cpmk");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Beberapa data mungkin gagal disimpan.</div>";
        }
    }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Tambah CPMK</h1>
  </section>

  <section class="content">
    <form method="post">
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label>Pilih CPL</label>
            <select name="id_capaian_pembelajaran_lulusan" class="form-control" required>
              <option value="">-- Pilih CPL --</option>
              <?php foreach ($dataCPL as $cpl): ?>
                <option value="<?= $cpl['id_capaian_pembelajaran_lulusan'] ?>"
                  <?= (isset($_POST['id_capaian_pembelajaran_lulusan']) && $_POST['id_capaian_pembelajaran_lulusan'] == $cpl['id_capaian_pembelajaran_lulusan']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($cpl['kode']) ?> - <?= htmlspecialchars($cpl['keterangan']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div id="cpmk-wrapper">
            <div class="cpmk-row border p-3 rounded mb-3">
              <div class="form-group">
                <label>Kode CPMK</label>
                <input type="text" name="kode[]" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Keterangan CPMK</label>
                <textarea name="keterangan[]" class="form-control" rows="2" required></textarea>
              </div>
              <button type="button" class="btn btn-danger btn-sm remove-cpmk mt-2">Hapus</button>
            </div>
          </div>

          <button type="button" id="add-cpmk" class="btn btn-secondary">+ Tambah CPMK</button>
        </div>

        <div class="card-footer">
          <a href="index.php?page=cpmk" class="btn btn-default">Batal</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </section>
</div>

<script>
// Tambah baris input CPMK
document.getElementById('add-cpmk').addEventListener('click', function () {
  const wrapper = document.getElementById('cpmk-wrapper');
  const newRow = document.createElement('div');
  newRow.classList.add('cpmk-row', 'border', 'p-3', 'rounded', 'mb-3');
  newRow.innerHTML = `
    <div class="form-group">
      <label>Kode CPMK</label>
      <input type="text" name="kode[]" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Keterangan CPMK</label>
      <textarea name="keterangan[]" class="form-control" rows="2" required></textarea>
    </div>
    <button type="button" class="btn btn-danger btn-sm remove-cpmk mt-2">Hapus</button>
  `;
  wrapper.appendChild(newRow);
});

// Hapus baris input CPMK
document.addEventListener('click', function (e) {
  if (e.target.classList.contains('remove-cpmk')) {
    e.target.closest('.cpmk-row').remove();
  }
});
</script>
