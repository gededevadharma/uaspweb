<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Buku</a>
    </div>
    <div>
        <form action="<?= base_url('buku') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control search-box me-2" placeholder="Cari buku..." value="<?= $search ?>">
            <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
            <?php if ($search): ?>
            <a href="<?= base_url('buku') ?>" class="btn btn-outline-danger ms-1"><i class="bi bi-x-circle"></i></a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if ($buku): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Total</th>
                        <th>Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = $start + 1; foreach ($buku as $b): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $b->judul ?></strong></td>
                        <td><?= $b->pengarang ?: '-' ?></td>
                        <td><?= $b->penerbit ?: '-' ?></td>
                        <td><?= $b->tahun ?: '-' ?></td>
                        <td><span class="badge bg-secondary"><?= $b->jumlah ?></span></td>
                        <td>
                            <?php if ($b->tersedia > 0): ?>
                                <span class="badge bg-success"><?= $b->tersedia ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger">0</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('buku/detail/' . $b->id) ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                            <a href="<?= base_url('buku/edit/' . $b->id) ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusBukuModal"
                                data-id="<?= $b->id ?>"
                                data-judul="<?= htmlspecialchars($b->judul, ENT_QUOTES) ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if ($total > $limit): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php $total_page = ceil($total / $limit); ?>
                <?php for ($i = 1; $i <= $total_page; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="<?= base_url('buku?page=' . $i . ($search ? '&search=' . $search : '')) ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>

        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
            <h5 class="mt-3 text-muted">Belum ada buku</h5>
            <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary mt-2">Tambah Buku</a>
        </div>
        <?php endif; ?>
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
            document.getElementById('hapusBukuLink').href = '<?= base_url('buku/hapus/') ?>' + btn.getAttribute('data-id');
        });
    }
});
</script>
