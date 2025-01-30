<?= $this->extend('templateuser/v_template_backenduser') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Upload Berkas</h4>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Kartu Keluarga -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Kartu Keluarga</h5>
                        </div>
                        <div class="card-body text-center">
                            <?php if (!empty($berkas['kk'])) : ?>
                                <img src="<?= base_url('berkas/' . $berkas['kk']) ?>" class="img-fluid mb-2">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Berkas telah diupload
                                </div>
                            <?php else : ?>
                                <?= form_open_multipart('Santri/uploadBerkas') ?>
                                <input type="hidden" name="jenis" value="kk">
                                <div class="form-group">
                                    <input type="file" name="berkas" class="form-control" required>
                                    <small class="text-muted">Format: JPG/JPEG/PNG/PDF, Maksimal 2MB</small>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-upload"></i> Upload
                                </button>
                                <?= form_close() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Akta Kelahiran -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Akta Kelahiran</h5>
                        </div>
                        <div class="card-body text-center">
                            <?php if (!empty($berkas['akta'])) : ?>
                                <img src="<?= base_url('berkas/' . $berkas['akta']) ?>" class="img-fluid mb-2">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Berkas telah diupload
                                </div>
                            <?php else : ?>
                                <?= form_open_multipart('Santri/uploadBerkas') ?>
                                <input type="hidden" name="jenis" value="akta">
                                <div class="form-group">
                                    <input type="file" name="berkas" class="form-control" required>
                                    <small class="text-muted">Format: JPG/JPEG/PNG/PDF, Maksimal 2MB</small>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-upload"></i> Upload
                                </button>
                                <?= form_close() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Ijazah -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Ijazah</h5>
                        </div>
                        <div class="card-body text-center">
                            <?php if (!empty($berkas['ijazah'])) : ?>
                                <img src="<?= base_url('berkas/' . $berkas['ijazah']) ?>" class="img-fluid mb-2">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Berkas telah diupload
                                </div>
                            <?php else : ?>
                                <?= form_open_multipart('Santri/uploadBerkas') ?>
                                <input type="hidden" name="jenis" value="ijazah">
                                <div class="form-group">
                                    <input type="file" name="berkas" class="form-control" required>
                                    <small class="text-muted">Format: JPG/JPEG/PNG/PDF, Maksimal 2MB</small>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-upload"></i> Upload
                                </button>
                                <?= form_close() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>