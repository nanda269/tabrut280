<?php
require_once __DIR__ . '/../config.php';

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "login.php");
        exit();
    }
}

function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}

function showAlert($message, $type = 'success') {
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
}

function getAlert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);
        return "<div class='alert alert-{$alert['type']} alert-dismissible fade show' role='alert'>
                    {$alert['message']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
    }
    return "";
}

function logActivity($action) {
    global $conn;
    $user_id = $_SESSION['user_id'] ?? null;
    $action = mysqli_real_escape_string($conn, $action);
    $query = "INSERT INTO audit_log (user_id, action) VALUES ('$user_id', '$action')";
    mysqli_query($conn, $query);
}
?>
