<?php
$dataCPL = $db->tampilData('capaian_pembelajaran_lulusan', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);
$dataProfil = $db->tampilData('profil_lulusan', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cpl = $_POST['id_cpl'];
    $profil_lulusan = $_POST['profil_lulusan'] ?? [];

    foreach ($profil_lulusan as $id_profil) {
        $db->insertData('capaian_pembelajaran_lulusan_detail', 
            ['id_capaian_pembelajaran_lulusan', 'id_profil_lulusan'], 
            [$id_cpl, $id_profil]
        );
    }

    echo $db->alert('Data relasi berhasil ditambahkan', 'index.php?page=cpl_detail');
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Tambah Relasi CPL - Profil Lulusan</h1>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="id_cpl">Pilih CPL</label>
            <select name="id_cpl" id="id_cpl" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php foreach ($dataCPL as $cpl): ?>
                <option value="<?= $cpl['id_capaian_pembelajaran_lulusan'] ?>"><?= $cpl['keterangan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Pilih Profil Lulusan</label>
            <?php foreach ($dataProfil as $profil): ?>
              <div class="form-check">
                <input type="checkbox" name="profil_lulusan[]" value="<?= $profil['id_profil_lulusan'] ?>" class="form-check-input" id="profil<?= $profil['id_profil_lulusan'] ?>">
                <label class="form-check-label" for="profil<?= $profil['id_profil_lulusan'] ?>"><?= $profil['keterangan'] ?></label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=cpl_detail" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>
