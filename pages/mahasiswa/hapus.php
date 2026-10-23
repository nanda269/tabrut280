<?php
require_once '../../includes/functions.php';
checkLogin();

$npm = $_GET['npm'] ?? '';
if (!empty($npm)) {
    $query = "DELETE FROM mahasiswa WHERE npm = '$npm'";
    if (mysqli_query($conn, $query)) {
        logActivity("Hapus mahasiswa: $npm");
        showAlert("Data mahasiswa berhasil dihapus!");
    } else {
        showAlert("Gagal menghapus data: " . mysqli_error($conn), 'danger');
    }
}
redirect('pages/mahasiswa/index.php');
?>
