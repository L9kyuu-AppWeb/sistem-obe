<?php
$dataProdi = $db->tampilData('program_studi', ['orderBy' => 'nama_prodi']);
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Data Program Studi</h1>
            <a href="index.php?page=program_studi&action=tambah" class="btn btn-primary mb-3">+ Tambah Program Studi</a>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Prodi</th>
                            <th>Nama Program Studi</th>
                            <th>Fakultas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataProdi as $prodi): ?>
                            <tr>
                                <td><?= htmlspecialchars($prodi['id_program_studi']) ?></td>
                                <td><?= htmlspecialchars($prodi['nama_prodi']) ?></td>
                                <td>
                                    <?php 
                                    // Tampilkan nama fakultas terkait
                                    echo $db->lihatData('fakultas', 'nama_fakultas', 'id_fakultas = ?', [$prodi['id_fakultas']]) ?? '-'; 
                                    ?>
                                </td>
                                <td>
                                    <a href="index.php?page=program_studi&action=edit&id=<?= $prodi['id_program_studi'] ?>" 
                                       class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?page=program_studi&action=hapus&id=<?= $prodi['id_program_studi'] ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($dataProdi)) : ?>
                            <tr><td colspan="4" class="text-center">Data kosong</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
