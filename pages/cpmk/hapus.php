<?php
$id = $_GET['id'] ?? '';
if ($id) {
    $hapus = $db->deleteData('cpmk', 'id_cpmk = ? AND id_fakultas = ? AND id_program_studi = ?', [$id, $relo_id_fakultas, $relo_id_program_studi]);
    if ($hapus) {
        echo $db->alert("Data CPMK berhasil dihapus.", "index.php?page=cpmk");
    } else {
        echo $db->alert("Gagal menghapus data.", "index.php?page=cpmk");
    }
} else {
    header("Location: index.php?page=cpmk");
}
?>
