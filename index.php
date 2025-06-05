<?php
include 'databases/koneksi.php';
session_start();
// Misal role user disimpan di session (contoh)
$role = $_SESSION['role'] ?? 'mahasiswa'; // isian (admin/mahasiswa)
$relo_id_fakultas = $_SESSION['relo_id_fakultas'] ?? '3'; // isian (admin/mahasiswa)
$relo_id_program_studi = $_SESSION['relo_id_program_studi'] ?? '3'; // isian (admin/mahasiswa)

// Ambil parameter page dan action
$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'tabel';

// Definisikan halaman statis yang boleh diakses semua role (atau buat per role kalau perlu)
$static_pages = ['dashboard', 'about'];

// Definisikan akses role ke modul tertentu
$role_pages = [
    'admin' => ['mahasiswa', 'dosen', 'dashboard', 'about'],  // admin boleh akses semua
    'mahasiswa' => ['dashboard', 'about', 'fakultas', 'program_studi', 'profil_lulusan', 'capaian_pembelajaran_lulusan', 'cpl_detail', 'bahan_kajian', 'bahan_kajian_detail', 'dosen', 'organisasi_matakuliah', 'matakuliah', 'cpmk', 'sub_cpmk', 'relasi_matkul_subcpmk']                 // mahasiswa hanya mahasiswa & about
];

// Cek akses halaman
$allowed_pages = $role_pages[$role] ?? [];

if (in_array($page, $static_pages)) {
    // halaman statis
    if (!in_array($page, $allowed_pages)) {
        $content_file = 'pages/404.php';
    } else {
        $content_file = "pages/$page.php";
    }
} else {
    // halaman modul (mahasiswa, dosen, dll)
    if (!in_array($page, $allowed_pages)) {
        $content_file = 'pages/404.php';
    } else {
        $valid_actions = ['tabel', 'tambah', 'edit', 'hapus'];
        $file_path = "pages/$page/$action.php";
        $content_file = (in_array($action, $valid_actions) && file_exists($file_path))
            ? $file_path
            : 'pages/404.php';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistem Obe</title>
    <link rel="icon" type="image/x-icon" href="dist/img/favicon.ico">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <div class="wrapper">

        <?php include 'includes/header.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <?php include $content_file; ?>
        <?php include 'includes/footer.php'; ?>

    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
</body>

</html>