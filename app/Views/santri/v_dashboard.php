<?= $this->extend('templateuser/v_template_backenduser') ?>

<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-success shadow-sm">
                    <h5><i class="icon fas fa-check"></i> Selamat Datang <?= session()->get('nama_user') ?>!</h5>
                    <p class="mb-0">Status pendaftaran Anda saat ini: <strong><?= session()->get('status_pendaftaran') ?? 'Menunggu Verifikasi' ?></strong></p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Status Pendaftaran -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Status</span>
                        <span class="info-box-number"><?= session()->get('status_pendaftaran') ?? 'Menunggu Verifikasi' ?></span>
                    </div>
                </div>
            </div>

            <!-- Kelengkapan Berkas -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kelengkapan Berkas</span>
                        <span class="info-box-number">0%</span>
                    </div>
                </div>
            </div>

            <!-- Biodata -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Biodata</span>
                        <span class="info-box-number">Belum Lengkap</span>
                    </div>
                </div>
            </div>

            <!-- Pengumuman -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bullhorn"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pengumuman</span>
                        <span class="info-box-number">0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- Informasi Pendaftaran -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle mr-1"></i>
                            Informasi Pendaftaran
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">No. Pendaftaran</dt>
                            <dd class="col-sm-8"><?= session()->get('no_pendaftaran') ?></dd>

                            <dt class="col-sm-4">Nama Lengkap</dt>
                            <dd class="col-sm-8"><?= session()->get('nama_user') ?></dd>

                            <dt class="col-sm-4">NISN</dt>
                            <dd class="col-sm-8"><?= session()->get('nisn') ?></dd>

                            <dt class="col-sm-4">Jenjang</dt>
                            <dd class="col-sm-8"><?= session()->get('jenjang') ?></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Right col -->
            <div class="col-md-4">
                <!-- Quick Links -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-link mr-1"></i>
                            Menu Cepat
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-user-edit mr-2"></i> Lengkapi Biodata
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-upload mr-2"></i> Upload Berkas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-print mr-2"></i> Cetak Kartu
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>