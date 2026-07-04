<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?> - Admin Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        html, body { height: 100%; margin: 0; }
        body { background: #f4f6f9; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0; width: 250px;
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            padding-top: 20px; z-index: 1000; overflow-y: auto;
        }
        .sidebar .brand { color: white; text-align: center; padding: 20px 15px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 10px; }
        .sidebar .brand i { font-size: 36px; }
        .sidebar .brand h5 { font-weight: 700; margin-top: 8px; }
        .sidebar .nav-link { color: rgba(255,255,255,0.7); padding: 12px 20px; margin: 2px 10px; border-radius: 10px; font-size: 14px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
        .sidebar .nav-link i { margin-right: 10px; width: 20px; text-align: center; }
        .content-wrap { margin-left: 250px; display: flex; flex-direction: column; min-height: 100vh; }
        .content-body { flex: 1; padding: 20px 30px; }
        .navbar-admin {
            background: white; border-radius: 15px; padding: 12px 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 25px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .card { border-radius: 15px; border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.05); transition: all 0.3s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .card-header { border-radius: 15px 15px 0 0 !important; font-weight: 600; }
        .stat-card { padding: 20px; border-radius: 15px; color: white; }
        .stat-card i { font-size: 2.5rem; opacity: 0.9; }
        .stat-card .jumlah { font-size: 2rem; font-weight: 700; }
        .btn-primary { background: #2c3e50; border: none; }
        .btn-primary:hover { background: #1a252f; }
        .btn-success { background: #27ae60; border: none; }
        .btn-warning { background: #f39c12; border: none; color: white; }
        .btn-danger { background: #e74c3c; border: none; }
        .btn-info { background: #3498db; border: none; color: white; }
        .badge-status { padding: 6px 12px; border-radius: 20px; font-weight: 500; font-size: 12px; }
        .page-link { color: #2c3e50; }
        .page-item.active .page-link { background: #2c3e50; border-color: #2c3e50; }
        .table th { background: #f8f9fa; color: #2c3e50; font-weight: 600; }
        a { color: #2c3e50; }
        .search-box { border-radius: 25px; padding: 8px 18px; border: 2px solid #e9ecef; }
        .search-box:focus { border-color: #2c3e50; box-shadow: none; }
        @media (max-width: 768px) {
            .sidebar { width: 100%; position: relative; height: auto; }
            .content-wrap { margin-left: 0; }
            .content-body { padding: 15px; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            <i class="bi bi-shield-lock-fill"></i>
            <h5>Perpustakaan</h5>
            <small style="color: rgba(255,255,255,0.5)">Sistem Manajemen</small>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'buku' ? 'active' : '' ?>" href="<?= base_url('buku') ?>"><i class="bi bi-book-fill"></i> Kelola Buku</a></li>
            <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'peminjaman' ? 'active' : '' ?>" href="<?= base_url('peminjaman') ?>"><i class="bi bi-journal-text"></i> Kelola Peminjaman</a></li>
            <li class="nav-item" style="margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                <a class="nav-link" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="content-wrap">
        <div class="content-body">
            <div class="navbar-admin">
                <div>
                    <h5 class="mb-0"><i class="bi bi-grid-fill"></i> <?= $judul ?></h5>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle me-2" style="font-size: 1.2rem;"></i>
                    <span class="fw-semibold"><?= $this->session->userdata('nama') ?></span>
                    <span class="badge bg-dark ms-2">Petugas</span>
                </div>
            </div>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill"></i> <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill"></i> <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
