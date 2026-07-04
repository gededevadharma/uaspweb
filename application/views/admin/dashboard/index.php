<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="jumlah"><?= $total_buku ?></div>
                    <small>Total Buku</small>
                </div>
                <i class="bi bi-book-fill"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="jumlah"><?= $total_peminjam ?></div>
                    <small>Total Peminjam</small>
                </div>
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card" style="background: linear-gradient(135deg, #a18cd1, #fbc2eb);">
            <div class="d-flex justify-content-between">
                <div>
                    <div class="jumlah"><?= $total_dikembalikan ?></div>
                    <small>Dikembalikan</small>
                </div>
                <i class="bi bi-arrow-return-left"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-journal-text"></i> Peminjaman Terbaru</span>
                <a href="<?= base_url('admin/peminjaman') ?>" class="btn btn-sm btn-outline-dark">Lihat</a>
            </div>
            <div class="card-body">
                <?php if ($peminjaman_terbaru): ?>
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <?php foreach ($peminjaman_terbaru as $p): ?>
                        <tr>
                            <td><strong><?= $p->nama_peminjam ?></strong></td>
                            <td><?= character_limiter($p->judul_buku, 20) ?></td>
                            <td>
                                <?php if ($p->status == 'dipinjam'): ?>
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Kembali</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-muted text-center py-3 mb-0">Belum ada peminjaman</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-book-fill"></i> Buku Terbaru</span>
                <a href="<?= base_url('admin/buku') ?>" class="btn btn-sm btn-outline-dark">Lihat</a>
            </div>
            <div class="card-body">
                <?php if ($buku_terbaru): ?>
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <?php foreach ($buku_terbaru as $b): ?>
                        <tr>
                            <td><strong><?= character_limiter($b->judul, 25) ?></strong></td>
                            <td><small class="text-muted"><?= $b->pengarang ?: '-' ?></small></td>
                            <td><span class="badge bg-secondary"><?= $b->tersedia ?>/<?= $b->jumlah ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-muted text-center py-3 mb-0">Belum ada buku</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people-fill"></i> Peminjam Terbaru</span>
                <a href="<?= base_url('admin/peminjam') ?>" class="btn btn-sm btn-outline-dark">Lihat</a>
            </div>
            <div class="card-body">
                <?php if ($peminjam_terbaru): ?>
                <table class="table table-sm table-borderless mb-0">
                    <tbody>
                        <?php foreach ($peminjam_terbaru as $p): ?>
                        <tr>
                            <td><strong><?= $p->nama ?></strong></td>
                            <td><?= $p->no_hp ?: '-' ?></td>
                            <td><small class="text-muted"><?= date('d/m/Y', strtotime($p->created_at)) ?></small></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-muted text-center py-3 mb-0">Belum ada peminjam</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
