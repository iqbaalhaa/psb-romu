<?= $this->extend('template/v_template_backenduser') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1>Detail Santri</h1>
    <form action="<?= base_url('Santri/UpdateBiodata') ?>" method="post">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lengkapi Biodata Santri</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
                </div>
                <div class="form-group">
                    <label for="no_telepon">No Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="no_telepon" class="form-control" id="no_telepon" placeholder="Masukkan nomor telepon" required>
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label for="jenjang">Jenjang <span class="text-danger">*</span></label>
                    <select name="jenjang" class="form-control" id="jenjang" required>
                        <option value="" disabled selected>Pilih Jenjang</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="<?= base_url('User/DataSantri') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>