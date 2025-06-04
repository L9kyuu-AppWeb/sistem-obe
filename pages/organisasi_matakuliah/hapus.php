<?php
$id = $_GET['id'] ?? '';

if ($id) {
  $db->deleteData('organisasi_matakuliah', 'id_organisasi_matakuliah = ?', [$id]);
  echo $db->alert('Data berhasil dihapus', 'index.php?page=organisasi_matakuliah');
} else {
  echo $db->alert('ID tidak ditemukan', 'index.php?page=organisasi_matakuliah');
}
