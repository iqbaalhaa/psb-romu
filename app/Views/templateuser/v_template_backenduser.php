<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PSB ROMU</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">
    <style>
        .nav-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        .nav-sidebar .nav-link.active {
            background-color: #007bff !important;
        }

        .footer a:hover {
            color: #e9ecef !important;
            text-decoration: underline;
        }

        .brand-link:hover {
            background-color: #218838 !important;
        }

        .user-panel .image img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #28a745;">

            <!-- Left navbar links -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <h4 class="text-white">Dashboard</h4>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Auth/LogoutUser') ?>" class="btn btn-danger" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1e7e34;">
            <!-- Brand Logo -->
            <a href="<?= base_url('Admin') ?>" class="brand-link" style="background-color: #28a745;">
                <img src="<?= base_url() ?>/assets/romu.png" alt="AdminLTE Logo" class="brand-image">
                <span class="brand-text font-weight-bold text-white">PSB ROMU</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('foto/santri/' . session()->get('foto')) ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('nama_user') ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('Santri') ?>" class="nav-link text-white <?= current_url() == base_url('Santri') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header text-white">PENDAFTARAN</li>
                        <li class="nav-item">
                            <a href="<?= base_url('Santri/BiodataSantri') ?>" class="nav-link text-white <?= current_url() == base_url('Santri/BiodataSantri') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Biodata Santri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Santri/Pembayaran') ?>" class="nav-link text-white <?= current_url() == base_url('Santri/Pembayaran') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Pembayaran
                                    <?php if (session()->get('status_pembayaran') == 0) : ?>
                                        <span class="badge badge-warning right">Belum Bayar</span>
                                        <?php $status_pendaftaran = 'Menunggu Pembayaran'; ?>
                                    <?php elseif (session()->get('status_pembayaran') == 1) : ?>
                                        <span class="badge badge-info right">Menunggu</span>
                                        <?php $status_pendaftaran = 'Menunggu Verifikasi'; ?>
                                    <?php else : ?>
                                        <span class="badge badge-success right">Lunas</span>
                                        <?php $status_pendaftaran = 'Pembayaran Terverifikasi'; ?>
                                    <?php endif; ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Santri/Berkas') ?>" class="nav-link text-white <?= current_url() == base_url('Santri/Berkas') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Upload Berkas
                                    <?php if (session()->get('status_berkas') == 0) : ?>
                                        <span class="badge badge-warning right">Belum Lengkap</span>
                                    <?php else : ?>
                                        <span class="badge badge-success right">Lengkap</span>
                                    <?php endif; ?>
                                </p>
                            </a>
                        </li>

                        <li class="nav-header text-white">STATUS</li>
                        <li class="nav-item">
                            <a href="<?= base_url('Santri/Pengumuman') ?>" class="nav-link text-white <?= current_url() == base_url('Santri/Pengumuman') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-bullhorn"></i>
                                <p>Pengumuman</p>
                            </a>
                        </li>

                        <li class="nav-header text-white">PENGATURAN</li>
                        <li class="nav-item">
                            <a href="<?= base_url('Santri/GantiPassword') ?>" class="nav-link text-white <?= current_url() == base_url('Santri/GantiPassword') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-key"></i>
                                <p>Ganti Password</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #f8f9fa;">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <?= $this->renderSection('content') ?>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer" style="background-color: #1e7e34;">
            <!-- Default to the left -->
            <strong class="text-white">Copyright &copy; 2025 <a href="#" class="text-white">Alfi Salam</a>.</strong>
            <span class="text-white">All rights reserved.</span>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script untuk Toast -->
    <script>
        $(document).ready(function() {
            const swal = $('.swal').data('swal');
            if (swal) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: swal,
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            }
        });
    </script>
</body>

</html>