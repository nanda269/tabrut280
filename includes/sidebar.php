<aside class="sidebar bg-dark text-white shadow-sm pt-5 mt-3">
    <div class="p-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white px-3 py-2 rounded d-flex align-items-center" href="<?= BASE_URL ?>index.php">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
        </ul>

        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white px-3 py-2 rounded d-flex align-items-center" href="<?= BASE_URL ?>pages/mahasiswa/index.php">
                    <i class="bi bi-people me-2"></i> Data Mahasiswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white px-3 py-2 rounded d-flex align-items-center" href="<?= BASE_URL ?>pages/fakultas/index.php">
                    <i class="bi bi-building me-2"></i> Fakultas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white px-3 py-2 rounded d-flex align-items-center" href="<?= BASE_URL ?>pages/prodi/index.php">
                    <i class="bi bi-journal-text me-2"></i> Program Studi
                </a>
            </li>
        </ul>

       
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white px-3 py-2 rounded d-flex align-items-center" href="<?= BASE_URL ?>pages/laporan/index.php">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i> Rekap Mahasiswa
                </a>
            </li>
        </ul>

        <?php if ($_SESSION['role'] == 'Admin'): ?>
        <div class="menu-label text-muted small text-uppercase mb-2 px-3 mt-4">Sistem</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white px-3 py-2 rounded d-flex align-items-center" href="<?= BASE_URL ?>pages/users/index.php">
                    <i class="bi bi-person-gear me-2"></i> Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white px-3 py-2 rounded d-flex align-items-center" href="<?= BASE_URL ?>pages/laporan/audit_log.php">
                    <i class="bi bi-journal-check me-2"></i> Audit Log
                </a>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</aside>
<main class="content mt-5 pt-4 px-4">
