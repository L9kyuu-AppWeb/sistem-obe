<?php
$id = $_GET['id'] ?? 0;
$hapus = $db->deleteData('bahan_kajian', 'id_bahan_kajian = ?', [$id]);
echo $hapus ? $db->alert('Data berhasil dihapus', 'index.php?page=bahan_kajian') : $db->alert('Gagal menghapus data');