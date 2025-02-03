<?= $this->extend('templateuser/v_template_backenduser') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Pengumuman</h3>
        </div>
        <div class="card-body">
            <?php if (empty($pengumuman)) : ?>
                <div class="alert alert-info">
                    Belum ada pengumuman saat ini.
                </div>
            <?php else : ?>
                <div class="timeline">
                    <?php
                    $currentDate = '';
                    foreach ($pengumuman as $value) :
                        $date = date('Y-m-d', strtotime($value['tanggal']));
                        if ($currentDate != $date) :
                            $currentDate = $date;
                    ?>
                            <div class="time-label">
                                <span class="bg-success">
                                    <?= date('d M Y', strtotime($value['tanggal'])) ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <div>
                            <i class="fas fa-bullhorn bg-success"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fas fa-clock"></i>
                                    <?= date('H:i', strtotime($value['tanggal'])) ?>
                                </span>
                                <h3 class="timeline-header">
                                    <strong><?= $value['judul'] ?></strong>
                                </h3>
                                <div class="timeline-body">
                                    <?= nl2br($value['isi']) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

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
        width: 4px;
    }

    .timeline>div {
        margin-bottom: 15px;
        margin-right: 10px;
        position: relative;
    }

    .time-label {
        margin-bottom: 1rem;
    }

    .time-label>span {
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        font-weight: 600;
        padding: 5px 10px;
    }

    .timeline-item {
        background-color: #fff;
        border-radius: 3px;
        margin-left: 60px;
        margin-right: 15px;
        margin-top: 0;
        padding: 0;
        position: relative;
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    }

    .timeline-item>.time {
        color: #999;
        float: right;
        font-size: 12px;
        padding: 10px;
    }

    .timeline-item>.timeline-header {
        border-bottom: 1px solid #f4f4f4;
        color: #555;
        font-size: 16px;
        line-height: 1.1;
        margin: 0;
        padding: 10px;
    }

    .timeline-item>.timeline-body {
        padding: 10px;
        color: #666;
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    .timeline>div>i {
        background-color: #adb5bd;
        border-radius: 50%;
        font-size: 16px;
        height: 30px;
        left: 18px;
        line-height: 30px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 30px;
        color: #fff;
    }

    .bg-gray {
        background-color: #adb5bd !important;
    }
</style>
<?= $this->endSection() ?>