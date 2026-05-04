<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../includes/config.php';
}
?>
<div class="top-bar">
  <div class="container d-flex flex-wrap justify-content-between">
    <div>
      <span><i class="bi bi-envelope-fill"></i><?= e(SITE_EMAIL) ?></span>
      <span class="ms-3 d-none d-sm-inline"><i class="bi bi-telephone-fill"></i><?= e(SITE_PHONE) ?></span>
    </div>
    <div class="d-none d-md-block">
      <span><i class="bi bi-geo-alt-fill"></i><?= e(SITE_ADDRESS) ?></span>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-ngo sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?= url('index.php') ?>">
      <img src="<?= asset('images/logo.png') ?>" alt="<?= e(SITE_NAME) ?> logo">
      <span class="brand-text">
        SustainLife
        <small>Foundation</small>
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link <?= is_active('index.php') ?>" href="<?= url('index.php') ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('about.php') ?>" href="<?= url('about.php') ?>">About</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('projects.php') ?>" href="<?= url('projects.php') ?>">Projects</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('consultancy.php') ?>" href="<?= url('consultancy.php') ?>">Consultancy</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('impact.php') ?>" href="<?= url('impact.php') ?>">Impact</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= in_array(basename($_SERVER['PHP_SELF']), ['news.php','events.php','promotions.php','announcements.php','content.php','faq.php']) ? 'active' : '' ?>"
             href="#" id="contentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Content
          </a>
          <ul class="dropdown-menu" aria-labelledby="contentDropdown">
            <li><a class="dropdown-item <?= is_active('news.php') ?>" href="<?= url('news.php') ?>"><i class="bi bi-newspaper me-2"></i>News</a></li>
            <li><a class="dropdown-item <?= is_active('events.php') ?>" href="<?= url('events.php') ?>"><i class="bi bi-calendar-event me-2"></i>Events</a></li>
            <li><a class="dropdown-item <?= is_active('promotions.php') ?>" href="<?= url('promotions.php') ?>"><i class="bi bi-megaphone me-2"></i>Promotions</a></li>
            <li><a class="dropdown-item <?= is_active('announcements.php') ?>" href="<?= url('announcements.php') ?>"><i class="bi bi-bell me-2"></i>Announcements</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item <?= is_active('content.php') ?>" href="<?= url('content.php') ?>"><i class="bi bi-collection me-2"></i>Content Hub</a></li>
            <li><a class="dropdown-item <?= is_active('faq.php') ?>" href="<?= url('faq.php') ?>"><i class="bi bi-question-circle me-2"></i>FAQ</a></li>
          </ul>
        </li>
        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
          <a class="btn btn-donate" href="<?= url('contact.php') ?>"><i class="bi bi-chat-dots-fill me-1"></i> Request a Quote</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
