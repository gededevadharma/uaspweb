<div class="mb-3">
    <a href="<?= base_url('admin/peminjaman') ?>" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Peminjam <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama peminjam" value="<?= set_value('nama') ?>" required>
                    <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp') ?>">
                    <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat') ?>">
                    <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tgl Pinjam <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_pinjam" class="form-control" value="<?= set_value('tgl_pinjam', date('Y-m-d')) ?>" required>
                    <?= form_error('tgl_pinjam', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tgl Kembali <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_kembali" class="form-control" value="<?= set_value('tgl_kembali', date('Y-m-d', strtotime('+7 days'))) ?>" required>
                    <?= form_error('tgl_kembali', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Buku <span class="text-danger">*</span></label>
                    <select name="buku_id" class="form-select" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach ($buku as $b): ?>
                        <option value="<?= $b->id ?>" <?= set_select('buku_id', $b->id) ?>>
                            <?= $b->judul ?> <?= $b->tersedia > 0 ? '(Sisa: ' . $b->tersedia . ')' : '(Kosong)' ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('buku_id', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Peminjaman</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('tgl_pinjam').addEventListener('change', function() {
        var pinjam = new Date(this.value);
        if (pinjam) {
            var kembali = new Date(pinjam);
            kembali.setDate(kembali.getDate() + 7);
            document.getElementById('tgl_kembali').value = kembali.toISOString().split('T')[0];
        }
    });
});
</script>
