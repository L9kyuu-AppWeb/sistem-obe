<?php
// Ambil semua CPL
$dataCPL = $db->tampilData('capaian_pembelajaran_lulusan', [
    'where' => 'id_fakultas = ? AND id_program_studi = ?',
    'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);

?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Relasi CPL dan Profil Lulusan</h1>
      <a href="index.php?page=cpl_detail&action=tambah" class="btn btn-primary mb-3">+ Tambah Relasi</a>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>CPL</th>
              <th>Profil Lulusan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataCPL as $cpl): 
              $relasi = $db->tampilData('capaian_pembelajaran_lulusan_detail d JOIN profil_lulusan p ON d.id_profil_lulusan = p.id_profil_lulusan', [
                'where' => 'd.id_capaian_pembelajaran_lulusan = ?',
                'params' => [$cpl['id_capaian_pembelajaran_lulusan']]
              ]);
            ?>
              <tr>
                <td><?= htmlspecialchars($cpl['keterangan']) ?></td>
                <td>
                  <ul>
                    <?php foreach ($relasi as $r): ?>
                      <li><?= htmlspecialchars($r['keterangan']) ?> 
                        <a href="index.php?page=cpl_detail&action=hapus&id=<?= $r['id_capaian_pembelajaran_lulusan_detail'] ?>" onclick="return confirm('Yakin hapus relasi ini?')" class="text-danger">(hapus)</a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </td>                
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
