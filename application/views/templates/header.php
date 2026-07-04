<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        html, body { height: 100%; margin: 0; }
        body { background: #f4f6f9; font-family: 'Segoe UI', Tahoma, sans-serif; display: flex; flex-direction: column; }
        .wrapper { flex: 1 0 auto; display: flex; flex-direction: column; }
        .content-wrap { flex: 1 0 auto; width: 100%; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.4rem; }
        .nav-link { font-weight: 500; }
        .card { border-radius: 15px; border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.05); transition: all 0.3s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .card-header { border-radius: 15px 15px 0 0 !important; font-weight: 600; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #5a6fd6 0%, #6a4192 100%); transform: translateY(-1px); box-shadow: 0 5px 15px rgba(102,126,234,0.4); }
        .btn-outline-primary { border-color: #764ba2; color: #764ba2; }
        .btn-outline-primary:hover { background: #764ba2; border-color: #764ba2; color: white; }
        .badge-status { padding: 6px 12px; border-radius: 20px; font-weight: 500; }
        .page-link { color: #764ba2; }
        .page-item.active .page-link { background: #764ba2; border-color: #764ba2; }
        a { color: #764ba2; }
        .stat-card { padding: 20px; border-radius: 15px; color: white; }
        .stat-card .jumlah { font-size: 2rem; font-weight: 700; }
        .stat-card i { font-size: 2.5rem; opacity: 0.9; }
        .book-cover { height: 200px; object-fit: cover; border-radius: 10px; }
        .search-box { border-radius: 25px; padding: 10px 20px; border: 2px solid #e9ecef; }
        .search-box:focus { border-color: #764ba2; box-shadow: none; }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url('dashboard') ?>">
                    <i class="bi bi-book-fill"></i> Perpustakaan
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="bi bi-house-fill"></i> Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('buku') ?>"><i class="bi bi-book"></i> Buku</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('peminjaman') ?>"><i class="bi bi-journal-text"></i> Peminjaman Saya</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?= $this->session->userdata('nama') ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>"><i class="bi bi-person"></i> Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content-wrap">
            <div class="container mt-4">
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
