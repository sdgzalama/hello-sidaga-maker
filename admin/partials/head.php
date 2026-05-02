<?php
// Shared admin <head> + opening shell. Set $page_title before include.
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../../includes/config.php';
}
$page_title = $page_title ?? 'Admin';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title) ?> &mdash; <?= e(SITE_NAME) ?> Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= asset('css/admin.css') ?>" rel="stylesheet">
</head>
<body>
<div class="admin-wrap">
<?php include __DIR__ . '/sidebar.php'; ?>
<main class="main">
<?php include __DIR__ . '/topbar.php'; ?>
<div class="content">
