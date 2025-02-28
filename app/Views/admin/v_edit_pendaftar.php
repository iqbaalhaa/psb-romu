<?= $this->extend('template/v_template_backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Edit Data Pendaftar</h4>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('Admin/UpdatePendaftar/' . $santri['id_santri']) ?>" method="post">
                <?= csrf_field() ?>
                
                <!-- Data Pribadi -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5>Data Pribadi</h5>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>NISN</label>
                            <input type="text" name="nisn" class="form-control" value="<?= $santri['nisn'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= $santri['nama_lengkap'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="<?= $santri['tempat_lahir'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" value="<?= $santri['tgl_lahir'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="L" <?= ($santri['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= ($santri['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>No. HP</label>
                            <input type="text" name="no_hp" class="form-control" value="<?= $santri['no_hp'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Gelombang</label>
                            <select name="gelombang" class="form-control" required>
                                <option value="1" <?= ($santri['gelombang'] == '1') ? 'selected' : '' ?>>Gelombang 1</option>
                                <option value="2" <?= ($santri['gelombang'] == '2') ? 'selected' : '' ?>>Gelombang 2</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Data Alamat -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5>Data Alamat</h5>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required><?= $detail['alamat'] ?? '' ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Desa/Kelurahan</label>
                            <input type="text" name="desa" class="form-control" value="<?= $detail['desa'] ?? '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="<?= $detail['kecamatan'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Kabupaten/Kota</label>
                            <input type="text" name="kabupaten" class="form-control" value="<?= $detail['kabupaten'] ?? '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value="<?= $detail['provinsi'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5>Data Orang Tua</h5>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" value="<?= $detail['nama_ayah'] ?? '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" class="form-control" value="<?= $detail['pekerjaan_ayah'] ?? '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" value="<?= $detail['nama_ibu'] ?? '' ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" class="form-control" value="<?= $detail['pekerjaan_ibu'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="<?= base_url('Admin/PendaftarMTs') ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 