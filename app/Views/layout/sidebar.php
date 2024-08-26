<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('images/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">EVI - v2</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('images/user.png'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= htmlentities(session()->get('name')) ?> <br> <?= htmlentities(session()->get('id')) ?></a>
            </div>
        </div>

        <!-- Sidebar Search Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if (session()->get('id') == '1' || session()->get('id') ==  '2' || session()->get('id') == '3') { ?>
                    <li class="nav-item <?= $act = $subjudul == 'Dashboard' ? 'menu-open' : ''; ?>">
                        <a href="<?= base_url('dashboard/admin'); ?>" class="nav-link <?= $act = $judul == 'Dashboard' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-tv mr-2"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $act = $judul == 'Pengawasan' ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?= $act = $judul == 'Pengawasan' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-file-earmark mr-2"></i>
                            <p>
                                Pengawasan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengawasan/admin'); ?>" class="nav-link <?= $act = $subjudul == 'Nilai Pengawasan' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nilai Pengawasan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= $act = $subjudul == 'rbac' ? 'menu-open' : ''; ?>">
                        <a href="<?= base_url('user/rbac'); ?>" class="nav-link <?= $act = $judul == 'Rbac' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-gear-wide-connected mr-2"></i>
                            <p>
                                RBAC
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $act = $subjudul == 'klasifikasi' ? 'menu-open' : ''; ?>">
                        <a href="<?= base_url('klasifikasi'); ?>" class="nav-link <?= $act = $judul == 'klasifikasi' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-list-task mr-2"></i>
                            <p>
                                Klasifikasi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('user'); ?>" class="nav-link <?= $act = $judul == 'User' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-person mr-2"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                <?php } elseif (session()->get('id') !== '1') { ?>
                    <li class="nav-item <?= $act = $judul == 'Dashboard' ? 'menu-open' : ''; ?>">
                        <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= $act = $judul == 'Dashboard' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-tv mr-2"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $act = $judul == 'Arsip' ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?= $act = $judul == 'Arsip' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-file-earmark mr-2"></i>
                            <p>
                                Arsip Aktif
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('berkas'); ?>" class="nav-link <?= $act = $subjudul == 'Berkas' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Berkas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('arsip'); ?>" class="nav-link <?= $act = $subjudul == 'Item Berkas' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Item Berkas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('arsip/daftarArsip'); ?>" class="nav-link <?= $act = $subjudul == 'Daftar Arsip' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Arsip</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= $act = $judul == 'Inaktif' ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?= $act = $judul == 'Inaktif' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-file-earmark mr-2"></i>
                            <p>
                                Arsip Inaktif
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('BerkasInaktif'); ?>" class="nav-link <?= $act = $subjudul == 'Berkas Inaktif' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Berkas</p>
                                </a>
                            </li>
                            <li class="nav-item <?= $act = $subjudul == 'Item Berkas Inaktif' ? 'active' : ''; ?>">
                                <a href="<?= base_url('arsipInaktif'); ?>" class="nav-link <?= $act = $subjudul == 'Item Arsip Inaktif' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Item Berkas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('arsipInaktif/daftarArsip'); ?>" class="nav-link <?= $act = $subjudul == 'Daftar Arsip Inaktif' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Arsip</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= $act = $judul == 'Item Vital' ? 'active' : ''; ?>">
                        <a href="<?= base_url('arsipVital'); ?>" class="nav-link <?= $act = $judul == 'Arsip Vital' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-shield mr-2"></i>
                            <p>
                                Arsip Vital
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?= $act = $judul == 'Sirkulasi' ? 'active' : ''; ?>">
                        <a href="<?= base_url('peminjaman'); ?>" class="nav-link <?= $act = $judul == 'Sirkulasi' ? 'active' : ''; ?>">
                            <i class="nav-icon bi-journal-arrow-down mr-2"></i>
                            <p>
                                Peminjaman
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">PENYUSUTAN</li>
                    <li class="nav-item <?= $act = $judul == 'pemindahan' ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?= $act = $judul == 'pemindahan' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-arrow-left-right mr-2"></i>
                            <p>
                                Pemindahan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="<?= base_url('pemindahan'); ?>" class="nav-link <?= $act = $subjudul == 'data retensi' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Retensi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pemindahan/data'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Pemindahan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon bi bi-trash mr-2"></i>
                            <p>Pemusnahan</p>
                            <span class="badge badge-danger right">inactive</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon bi bi-box-fill mr-2"></i>
                            <p>Penyerahan</p>
                            <span class="badge badge-danger right">inactive</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Pengawasan
                                <!-- <i class="fas fa-angle-left right"></i> -->
                                <span class="badge badge-danger right">inactive</span>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengawasan'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Umum</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penciptaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penggunaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pemeliharaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penyusutan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SDM Kearsipan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-header">LOGOUT</li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                        <i class="nav-icon bi bi-arrow-bar-right text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 text-sm">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $judul; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $judul; ?></a></li>
                        <li class="breadcrumb-item active"><?= $subjudul; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">