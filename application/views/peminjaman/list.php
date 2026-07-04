<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Peminjaman</a>
    <div class="d-flex gap-2">
        <a href="<?= base_url('peminjaman') ?>" class="btn btn-outline-dark btn-sm <?= !$status_filter ? 'active' : '' ?>">Semua</a>
        <a href="<?= base_url('peminjaman?status=dipinjam') ?>" class="btn btn-outline-warning btn-sm <?= $status_filter == 'dipinjam' ? 'active' : '' ?>">Dipinjam</a>
        <a href="<?= base_url('peminjaman?status=dikembalikan') ?>" class="btn btn-outline-success btn-sm <?= $status_filter == 'dikembalikan' ? 'active' : '' ?>">Dikembalikan</a>
        <a href="<?= base_url('peminjaman?status=terlambat') ?>" class="btn btn-outline-danger btn-sm <?= $status_filter == 'terlambat' ? 'active' : '' ?>">Terlambat</a>
        <form action="<?= base_url('peminjaman') ?>" method="get" class="d-flex ms-2">
            <?php if ($status_filter): ?>
            <input type="hidden" name="status" value="<?= $status_filter ?>">
            <?php endif; ?>
            <input type="text" name="search" class="form-control search-box me-2" placeholder="Cari..." value="<?= $search ?>">
            <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
            <?php if ($search || $status_filter): ?>
            <a href="<?= base_url('peminjaman') ?>" class="btn btn-outline-danger ms-1"><i class="bi bi-x-circle"></i></a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if ($peminjaman): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>No</th><th>Peminjam</th><th>No. HP</th><th>Alamat</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Tgl Dikembalikan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    <?php $no = $start + 1; foreach ($peminjaman as $p):
                        $terlambat = ($p->status == 'dipinjam' && strtotime($p->tgl_kembali) < time());
                    ?>
                    <tr class="<?= $terlambat ? 'table-danger' : '' ?>">
                        <td><?= $no++ ?></td>
                        <td><strong><?= $p->nama_peminjam ?></strong></td>
                        <td><?= $p->no_hp ?: '-' ?></td>
                        <td><?= $p->alamat ?: '-' ?></td>
                        <td><?= character_limiter($p->judul_buku, 25) ?></td>
                        <td><?= date('d/m/Y', strtotime($p->tgl_pinjam)) ?></td>
                        <td><?= date('d/m/Y', strtotime($p->tgl_kembali)) ?></td>
                        <td><?= $p->tgl_dikembalikan ? date('d/m/Y', strtotime($p->tgl_dikembalikan)) : '-' ?></td>
                        <td>
                            <?php if ($terlambat): ?>
                                <span class="badge bg-danger">Terlambat</span>
                            <?php elseif ($p->status == 'dipinjam'): ?>
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            <?php else: ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal"
                                data-peminjam="<?= htmlspecialchars($p->nama_peminjam, ENT_QUOTES) ?>"
                                data-nohp="<?= htmlspecialchars($p->no_hp, ENT_QUOTES) ?>"
                                data-alamat="<?= htmlspecialchars($p->alamat, ENT_QUOTES) ?>"
                                data-buku="<?= htmlspecialchars($p->judul_buku, ENT_QUOTES) ?>"
                                data-pengarang="<?= htmlspecialchars($p->pengarang, ENT_QUOTES) ?>"
                                data-penerbit="<?= htmlspecialchars($p->penerbit, ENT_QUOTES) ?>"
                                data-isbn="<?= htmlspecialchars($p->isbn, ENT_QUOTES) ?>"
                                data-tglpinjam="<?= $p->tgl_pinjam ?>"
                                data-tglkembali="<?= $p->tgl_kembali ?>"
                                data-tgldikembalikan="<?= $p->tgl_dikembalikan ?>"
                                data-status="<?= $p->status ?>"
                                data-terlambat="<?= $terlambat ? 'true' : 'false' ?>">
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if ($p->status == 'dipinjam'): ?>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#kembalikanModal"
                                data-id="<?= $p->id ?>"
                                data-judul="<?= htmlspecialchars($p->judul_buku, ENT_QUOTES) ?>"
                                data-peminjam="<?= htmlspecialchars($p->nama_peminjam, ENT_QUOTES) ?>">
                                <i class="bi bi-arrow-return-left"></i>
                            </button>
                            <?php else: ?>
                            <span class="text-muted small">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($total > $limit): ?>
        <nav><ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= ceil($total / $limit); $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="<?= base_url('peminjaman?page=' . $i . ($search ? '&search=' . $search : '') . ($status_filter ? '&status=' . $status_filter : '')) ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul></nav>
        <?php endif; ?>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
            <h5 class="mt-3 text-muted">Belum ada data peminjaman</h5>
            <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary mt-2">Tambah Peminjaman</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal View Detail -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i> Detail Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold border-bottom pb-2"><i class="bi bi-person-fill"></i> Data Peminjam</h6>
                        <table class="table table-sm table-borderless">
                            <tr><td class="text-muted" style="width:100px">Nama</td><td><strong id="view-nama"></strong></td></tr>
                            <tr><td class="text-muted">No. HP</td><td id="view-nohp"></td></tr>
                            <tr><td class="text-muted">Alamat</td><td id="view-alamat"></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold border-bottom pb-2"><i class="bi bi-book-fill"></i> Data Buku</h6>
                        <table class="table table-sm table-borderless">
                            <tr><td class="text-muted" style="width:100px">Judul</td><td><strong id="view-buku"></strong></td></tr>
                            <tr><td class="text-muted">Pengarang</td><td id="view-pengarang"></td></tr>
                            <tr><td class="text-muted">Penerbit</td><td id="view-penerbit"></td></tr>
                            <tr><td class="text-muted">ISBN</td><td id="view-isbn"></td></tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="fw-bold border-bottom pb-2"><i class="bi bi-calendar-event"></i> Data Peminjaman</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td class="text-muted" style="width:120px">Tgl Pinjam</td>
                                <td><strong id="view-tglpinjam"></strong></td>
                                <td class="text-muted" style="width:120px">Tgl Kembali</td>
                                <td><strong id="view-tglkembali"></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tgl Dikembalikan</td>
                                <td id="view-tgldikembalikan"></td>
                                <td class="text-muted">Status</td>
                                <td id="view-status"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kembalikan -->
