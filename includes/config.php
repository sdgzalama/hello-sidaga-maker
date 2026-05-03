<?php
// Site-wide configuration for SustainLife Foundation (SLF)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('SITE_NAME', 'SustainLife Foundation');
define('SITE_SHORT', 'SLF');
define('SITE_TAGLINE', 'Healthy, Safe & Sustainable Communities');
define('SITE_EMAIL', 'jacobdamson120@gmail.com');
define('SITE_PHONE', '+255 656 891 338 / +255 788 312 626');
define('SITE_ADDRESS', 'Tanzania');

// Base URL — change if you serve under a sub-path
define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets/');

// Database (used later when backend is wired up)
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'slf_site');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

function url($path = '') {
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}
function asset($path = '') {
    return rtrim(ASSETS_URL, '/') . '/' . ltrim($path, '/');
}
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function is_active($page) {
    $current = basename($_SERVER['PHP_SELF']);
    return $current === $page ? 'active' : '';
}
