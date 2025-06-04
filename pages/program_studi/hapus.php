<?php
$id = $_GET['id'] ?? null;
if (!$id) {
    echo $db->alert("ID Program Studi tidak ditemukan", "index.php?page=program_studi");
    exit;
}

$hapus = $db->deleteData('program_studi', 'id_program_studi = ?', [$id]);

if ($hapus) {
    echo $db->alert("Data berhasil dihapus", "index.php?page=program_studi");
} else {
    echo $db->alert("Gagal menghapus data", "index.php?page=program_studi");
}
