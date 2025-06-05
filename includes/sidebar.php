<?php
$currentPage = $_GET['page'] ?? 'dashboard';
$currentAction = $_GET['action'] ?? '';

// Ambil menu yang bisa diakses user sesuai role
$allowedMenus = $role_pages[$role] ?? [];

function isActiveMenu($menuName, $currentPage)
{
    return $menuName === $currentPage ? 'active' : '';
}

function isMenuOpen($menuName, $currentPage)
{
    return $menuName === $currentPage ? 'menu-open' : '';
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
        <img src="dist/img/logo-obe.png" alt="OBE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">OBE</span>
    </a>

    <div class="sidebar">
        <!-- User Info -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $role ?></a>
            </div>
        </div> -->

        <?php
        $nama = "Nine";
        $keterangan = "Administrator";
        ?>

        <style>
            /* Gambar besar dan teks putih saat sidebar penuh */
            .custom-user-panel .user-img {
                width: 160px;
                height: 160px;
                object-fit: cover;
            }

            .custom-user-panel .user-name {
                font-size: 1.1rem;
                color: #fff;
            }

            .custom-user-panel .user-role {
                font-size: 0.85rem;
                color: #fff;
            }

            /* Ketika sidebar diminimalkan, sembunyikan teks dan kecilkan gambar */
            .sidebar-mini.sidebar-collapse .custom-user-panel {
                align-items: center;
                padding: 0 !important;
            }

            .sidebar-mini.sidebar-collapse .custom-user-panel .user-img {
                width: 35px;
                height: 35px;
            }

            .sidebar-mini.sidebar-collapse .custom-user-panel .info {
                display: none;
            }
        </style>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column align-items-center text-center custom-user-panel">
            <div class="image">
                <img src="dist/img/user2-160x160.png" class="img-circle elevation-2 user-img" alt="User Image">
            </div>
            <div class="info mt-2 text-white">
                <div class="fw-bold user-name"><?= $nama ?></div>
                <div class="user-role"><?= $keterangan ?></div>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <?php if (in_array('dashboard', $allowedMenus)) : ?>
                    <li class="nav-item">
                        <a href="index.php?page=dashboard" class="nav-link <?= isActiveMenu('dashboard', $currentPage) ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- About -->
                <?php if (in_array('about', $allowedMenus)) : ?>
                    <li class="nav-item">
                        <a href="index.php?page=about" class="nav-link <?= isActiveMenu('about', $currentPage) ?>">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>About</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Mahasiswa Menu -->
                <?php if (in_array('mahasiswa', $allowedMenus)) : ?>
                    <li class="nav-item <?= isMenuOpen('mahasiswa', $currentPage) ?>">
                        <a href="#" class="nav-link <?= isActiveMenu('mahasiswa', $currentPage) ?>">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Mahasiswa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=mahasiswa"
                                    class="nav-link <?= ($currentPage === 'mahasiswa' && $currentAction === '') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Mahasiswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=mahasiswa&action=tambah"
                                    class="nav-link <?= ($currentPage === 'mahasiswa' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Mahasiswa</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Fakultas Menu -->
                <?php if (in_array('fakultas', $allowedMenus)) : ?>
                    <li class="nav-item <?= isMenuOpen('fakultas', $currentPage) ?>">
                        <a href="#" class="nav-link <?= isActiveMenu('fakultas', $currentPage) ?>">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                Fakultas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=fakultas"
                                    class="nav-link <?= ($currentPage === 'fakultas' && $currentAction === '') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Fakultas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=fakultas&action=tambah"
                                    class="nav-link <?= ($currentPage === 'fakultas' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Fakultas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (in_array('program_studi', $allowedMenus)) : ?>
                    <li class="nav-item <?= isMenuOpen('program_studi', $currentPage) ?>">
                        <a href="#" class="nav-link <?= isActiveMenu('program_studi', $currentPage) ?>">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Program Studi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=program_studi"
                                    class="nav-link <?= ($currentPage === 'program_studi' && $currentAction === '') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Program Studi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=program_studi&action=tambah"
                                    class="nav-link <?= ($currentPage === 'program_studi' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Program Studi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Profil Lulusan Menu -->
                <?php if (in_array('profil_lulusan', $allowedMenus)) : ?>
                    <li class="nav-item <?= ($currentPage === 'profil_lulusan') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($currentPage === 'profil_lulusan') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Profil Lulusan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=profil_lulusan"
                                    class="nav-link <?= ($currentPage === 'profil_lulusan' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Profil Lulusan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=profil_lulusan&action=tambah"
                                    class="nav-link <?= ($currentPage === 'profil_lulusan' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Profil Lulusan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (in_array('capaian_pembelajaran_lulusan', $allowedMenus)) : ?>
                    <li
                        class="nav-item <?= ($currentPage === 'capaian_pembelajaran_lulusan' || $currentPage === 'cpl_detail') ? 'menu-open' : '' ?>">
                        <a href="#"
                            class="nav-link <?= ($currentPage === 'capaian_pembelajaran_lulusan' || $currentPage === 'cpl_detail') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-bullseye"></i>
                            <p>
                                CPL
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Data CPL -->
                            <li class="nav-item">
                                <a href="index.php?page=capaian_pembelajaran_lulusan"
                                    class="nav-link <?= ($currentPage === 'capaian_pembelajaran_lulusan' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Data CPL</p>
                                </a>
                            </li>

                            <!-- Tambah CPL -->
                            <li class="nav-item">
                                <a href="index.php?page=capaian_pembelajaran_lulusan&action=tambah"
                                    class="nav-link <?= ($currentPage === 'capaian_pembelajaran_lulusan' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah CPL</p>
                                </a>
                            </li>

                            <!-- Relasi CPL & Profil -->
                            <li class="nav-item">
                                <a href="index.php?page=cpl_detail"
                                    class="nav-link <?= ($currentPage === 'cpl_detail' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Relasi CPL & Profil</p>
                                </a>
                            </li>

                            <!-- Tambah Relasi -->
                            <li class="nav-item">
                                <a href="index.php?page=cpl_detail&action=tambah"
                                    class="nav-link <?= ($currentPage === 'cpl_detail' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Relasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (in_array('bahan_kajian', $allowedMenus)) : ?>
                    <li
                        class="nav-item <?= ($currentPage === 'bahan_kajian' || $currentPage === 'bahan_kajian_detail') ? 'menu-open' : '' ?>">
                        <a href="#"
                            class="nav-link <?= ($currentPage === 'bahan_kajian' || $currentPage === 'bahan_kajian_detail') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Bahan Kajian
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Data Bahan Kajian -->
                            <li class="nav-item">
                                <a href="index.php?page=bahan_kajian"
                                    class="nav-link <?= ($currentPage === 'bahan_kajian' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Data Bahan Kajian</p>
                                </a>
                            </li>

                            <!-- Tambah Bahan Kajian -->
                            <li class="nav-item">
                                <a href="index.php?page=bahan_kajian&action=tambah"
                                    class="nav-link <?= ($currentPage === 'bahan_kajian' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Bahan Kajian</p>
                                </a>
                            </li>

                            <!-- Relasi Bahan Kajian & CPL -->
                            <li class="nav-item">
                                <a href="index.php?page=bahan_kajian_detail"
                                    class="nav-link <?= ($currentPage === 'bahan_kajian_detail' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Relasi BK & CPL</p>
                                </a>
                            </li>

                            <!-- Tambah Relasi -->
                            <li class="nav-item">
                                <a href="index.php?page=bahan_kajian_detail&action=tambah"
                                    class="nav-link <?= ($currentPage === 'bahan_kajian_detail' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Relasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (in_array('cpmk', $allowedMenus)) : ?>
                    <li class="nav-item <?= ($currentPage === 'cpmk') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($currentPage === 'cpmk') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>
                                CPMK
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=cpmk"
                                    class="nav-link <?= ($currentPage === 'cpmk' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data CPMK</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=cpmk&action=tambah"
                                    class="nav-link <?= ($currentPage === 'cpmk' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah CPMK</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (in_array('sub_cpmk', $allowedMenus)) : ?>
                    <li class="nav-item <?= ($currentPage === 'sub_cpmk') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($currentPage === 'sub_cpmk') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>
                                Sub CPMK
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=sub_cpmk"
                                    class="nav-link <?= ($currentPage === 'sub_cpmk' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Sub CPMK</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=sub_cpmk&action=tambah"
                                    class="nav-link <?= ($currentPage === 'sub_cpmk' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Sub CPMK</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Dosen Menu -->
                <?php if (in_array('dosen', $allowedMenus)) : ?>
                    <li class="nav-item <?= ($currentPage === 'dosen') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($currentPage === 'dosen') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Dosen
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Data Dosen -->
                            <li class="nav-item">
                                <a href="index.php?page=dosen"
                                    class="nav-link <?= ($currentPage === 'dosen' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Dosen</p>
                                </a>
                            </li>
                            <!-- Tambah Dosen -->
                            <li class="nav-item">
                                <a href="index.php?page=dosen&action=tambah"
                                    class="nav-link <?= ($currentPage === 'dosen' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Dosen</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Organisasi Mata Kuliah Menu -->
                <?php if (in_array('organisasi_matakuliah', $allowedMenus)) : ?>
                    <li class="nav-item <?= ($currentPage === 'organisasi_matakuliah') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($currentPage === 'organisasi_matakuliah') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>
                                Organisasi Mata Kuliah
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=organisasi_matakuliah"
                                    class="nav-link <?= ($currentPage === 'organisasi_matakuliah' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Organisasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=organisasi_matakuliah&action=tambah"
                                    class="nav-link <?= ($currentPage === 'organisasi_matakuliah' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Organisasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (in_array('matakuliah', $allowedMenus)) : ?>
                    <li class="nav-item <?= ($currentPage === 'matakuliah') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($currentPage === 'matakuliah') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Matakuliah
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=matakuliah"
                                    class="nav-link <?= ($currentPage === 'matakuliah' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Matakuliah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=matakuliah&action=tambah"
                                    class="nav-link <?= ($currentPage === 'matakuliah' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Matakuliah</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (in_array('relasi_matkul_subcpmk', $allowedMenus)) : ?>
                    <li class="nav-item <?= ($currentPage === 'relasi_matkul_subcpmk') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= ($currentPage === 'relasi_matkul_subcpmk') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                Relasi Matkul - Sub CPMK
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?page=relasi_matkul_subcpmk"
                                    class="nav-link <?= ($currentPage === 'relasi_matkul_subcpmk' && empty($currentAction)) ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Relasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=relasi_matkul_subcpmk&action=tambah"
                                    class="nav-link <?= ($currentPage === 'relasi_matkul_subcpmk' && $currentAction === 'tambah') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Relasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>