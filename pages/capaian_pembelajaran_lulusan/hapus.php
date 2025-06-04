<?php
$id = $_GET['id'] ?? null;
if ($id) {
  $hapus = $db->deleteData('capaian_pembelajaran_lulusan', 'id_capaian_pembelajaran_lulusan = ? AND id_fakultas = ? AND id_program_studi = ?', [$id, $relo_id_fakultas, $relo_id_program_studi]);
  echo $hapus
    ? $db->alert("Data berhasil dihapus", "index.php?page=capaian_pembelajaran_lulusan")
    : "<div class='alert alert-danger'>Gagal menghapus data.</div>";
}
?>
