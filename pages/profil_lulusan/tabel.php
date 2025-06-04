<?php
// Ambil data profil lulusan sesuai fakultas dan program studi user session
$dataProfilLulusan = $db->tampilData('profil_lulusan', [
    'kolom' => 'id_profil_lulusan, kode, keterangan', // ambil hanya kolom yang dibutuhkan
    'where' => 'id_fakultas = ? AND id_program_studi = ?',
    'params' => [
        $relo_id_fakultas, $relo_id_program_studi
    ]
]);
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Data Profil Lulusan</h1>
      <a href="index.php?page=profil_lulusan&action=tambah" class="btn btn-primary mb-3">+ Tambah Profil Lulusan</a>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID Profil</th>
              <th>Kode</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataProfilLulusan as $profil): ?>
              <tr>
                <td><?= $profil['id_profil_lulusan'] ?></td>
                <td><?= htmlspecialchars($profil['kode']) ?></td>
                <td><?= htmlspecialchars($profil['keterangan']) ?></td>
                <td>
                  <a href="index.php?page=profil_lulusan&action=edit&id=<?= $profil['id_profil_lulusan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="index.php?page=profil_lulusan&action=hapus&id=<?= $profil['id_profil_lulusan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($dataProfilLulusan)): ?>
              <tr><td colspan="4" class="text-center">Data profil lulusan tidak ditemukan.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
