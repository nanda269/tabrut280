<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Get Stats
$total_mhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM mahasiswa"))['count'];
$total_prodi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM prodi"))['count'];
$total_fakultas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM fakultas"))['count'];
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Dashboard</h1>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                    <i class="bi bi-people text-primary fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Mahasiswa</div>
                    <div class="h4 mb-0 fw-bold"><?= $total_mhs ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3">
                    <i class="bi bi-journal-text text-success fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Program Studi</div>
                    <div class="h4 mb-0 fw-bold"><?= $total_prodi ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="rounded-3 bg-warning bg-opacity-10 p-3 me-3">
                    <i class="bi bi-building text-warning fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Fakultas</div>
                    <div class="h4 mb-0 fw-bold"><?= $total_fakultas ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="rounded-3 bg-info bg-opacity-10 p-3 me-3">
                    <i class="bi bi-shield-lock text-info fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Hak Akses</div>
                    <div class="h4 mb-0 fw-bold"><?= $_SESSION['role'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card p-4 mb-4">
            <h5 class="fw-bold mb-4">Informasi Sistem</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="text-muted small">Universitas</div>
                    <div class="fw-bold">Universitas Muhammadiyah Bengkulu</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Role</div>
                    <div class="fw-bold"><?= $_SESSION['role'] ?></div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Username</div>
                    <div class="fw-bold"><?= $_SESSION['username'] ?></div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Status</div>
                    <div class="text-success fw-bold">Aktif</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card p-4 mb-4 h-100">
            <h5 class="fw-bold mb-4">Waktu Saat Ini</h5>
            <div class="text-center py-4">
                <div class="h2 fw-bold mb-0" id="clock">00:00:00</div>
                <div class="text-muted"><?= date('d F Y') ?></div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const time = now.toLocaleTimeString('id-ID');
        document.getElementById('clock').innerText = time;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

<?php require_once 'includes/footer.php'; ?>
