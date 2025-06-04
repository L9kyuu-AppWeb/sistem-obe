<?php
// Base page parameter
$basePage = 'index.php?page=relasi_matkul_subcpmk';
// Ambil input pencarian dan halaman saat ini
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
if ($page < 1) $page = 1;

$limit = 20;
$offset = ($page - 1) * $limit;

// Pastikan variabel ini sudah didefinisikan sesuai konteks Anda
// Contoh:
// $relo_id_fakultas = <nilai_fakultas>;
// $relo_id_program_studi = <nilai_prodi>;

$whereClauses = ["m.id_fakultas = ?", "m.id_program_studi = ?"];
$params = [$relo_id_fakultas, $relo_id_program_studi];

if ($search !== '') {
    $whereClauses[] = "(m.kode LIKE ? OR m.keterangan LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$where = implode(" AND ", $whereClauses);

// Hitung total data (count) menggunakan queryBebas
$countSql = "SELECT COUNT(DISTINCT m.id_matakuliah) as total FROM matakuliah_sub_cpmk rel
    JOIN matakuliah m ON rel.id_matakuliah = m.id_matakuliah
    JOIN sub_cpmk sub ON rel.id_sub_cpmk = sub.id_sub_cpmk
    JOIN cpmk ON sub.id_cpmk = cpmk.id_cpmk
    JOIN capaian_pembelajaran_lulusan cpl ON cpmk.id_capaian_pembelajaran_lulusan = cpl.id_capaian_pembelajaran_lulusan
    WHERE $where
";

$countResult = $db->queryBebas($countSql, $params);
$totalData = isset($countResult[0]['total']) ? (int)$countResult[0]['total'] : 0;
$totalPages = (int)ceil($totalData / $limit);

// SELECT data dengan pagination, injection LIMIT dan OFFSET aman karena integer
$select = "
    m.id_matakuliah,
    m.kode AS kode_matakuliah,
    m.keterangan AS nama_matakuliah,
    cpl.kode AS kode_cpl,
    cpl.keterangan AS keterangan_cpl,
    cpmk.kode AS kode_cpmk,
    cpmk.keterangan AS keterangan_cpmk,
    sub.id_sub_cpmk,
    sub.kode AS kode_sub_cpmk,
    sub.keterangan AS keterangan_sub_cpmk
";

$dataSql = "SELECT $select FROM matakuliah_sub_cpmk rel
    JOIN matakuliah m ON rel.id_matakuliah = m.id_matakuliah
    JOIN sub_cpmk sub ON rel.id_sub_cpmk = sub.id_sub_cpmk
    JOIN cpmk ON sub.id_cpmk = cpmk.id_cpmk
    JOIN capaian_pembelajaran_lulusan cpl ON cpmk.id_capaian_pembelajaran_lulusan = cpl.id_capaian_pembelajaran_lulusan
    WHERE $where
    ORDER BY m.kode, cpl.kode, cpmk.kode, sub.kode
    LIMIT $limit OFFSET $offset
";

$data = $db->queryBebas($dataSql, $params);

// Selanjutnya data dapat digunakan sama seperti kode tabel dan pagination yang sudah Anda miliki.
// Jangan lupa menampilkan form pencarian dan navigasi halaman seperti diminta sebelumnya.
?>


<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Relasi Matakuliah - Sub CPMK</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="index.php?page=relasi_matkul_subcpmk&action=tambah" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Relasi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Konten Utama -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form method="GET" action="index.php">
                        <input type="hidden" name="page" value="relasi_matkul_subcpmk">
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari Matakuliah"
                                value="<?= htmlspecialchars($search) ?>"
                                autocomplete="off">
                            <input type="hidden" name="page_num" value="1"> <!-- Reset page to 1 when searching -->
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 25%;">Mata Kuliah</th>
                                    <th style="width: 25%;">CPL</th>
                                    <th style="width: 25%;">CPMK</th>
                                    <th style="width: 25%;">Sub CPMK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data): ?>
                                    <?php
                                    // Kelompokkan data berdasar matakuliah, CPL, CPMK
                                    $grouped = [];
                                    foreach ($data as $row) {
                                        $mkKey = $row['id_matakuliah'];
                                        $cplKey = $row['kode_cpl'];
                                        $cpmkKey = $row['kode_cpmk'];
                                        $grouped[$mkKey]['info'] = [
                                            'kode_matakuliah' => $row['kode_matakuliah'],
                                            'nama_matakuliah' => $row['nama_matakuliah'],
                                        ];
                                        $grouped[$mkKey]['cpl'][$cplKey]['info'] = [
                                            'kode_cpl' => $row['kode_cpl'],
                                            'keterangan_cpl' => $row['keterangan_cpl'],
                                        ];
                                        $grouped[$mkKey]['cpl'][$cplKey]['cpmk'][$cpmkKey]['info'] = [
                                            'kode_cpmk' => $row['kode_cpmk'],
                                            'keterangan_cpmk' => $row['keterangan_cpmk'],
                                        ];
                                        $grouped[$mkKey]['cpl'][$cplKey]['cpmk'][$cpmkKey]['sub_cpmk'][] = [
                                            'kode_sub_cpmk' => $row['kode_sub_cpmk'],
                                            'keterangan_sub_cpmk' => $row['keterangan_sub_cpmk'],
                                        ];
                                    }

                                    foreach ($grouped as $mkId => $mkData):
                                        // Hitung total row untuk rowspan matakuliah
                                        $rowspanMatkul = 0;
                                        foreach ($mkData['cpl'] as $cplData) {
                                            foreach ($cplData['cpmk'] as $cpmkData) {
                                                $rowspanMatkul += count($cpmkData['sub_cpmk']);
                                            }
                                        }

                                        $firstMkRow = true;
                                        foreach ($mkData['cpl'] as $cplData):
                                            // Hitung total row untuk rowspan CPL
                                            $rowspanCpl = 0;
                                            foreach ($cplData['cpmk'] as $cpmkData) {
                                                $rowspanCpl += count($cpmkData['sub_cpmk']);
                                            }

                                            $firstCplRow = true;
                                            foreach ($cplData['cpmk'] as $cpmkData):
                                                // Hitung total row untuk rowspan CPMK
                                                $rowspanCpmk = count($cpmkData['sub_cpmk']);

                                                $firstCpmkRow = true;
                                                foreach ($cpmkData['sub_cpmk'] as $subCpmk):
                                    ?>
                                                    <tr>
                                                        <?php if ($firstMkRow): ?>
                                                            <td rowspan="<?= $rowspanMatkul ?>">
                                                                <strong><?= htmlspecialchars($mkData['info']['kode_matakuliah']) ?></strong><br>
                                                                <?= htmlspecialchars($mkData['info']['nama_matakuliah']) ?>
                                                            </td>
                                                        <?php endif; ?>

                                                        <?php if ($firstCplRow): ?>
                                                            <td rowspan="<?= $rowspanCpl ?>">
                                                                <strong><?= htmlspecialchars($cplData['info']['kode_cpl']) ?></strong><br>
                                                                <?= htmlspecialchars($cplData['info']['keterangan_cpl']) ?>
                                                            </td>
                                                        <?php endif; ?>

                                                        <?php if ($firstCpmkRow): ?>
                                                            <td rowspan="<?= $rowspanCpmk ?>">
                                                                <strong><?= htmlspecialchars($cpmkData['info']['kode_cpmk']) ?></strong><br>
                                                                <?= htmlspecialchars($cpmkData['info']['keterangan_cpmk']) ?>
                                                            </td>
                                                        <?php endif; ?>

                                                        <td>
                                                            <strong><?= htmlspecialchars($subCpmk['kode_sub_cpmk']) ?></strong><br>
                                                            <?= htmlspecialchars($subCpmk['keterangan_sub_cpmk']) ?>
                                                        </td>
                                                    </tr>
                                    <?php
                                                    $firstMkRow = false;
                                                    $firstCplRow = false;
                                                    $firstCpmkRow = false;
                                                endforeach;
                                            endforeach;
                                        endforeach;
                                    endforeach;
                                    ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada data relasi yang ditambahkan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page_num=1&search=<?= urlencode($search) ?>">First</a>
                                </li>
                                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page_num=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page_num=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($page == $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page_num=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                                </li>
                                <li class="page-item <?= ($page == $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page_num=<?= $totalPages ?>&search=<?= urlencode($search) ?>">Last</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>