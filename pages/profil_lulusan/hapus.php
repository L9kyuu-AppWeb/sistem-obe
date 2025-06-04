<?php
$id = $_GET['id'] ?? null;
if ($id) {
    // Pastikan data sesuai dengan session user agar tidak bisa hapus data sembarangan
    $dataProfil = $db->tampilData('profil_lulusan', [
        'where' => 'id_profil_lulusan = :id AND id_fakultas = :id_fakultas AND id_program_studi = :id_program_studi',
        'params' => [
            ':id' => $id,
            ':id_fakultas' => $relo_id_fakultas,
            ':id_program_studi' => $relo_id_program_studi
        ]
    ]);

    if (!empty($dataProfil)) {
        $hapus = $db->deleteData('profil_lulusan', 'id_profil_lulusan = :id', [':id' => $id]);

        if ($hapus) {
            echo $db->alert("Data berhasil dihapus", "index.php?page=profil_lulusan");
        } else {
            echo $db->alert("Gagal menghapus data", "index.php?page=profil_lulusan");
        }
    } else {
        echo $db->alert("Data tidak ditemukan atau Anda tidak memiliki akses.", "index.php?page=profil_lulusan");
    }
} else {
    header("Location: index.php?page=profil_lulusan");
    exit;
}
