<div class="mb-3">
    <a href="<?= base_url('peminjam') ?>" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" value="<?= set_value('nama', isset($peminjam) ? $peminjam->nama : '') ?>" required>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp', isset($peminjam) ? $peminjam->no_hp : '') ?>">
                <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="mb-4">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2"><?= set_value('alamat', isset($peminjam) ? $peminjam->alamat : '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
        </form>
    </div>
</div>
