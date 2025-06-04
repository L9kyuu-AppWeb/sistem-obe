<?php
// Ambil semua Bahan Kajian
$dataBahanKajian = $db->tampilData('bahan_kajian', [
    'where' => 'id_fakultas = ? AND id_program_studi = ?',
    'params' => [$relo_id_fakultas, $relo_id_program_studi],
]);
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Relasi Bahan Kajian dan CPL</h1>
      <a href="index.php?page=bahan_kajian_detail&action=tambah" class="btn btn-primary mb-3">+ Tambah Relasi</a>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Bahan Kajian</th>
              <th>CPL Terkait</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataBahanKajian as $bk): 
              $relasi = $db->tampilData('bahan_kajian_detail d JOIN capaian_pembelajaran_lulusan c ON d.id_capaian_pembelajaran_lulusan = c.id_capaian_pembelajaran_lulusan', [
                'where' => 'd.id_bahan_kajian = ?',
                'params' => [$bk['id_bahan_kajian']]
              ]);
            ?>
              <tr>
                <td><?= htmlspecialchars($bk['keterangan']) ?></td>
                <td>
                  <ul>
                    <?php foreach ($relasi as $r): ?>
                      <li><?= htmlspecialchars($r['keterangan']) ?> 
                        <a href="index.php?page=bahan_kajian_detail&action=hapus&id=<?= $r['id_bahan_kajian_detail'] ?>" onclick="return confirm('Yakin hapus relasi ini?')" class="text-danger">(hapus)</a>
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
