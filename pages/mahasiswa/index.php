<?php
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';

$query = "SELECT m.*, p.nama_prodi, f.nama_fakultas 
          FROM mahasiswa m 
          LEFT JOIN prodi p ON m.id_prodi = p.id 
          LEFT JOIN fakultas f ON p.id_fakultas = f.id 
          ORDER BY m.npm ASC";
$result = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Mahasiswa</h1>
    <a href="tambah.php" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
    </a>
</div>

<?= getAlert() ?>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">No.</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi / Fakultas</th>
                        <th>JK</th>
                        <th>TTL</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)): 
                    ?>
                    <tr>
                        <td class="px-4"><?= $no++ ?></td>
                        <td class="fw-bold"><?= $row['npm'] ?></td>
                        <td><?= $row['nama_mahasiswa'] ?></td>
                        <td>
                            <div class="fw-bold fs-7"><?= $row['nama_prodi'] ?></div>
                            <small class="text-muted fs-8"><?= $row['nama_fakultas'] ?></small>
                        </td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td>
                            <div class="fs-7"><?= $row['tempat_lahir'] ?></div>
                            <small class="text-muted fs-8"><?= date('d-m-Y', strtotime($row['tanggal_lahir'])) ?></small>
                        </td>
                        <td>
                            <a href="edit.php?npm=<?= $row['npm'] ?>" class="btn btn-light btn-sm text-primary border" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="hapus.php?npm=<?= $row['npm'] ?>" class="btn btn-light btn-sm text-danger border" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if (mysqli_num_rows($result) == 0): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada data mahasiswa.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
