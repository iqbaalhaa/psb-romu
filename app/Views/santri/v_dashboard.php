<?= $this->extend('templateuser/v_template_backenduser') ?>

<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert <?= (session()->get('status_pembayaran') == 2) ? 'alert-success' : ((session()->get('status_pembayaran') == 0) ? 'alert-warning' : 'alert-info') ?> shadow">
                    <h5>
                        <i class="icon fas <?= (session()->get('status_pembayaran') == 2) ? 'fa-check' : ((session()->get('status_pembayaran') == 0) ? 'fa-clock' : 'fa-info-circle') ?>"></i>
                        Selamat Datang <?= session()->get('nama_user') ?>!
                    </h5>
                    <p class="mb-0">Status pendaftaran Anda saat ini:
                        <strong>
                            <?php
                            if (session()->get('status_pembayaran') == 0) {
                                echo 'Menunggu Pembayaran';
                            } elseif (session()->get('status_pembayaran') == 1) {
                                echo 'Menunggu Verifikasi';
                            } else {
                                echo 'Pembayaran Terverifikasi';
                            }
                            ?>
                        </strong>
                        <?php if (session()->get('alasan_tolak')): ?>
                            <br>
                            <small class="text-danger">Alasan: <?= session()->get('alasan_tolak') ?></small>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Status Pendaftaran -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 shadow-sm">
                    <span class="info-box-icon <?= (session()->get('status_pembayaran') == 2) ? 'bg-success' : ((session()->get('status_pembayaran') == 0) ? 'bg-warning' : 'bg-info') ?> elevation-1">
                        <i class="fas <?= (session()->get('status_pembayaran') == 2) ? 'fa-check' : ((session()->get('status_pembayaran') == 0) ? 'fa-clock' : 'fa-info-circle') ?>"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Status</span>
                        <span class="info-box-number">
                            <?php
                            if (session()->get('status_pembayaran') == 0) {
                                echo 'Menunggu Pembayaran';
                            } elseif (session()->get('status_pembayaran') == 1) {
                                echo 'Menunggu Verifikasi';
                            } else {
                                echo 'Terverifikasi';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Kelengkapan Berkas -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 shadow-sm">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kelengkapan Berkas</span>
                        <span class="info-box-number"><?= $persentase_berkas ?? '0' ?>%</span>
                    </div>
                </div>
            </div>

            <!-- Biodata -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 shadow-sm">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Biodata</span>
                        <span class="info-box-number"><?= $status_biodata ?? 'Belum Lengkap' ?></span>
                    </div>
                </div>
            </div>

            <!-- Pengumuman -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 shadow-sm">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bullhorn"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pengumuman</span>
                        <span class="info-box-number"><?= $jumlah_pengumuman ?? '0' ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- Informasi Pendaftaran -->
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary text-white">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle mr-1"></i>
                            Informasi Pendaftaran
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">No. Pendaftaran</dt>
                            <dd class="col-sm-8"><?= $santri['no_pendaftaran'] ?? '-' ?></dd>

                            <dt class="col-sm-4">Nama Lengkap</dt>
                            <dd class="col-sm-8"><?= $santri['nama_lengkap'] ?? '-' ?></dd>

                            <dt class="col-sm-4">NISN</dt>
                            <dd class="col-sm-8"><?= $santri['nisn'] ?? '-' ?></dd>

                            <dt class="col-sm-4">Jenjang</dt>
                            <dd class="col-sm-8"><?= $santri['jenjang'] ?? '-' ?></dd>

                            <dt class="col-sm-4">Gelombang</dt>
                            <dd class="col-sm-8">Gelombang <?= $santri['gelombang'] ?? '-' ?></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Right col -->
            <div class="col-md-4">
                <!-- Quick Links -->
                <div class="card shadow">
                    <div class="card-header bg-gradient-success text-white">
                        <h3 class="card-title">
                            <i class="fas fa-link mr-1"></i>
                            Menu Cepat
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('Santri/DetailSantri') ?>" class="nav-link">
                                    <i class="fas fa-user-edit mr-2"></i> Lengkapi Biodata
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Santri/Berkas') ?>" class="nav-link">
                                    <i class="fas fa-upload mr-2"></i> Upload Berkas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('Santri/CetakKartu') ?>" class="nav-link">
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