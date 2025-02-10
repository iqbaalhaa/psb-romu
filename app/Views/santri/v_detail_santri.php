<?= $this->extend('templateuser/v_template_backenduser') ?>
<?= $this->section('content') ?>

<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Biodata Santri</h3>
        </div>
        <div class="card-body">
            <?php 
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    <ul>
                        <?php foreach ($errors as $key => $error) { ?>
                            <li><?= esc($error) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php 
            if (session()->getFlashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php } ?>

            <?php 
            if (session()->getFlashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php } ?>

            <?= form_open('Santri/updateBiodata') ?>
            
            <!-- Data Pribadi Santri -->
            <h5 class="border-bottom mb-3 pb-2">Data Pribadi Santri</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control" value="<?= $santri['nisn'] ?? '' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?= $santri['nama_lengkap'] ?? '' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="<?= $santri['tempat_lahir'] ?? '' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="<?= $santri['tgl_lahir'] ?? '' ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" value="<?= ($santri['jenis_kelamin'] ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= $santri['no_hp'] ?? '' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" class="form-control" value="<?= $santri['asal_sekolah'] ?? '' ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" value="<?= $santri['nik'] ?? '' ?>" >
                    </div>
                </div>

            </div>

            <!-- Alamat Lengkap -->
            <h5 class="border-bottom mb-3 pb-2 mt-4">Alamat Lengkap</h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" required><?= $detail['alamat'] ?? old('alamat') ?></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Desa/Kelurahan</label>
                        <input type="text" name="desa" class="form-control" value="<?= $detail['desa'] ?? old('desa') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" value="<?= $detail['kecamatan'] ?? old('kecamatan') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control" value="<?= $detail['kabupaten'] ?? old('kabupaten') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" value="<?= $detail['provinsi'] ?? old('provinsi') ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control" value="<?= $detail['kode_pos'] ?? old('kode_pos') ?>" required>
                    </div>
                </div>
            </div>

            <!-- Data Ayah -->
            <h5 class="border-bottom mb-3 pb-2 mt-4">Data Ayah</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control" value="<?= $detail['nama_ayah'] ?? old('nama_ayah') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>NIK Ayah</label>
                        <input type="text" name="nik_ayah" class="form-control" value="<?= $detail['nik_ayah'] ?? old('nik_ayah') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select name="pendidikan_ayah" class="form-control" required>
                            <option value="">-- Pilih Pendidikan --</option>
                            <?php
                            $pendidikan = ['SD/MI', 'SMP/MTs', 'SMA/MA', 'D1', 'D2', 'D3', 'D4/S1', 'S2', 'S3'];
                            foreach ($pendidikan as $p) {
                                $selected = ($detail['pendidikan_ayah'] ?? old('pendidikan_ayah')) == $p ? 'selected' : '';
                                echo "<option value='$p' $selected>$p</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control" value="<?= $detail['pekerjaan_ayah'] ?? old('pekerjaan_ayah') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Penghasilan per Bulan</label>
                        <select name="penghasilan_ayah" class="form-control" required>
                            <option value="">-- Pilih Penghasilan --</option>
                            <?php
                            $penghasilan = [
                                '< 500.000' => '< Rp. 500.000',
                                '500.000 - 1.000.000' => 'Rp. 500.000 - Rp. 1.000.000',
                                '1.000.000 - 2.000.000' => 'Rp. 1.000.000 - Rp. 2.000.000',
                                '2.000.000 - 3.000.000' => 'Rp. 2.000.000 - Rp. 3.000.000',
                                '3.000.000 - 5.000.000' => 'Rp. 3.000.000 - Rp. 5.000.000',
                                '> 5.000.000' => '> Rp. 5.000.000'
                            ];
                            foreach ($penghasilan as $value => $label) {
                                $selected = ($detail['penghasilan_ayah'] ?? old('penghasilan_ayah')) == $value ? 'selected' : '';
                                echo "<option value='$value' $selected>$label</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp_ayah" class="form-control" value="<?= $detail['no_hp_ayah'] ?? old('no_hp_ayah') ?>" required>
                    </div>
                </div>
            </div>

            <!-- Data Ibu -->
            <h5 class="border-bottom mb-3 pb-2 mt-4">Data Ibu</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control" value="<?= $detail['nama_ibu'] ?? old('nama_ibu') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>NIK Ibu</label>
                        <input type="text" name="nik_ibu" class="form-control" value="<?= $detail['nik_ibu'] ?? old('nik_ibu') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select name="pendidikan_ibu" class="form-control" required>
                            <option value="">-- Pilih Pendidikan --</option>
                            <?php
                            foreach ($pendidikan as $p) {
                                $selected = ($detail['pendidikan_ibu'] ?? old('pendidikan_ibu')) == $p ? 'selected' : '';
                                echo "<option value='$p' $selected>$p</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control" value="<?= $detail['pekerjaan_ibu'] ?? old('pekerjaan_ibu') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Penghasilan per Bulan</label>
                        <select name="penghasilan_ibu" class="form-control" required>
                            <option value="">-- Pilih Penghasilan --</option>
                            <?php
                            foreach ($penghasilan as $value => $label) {
                                $selected = ($detail['penghasilan_ibu'] ?? old('penghasilan_ibu')) == $value ? 'selected' : '';
                                echo "<option value='$value' $selected>$label</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp_ibu" class="form-control" value="<?= $detail['no_hp_ibu'] ?? old('no_hp_ibu') ?>" required>
                    </div>
                </div>
            </div>

            <!-- Data Wali (Opsional) -->
            <h5 class="border-bottom mb-3 pb-2 mt-4">Data Wali (Opsional)</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Wali</label>
                        <input type="text" name="nama_wali" class="form-control" value="<?= $detail['nama_wali'] ?? old('nama_wali') ?>">
                    </div>
                    <div class="form-group">
                        <label>NIK Wali</label>
                        <input type="text" name="nik_wali" class="form-control" value="<?= $detail['nik_wali'] ?? old('nik_wali') ?>">
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <select name="pendidikan_wali" class="form-control">
                            <option value="">-- Pilih Pendidikan --</option>
                            <?php
                            foreach ($pendidikan as $p) {
                                $selected = ($detail['pendidikan_wali'] ?? old('pendidikan_wali')) == $p ? 'selected' : '';
                                echo "<option value='$p' $selected>$p</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan_wali" class="form-control" value="<?= $detail['pekerjaan_wali'] ?? old('pekerjaan_wali') ?>">
                    </div>
                    <div class="form-group">
                        <label>Penghasilan per Bulan</label>
                        <select name="penghasilan_wali" class="form-control">
                            <option value="">-- Pilih Penghasilan --</option>
                            <?php
                            foreach ($penghasilan as $value => $label) {
                                $selected = ($detail['penghasilan_wali'] ?? old('penghasilan_wali')) == $value ? 'selected' : '';
                                echo "<option value='$value' $selected>$label</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp_wali" class="form-control" value="<?= $detail['no_hp_wali'] ?? old('no_hp_wali') ?>">
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Biodata</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

