<form action="<?= base_url('admin/login') ?>" method="post">
    <div class="mb-3">
        <label class="form-label"><i class="bi bi-person-fill"></i> Username</label>
        <input type="text" name="username" class="form-control form-control-lg" placeholder="Masukkan username" value="<?= set_value('username') ?>" required autofocus>
        <?= form_error('username', '<small class="text-danger">', '</small>') ?>
    </div>
    <div class="mb-4">
        <label class="form-label"><i class="bi bi-key-fill"></i> Password</label>
        <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
        <?= form_error('password', '<small class="text-danger">', '</small>') ?>
    </div>
    <button type="submit" class="btn btn-primary w-100 btn-lg">Masuk <i class="bi bi-box-arrow-in-right"></i></button>
</form>
