<?php
// Ambil id dari query string
$id = $_GET['id'] ?? null;

if (!$id) {
    echo $db->alert("ID fakultas tidak ditemukan.", "index.php?page=fakultas");
    exit;
}

// Hapus data fakultas berdasarkan id
$hapus = $db->deleteData('fakultas', 'id_fakultas = ?', [$id]);

if ($hapus) {
    echo $db->alert("Data berhasil dihapus.", "index.php?page=fakultas");
} else {
    echo $db->alert("Gagal menghapus data.", "index.php?page=fakultas");
}
