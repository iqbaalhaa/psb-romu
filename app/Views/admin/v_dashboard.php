<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<!-- Main content -->
<section class="content container-fluid px-4">
    <!-- Info boxes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-custom shadow-sm">
                <h5><i class="icon fas fa-check"></i> Selamat Datang! <?= session()->get('nama_user') ?></h5>
                <p class="mb-0">Anda login sebagai Administrator. Kelola sistem pendaftaran dengan bijak.</p>
            </div>
        </div>
    </div>

    <!-- Data MTs -->
    <div class="section-header mb-4">
        <h4 class="section-title">Data Pendaftaran MTs</h4>
        <div class="section-line"></div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Total Pendaftar</div>
                    <div class="stat-card-number">
                        <?= number_format($total_mts ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-info">
                <div class="stat-card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Menunggu Verifikasi</div>
                    <div class="stat-card-number">
                        <?= number_format($pending_mts ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-warning">
                <div class="stat-card-icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Belum Bayar</div>
                    <div class="stat-card-number">
                        <?= number_format($unpaid_mts ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-success">
                <div class="stat-card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Terverifikasi</div>
                    <div class="stat-card-number">
                        <?= number_format($verified_mts ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data MA -->
    <div class="section-header mb-4">
        <h4 class="section-title">Data Pendaftaran MA</h4>
        <div class="section-line"></div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Total Pendaftar</div>
                    <div class="stat-card-number">
                        <?= number_format($total_ma ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-info">
                <div class="stat-card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Menunggu Verifikasi</div>
                    <div class="stat-card-number">
                        <?= number_format($pending_ma ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-warning">
                <div class="stat-card-icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Belum Bayar</div>
                    <div class="stat-card-number">
                        <?= number_format($unpaid_ma ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-gradient-success">
                <div class="stat-card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-title">Terverifikasi</div>
                    <div class="stat-card-number">
                        <?= number_format($verified_ma ?? 0) ?>
                        <span class="stat-suffix">Santri</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .alert-custom {
        border-radius: 15px;
        border-left: 5px solid #004d40;
        background-color: #ffffff;
        padding: 20px;
        margin-bottom: 30px;
    }

    .alert-custom h5 {
        color: #004d40;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .section-header {
        position: relative;
        margin-bottom: 30px;
    }

    .section-title {
        color: #004d40;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .section-line {
        width: 50px;
        height: 3px;
        background: #004d40;
        margin-top: 10px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
        color: white;
        height: 140px;
        width: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card-icon {
        min-width: 60px;
        height: 60px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .stat-card-icon i {
        font-size: 28px;
        color: white;
    }

    .stat-card-info {
        flex: 1;
        min-width: 0;
    }

    .stat-card-title {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .stat-card-number {
        font-size: 24px;
        font-weight: 600;
        line-height: 1.2;
    }

    .stat-suffix {
        font-size: 14px;
        opacity: 0.9;
        margin-left: 5px;
        white-space: nowrap;
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, #004d40, #00695c);
    }

    .bg-gradient-info {
        background: linear-gradient(45deg, #0288d1, #039be5);
    }

    .bg-gradient-warning {
        background: linear-gradient(45deg, #f57c00, #fb8c00);
    }

    .bg-gradient-success {
        background: linear-gradient(45deg, #2e7d32, #388e3c);
    }

    @media (max-width: 768px) {
        .stat-card {
            height: 120px;
            padding: 15px;
        }

        .stat-card-icon {
            min-width: 50px;
            height: 50px;
        }

        .stat-card-icon i {
            font-size: 20px;
        }

        .stat-card-title {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .stat-card-number {
            font-size: 18px;
        }

        .stat-suffix {
            font-size: 12px;
        }
    }
</style>

<?= $this->endSection() ?>