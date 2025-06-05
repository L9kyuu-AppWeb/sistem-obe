<?php
// Ambil data dosen untuk dropdown (sesuaikan relasi fakultas & prodi jika perlu)
$dataDosen = $db->tampilData('dosen', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);

// Proses simpan data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $keterangan = $_POST['keterangan'] ?? '';
  $kode = $_POST['kode'] ?? '';
  $sks = $_POST['sks'] ?? '';
  $semester = $_POST['semester'] ?? '';
  $tanggal_penyusunan = $_POST['tanggal_penyusunan'] ?? '';
  $id_dosen_pengembang_rps = $_POST['id_dosen_pengembang_rps'] ?? '';
  $id_dosen_ketua_program_studi = $_POST['id_dosen_ketua_program_studi'] ?? '';
  $deskripsi_singkat = $_POST['deskripsi_singkat'] ?? '';
  $tautan_kelas_daring = $_POST['tautan_kelas_daring'] ?? '';

  // Validasi sederhana
  if (!$keterangan || !$kode || !$sks || !$semester || !$tanggal_penyusunan || !$id_dosen_pengembang_rps || !$id_dosen_ketua_program_studi) {
    echo "<div class='alert alert-danger'>Semua field wajib diisi kecuali deskripsi dan tautan kelas.</div>";
  } else {
    // Insert ke database
    $insert = $db->insertData('matakuliah', [
      'keterangan',
      'kode',
      'sks',
      'semester',
      'tanggal_penyusunan',
      'id_dosen_pengembang_rps',
      'id_dosen_ketua_program_studi',
      'deskripsi_singkat',
      'tautan_kelas_daring',
      'id_fakultas',
      'id_program_studi'
    ], [
      $keterangan,
      $kode,
      $sks,
      $semester,
      $tanggal_penyusunan,
      $id_dosen_pengembang_rps,
      $id_dosen_ketua_program_studi,
      $deskripsi_singkat,
      $tautan_kelas_daring,
      $relo_id_fakultas,
      $relo_id_program_studi
    ]);

    if ($insert) {
      echo $db->alert("Data matakuliah berhasil ditambahkan.", "index.php?page=matakuliah");
      exit;
    } else {
      echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
    }
  }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Tambah Matakuliah</h1>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST" action="">
        <div class="card-body">
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" required value="<?= htmlspecialchars($_POST['keterangan'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" id="kode" class="form-control" required value="<?= htmlspecialchars($_POST['kode'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="sks">SKS</label>
            <input type="number" name="sks" id="sks" class="form-control" min="1" max="10" required value="<?= htmlspecialchars($_POST['sks'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="semester">Semester</label>
            <select name="semester" id="semester" class="form-control" required>
              <option value="">-- Pilih Semester --</option>
              <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?= $i ?>" <?= (isset($_POST['semester']) && $_POST['semester'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="tanggal_penyusunan">Tanggal Penyusunan</label>
            <input type="date" name="tanggal_penyusunan" id="tanggal_penyusunan" class="form-control" required value="<?= htmlspecialchars($_POST['tanggal_penyusunan'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="id_dosen_pengembang_rps">Dosen Pengembang RPS</label>
            <select name="id_dosen_pengembang_rps" id="id_dosen_pengembang_rps" class="form-control select2" required>
              <option value="">-- Pilih Dosen --</option>
              <?php foreach ($dataDosen as $dosen): ?>
                <option value="<?= $dosen['id_dosen'] ?>" <?= (isset($_POST['id_dosen_pengembang_rps']) && $_POST['id_dosen_pengembang_rps'] == $dosen['id_dosen']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($dosen['keterangan']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="id_dosen_ketua_program_studi">Dosen Ketua Program Studi</label>
            <select name="id_dosen_ketua_program_studi" id="id_dosen_ketua_program_studi" class="form-control select2" required>
              <option value="">-- Pilih Dosen --</option>
              <?php foreach ($dataDosen as $dosen): ?>
                <option value="<?= $dosen['id_dosen'] ?>" <?= (isset($_POST['id_dosen_ketua_program_studi']) && $_POST['id_dosen_ketua_program_studi'] == $dosen['id_dosen']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($dosen['keterangan']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="deskripsi_singkat">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" class="form-control"><?= htmlspecialchars($_POST['deskripsi_singkat'] ?? '') ?></textarea>
          </div>

          <div class="form-group">
            <label for="tautan_kelas_daring">Tautan Kelas Daring</label>
            <input type="url" name="tautan_kelas_daring" id="tautan_kelas_daring" class="form-control" value="<?= htmlspecialchars($_POST['tautan_kelas_daring'] ?? '') ?>">
          </div>

          <!-- id_fakultas dan id_program_studi otomatis dari session, tidak perlu input -->
        </div>

        <div class="card-footer">
          <a href="index.php?page=matakuliah" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </section>
</div>