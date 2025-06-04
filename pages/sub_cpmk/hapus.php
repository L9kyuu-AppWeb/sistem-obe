<?php
$id = $_GET['id'] ?? '';
if ($id) {
  $hapus = $db->deleteData('sub_cpmk', 'id_sub_cpmk = ? AND id_fakultas = ? AND id_program_studi = ?', [$id, $relo_id_fakultas, $relo_id_program_studi]);
  if ($hapus) {
    echo $db->alert("Data berhasil dihapus.", "index.php?page=sub_cpmk");
  } else {
    echo $db->alert("Gagal menghapus data.", "index.php?page=sub_cpmk");
  }
}
?>
