<?= $this->extend('templateuser/v_template_backenduser') ?>

<?= $this->section('content') ?>
<div class="col-md-6">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Form <?= $title ?></h3>
        </div>
        <div class="card-body">
            <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif ?>

            <?php echo form_open('Santri/updatePassword') ?>
            <div class="form-group">
                <label>Password Lama</label>
                <div class="input-group">
                    <input type="password" name="password_lama" class="form-control" id="password_lama" placeholder="Password Lama">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('password_lama')" style="cursor: pointer;">
                            <i class="fas fa-eye" id="icon_password_lama"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Password Baru</label>
                <div class="input-group">
                    <input type="password" name="password_baru" class="form-control" id="password_baru" placeholder="Password Baru">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('password_baru')" style="cursor: pointer;">
                            <i class="fas fa-eye" id="icon_password_baru"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="input-group">
                    <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" placeholder="Konfirmasi Password">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('konfirmasi_password')" style="cursor: pointer;">
                            <i class="fas fa-eye" id="icon_konfirmasi_password"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Update Password</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const icon = document.getElementById('icon_' + inputId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
<?= $this->endSection() ?>