<div class="mb-3">
    <a href="<?= base_url('admin/buku') ?>" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <i class="bi bi-journal-richtext" style="font-size: 8rem; color: #2c3e50;"></i>
            </div>
            <div class="col-md-9">
                <h4 class="fw-bold"><?= $buku->judul ?></h4>
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-2"><small class="text-muted d-block">Pengarang</small><strong><?= $buku->pengarang ?: '-' ?></strong></div>
                    <div class="col-md-4 mb-2"><small class="text-muted d-block">Penerbit</small><strong><?= $buku->penerbit ?: '-' ?></strong></div>
                    <div class="col-md-4 mb-2"><small class="text-muted d-block">ISBN</small><strong><?= $buku->isbn ?: '-' ?></strong></div>
                    <div class="col-md-4 mb-2"><small class="text-muted d-block">Tahun</small><strong><?= $buku->tahun ?: '-' ?></strong></div>
                    <div class="col-md-4 mb-2"><small class="text-muted d-block">Jumlah Total</small><strong><?= $buku->jumlah ?></strong></div>
                    <div class="col-md-4 mb-2"><small class="text-muted d-block">Tersedia</small>
                        <strong class="<?= $buku->tersedia > 0 ? 'text-success' : 'text-danger' ?>"><?= $buku->tersedia ?></strong>
                    </div>
                </div>
                <?php if ($buku->deskripsi): ?>
                <hr>
                <h6>Deskripsi</h6>
                <p class="text-muted"><?= nl2br($buku->deskripsi) ?></p>
                <?php endif; ?>
                <hr>
                <a href="<?= base_url('admin/buku/edit/' . $buku->id) ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusBukuModal"
                    data-id="<?= $buku->id ?>"
                    data-judul="<?= htmlspecialchars($buku->judul, ENT_QUOTES) ?>">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Buku -->
<div class="modal fade" id="hapusBukuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-trash" style="font-size: 4rem; color: #e74c3c;"></i>
                <h5 class="mt-3">Hapus Buku</h5>
                <p>Apakah Anda yakin ingin menghapus buku <strong id="hapusBukuJudul"></strong>?</p>
                <p class="text-danger small">Data peminjaman terkait juga akan dihapus.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="hapusBukuLink" class="btn btn-danger"><i class="bi bi-check-lg"></i> Ya, Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('hapusBukuModal');
    if (modal) {
        modal.addEventListener('show.bs.modal', function(event) {
            var btn = event.relatedTarget;
            document.getElementById('hapusBukuJudul').textContent = '"' + btn.getAttribute('data-judul') + '"';
            document.getElementById('hapusBukuLink').href = '<?= base_url('admin/buku/hapus/') ?>' + btn.getAttribute('data-id');
        });
    }
});
</script>
