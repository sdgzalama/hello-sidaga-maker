<?php
// Public navbar partial
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../includes/config.php';
}
?>
<div class="top-bar">
  <div class="container d-flex flex-wrap justify-content-between">
    <div>
      <span><i class="bi bi-envelope-fill"></i><?= e(SITE_EMAIL) ?></span>
      <span class="ms-3"><i class="bi bi-telephone-fill"></i><?= e(SITE_PHONE) ?></span>
    </div>
    <div class="d-none d-md-block">
      <span><i class="bi bi-geo-alt-fill"></i><?= e(SITE_ADDRESS) ?></span>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-ngo sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="<?= url('index.php') ?>">
      <span class="brand-mark"><i class="bi bi-heart-pulse-fill"></i></span>
      <?= e(SITE_NAME) ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link <?= is_active('index.php') ?>" href="<?= url('index.php') ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('about.php') ?>" href="<?= url('about.php') ?>">About</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('news.php') ?>" href="<?= url('news.php') ?>">News</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('events.php') ?>" href="<?= url('events.php') ?>">Events</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('announcements.php') ?>" href="<?= url('announcements.php') ?>">Announcements</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('promotions.php') ?>" href="<?= url('promotions.php') ?>">Promotions</a></li>
        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
          <a class="btn btn-donate" href="#donate"><i class="bi bi-heart-fill me-1"></i> Donate</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
