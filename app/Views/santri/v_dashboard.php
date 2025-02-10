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
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: <?= $persentase_berkas ?? '0' ?>%"
                                height="30px"
                                aria-valuenow="<?= $persentase_berkas ?? '0' ?>"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <span class="info-box-number mt-1">
                            <?= $persentase_berkas ?? '0' ?>% Lengkap
                        </span>
                    </div>
                </div>
            </div>

            <!-- Biodata -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 shadow-sm">
                    <span class="info-box-icon <?= ($status_biodata == 'Lengkap') ? 'bg-success' : 'bg-warning' ?> elevation-1">
                        <i class="fas <?= ($status_biodata == 'Lengkap') ? 'fa-check' : 'fa-user' ?>"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Biodata</span>
                        <span class="info-box-number">
                            <?= $status_biodata ?>
                            <?php if ($status_biodata == 'Belum Lengkap'): ?>
                                <br>
                                <small>
                                    <a href="<?= base_url('Santri/BiodataSantri') ?>" class="text-warning">
                                        <i class="fas fa-edit"></i> Lengkapi Sekarang
                                    </a>
                                </small>
                            <?php endif; ?>
                        </span>
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
            <div class="col-md-4">
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
                            <dt class="col-sm-6">No. Pendaftaran</dt>
                            <dd class="col-sm-6"><?= $santri['no_pendaftaran'] ?? '-' ?></dd>

                            <dt class="col-sm-6">Nama Lengkap</dt>
                            <dd class="col-sm-6"><?= $santri['nama_lengkap'] ?? '-' ?></dd>

                            <dt class="col-sm-6">NISN</dt>
                            <dd class="col-sm-6"><?= $santri['nisn'] ?? '-' ?></dd>

                            <dt class="col-sm-6">Jenjang</dt>
                            <dd class="col-sm-6"><?= $santri['jenjang'] ?? '-' ?></dd>

                            <dt class="col-sm-6">Gelombang</dt>
                            <dd class="col-sm-6">Gelombang <?= $santri['gelombang'] ?? '-' ?></dd>
                        </dl>
                        <a href="<?= base_url('Santri/CetakKartu') ?>" class="btn btn-success">
                            <i class="fas fa-print mr-2"></i> Cetak Kartu
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right col -->
            <div class="col-md-8">
                <!-- Pengumuman -->
                <div class="card shadow">
                    <div class="card-header bg-gradient-danger text-white">
                        <h3 class="card-title">
                            <i class="fas fa-bullhorn mr-1"></i>
                            Pengumuman Terbaru
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <?php if (!empty($pengumuman)): ?>
                            <div class="timeline timeline-inverse p-2">
                                <?php
                                $count = 0;
                                foreach ($pengumuman as $p):
                                    if ($count >= 3) break; // Tampilkan hanya 3 pengumuman teratas
                                ?>
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            <?= date('d M Y', strtotime($p['tanggal'])) ?>
                                        </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-bullhorn bg-danger"></i>
                                        <div class="timeline-item">
                                            <span class="time">
                                                <i class="fas fa-clock"></i>
                                                <?= date('H:i', strtotime($p['tanggal'])) ?>
                                            </span>
                                            <h3 class="timeline-header">
                                                <strong><?= $p['judul'] ?></strong>
                                            </h3>
                                            <div class="timeline-body">
                                                <?= strlen($p['isi']) > 100 ? substr($p['isi'], 0, 100) . '...' : $p['isi'] ?>
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="<?= base_url('Santri/Pengumuman') ?>" class="text-primary">Baca selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $count++;
                                endforeach;
                                ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center p-3">
                                <i class="fas fa-info-circle mb-2"></i>
                                <p class="mb-0">Belum ada pengumuman</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .timeline {
        margin: 0;
        padding: 0;
        position: relative;
    }

    .timeline::before {
        background-color: #dee2e6;
        bottom: 0;
        content: "";
        left: 31px;
        margin: 0;
        position: absolute;
        top: 0;
        width: 2px;
    }

    .timeline .time-label {
        margin-bottom: 1rem;
    }

    .timeline .time-label>span {
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        font-weight: 600;
        padding: 3px 8px;
        font-size: 0.8rem;
    }

    .timeline-item {
        margin-left: 45px;
        margin-bottom: 15px;
        padding: 0.5rem;
        position: relative;
        background: #f8f9fa;
        border-radius: 4px;
    }

    .timeline>div>i {
        width: 24px;
        height: 24px;
        font-size: 12px;
        line-height: 24px;
        position: absolute;
        color: #fff;
        background-color: #dc3545;
        border-radius: 50%;
        text-align: center;
        left: 18px;
        top: 0;
    }

    .timeline-item .time {
        float: right;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .timeline-item .timeline-header {
        font-size: 0.9rem;
        margin: 0;
        padding: 0.2rem 0;
    }

    .timeline-item .timeline-body {
        font-size: 0.85rem;
        color: #666;
        padding: 0.5rem 0;
    }

    .timeline-item .timeline-footer {
        font-size: 0.8rem;
    }
</style>

<?= $this->endSection() ?>