<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../includes/config.php';
}
$page_title = $page_title ?? SITE_NAME;
$body_class = $body_class ?? '';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title) ?> &mdash; <?= e(SITE_NAME) ?></title>
  <meta name="description" content="<?= e(SITE_NAME) ?> &mdash; <?= e(SITE_TAGLINE) ?>. A Tanzanian NGO promoting health, safety, sustainable agriculture, environment and inclusive empowerment.">
  <link rel="icon" href="<?= asset('images/logo.png') ?>" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= asset('css/style.css') ?>" rel="stylesheet">
</head>
<body class="<?= e($body_class) ?>">
