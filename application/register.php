<form action="<?= base_url('register') ?>" method="post">
    <div class="mb-3">
        <label class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
        <input type="email" name="email" class="form-control form-control-lg" placeholder="email@contoh.com" value="<?= set_value('email') ?>" required autofocus>
        <?= form_error('email', '<small class="text-danger">', '</small>') ?>
    </div>
    <div class="mb-3">
        <label class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
        <input type="password" name="password" class="form-control form-control-lg" placeholder="Minimal 6 karakter" required>
        <?= form_error('password', '<small class="text-danger">', '</small>') ?>
    </div>
    <div class="mb-4">
        <label class="form-label"><i class="bi bi-lock-fill"></i> Konfirmasi Password</label>
        <input type="password" name="konfirmasi_password" class="form-control form-control-lg" placeholder="Ulangi password" required>
        <?= form_error('konfirmasi_password', '<small class="text-danger">', '</small>') ?>
    </div>
    <button type="submit" class="btn btn-primary w-100 btn-lg">Daftar <i class="bi bi-person-plus-fill"></i></button>
</form>
<div class="text-center mt-4">
    <small>Sudah punya akun? <a href="<?= base_url('login') ?>" class="fw-bold">Masuk disini</a></small>
</div>
