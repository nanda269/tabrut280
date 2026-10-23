<?php
require_once __DIR__ . '/functions.php';
checkLogin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM Mahasiswa - UMB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="wrapper">
        <!-- Navbar Top -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top px-4">
            <div class="container-fluid">
                <button class="btn btn-link d-lg-none" id="sidebarToggle">
                    <i class="bi bi-list fs-4 text-dark"></i>
                </button>
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0 fw-bold">SIM Mahasiswa</h6>
                        <small class="text-muted">Universitas Muhammadiyah Bengkulu</small>
                    </div>
                </div>
                <div class="ms-auto d-flex align-items-center">
                    <div class="d-flex align-items-center me-3">
                        <div class="avatar bg-success text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                            <?= substr($_SESSION['nama_lengkap'], 0, 1) ?>
                        </div>
                        <div class="d-none d-md-block">
                            <h6 class="mb-0 fw-bold fs-7"><?= $_SESSION['nama_lengkap'] ?></h6>
                            <small class="text-muted fs-8"><?= $_SESSION['role'] ?></small>
                        </div>
                    </div>
                    <a href="<?= BASE_URL ?>logout.php" class="btn btn-outline-danger btn-sm">Keluar</a>
                </div>
            </div>
        </nav>
