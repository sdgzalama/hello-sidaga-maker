<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../../includes/config.php';
}
$page_title = $page_title ?? 'Admin';
?>
<div class="topbar">
  <div class="d-flex align-items-center gap-2">
    <button class="sidebar-toggle"><i class="bi bi-list"></i></button>
    <h1 class="page-title"><?= e($page_title) ?></h1>
  </div>
  <div>
    <span class="user-chip"><i class="bi bi-person-circle"></i> Admin</span>
  </div>
</div>
