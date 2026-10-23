<?php
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';

if ($_SESSION['role'] != 'Admin') {
    redirect('index.php');
}

if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = $_POST['role_id'];

    $query = "INSERT INTO users (username, password, nama_lengkap, role_id) VALUES ('$username', '$password', '$nama', '$role_id')";
    if (mysqli_query($conn, $query)) {
        logActivity("Tambah user: $username");
        showAlert("User berhasil ditambahkan!");
    } else {
        showAlert("Gagal: " . mysqli_error($conn), 'danger');
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id != $_SESSION['user_id']) {
        mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
        logActivity("Hapus user ID: $id");
        showAlert("User berhasil dihapus!");
    } else {
        showAlert("Tidak dapat menghapus diri sendiri!", 'danger');
    }
    redirect('pages/users/index.php');
}

$result = mysqli_query($conn, "SELECT u.*, r.nama_role FROM users u JOIN roles r ON u.role_id = r.id");
$roles = mysqli_query($conn, "SELECT * FROM roles");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Manajemen Pengguna</h1>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-person-plus"></i> Tambah Pengguna
    </button>
</div>

<?= getAlert() ?>

<div class="card shadow-sm col-lg-8">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">No.</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
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
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td>@<?= $row['username'] ?></td>
                        <td><span class="badge bg-secondary"><?= $row['nama_role'] ?></span></td>
                        <td><span class="badge bg-success"><?= $row['status'] ?></span></td>
                        <td>
                            <?php if ($row['id'] != $_SESSION['user_id']): ?>
                            <a href="?hapus=<?= $row['id'] ?>" class="btn btn-light btn-sm text-danger border" onclick="return confirm('Hapus user ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <?php while ($r = mysqli_fetch_assoc($roles)): ?>
                            <option value="<?= $r['id'] ?>"><?= $r['nama_role'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
