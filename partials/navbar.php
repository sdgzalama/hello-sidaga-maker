<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../includes/config.php';
}
$current_page = basename($_SERVER['PHP_SELF']);
$services_pages  = ['services.php','consultancy.php'];
$resources_pages = ['resources.php','resource.php','strategic-plan.php','faq.php'];
$media_pages     = ['news.php','events.php','announcements.php','campaigns.php','promotions.php','content.php'];
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
      <img src="<?= asset('images/logo.png') ?>" alt="SustainLife Foundation logo">
      <span class="brand-text">
        SustainLife
        <small>Foundation</small>
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-lg-auto align-items-lg-center nav-compact">
        <li class="nav-item"><a class="nav-link <?= is_active('index.php') ?>" href="<?= url('index.php') ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= is_active('about.php') ?>" href="<?= url('about.php') ?>">About</a></li>

        <li class="nav-item dropdown dropdown-hover">
          <a class="nav-link dropdown-toggle <?= in_array($current_page, $services_pages) ? 'active' : '' ?>"
             href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Services
          </a>
          <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
            <li><a class="dropdown-item" href="<?= url('services.php') ?>"><i class="bi bi-grid me-2"></i>All Services</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= url('services.php#svc-consultancy') ?>"><i class="bi bi-briefcase me-2"></i>Consultancy</a></li>
            <li><a class="dropdown-item" href="<?= url('services.php#svc-it') ?>"><i class="bi bi-cpu me-2"></i>Technology</a></li>
            <li><a class="dropdown-item" href="<?= url('services.php#svc-research') ?>"><i class="bi bi-search me-2"></i>Research &amp; M&amp;E</a></li>
            <li><a class="dropdown-item" href="<?= url('services.php#svc-agriculture') ?>"><i class="bi bi-tree me-2"></i>Agriculture</a></li>
            <li><a class="dropdown-item" href="<?= url('services.php#svc-training') ?>"><i class="bi bi-mortarboard me-2"></i>Training</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link <?= is_active('projects.php') ?>" href="<?= url('projects.php') ?>">Projects</a></li>

        <li class="nav-item dropdown dropdown-hover">
          <a class="nav-link dropdown-toggle <?= in_array($current_page, $resources_pages) ? 'active' : '' ?>"
             href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Resources
          </a>
          <ul class="dropdown-menu" aria-labelledby="resourcesDropdown">
            <li><a class="dropdown-item" href="<?= url('strategic-plan.php') ?>"><i class="bi bi-bullseye me-2"></i>Strategic Plan</a></li>
            <li><a class="dropdown-item" href="<?= url('resources.php?type=annual-report') ?>"><i class="bi bi-journal-bookmark me-2"></i>Annual Reports</a></li>
            <li><a class="dropdown-item" href="<?= url('resources.php?type=publication') ?>"><i class="bi bi-book me-2"></i>Publications</a></li>
            <li><a class="dropdown-item" href="<?= url('resources.php?type=policy') ?>"><i class="bi bi-shield-check me-2"></i>Policies</a></li>
            <li><a class="dropdown-item" href="<?= url('resources.php') ?>"><i class="bi bi-download me-2"></i>Downloads</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= url('faq.php') ?>"><i class="bi bi-question-circle me-2"></i>FAQ</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown dropdown-hover">
          <a class="nav-link dropdown-toggle <?= in_array($current_page, $media_pages) ? 'active' : '' ?>"
             href="#" id="mediaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Media
          </a>
          <ul class="dropdown-menu" aria-labelledby="mediaDropdown">
            <li><a class="dropdown-item" href="<?= url('news.php') ?>"><i class="bi bi-newspaper me-2"></i>News</a></li>
            <li><a class="dropdown-item" href="<?= url('events.php') ?>"><i class="bi bi-calendar-event me-2"></i>Events</a></li>
            <li><a class="dropdown-item" href="<?= url('announcements.php') ?>"><i class="bi bi-megaphone me-2"></i>Announcements</a></li>
            <li><a class="dropdown-item" href="<?= url('campaigns.php') ?>"><i class="bi bi-flag me-2"></i>Campaigns</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= url('content.php') ?>"><i class="bi bi-collection me-2"></i>Content Hub</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link <?= is_active('contact.php') ?>" href="<?= url('contact.php') ?>">Contact</a></li>
        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
          <a class="btn btn-donate w-100 w-lg-auto" href="<?= url('contact.php') ?>"><i class="bi bi-chat-dots-fill me-1"></i> Request a Quote</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
