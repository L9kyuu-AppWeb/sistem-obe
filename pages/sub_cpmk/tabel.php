<div class="content-wrapper">
<?php
// Ambil data CPMK berdasarkan fakultas dan program studi
$dataCPMKRaw = $db->tampilData('cpmk', [
  'where' => 'id_fakultas = ? AND id_program_studi = ?',
  'params' => [$relo_id_fakultas, $relo_id_program_studi]
]);

// Siapkan array baru untuk CPMK dan Sub-CPMK terkait
$dataCPMK = [];
foreach ($dataCPMKRaw as $cpmk) {
  $id = $cpmk['id_cpmk'];

  // Ambil sub_cpmk per CPMK
  $subCpmkList = $db->tampilData('sub_cpmk', [
    'where' => 'id_cpmk = ?',
    'params' => [$id]
  ]);

  $dataCPMK[$id] = [
    'id_cpmk' => $id,
    'kode' => $cpmk['kode'],
    'keterangan' => $cpmk['keterangan'],
    'sub_cpmk' => $subCpmkList
  ];
}
?>

<section class="content-header">
  <h1>Data Sub CPMK Berdasarkan CPMK</h1>
  <a href="index.php?page=sub_cpmk&action=tambah" class="btn btn-primary">+ Tambah Sub CPMK</a>
</section>

<section class="content">
  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="35%">Capaian Pembelajaran Mata Kuliah (CPMK)</th>
            <th>Daftar Sub CPMK</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dataCPMK as $cpmk): ?>
            <tr>
              <td>
                <div>
                  <span class="badge bg-primary"><?= htmlspecialchars($cpmk['kode']) ?></span><br>
                  <small><?= nl2br(htmlspecialchars($cpmk['keterangan'])) ?></small>
                </div>
              </td>
              <td>
                <?php if (!empty($cpmk['sub_cpmk'])): ?>
                  <ul class="list-unstyled">
                    <?php foreach ($cpmk['sub_cpmk'] as $sub): ?>
                      <li class="mb-2">
                        <div>
                          <span class="badge bg-success"><?= htmlspecialchars($sub['kode']) ?></span>
                          <?= htmlspecialchars($sub['keterangan']) ?>
                        </div>
                        <div class="mt-1">
                          <a href="index.php?page=sub_cpmk&action=edit&id=<?= $sub['id_sub_cpmk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                          <a href="index.php?page=sub_cpmk&action=hapus&id=<?= $sub['id_sub_cpmk'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php else: ?>
                  <i class="text-muted">Belum ada Sub CPMK</i>
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
