<?php
require_once 'includes/functions.php';

if (isset($_SESSION['user_id'])) {
    redirect('index.php');
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    $query = "SELECT u.*, r.nama_role FROM users u JOIN roles r ON u.role_id = r.id WHERE username = '$username' AND status = 'Aktif'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role'] = $user['nama_role'];
            
            logActivity("Login ke sistem");
            redirect('index.php');
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan atau akun tidak aktif!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Mahasiswa UMB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { max-width: 400px; margin-top: 100px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .card-header { background-color: #004d40; color: white; border-radius: 15px 15px 0 0 !important; text-align: center; padding: 20px; }
        .btn-primary { background-color: #004d40; border: none; }
        .btn-primary:hover { background-color: #00332c; }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card">
            <div class="card-header">
                <h4>SIM Mahasiswa</h4>
                <small>Universitas Muhammadiyah Bengkulu</small>
            </div>
            <div class="card-body p-4">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                </form>
            </div>
        </div>
        <div class="text-center mt-3 text-muted">
            <small>&copy; 2026 Universitas Muhammadiyah Bengkulu</small>
        </div>
    </div>
</body>
</html>
