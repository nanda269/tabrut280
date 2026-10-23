<?php
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';

$query = "SELECT p.nama_prodi, f.nama_fakultas, COUNT(m.npm) as total 
          FROM prodi p 
          JOIN fakultas f ON p.id_fakultas = f.id 
          LEFT JOIN mahasiswa m ON p.id = m.id_prodi 
          GROUP BY p.id 
          ORDER BY f.nama_fakultas, p.nama_prodi ASC";
$result = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Laporan Rekap Mahasiswa</h1>
    <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
        <i class="bi bi-printer"></i> Cetak Laporan
    </button>
</div>

<div class="card shadow-sm col-lg-8">
    <div class="card-body p-4">
        <div class="text-center mb-4">
            <h5 class="fw-bold mb-0">REKAPITULASI JUMLAH MAHASISWA</h5>
            <small class="text-muted">Universitas Muhammadiyah Bengkulu</small>
        </div>
        
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th width="50">No.</th>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                    <th width="150">Jumlah Mahasiswa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $grand_total = 0;
                while ($row = mysqli_fetch_assoc($result)): 
                    $grand_total += $row['total'];
                ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $row['nama_prodi'] ?></td>
                    <td><?= $row['nama_fakultas'] ?></td>
                    <td class="text-center fw-bold"><?= $row['total'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <th colspan="3" class="text-end px-4">TOTAL KESELURUHAN</th>
                    <th class="text-center"><?= $grand_total ?></th>
                </tr>
            </tfoot>
        </table>
        
        <div class="mt-5 d-none d-print-block">
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4 text-center">
                    <p>Bengkulu, <?= date('d F Y') ?></p>
                    <p class="mb-5">Dicetak Oleh,</p>
                    <br><br>
                    <p class="fw-bold mb-0"><?= $_SESSION['nama_lengkap'] ?></p>
                    <small>(<?= $_SESSION['role'] ?>)</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .sidebar, .navbar, .btn, .menu-label, .fixed-top { display: none !important; }
    .content { margin-left: 0 !important; width: 100% !important; padding: 0 !important; }
    .card { border: none !important; box-shadow: none !important; }
    body { background-color: white !important; }
}
</style>

<?php require_once '../../includes/footer.php'; ?>
