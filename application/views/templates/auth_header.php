<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?> - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        .auth-card .brand {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-card .brand i {
            font-size: 48px;
            color: #667eea;
        }
        .auth-card .brand h3 {
            font-weight: 700;
            color: #333;
            margin-top: 10px;
        }
        .auth-card .brand p {
            color: #888;
            font-size: 14px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd6 0%, #6a4192 100%);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118,75,162,0.25);
        }
        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand">
            <i class="bi bi-book-fill"></i>
            <h3>Perpustakaan</h3>
            <p>Sistem Manajemen Perpustakaan</p>
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
