<?php
$dataBahanKajian = $db->tampilData('bahan_kajian', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);
$dataCPL = $db->tampilData('capaian_pembelajaran_lulusan', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bahan_kajian = $_POST['id_bahan_kajian'];
    $cpl_terpilih = $_POST['cpl'] ?? [];

    foreach ($cpl_terpilih as $id_cpl) {
        $db->insertData('bahan_kajian_detail', 
            ['id_bahan_kajian', 'id_capaian_pembelajaran_lulusan'], 
            [$id_bahan_kajian, $id_cpl]
        );
    }

    echo $db->alert('Relasi berhasil ditambahkan', 'index.php?page=bahan_kajian_detail');
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Tambah Relasi Bahan Kajian - CPL</h1>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="id_bahan_kajian">Pilih Bahan Kajian</label>
            <select name="id_bahan_kajian" id="id_bahan_kajian" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php foreach ($dataBahanKajian as $bk): ?>
                <option value="<?= $bk['id_bahan_kajian'] ?>"><?= $bk['keterangan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Pilih CPL</label>
            <?php foreach ($dataCPL as $cpl): ?>
              <div class="form-check">
                <input type="checkbox" name="cpl[]" value="<?= $cpl['id_capaian_pembelajaran_lulusan'] ?>" class="form-check-input" id="cpl<?= $cpl['id_capaian_pembelajaran_lulusan'] ?>">
                <label class="form-check-label" for="cpl<?= $cpl['id_capaian_pembelajaran_lulusan'] ?>"><?= $cpl['keterangan'] ?></label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=bahan_kajian_detail" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>
