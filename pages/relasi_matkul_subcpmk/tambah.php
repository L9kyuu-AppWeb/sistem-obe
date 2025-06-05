<?php
// Ambil data matakuliah untuk dropdown
$matakuliahs = $db->tampilData('matakuliah', [
    'kolom' => 'id_matakuliah, kode, keterangan',
    'orderBy' => 'kode'
]);

// Ambil data CPL-CPMK-SubCPMK pakai joinTableMulti
$select = "
    cpl.kode AS kode_cpl, cpl.keterangan AS ket_cpl,
    cpmk.kode AS kode_cpmk, cpmk.keterangan AS ket_cpmk,
    sub_cpmk.id_sub_cpmk, sub_cpmk.kode AS kode_sub, sub_cpmk.keterangan AS ket_sub
";

$tabelUtama = "sub_cpmk";

$joins = [
    ['tabel' => 'cpmk', 'kondisi' => 'sub_cpmk.id_cpmk = cpmk.id_cpmk'],
    ['tabel' => 'capaian_pembelajaran_lulusan cpl', 'kondisi' => 'cpmk.id_capaian_pembelajaran_lulusan = cpl.id_capaian_pembelajaran_lulusan']
];

$where = ''; // bisa diisi filter fakultas/program studi jika perlu
$params = [];

$data = $db->joinTableMulti($select, $tabelUtama, $joins, $where, $params);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_matakuliah = $_POST['id_matakuliah'] ?? '';
    $selected_sub_cpmks = $_POST['sub_cpmk'] ?? [];

    if (!$id_matakuliah) {
        echo "<div class='alert alert-danger'>Matakuliah harus dipilih.</div>";
    } elseif (empty($selected_sub_cpmks)) {
        echo "<div class='alert alert-danger'>Minimal pilih satu Sub CPMK.</div>";
    } else {
        $error = false;
        foreach ($selected_sub_cpmks as $id_sub_cpmk) {
            // Pastikan id_sub_cpmk adalah integer untuk keamanan
            $id_sub_cpmk = intval($id_sub_cpmk);
            $insert = $db->insertData(
                'matakuliah_sub_cpmk',
                ['id_matakuliah', 'id_sub_cpmk'], // Perbaiki nama kolom
                [$id_matakuliah, $id_sub_cpmk]
            );
            if (!$insert) {
                $error = true;
            }
        }
        if ($error) {
            echo "<div class='alert alert-danger'>Gagal menyimpan beberapa data.</div>";
        } else {
            echo $db->alert("Data berhasil disimpan", "index.php?page=relasi_matkul_subcpmk");
        }
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Matakuliah - Sub CPMK</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <form method="POST" action="">
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_matakuliah">Pilih Matakuliah</label>                        
                        <select name="id_matakuliah" id="id_matakuliah" class="form-control select2" required>
                            <option value="">-- Pilih Matakuliah --</option>
                            <?php foreach ($matakuliahs as $m) : ?>
                                <option value="<?= htmlspecialchars($m['id_matakuliah']) ?>">
                                    <?= htmlspecialchars($m['kode'] . ' - ' . $m['keterangan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            font-family: Arial, sans-serif;
                        }

                        thead {
                            background-color: #007bff;
                            color: white;
                        }

                        thead th {
                            padding: 10px;
                            text-align: left;
                            border: 1px solid #ddd;
                        }

                        tbody td {
                            padding: 8px 12px;
                            border: 1px solid #ddd;
                            vertical-align: top;
                        }

                        tbody tr:hover {
                            background-color: #f1f9ff;
                        }

                        /* Highlight CPL dan CPMK yang muncul pertama kali */
                        .group-header {
                            background-color: #e9f0ff;
                            font-weight: 600;
                        }

                        /* Checkbox kolom lebih sempit */
                        .checkbox-col {
                            width: 350px;
                        }
                    </style>

                    <?php
                    // Pertama, kita kelompokkan data berdasarkan CPL dan CPMK agar bisa hitung rowspan

                    $grouped = []; // Struktur: $grouped[cpl][cpmk][] = sub_cpmk

                    foreach ($data as $row) {
                        $cplKey = $row['kode_cpl'] . ' - ' . $row['ket_cpl'];
                        $cpmkKey = $row['kode_cpmk'] . ' - ' . $row['ket_cpmk'];

                        if (!isset($grouped[$cplKey])) {
                            $grouped[$cplKey] = [];
                        }
                        if (!isset($grouped[$cplKey][$cpmkKey])) {
                            $grouped[$cplKey][$cpmkKey] = [];
                        }
                        $grouped[$cplKey][$cpmkKey][] = [
                            'id_sub_cpmk' => $row['id_sub_cpmk'],
                            'kode_sub' => $row['kode_sub'],
                            'ket_sub' => $row['ket_sub'],
                        ];
                    }
                    ?>

                    <table border="1" cellpadding="8" cellspacing="0" width="100%">
                        <thead style="background:#007bff; color:white;">
                            <tr>
                                <th style="width: 30%;">CPL</th>
                                <th style="width: 30%;">CPMK</th>
                                <th>Sub CPMK (Centang)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grouped as $cpl => $cpmks): ?>
                                <?php
                                $cplRowCount = 0;
                                foreach ($cpmks as $cpmk => $subs) {
                                    $cplRowCount += count($subs);
                                }
                                $cplPrinted = false;
                                ?>
                                <?php foreach ($cpmks as $cpmk => $subs): ?>
                                    <?php $cpmkRowCount = count($subs);
                                    $cpmkPrinted = false; ?>
                                    <?php foreach ($subs as $sub): ?>
                                        <tr>
                                            <?php if (!$cplPrinted): ?>
                                                <td rowspan="<?= $cplRowCount ?>" style="background:#e9f0ff; font-weight:600;">
                                                    <?= htmlspecialchars($cpl) ?>
                                                </td>
                                                <?php $cplPrinted = true; ?>
                                            <?php endif; ?>

                                            <?php if (!$cpmkPrinted): ?>
                                                <td rowspan="<?= $cpmkRowCount ?>" style="background:#f0f5ff; font-weight:600;">
                                                    <?= htmlspecialchars($cpmk) ?>
                                                </td>
                                                <?php $cpmkPrinted = true; ?>
                                            <?php endif; ?>

                                            <td>
                                                <input type="checkbox" name="sub_cpmk[]" value="<?= htmlspecialchars($sub['id_sub_cpmk']) ?>">
                                                <?= htmlspecialchars($sub['kode_sub'] . ' - ' . $sub['ket_sub']) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <a href="index.php?page=relasi_matkul_subcpmk" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </section>
</div>