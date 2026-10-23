<?php
require_once '../../includes/header.php';
require_once '../../includes/sidebar.php';

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_prodi']);
    $id_fakultas = $_POST['id_fakultas'];
    mysqli_query($conn, "INSERT INTO prodi (nama_prodi, id_fakultas) VALUES ('$nama', '$id_fakultas')");
    logActivity("Tambah prodi: $nama");
    showAlert("Program Studi berhasil ditambahkan!");
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_prodi']);
    $id_fakultas = $_POST['id_fakultas'];
    mysqli_query($conn, "UPDATE prodi SET nama_prodi = '$nama', id_fakultas = '$id_fakultas' WHERE id = '$id'");
    logActivity("Edit prodi ID: $id menjadi $nama");
    showAlert("Program Studi berhasil diperbarui!");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM prodi WHERE id = '$id'");
    logActivity("Hapus prodi ID: $id");
    showAlert("Program Studi berhasil dihapus!");
    redirect('pages/prodi/index.php');
}

$result = mysqli_query($conn, "SELECT p.*, f.nama_fakultas FROM prodi p JOIN fakultas f ON p.id_fakultas = f.id ORDER BY f.nama_fakultas, p.nama_prodi ASC");
$fakultas_query = mysqli_query($conn, "SELECT * FROM fakultas");
$list_fakultas = [];
while ($f = mysqli_fetch_assoc($fakultas_query)) {
    $list_fakultas[] = $f;
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Program Studi</h1>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Prodi
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
                        <th>Program Studi</th>
                        <th>Fakultas</th>
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
                        <td><?= $row['nama_prodi'] ?></td>
                        <td><?= $row['nama_fakultas'] ?></td>
                        <td>
                            <button class="btn btn-light btn-sm text-primary border me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="?hapus=<?= $row['id'] ?>" class="btn btn-light btn-sm text-danger border" onclick="return confirm('Hapus prodi ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" class="modal-content text-start">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Program Studi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Prodi</label>
                                                <input type="text" name="nama_prodi" class="form-control" value="<?= $row['nama_prodi'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Fakultas</label>
                                                <select name="id_fakultas" class="form-select" required>
                                                    <?php foreach ($list_fakultas as $f): ?>
                                                        <option value="<?= $f['id'] ?>" <?= $row['id_fakultas'] == $f['id'] ? 'selected' : '' ?>>
                                                            <?= $f['nama_fakultas'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                <h5 class="modal-title">Tambah Program Studi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Prodi</label>
                    <input type="text" name="nama_prodi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <select name="id_fakultas" class="form-select" required>
                        <?php foreach ($list_fakultas as $f): ?>
                            <option value="<?= $f['id'] ?>"><?= $f['nama_fakultas'] ?></option>
                        <?php endforeach; ?>
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
