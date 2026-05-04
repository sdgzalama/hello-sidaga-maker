<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../../includes/config.php';
}
$current = basename($_SERVER['PHP_SELF']);
function admin_active($p) { return basename($_SERVER['PHP_SELF']) === $p ? 'active' : ''; }
?>
<aside class="sidebar">
  <div class="brand">
    <img src="<?= asset('images/logo.png') ?>" alt="SLF" style="width:36px;height:36px;object-fit:contain;background:#fff;border-radius:9px;padding:3px;">
    <span><?= e(SITE_SHORT) ?> Admin</span>
  </div>

  <div class="nav-section">Main</div>
  <a class="nav-link <?= admin_active('dashboard.php') ?>" href="<?= url('admin/dashboard.php') ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
  </a>

  <div class="nav-section">Manage Content</div>
  <a class="nav-link <?= admin_active('manage-news.php') ?>" href="<?= url('admin/manage-news.php') ?>">
    <i class="bi bi-newspaper"></i> News
  </a>
  <a class="nav-link <?= admin_active('manage-events.php') ?>" href="<?= url('admin/manage-events.php') ?>">
    <i class="bi bi-calendar-event"></i> Events
  </a>
  <a class="nav-link <?= admin_active('manage-announcements.php') ?>" href="<?= url('admin/manage-announcements.php') ?>">
    <i class="bi bi-megaphone"></i> Announcements
  </a>
  <a class="nav-link <?= admin_active('manage-promotions.php') ?>" href="<?= url('admin/manage-promotions.php') ?>">
    <i class="bi bi-gift"></i> Promotions
  </a>

  <div class="nav-section">Account</div>
  <a class="nav-link" href="<?= url('index.php') ?>"><i class="bi bi-globe"></i> View Site</a>
  <a class="nav-link" href="<?= url('admin/login.php?logout=1') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a>
</aside>
