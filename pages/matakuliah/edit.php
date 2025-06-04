<?php
// Ambil id dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo $db->alert("ID matakuliah tidak ditemukan.", "index.php?page=matakuliah");
    exit;
}

// Ambil data matakuliah berdasarkan id
$data = $db->tampilData('matakuliah', [
    'where' => 'id_matakuliah = ?',
    'params' => [$id],
]);

if (!$data) {
    echo $db->alert("Data matakuliah tidak ditemukan.", "index.php?page=matakuliah");
    exit;
}

$matakuliah = $data[0];

// Ambil daftar dosen untuk dropdown
$dataDosen = $db->tampilData('dosen', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $keterangan = $_POST['keterangan'] ?? '';
    $kode = $_POST['kode'] ?? '';
    $sks = $_POST['sks'] ?? 0;
    $semester = $_POST['semester'] ?? 1;
    $tanggal_penyusunan = $_POST['tanggal_penyusunan'] ?? '';
    $id_dosen_pengembang_rps = $_POST['id_dosen_pengembang_rps'] ?? null;
    $id_dosen_ketua_program_studi = $_POST['id_dosen_ketua_program_studi'] ?? null;
    $deskripsi_singkat = $_POST['deskripsi_singkat'] ?? '';
    $tautan_kelas_daring = $_POST['tautan_kelas_daring'] ?? '';

    // Validasi minimal
    if ($keterangan === '' || $kode === '') {
        echo "<div class='alert alert-danger'>Keterangan dan Kode wajib diisi.</div>";
    } else {
        // Update data
        $update = $db->updateData(
            'matakuliah',
            ['keterangan', 'kode', 'sks', 'semester', 'tanggal_penyusunan', 'id_dosen_pengembang_rps', 'id_dosen_ketua_program_studi', 'deskripsi_singkat', 'tautan_kelas_daring'],
            'id_matakuliah = ?',
            [$keterangan, $kode, $sks, $semester, $tanggal_penyusunan, $id_dosen_pengembang_rps, $id_dosen_ketua_program_studi, $deskripsi_singkat, $tautan_kelas_daring, $id]
        );

        if ($update) {
            echo $db->alert("Data matakuliah berhasil diupdate.", "index.php?page=matakuliah");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Gagal mengupdate data.</div>";
        }
    }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Edit Matakuliah</h1>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <form method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= htmlspecialchars($matakuliah['keterangan']) ?>" required>
          </div>
          <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" id="kode" class="form-control" value="<?= htmlspecialchars($matakuliah['kode']) ?>" required>
          </div>
          <div class="form-group">
            <label for="sks">SKS</label>
            <input type="number" name="sks" id="sks" class="form-control" value="<?= (int)$matakuliah['sks'] ?>" min="0" required>
          </div>
          <div class="form-group">
            <label for="semester">Semester</label>
            <select name="semester" id="semester" class="form-control" required>
              <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?= $i ?>" <?= ($matakuliah['semester'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tanggal_penyusunan">Tanggal Penyusunan</label>
            <input type="date" name="tanggal_penyusunan" id="tanggal_penyusunan" class="form-control" value="<?= htmlspecialchars($matakuliah['tanggal_penyusunan']) ?>">
          </div>
          <div class="form-group">
            <label for="id_dosen_pengembang_rps">Dosen Pengembang RPS</label>
            <select name="id_dosen_pengembang_rps" id="id_dosen_pengembang_rps" class="form-control">
              <option value="">-- Pilih Dosen --</option>
              <?php foreach ($dataDosen as $dosen): ?>
                <?php 
                  $selected = (isset($_POST['id_dosen_pengembang_rps']) && $_POST['id_dosen_pengembang_rps'] == $dosen['id_dosen']) 
                            || (!isset($_POST['id_dosen_pengembang_rps']) && $matakuliah['id_dosen_pengembang_rps'] == $dosen['id_dosen']);
                ?>
                <option value="<?= $dosen['id_dosen'] ?>" <?= $selected ? 'selected' : '' ?>>
                  <?= htmlspecialchars($dosen['keterangan']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="id_dosen_ketua_program_studi">Dosen Ketua Program Studi</label>
            <select name="id_dosen_ketua_program_studi" id="id_dosen_ketua_program_studi" class="form-control" required>
              <option value="">-- Pilih Dosen --</option>
              <?php foreach ($dataDosen as $dosen): ?>
                <?php 
                  $selected = (isset($_POST['id_dosen_ketua_program_studi']) && $_POST['id_dosen_ketua_program_studi'] == $dosen['id_dosen']) 
                            || (!isset($_POST['id_dosen_ketua_program_studi']) && $matakuliah['id_dosen_ketua_program_studi'] == $dosen['id_dosen']);
                ?>
                <option value="<?= $dosen['id_dosen'] ?>" <?= $selected ? 'selected' : '' ?>>
                  <?= htmlspecialchars($dosen['keterangan']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="deskripsi_singkat">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" class="form-control"><?= htmlspecialchars($matakuliah['deskripsi_singkat']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="tautan_kelas_daring">Tautan Kelas Daring</label>
            <input type="url" name="tautan_kelas_daring" id="tautan_kelas_daring" class="form-control" value="<?= htmlspecialchars($matakuliah['tautan_kelas_daring']) ?>">
          </div>
        </div>
        <div class="card-footer">
          <a href="index.php?page=matakuliah" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </section>
</div>
