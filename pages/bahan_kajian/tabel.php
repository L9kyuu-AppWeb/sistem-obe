<?php
$dataBahanKajian = $db->tampilData('bahan_kajian', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi]
]);
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Data Bahan Kajian</h1>
      <a href="index.php?page=bahan_kajian&action=tambah" class="btn btn-primary mb-3">+ Tambah Bahan Kajian</a>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataBahanKajian as $bk): ?>
              <tr>
                <td><?= htmlspecialchars($bk['kode']) ?></td>
                <td><?= htmlspecialchars($bk['keterangan']) ?></td>
                <td>
                  <a href="index.php?page=bahan_kajian&action=edit&id=<?= $bk['id_bahan_kajian'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="index.php?page=bahan_kajian&action=hapus&id=<?= $bk['id_bahan_kajian'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