<div class="modal fade" id="kembalikanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-arrow-return-left"></i> Konfirmasi Pengembalian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-check-circle" style="font-size: 4rem; color: #28a745;"></i>
                <h5 class="mt-3">Kembalikan Buku</h5>
                <p id="kembalikan-judul" class="fw-bold"></p>
                <p id="kembalikan-peminjam" class="text-muted"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="kembalikan-link" class="btn btn-success"><i class="bi bi-check-lg"></i> Ya, Kembalikan</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var viewModal = document.getElementById('viewModal');
    if (viewModal) {
        viewModal.addEventListener('show.bs.modal', function(event) {
            var btn = event.relatedTarget;
            document.getElementById('view-nama').textContent = btn.getAttribute('data-peminjam');
            document.getElementById('view-nohp').textContent = btn.getAttribute('data-nohp') || '-';
            document.getElementById('view-alamat').textContent = btn.getAttribute('data-alamat') || '-';
            document.getElementById('view-buku').textContent = btn.getAttribute('data-buku');
            document.getElementById('view-pengarang').textContent = btn.getAttribute('data-pengarang') || '-';
            document.getElementById('view-penerbit').textContent = btn.getAttribute('data-penerbit') || '-';
            document.getElementById('view-isbn').textContent = btn.getAttribute('data-isbn') || '-';
            document.getElementById('view-tglpinjam').textContent = btn.getAttribute('data-tglpinjam') ? new Date(btn.getAttribute('data-tglpinjam')).toLocaleDateString('id-ID') : '-';
            document.getElementById('view-tglkembali').textContent = btn.getAttribute('data-tglkembali') ? new Date(btn.getAttribute('data-tglkembali')).toLocaleDateString('id-ID') : '-';
            var tglDikembalikan = btn.getAttribute('data-tgldikembalikan');
            document.getElementById('view-tgldikembalikan').textContent = tglDikembalikan ? new Date(tglDikembalikan).toLocaleDateString('id-ID') : '-';
            var status = btn.getAttribute('data-status');
            var terlambat = btn.getAttribute('data-terlambat') === 'true';
            var statusHtml = '';
            if (terlambat) {
                statusHtml = '<span class="badge bg-danger">Terlambat</span>';
            } else if (status == 'dipinjam') {
                statusHtml = '<span class="badge bg-warning text-dark">Dipinjam</span>';
            } else {
                statusHtml = '<span class="badge bg-success">Dikembalikan</span>';
            }
            document.getElementById('view-status').innerHTML = statusHtml;
        });
    }

    var modal = document.getElementById('kembalikanModal');
    if (modal) {
        modal.addEventListener('show.bs.modal', function(event) {
            var btn = event.relatedTarget;
            document.getElementById('kembalikan-judul').textContent = '"' + btn.getAttribute('data-judul') + '"';
            document.getElementById('kembalikan-peminjam').textContent = 'Peminjam: ' + btn.getAttribute('data-peminjam');
            document.getElementById('kembalikan-link').href = '<?= base_url('peminjaman/kembali/') ?>' + btn.getAttribute('data-id');
        });
    }
});
</script>
