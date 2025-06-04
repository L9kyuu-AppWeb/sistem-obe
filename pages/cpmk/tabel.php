<div class="content-wrapper">
<?php
// Contoh koneksi DB dan class $db sudah ada sebelumnya
// Variabel $relo_id_fakultas dan $relo_id_program_studi sudah didefinisikan

// Ambil data CPL unik berdasarkan fakultas dan program studi
$dataCPLRaw = $db->tampilData('capaian_pembelajaran_lulusan', [
  'kolom' => 'id_capaian_pembelajaran_lulusan, kode, keterangan',
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi]
]);

// Siapkan array baru untuk CPL unik dengan CPMK terkait
$dataCPL = [];
foreach ($dataCPLRaw as $cpl) {
  $id = $cpl['id_capaian_pembelajaran_lulusan'];

  // Ambil CPMK hanya sekali per CPL
  $cpmkList = $db->tampilData('cpmk', [
    'where' => 'id_capaian_pembelajaran_lulusan = ?',
    'params' => [$id]
  ]);

  // Masukkan CPL dengan data CPMK terkait ke array result
  $dataCPL[$id] = [
    'id_capaian_pembelajaran_lulusan' => $id,
    'kode' => $cpl['kode'],
    'keterangan' => $cpl['keterangan'],
    'cpmk' => $cpmkList
  ];
}
?>


  <section class="content-header">
    <h1>Data CPMK Berdasarkan CPL</h1>
    <a href="index.php?page=cpmk&action=tambah" class="btn btn-primary">+ Tambah CPMK</a>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="35%">Capaian Pembelajaran Lulusan (CPL)</th>
              <th>Daftar CPMK</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataCPL as $cpl): ?>
              <tr>
                <td>
                  <div>
                    <span class="badge bg-primary"><?= htmlspecialchars($cpl['kode']) ?></span><br>
                    <small><?= nl2br(htmlspecialchars($cpl['keterangan'])) ?></small>
                  </div>
                </td>
                <td>
                  <?php if (!empty($cpl['cpmk'])): ?>
                    <ul class="list-unstyled">
                      <?php foreach ($cpl['cpmk'] as $cpmk): ?>
                        <li class="mb-2">
                          <div>
                            <span class="badge bg-success"><?= htmlspecialchars($cpmk['kode']) ?></span>
                            <?= htmlspecialchars($cpmk['keterangan']) ?>
                          </div>
                          <div class="mt-1">
                            <a href="index.php?page=cpmk&action=edit&id=<?= $cpmk['id_cpmk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="index.php?page=cpmk&action=hapus&id=<?= $cpmk['id_cpmk'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <i class="text-muted">Belum ada CPMK</i>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>