<?= $this->extend('templateuser/v_template_backenduser') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Pembayaran Pendaftaran</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Informasi Pembayaran</h5>
                        <p>Silahkan transfer biaya pendaftaran sebesar <strong>Rp. 100.000</strong> ke rekening berikut:</p>
                        <p>Bank BRI: 1234-5678-9012-3456</p>
                        <p>A.n: Yayasan Pondok Pesantren</p>
                    </div>

                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('success')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (empty($pembayaran) || $pembayaran['status_pembayaran'] == 0) : ?>
                        <form action="<?= base_url('Santri/uploadBuktiPembayaran') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Upload Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" class="form-control" required accept="image/jpeg,image/png,image/jpg">
                                <small class="text-muted">Format: JPG/JPEG/PNG, Maksimal 2MB</small>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i> Upload
                            </button>
                        </form>
                    <?php else : ?>
                        <div class="text-center">
                            <img src="<?= base_url('bukti_pembayaran/' . $pembayaran['bukti_pembayaran']) ?>"
                                class="img-fluid mb-3" style="max-height: 300px;">

                            <?php if ($pembayaran['status_pembayaran'] == 1) : ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Menunggu verifikasi admin
                                </div>
                            <?php elseif ($pembayaran['status_pembayaran'] == 2) : ?>
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Pembayaran telah diverifikasi
                                </div>
                                <form action="<?= base_url('Santri/updateBuktiPembayaran') ?>" method="post" enctype="multipart/form-data" class="mt-3">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
                                    <div class="form-group">
                                        <label>Update Bukti Pembayaran</label>
                                        <input type="file" name="bukti_pembayaran" class="form-control" required accept="image/jpeg,image/png,image/jpg">
                                        <small class="text-muted">Format: JPG/JPEG/PNG, Maksimal 2MB</small>
                                    </div>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-sync"></i> Update Bukti Pembayaran
                                    </button>
                                </form>
                            <?php elseif ($pembayaran['status_pembayaran'] == 0) : ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-circle"></i> Pembayaran ditolak
                                    <?php if (!empty($pembayaran['alasan_tolak'])) : ?>
                                        <br>Alasan: <?= $pembayaran['alasan_tolak'] ?>
                                    <?php endif; ?>
                                </div>
                                <form action="<?= base_url('Santri/updateBuktiPembayaran') ?>" method="post" enctype="multipart/form-data" class="mt-3">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
                                    <div class="form-group">
                                        <label>Update Bukti Pembayaran</label>
                                        <input type="file" name="bukti_pembayaran" class="form-control" required accept="image/jpeg,image/png,image/jpg">
                                        <small class="text-muted">Format: JPG/JPEG/PNG, Maksimal 2MB</small>
                                    </div>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-sync"></i> Update Bukti Pembayaran
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Auto hide alerts after 5 seconds
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>
<?= $this->endSection() ?>