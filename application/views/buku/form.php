<div class="mb-3">
    <a href="<?= base_url('buku') ?>" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control" value="<?= set_value('judul', isset($buku) ? $buku->judul : '') ?>" required>
                    <?= form_error('judul', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="<?= set_value('isbn', isset($buku) ? $buku->isbn : '') ?>">
                    <?= form_error('isbn', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pengarang</label>
                    <input type="text" name="pengarang" class="form-control" value="<?= set_value('pengarang', isset($buku) ? $buku->pengarang : '') ?>">
                    <?= form_error('pengarang', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= set_value('penerbit', isset($buku) ? $buku->penerbit : '') ?>">
                    <?= form_error('penerbit', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun" class="form-control" value="<?= set_value('tahun', isset($buku) ? $buku->tahun : '') ?>" min="1900" max="<?= date('Y') ?>">
                    <?= form_error('tahun', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Jumlah Eksemplar</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= set_value('jumlah', isset($buku) ? $buku->jumlah : '1') ?>" min="1">
                    <?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
                    <?php if (isset($buku)): ?>
                    <small class="text-muted">Tersedia saat ini: <?= $buku->tersedia ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"><?= set_value('deskripsi', isset($buku) ? $buku->deskripsi : '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> <?= isset($buku) ? 'Simpan Perubahan' : 'Simpan' ?>
            </button>
        </form>
    </div>
</div>
