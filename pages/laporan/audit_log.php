<?php
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';

if ($_SESSION['role'] != 'Admin') {
    redirect('index.php');
}

$query = "SELECT a.*, u.username, u.nama_lengkap 
          FROM audit_log a 
          LEFT JOIN users u ON a.user_id = u.id 
          ORDER BY a.timestamp DESC 
          LIMIT 100";
$result = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Audit Log</h1>
    <small class="text-muted">Menampilkan 100 aktivitas terbaru</small>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">Waktu</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="px-4 text-muted small"><?= date('d/m/Y H:i:s', strtotime($row['timestamp'])) ?></td>
                        <td>
                            <div class="fw-bold fs-7"><?= $row['nama_lengkap'] ?></div>
                            <small class="text-muted fs-8">@<?= $row['username'] ?></small>
                        </td>
                        <td><?= $row['action'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
