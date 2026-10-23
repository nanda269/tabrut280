<?php
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';

$npm_id = $_GET['npm'] ?? '';
$query_mhs = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm = '$npm_id'");
$data = mysqli_fetch_assoc($query_mhs);

if (!$data) {
    redirect('pages/mahasiswa/index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_mahasiswa']);
    $jk = $_POST['jenis_kelamin'];
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $id_prodi = $_POST['id_prodi'];

    $sql = "UPDATE mahasiswa SET 
            nama_mahasiswa = '$nama', 
            jenis_kelamin = '$jk', 
            tempat_lahir = '$tempat_lahir', 
            tanggal_lahir = '$tanggal_lahir', 
            tanggal_masuk = '$tanggal_masuk', 
            alamat = '$alamat', 
            id_prodi = '$id_prodi'";
    
    // Update password only if provided
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql .= ", password = '$password'";
    }
    
    $sql .= " WHERE npm = '$npm_id'";

    if (mysqli_query($conn, $sql)) {
        logActivity("Update mahasiswa: $npm_id");
        showAlert("Data mahasiswa berhasil diperbarui!");
        redirect('pages/mahasiswa/index.php');
    } else {
        $error = "Gagal memperbarui data: " . mysqli_error($conn);
    }
}

$prodis = mysqli_query($conn, "SELECT p.*, f.nama_fakultas FROM prodi p JOIN fakultas f ON p.id_fakultas = f.id");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Edit Mahasiswa</h1>
    <a href="index.php" class="btn btn-light border btn-sm">Kembali</a>
</div>

<div class="card shadow-sm col-lg-8">
    <div class="card-body p-4">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">NPM</label>
                    <input type="text" class="form-control bg-light" value="<?= $data['npm'] ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama_mahasiswa" class="form-control" value="<?= $data['nama_mahasiswa'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Program Studi</label>
                    <select name="id_prodi" class="form-select" required>
                        <?php while ($p = mysqli_fetch_assoc($prodis)): ?>
                            <option value="<?= $p['id'] ?>" <?= $data['id_prodi'] == $p['id'] ? 'selected' : '' ?>>
                                <?= $p['nama_prodi'] ?> (<?= $p['nama_fakultas'] ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= $data['tempat_lahir'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="<?= $data['tanggal_masuk'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat'] ?></textarea>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">Update Data</button>
                    <a href="index.php" class="btn btn-light border px-4">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php'; ?>
