<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<!-- Main content -->
<section class="content container-fluid px-4">
    <!-- Info boxes -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-success shadow-sm">
                <h5><i class="icon fas fa-check"></i> Selamat Datang! <?= session()->get('nama_user') ?></h5>
                <p class="mb-0">Anda login sebagai Administrator. Kelola sistem pendaftaran dengan bijak.</p>
            </div>
        </div>
    </div>

    <!-- Data MTs -->
    <h4 class="mb-3">Data Pendaftaran MTs</h4>
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pendaftar</span>
                    <span class="info-box-number">
                        <?= isset($total_mts) ? number_format($total_mts) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-info"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Menunggu Verifikasi</span>
                    <span class="info-box-number">
                        <?= isset($pending_mts) ? number_format($pending_mts) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Belum Bayar</span>
                    <span class="info-box-number">
                        <?= isset($unpaid_mts) ? number_format($unpaid_mts) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Terverifikasi</span>
                    <span class="info-box-number">
                        <?= isset($verified_mts) ? number_format($verified_mts) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data MA -->
    <h4 class="mb-3">Data Pendaftaran MA</h4>
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pendaftar</span>
                    <span class="info-box-number">
                        <?= isset($total_ma) ? number_format($total_ma) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-info"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Menunggu Verifikasi</span>
                    <span class="info-box-number">
                        <?= isset($pending_ma) ? number_format($pending_ma) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Belum Bayar</span>
                    <span class="info-box-number">
                        <?= isset($unpaid_ma) ? number_format($unpaid_ma) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="info-box shadow hover-effect">
                <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Terverifikasi</span>
                    <span class="info-box-number">
                        <?= isset($verified_ma) ? number_format($verified_ma) : 0 ?>
                        <small>Santri</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hover-effect {
        transition: all 0.3s ease;
    }

    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
    }

    .info-box {
        min-height: 140px;
        background: #ffffff;
        border-radius: 15px;
        margin-bottom: 20px;
        padding: 20px;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .info-box-icon {
        border-radius: 12px;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }

    .info-box-icon i {
        font-size: 2.5rem;
        color: #ffffff;
    }

    .info-box-content {
        padding-top: 5px;
        flex-grow: 1;
    }

    .info-box-text {
        font-size: 1rem;
        font-weight: 600;
        color: #28a745;
        margin-bottom: 10px;
    }

    .info-box-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #28a745;
    }

    .info-box-number small {
        font-size: 1.1rem;
        color: #666;
        margin-left: 5px;
    }

    .alert-success {
        border-radius: 15px;
        border-left: 5px solid #28a745;
        background-color: #ffffff;
    }

    .alert-success h5 {
        color: #28a745;
        font-weight: 600;
    }

    .alert-success p {
        color: #666;
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    @media (max-width: 768px) {
        .info-box {
            min-height: 120px;
            padding: 15px;
        }

        .info-box-icon {
            width: 70px;
            height: 70px;
        }

        .info-box-text {
            font-size: 1.1rem;
        }

        .info-box-number {
            font-size: 1.6rem;
        }
    }
</style>

<?= $this->endSection() ?>