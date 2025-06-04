<?php
$dataCPL = $db->tampilData('capaian_pembelajaran_lulusan', [
    'kolom' => 'id_capaian_pembelajaran_lulusan, kode, keterangan',
    'where' => 'id_fakultas = ? AND id_program_studi = ?',
    'params' => [$relo_id_fakultas, $relo_id_program_studi]
]);
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Capaian Pembelajaran Lulusan</h1>
      <a href="index.php?page=capaian_pembelajaran_lulusan&action=tambah" class="btn btn-primary mb-3">+ Tambah CPL</a>
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
            <?php foreach ($dataCPL as $row): ?>
              <tr>
                <td><?= $row['kode'] ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td>
                  <a href="index.php?page=capaian_pembelajaran_lulusan&action=edit&id=<?= $row['id_capaian_pembelajaran_lulusan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="index.php?page=capaian_pembelajaran_lulusan&action=hapus&id=<?= $row['id_capaian_pembelajaran_lulusan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($dataCPL)): ?>
              <tr><td colspan="3" class="text-center">Data tidak ditemukan.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
