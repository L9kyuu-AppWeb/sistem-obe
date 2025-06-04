<?php
$id = $_GET['id'] ?? '';
if ($id) {
  $db->deleteData('dosen', 'id_dosen = ?', [$id]);
  echo $db->alert("Data dosen berhasil dihapus", "index.php?page=dosen");
} else {
  echo $db->alert("ID tidak ditemukan", "index.php?page=dosen");
}
