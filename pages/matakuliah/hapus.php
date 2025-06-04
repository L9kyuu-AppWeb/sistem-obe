<?php
$id = $_GET['id'] ?? null;

if (!$id) {
    echo $db->alert("ID matakuliah tidak ditemukan.", "index.php?page=matakuliah");
    exit;
}

// Hapus data matakuliah berdasarkan id
$delete = $db->deleteData('matakuliah', 'id_matakuliah = ?', [$id]);

if ($delete) {
    echo $db->alert("Data matakuliah berhasil dihapus.", "index.php?page=matakuliah");
} else {
    echo $db->alert("Gagal menghapus data matakuliah.", "index.php?page=matakuliah");
}
?>
