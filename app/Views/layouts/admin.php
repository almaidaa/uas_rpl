<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Daftar Mata Kuliah' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('logout') ?>" role="button">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= base_url('/dashboard') ?>" class="brand-link">
            <span class="brand-text font-weight-light"><?= $logged_in_user_name ?? session()->get('username') ?></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block"><?= session()->get('username') ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <?php if (session()->get('role') == 'admin'): ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Manajemen Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/mahasiswa/mahasiswa') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mahasiswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/dosen/index') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dosen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/mata_kuliah/index') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mata Kuliah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/jadwal/index') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jadwal Perkuliahan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/users') ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Manajemen Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/laporan') ?>" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/notifikasi') ?>" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>Notifikasi</p>
                            </a>
                        </li>
                    <?php elseif (session()->get('role') == 'dosen'): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('dosen/jadwal/index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Jadwal Mengajar</p>
                            </a>
                        </li>
                        <!-- Tambahkan menu lain untuk dosen jika ada -->
                    <?php elseif (session()->get('role') == 'mahasiswa'): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('mahasiswa/krs/index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-file-signature"></i>
                                <p>KRS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('mahasiswa/khs/dashboard') ?>" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>KHS</p>
                            </a>
                        </li>
                        <!-- Tambahkan menu lain untuk mahasiswa jika ada -->
                    <?php endif; ?>
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $title ?? 'Page Title' ?></h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; 2025 KELOMPOK 1.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
