<?php
$data = $db->joinTableMulti(
  'm.*, dp.keterangan AS dosen_pengembang, dk.keterangan AS dosen_ketua',
  'matakuliah m',
  [
    ['tabel' => 'dosen dp', 'kondisi' => 'm.id_dosen_pengembang_rps = dp.id_dosen'],
    ['tabel' => 'dosen dk', 'kondisi' => 'm.id_dosen_ketua_program_studi = dk.id_dosen']
  ],
  'm.id_fakultas = ? AND m.id_program_studi = ?',
  [$relo_id_fakultas, $relo_id_program_studi]
);
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Mata Kuliah</h1>
    <a href="index.php?page=matakuliah&action=tambah" class="btn btn-primary">+ Tambah</a>
  </section>

  <section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Mata Kuliah</h3>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Info Mata Kuliah</th>
            <th>Pengembang</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $i => $row): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td>
                <strong><?= htmlspecialchars($row['kode']) ?> - <?= htmlspecialchars($row['keterangan']) ?></strong><br>
                <?= htmlspecialchars($row['sks']) ?> SKS | Semester <?= htmlspecialchars($row['semester']) ?>
              </td>
              <td>
                <?= htmlspecialchars($row['dosen_pengembang']) ?><br>
                <small><em>Kaprodi: <?= htmlspecialchars($row['dosen_ketua']) ?></em></small>
              </td>
              <td><?= htmlspecialchars($row['tanggal_penyusunan']) ?></td>
              <td>
                <a href="index.php?page=matakuliah&action=edit&id=<?= $row['id_matakuliah'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="index.php?page=matakuliah&action=hapus&id=<?= $row['id_matakuliah'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

</div>