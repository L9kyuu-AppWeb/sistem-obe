<?php
$dataFakultas = $db->tampilData('fakultas');
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Data Fakultas</h1>
      <a href="index.php?page=fakultas&action=tambah" class="btn btn-primary mb-3">+ Tambah Fakultas</a>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID Fakultas</th>
              <th>Nama Fakultas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataFakultas as $fakultas): ?>
              <tr>
                <td><?= $fakultas['id_fakultas'] ?></td>
                <td><?= $fakultas['nama_fakultas'] ?></td>
                <td>
                  <a href="index.php?page=fakultas&action=edit&id=<?= $fakultas['id_fakultas'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="index.php?page=fakultas&action=hapus&id=<?= $fakultas['id_fakultas'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
