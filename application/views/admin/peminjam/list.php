<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted"><i class="bi bi-people-fill"></i> Daftar Peminjam</span>
    <form action="<?= base_url('admin/peminjam') ?>" method="get" class="d-flex">
        <input type="text" name="search" class="form-control search-box me-2" placeholder="Cari nama/no HP..." value="<?= $search ?>">
        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
        <?php if ($search): ?>
        <a href="<?= base_url('admin/peminjam') ?>" class="btn btn-outline-danger ms-1"><i class="bi bi-x-circle"></i></a>
        <?php endif; ?>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <?php if ($peminjam): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>No</th><th>Nama</th><th>No. HP</th><th>Alamat</th><th>Tgl Daftar</th></tr></thead>
                <tbody>
                    <?php $no = $start + 1; foreach ($peminjam as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $p->nama ?></strong></td>
                        <td><?= $p->no_hp ?: '-' ?></td>
                        <td><?= $p->alamat ?: '-' ?></td>
                        <td><?= date('d/m/Y', strtotime($p->created_at)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($total > $limit): ?>
        <nav><ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= ceil($total / $limit); $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="<?= base_url('admin/peminjam?page=' . $i . ($search ? '&search=' . $search : '')) ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul></nav>
        <?php endif; ?>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-people" style="font-size: 4rem; color: #ccc;"></i>
            <h5 class="mt-3 text-muted">Belum ada data peminjam</h5>
        </div>
        <?php endif; ?>
    </div>
</div>
