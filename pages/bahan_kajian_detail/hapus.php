<?php
$id = $_GET['id'] ?? 0;
$id_bahan_kajian = $_GET['id_bahan_kajian'] ?? 0;
$hapus = $db->deleteData('bahan_kajian_detail', 'id_bahan_kajian_detail = ?', [$id]);
echo $hapus ? $db->alert('Relasi berhasil dihapus', 'index.php?page=bahan_kajian_detail&id=' . $id_bahan_kajian) : $db->alert('Gagal menghapus');
