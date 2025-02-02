<?= $this->extend('templateuser/v_template_backenduser') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1>Detail Santri</h1>
    <?= form_open_multipart('Santri/UpdateBiodata') ?>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="formTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#dataSantri">Data Santri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#dataOrtu">Data Orang Tua</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#dataWali">Data Wali</a>
        </li>
    </ul>

    <div class="tab-content pt-3">
        <!-- Tab Data Santri -->
        <div class="tab-pane fade show active" id="dataSantri">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Pendaftaran</label>
                                <input type="text" class="form-control" value="<?= $santri['no_pendaftaran'] ?? 'Data tidak tersedia' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>NISN</label>
                                <input type="text" name="nisn" class="form-control" value="<?= $santri['nisn'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Asal Sekolah</label>
                                <input type="text" class="form-control" value="<?= $santri['asal_sekolah'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <input type="text" class="form-control" value="<?= $santri['tahun_daftar'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Gelombang Pendaftaran</label>
                                <input type="text" class="form-control" value="Gelombang <?= $santri['gelombang'] ?? '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?= $santri['nama_lengkap'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="<?= $santri['tempat_lahir'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="<?= $santri['tgl_lahir'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="L" <?= ($santri['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= ($santri['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <input type="text" class="form-control" value="Islam" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jalur Pendaftaran</label>
                                <input type="text" name="jalur_pendaftaran" class="form-control" value="<?= $santri['jalur_pendaftaran'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Status dalam Keluarga</label>
                                <input type="text" name="status_keluarga" class="form-control" value="<?= $santri['status_keluarga'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Anak Ke-</label>
                                <input type="number" name="anak_ke" class="form-control" value="<?= $santri['anak_ke'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3"><?= $santri['alamat'] ?? '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>No. Telepon/HP</label>
                                <input type="text" name="no_hp" class="form-control" value="<?= $santri['no_hp'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Sekolah Asal</label>
                                <input type="text" name="asal_sekolah" class="form-control" value="<?= $santri['asal_sekolah'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Data Orang Tua -->
        <div class="tab-pane fade" id="dataOrtu">
            <div class="card">
                <div class="card-body">
                    <h5 class="border-bottom pb-2">Data Ayah</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Ayah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ayah" class="form-control" value="<?= $detail['nama_ayah'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>NIK Ayah <span class="text-danger">*</span></label>
                                <input type="text" name="nik_ayah" class="form-control" value="<?= $detail['nik_ayah'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Pendidikan Ayah <span class="text-danger">*</span></label>
                                <select name="pendidikan_ayah" class="form-control" required>
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="SD" <?= ($detail['pendidikan_ayah'] ?? '') == 'SD' ? 'selected' : '' ?>>SD/Sederajat</option>
                                    <option value="SMP" <?= ($detail['pendidikan_ayah'] ?? '') == 'SMP' ? 'selected' : '' ?>>SMP/Sederajat</option>
                                    <option value="SMA" <?= ($detail['pendidikan_ayah'] ?? '') == 'SMA' ? 'selected' : '' ?>>SMA/Sederajat</option>
                                    <option value="D3" <?= ($detail['pendidikan_ayah'] ?? '') == 'D3' ? 'selected' : '' ?>>D3</option>
                                    <option value="S1" <?= ($detail['pendidikan_ayah'] ?? '') == 'S1' ? 'selected' : '' ?>>S1</option>
                                    <option value="S2" <?= ($detail['pendidikan_ayah'] ?? '') == 'S2' ? 'selected' : '' ?>>S2</option>
                                    <option value="S3" <?= ($detail['pendidikan_ayah'] ?? '') == 'S3' ? 'selected' : '' ?>>S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan Ayah <span class="text-danger">*</span></label>
                                <input type="text" name="pekerjaan_ayah" class="form-control" value="<?= $detail['pekerjaan_ayah'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Penghasilan Ayah <span class="text-danger">*</span></label>
                                <select name="penghasilan_ayah" class="form-control" required>
                                    <option value="">-- Pilih Penghasilan --</option>
                                    <option value="< 1.000.000" <?= ($detail['penghasilan_ayah'] ?? '') == '< 1.000.000' ? 'selected' : '' ?>>
                                        < Rp 1.000.000</option>
                                    <option value="1.000.000 - 3.000.000" <?= ($detail['penghasilan_ayah'] ?? '') == '1.000.000 - 3.000.000' ? 'selected' : '' ?>>Rp 1.000.000 - Rp 3.000.000</option>
                                    <option value="3.000.000 - 5.000.000" <?= ($detail['penghasilan_ayah'] ?? '') == '3.000.000 - 5.000.000' ? 'selected' : '' ?>>Rp 3.000.000 - Rp 5.000.000</option>
                                    <option value="> 5.000.000" <?= ($detail['penghasilan_ayah'] ?? '') == '> 5.000.000' ? 'selected' : '' ?>>> Rp 5.000.000</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>No. HP Ayah</label>
                                <input type="text" name="no_hp_ayah" class="form-control" value="<?= $detail['no_hp_ayah'] ?? '' ?>">
                            </div>
                        </div>
                    </div>

                    <h5 class="border-bottom pb-2 mt-4">Data Ibu</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Ibu <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ibu" class="form-control" value="<?= $detail['nama_ibu'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>NIK Ibu <span class="text-danger">*</span></label>
                                <input type="text" name="nik_ibu" class="form-control" value="<?= $detail['nik_ibu'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Pendidikan Ibu <span class="text-danger">*</span></label>
                                <select name="pendidikan_ibu" class="form-control" required>
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="SD" <?= ($detail['pendidikan_ibu'] ?? '') == 'SD' ? 'selected' : '' ?>>SD/Sederajat</option>
                                    <option value="SMP" <?= ($detail['pendidikan_ibu'] ?? '') == 'SMP' ? 'selected' : '' ?>>SMP/Sederajat</option>
                                    <option value="SMA" <?= ($detail['pendidikan_ibu'] ?? '') == 'SMA' ? 'selected' : '' ?>>SMA/Sederajat</option>
                                    <option value="D3" <?= ($detail['pendidikan_ibu'] ?? '') == 'D3' ? 'selected' : '' ?>>D3</option>
                                    <option value="S1" <?= ($detail['pendidikan_ibu'] ?? '') == 'S1' ? 'selected' : '' ?>>S1</option>
                                    <option value="S2" <?= ($detail['pendidikan_ibu'] ?? '') == 'S2' ? 'selected' : '' ?>>S2</option>
                                    <option value="S3" <?= ($detail['pendidikan_ibu'] ?? '') == 'S3' ? 'selected' : '' ?>>S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan Ibu <span class="text-danger">*</span></label>
                                <input type="text" name="pekerjaan_ibu" class="form-control" value="<?= $detail['pekerjaan_ibu'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Penghasilan Ibu <span class="text-danger">*</span></label>
                                <select name="penghasilan_ibu" class="form-control" required>
                                    <option value="">-- Pilih Penghasilan --</option>
                                    <option value="< 1.000.000" <?= ($detail['penghasilan_ibu'] ?? '') == '< 1.000.000' ? 'selected' : '' ?>>
                                        < Rp 1.000.000</option>
                                    <option value="1.000.000 - 3.000.000" <?= ($detail['penghasilan_ibu'] ?? '') == '1.000.000 - 3.000.000' ? 'selected' : '' ?>>Rp 1.000.000 - Rp 3.000.000</option>
                                    <option value="3.000.000 - 5.000.000" <?= ($detail['penghasilan_ibu'] ?? '') == '3.000.000 - 5.000.000' ? 'selected' : '' ?>>Rp 3.000.000 - Rp 5.000.000</option>
                                    <option value="> 5.000.000" <?= ($detail['penghasilan_ibu'] ?? '') == '> 5.000.000' ? 'selected' : '' ?>>> Rp 5.000.000</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>No. HP Ibu</label>
                                <input type="text" name="no_hp_ibu" class="form-control" value="<?= $detail['no_hp_ibu'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Data Wali -->
        <div class="tab-pane fade" id="dataWali">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sama_dengan_ortu">
                            <label class="custom-control-label" for="sama_dengan_ortu">Sama dengan Orang Tua</label>
                        </div>
                    </div>
                    <div id="form_wali">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Wali</label>
                                    <input type="text" name="nama_wali" class="form-control" value="<?= $detail['nama_wali'] ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>NIK Wali</label>
                                    <input type="text" name="nik_wali" class="form-control" value="<?= $detail['nik_wali'] ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Pendidikan Wali</label>
                                    <select name="pendidikan_wali" class="form-control">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="SD">SD/Sederajat</option>
                                        <option value="SMP">SMP/Sederajat</option>
                                        <option value="SMA">SMA/Sederajat</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan Wali</label>
                                    <input type="text" name="pekerjaan_wali" class="form-control" value="<?= $detail['pekerjaan_wali'] ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Penghasilan Wali</label>
                                    <select name="penghasilan_wali" class="form-control">
                                        <option value="">-- Pilih Penghasilan --</option>
                                        <option value="< 1.000.000">
                                            < Rp 1.000.000</option>
                                        <option value="1.000.000 - 3.000.000">Rp 1.000.000 - Rp 3.000.000</option>
                                        <option value="3.000.000 - 5.000.000">Rp 3.000.000 - Rp 5.000.000</option>
                                        <option value="> 5.000.000">> Rp 5.000.000</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No. HP Wali</label>
                                    <input type="text" name="no_hp_wali" class="form-control" value="<?= $detail['no_hp_wali'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer mt-4">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('User/DataSantri') ?>" class="btn btn-secondary">Kembali</a>
    </div>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Handle checkbox wali sama dengan ortu
    document.getElementById('sama_dengan_ortu').addEventListener('change', function() {
        var formWali = document.getElementById('form_wali');
        formWali.style.display = this.checked ? 'none' : 'block';

        if (this.checked) {
            // Copy data dari orang tua
            document.getElementsByName('nama_wali')[0].value = document.getElementsByName('nama_ayah')[0].value;
            document.getElementsByName('nik_wali')[0].value = document.getElementsByName('nik_ayah')[0].value;
            document.getElementsByName('pendidikan_wali')[0].value = document.getElementsByName('pendidikan_ayah')[0].value;
            document.getElementsByName('pekerjaan_wali')[0].value = document.getElementsByName('pekerjaan_ayah')[0].value;
            document.getElementsByName('penghasilan_wali')[0].value = document.getElementsByName('penghasilan_ayah')[0].value;
            document.getElementsByName('no_hp_wali')[0].value = document.getElementsByName('no_hp_ayah')[0].value;
        }
    });
</script>
<?= $this->endSection() ?>