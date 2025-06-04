<?php
$data = $db->tampilData('dosen', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi]
]);
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Dosen</h1>
    <a href="index.php?page=dosen&action=tambah" class="btn btn-primary">+ Tambah Dosen</a>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>NIDN</th>
              <th>NUPTK</th>
              <th>Keterangan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $i => $row): ?>
            <tr>
              <td><?= $i+1 ?></td>
              <td><?= htmlspecialchars($row['nidn']) ?></td>
              <td><?= htmlspecialchars($row['nuptk']) ?></td>
              <td><?= htmlspecialchars($row['keterangan']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <a href="index.php?page=dosen&action=edit&id=<?= $row['id_dosen'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="index.php?page=dosen&action=hapus&id=<?= $row['id_dosen'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
