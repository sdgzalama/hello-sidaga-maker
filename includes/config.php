<?php
// Site-wide configuration for SustainLife Foundation (SLF)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PHP 7 polyfills for PHP 8 string helpers
if (!function_exists('str_starts_with')) {
    function str_starts_with($h, $n) { return $n === '' || strpos($h, $n) === 0; }
}
if (!function_exists('str_ends_with')) {
    function str_ends_with($h, $n) { return $n === '' || substr($h, -strlen($n)) === $n; }
}
if (!function_exists('str_contains')) {
    function str_contains($h, $n) { return $n === '' || strpos($h, $n) !== false; }
}

define('SITE_NAME', 'SustainLife Foundation');
define('SITE_SHORT', 'SLF');
define('SITE_TAGLINE', 'Healthy, Safe & Sustainable Communities');
define('SITE_EMAIL', 'jacobdamson120@gmail.com');
define('SITE_PHONE', '+255 656 891 338 / +255 788 312 626');
define('SITE_ADDRESS', 'Tanzania');
define('SITE_URL', 'https://sustainlifefoundation.org');

// Base URL — change if you serve under a sub-path
define('BASE_URL', '/');
define('ASSETS_URL', BASE_URL . 'assets/');

function current_url() {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? parse_url(SITE_URL, PHP_URL_HOST);
    $uri  = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    return $scheme . '://' . $host . $uri;
}
function canonical_url() {
    $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    return rtrim(SITE_URL, '/') . $uri;
}
function clip($s, $n) { $s = trim(preg_replace('/\s+/', ' ', (string)$s)); return mb_strlen($s) > $n ? rtrim(mb_substr($s, 0, $n - 1)) . '…' : $s; }

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
