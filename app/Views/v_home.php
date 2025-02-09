<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'PSB ROMU' ?> | <?= $subtitle ?? 'Penerimaan Santri Baru' ?></title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(40, 167, 69, 0.2), rgba(40, 167, 69, 0.8)),
                url('<?= base_url() ?>/assets/pesantren-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 50px 0;
            color: white;
            text-align: center;
        }

        .program-card {
            transition: transform 0.3s;
            margin-bottom: 30px;
        }

        .program-card:hover {
            transform: translateY(-10px);
        }

        .feature-box {
            text-align: center;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .feature-box i {
            font-size: 40px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 15px 20px;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .footer {
            background: #004d40;
            padding: 30px 0;
            color: white;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <?php 
    $pesan = session()->getFlashdata('pesan');
    if ($pesan) : 
    ?>
    <script>
        window.onload = function() {
            Swal.fire({
                icon: '<?= is_array($pesan) ? $pesan['icon'] : 'error' ?>',
                title: '<?= is_array($pesan) ? $pesan['title'] : 'Alert!' ?>',
                html: '<?= is_array($pesan) ? nl2br(str_replace("'", "\'", $pesan['text'])) : $pesan ?>',
                confirmButtonColor: '<?= is_array($pesan) && $pesan['icon'] == 'success' ? '#28a745' : '#dc3545' ?>',
                confirmButtonText: 'OK'
            });
        }
    </script>
    <?php endif; ?>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark" style="background-color: #004d40;">
            <div class="container">
                <a href="<?= base_url() ?>" class="navbar-brand">
                    <img src="<?= base_url() ?>/assets/romu.png" alt="Logo" class="brand-image" style="opacity: .8">
                    <span class="brand-text font-weight-bold">PSB ROMU</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>" class="nav-link">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Syarat & Ketentuan</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-outline-light ml-2" data-toggle="modal" data-target="#modalLogin">
                                Login
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="container">
                    <h2 class="display-4 mb-4"><b>Penerimaan Santri Baru</b></h2>
                    <h3 class="mb-4"><b>Tahun Ajaran 2025/2026</b></h3>
                    <a href="#daftar" class="btn btn-light btn-lg px-4">Daftar Sekarang</a>
                </div>
            </div>

            <!-- Main content -->
            <div class="content py-5">
                <div class="container">

                    <!-- Program Cards -->
                    <div class="row" id="daftar">
                        <div class="col-12 text-center mb-5">
                            <h2>Pilih Jalur Pendaftaran</h2>
                            <p class="lead">Silahkan pilih jenjang pendidikan yang diinginkan</p>
                        </div>

                        <div class="col-md-6">
                            <div class="card program-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-school fa-3x text-success mb-3"></i>
                                    <h3>MTs (SMP)</h3>
                                    <p>Pendidikan tingkat menengah pertama dengan kurikulum pesantren</p>
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalMTs">
                                        Daftar MTs
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card program-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-university fa-3x text-success mb-3"></i>
                                    <h3>MA (SMA)</h3>
                                    <p>Pendidikan tingkat menengah atas dengan keunggulan akademik</p>
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalMA">
                                        Daftar MA
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features Section -->
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="feature-box">
                                <i class="fas fa-clock"></i>
                                <h4>Pendaftaran Online 24 Jam</h4>
                                <p>Daftar kapanpun dan dimanapun secara online</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-box">
                                <i class="fas fa-book-reader"></i>
                                <h4>Kurikulum Terintegrasi</h4>
                                <p>Memadukan kurikulum nasional dan pesantren</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-box">
                                <i class="fas fa-mosque"></i>
                                <h4>Fasilitas Lengkap</h4>
                                <p>Asrama, masjid, dan fasilitas belajar modern</p>
                            </div>
                        </div>
                    </div>

                    <?= $this->renderSection('content') ?>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Kontak Kami</h5>
                        <p><i class="fas fa-map-marker-alt"></i> Alamat Pesantren</p>
                        <p><i class="fas fa-phone"></i> (021) 1234567</p>
                        <p><i class="fas fa-envelope"></i> info@pesantrenromu.sch.id</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <h5>Media Sosial</h5>
                        <a href="#" class="text-white mr-3"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white mr-3"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <hr class="mt-4" style="border-color: rgba(255,255,255,0.1)">
                <div class="text-center">
                    <p class="mb-0">Copyright &copy; 2025 Pesantren ROMU. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modal Form MTs -->
    <div class="modal fade" id="modalMTs" tabindex="-1" role="dialog" aria-labelledby="modalMTsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalMTsLabel">Formulir Pendaftaran MTs</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('Pendaftaran/SimpanMTs', ['class' => 'needs-validation']) ?>
                    <!-- Data Akun -->
                    <h5 class="border-bottom pb-2">Data Akun</h5>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- Data Pribadi -->
                    <h5 class="border-bottom pb-2 mt-4">Data Pribadi</h5>
                    <div class="form-group">
                        <label>NISN <span class="text-danger">*</span></label>
                        <input type="text" name="nisn" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_lahir" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <!-- Data Sekolah -->
                    <h5 class="border-bottom pb-2 mt-4">Data Sekolah Asal</h5>
                    <div class="form-group">
                        <label>Nama Sekolah <span class="text-danger">*</span></label>
                        <input type="text" name="asal_sekolah" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Foto <span class="text-danger">*</span> <small>(Maksimal 1MB, Format: JPG/PNG)</small></label>
                        <input type="file" name="foto" class="form-control-file" accept="image/jpeg,image/png" required>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Data lengkap dapat dilengkapi setelah login di dashboard santri
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save mr-2"></i> Daftar Sekarang
                    </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form MA -->
    <div class="modal fade" id="modalMA" tabindex="-1" role="dialog" aria-labelledby="modalMALabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalMALabel">Formulir Pendaftaran MA</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('Pendaftaran/SimpanMA', ['class' => 'needs-validation']) ?>
                    <!-- Data Akun -->
                    <h5 class="border-bottom pb-2">Data Akun</h5>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <!-- Data Pribadi -->
                    <h5 class="border-bottom pb-2 mt-4">Data Pribadi</h5>
                    <div class="form-group">
                        <label>NISN <span class="text-danger">*</span></label>
                        <input type="text" name="nisn" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_lahir" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <!-- Data Sekolah -->
                    <h5 class="border-bottom pb-2 mt-4">Data Sekolah Asal</h5>
                    <div class="form-group">
                        <label>Nama Sekolah <span class="text-danger">*</span></label>
                        <input type="text" name="asal_sekolah" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Foto <span class="text-danger">*</span> <small>(Maksimal 1MB, Format: JPG/PNG)</small></label>
                        <input type="file" name="foto" class="form-control-file" accept="image/jpeg,image/png" required>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Data lengkap dapat dilengkapi setelah login di dashboard santri
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save mr-2"></i> Daftar Sekarang
                    </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalLoginLabel">Login</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('Auth/CekLogin') ?>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password_login" required>
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword('password_login')" style="cursor: pointer;">
                                    <i class="fas fa-eye" id="icon_password_login"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url() ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/AdminLTE/dist/js/adminlte.min.js"></script>
    
    <!-- Debug script untuk memeriksa pesan flash -->
    <?php if ($pesan) : ?>
    <script>
        console.log('Pesan Flash:', <?= json_encode($pesan) ?>);
    </script>
    <?php endif; ?>
    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById('icon_' + inputId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>