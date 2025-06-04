<?php
$data = $db->tampilData('organisasi_matakuliah', [
    'where' => 'id_fakultas = ? AND id_program_studi = ?',
    'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Organisasi Mata Kuliah</h1>
    <a href="index.php?page=organisasi_matakuliah&action=tambah" class="btn btn-primary">+ Tambah</a>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $i => $row): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td>
                  <a href="index.php?page=organisasi_matakuliah&action=edit&id=<?= $row['id_organisasi_matakuliah'] ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="index.php?page=organisasi_matakuliah&action=hapus&id=<?= $row['id_organisasi_matakuliah'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
