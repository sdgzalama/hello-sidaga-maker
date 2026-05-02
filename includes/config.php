<?php
// Site-wide configuration
// Edit these values to match your local environment.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Site
define('SITE_NAME', 'HopeBridge NGO');
define('SITE_TAGLINE', 'Care, Compassion, Community');
define('SITE_EMAIL', 'contact@hopebridge.org');
define('SITE_PHONE', '+1 (555) 123-4567');
define('SITE_ADDRESS', '123 Charity Lane, Hope City');

// Base URL — change if you serve under a sub-path
define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets/');

// Database (used later when backend is wired up)
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'ngo_site');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Helpers
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
