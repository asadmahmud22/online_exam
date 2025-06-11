<?php
function encrypt_password($password) {
    // Tidak menggunakan enkripsi
    return $password;
}

function verify_password($password, $hash) {
    // Bandingkan langsung password dengan nilai yang disimpan
    return $password === $hash;
}

function check_login($role) {
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== $role) {
        header("Location: login.php");
        exit();
    }
}
?>
