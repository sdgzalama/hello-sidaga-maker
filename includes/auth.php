<?php
// Simple auth helpers, wire to DB later.
require_once __DIR__ . '/config.php';

function is_logged_in() {
    return !empty($_SESSION['admin_user']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . url('admin/login.php'));
        exit;
    }
}

function current_admin() {
    return $_SESSION['admin_user'] ?? null;
}

function logout() {
    unset($_SESSION['admin_user']);
    session_destroy();
}
