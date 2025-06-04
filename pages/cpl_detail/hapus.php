<?php
$id = $_GET['id'] ?? 0;
$hapus = $db->deleteData('capaian_pembelajaran_lulusan_detail', 'id_capaian_pembelajaran_lulusan_detail = ?', [$id]);

if ($hapus) {
    echo $db->alert('Data berhasil dihapus', 'index.php?page=cpl_detail');
} else {
    echo $db->alert('Gagal menghapus data', 'index.php?page=cpl_detail');
}
