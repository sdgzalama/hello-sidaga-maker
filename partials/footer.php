<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../includes/config.php';
}
?>
<footer class="footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="brand-line">
          <img src="<?= asset('images/logo.png') ?>" alt="<?= e(SITE_NAME) ?>">
          <h5 class="mb-0" style="text-transform:none;letter-spacing:0;font-size:1.1rem;"><?= e(SITE_NAME) ?></h5>
        </div>
        <p><?= e(SITE_TAGLINE) ?>. A Tanzanian NGO working at the intersection of health, environment, safety, sustainable agriculture and social inclusion.</p>
        <div class="social">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <h5>Explore</h5>
        <ul class="list-unstyled">
          <li><a href="<?= url('about.php') ?>">About</a></li>
          <li><a href="<?= url('projects.php') ?>">Projects</a></li>
          <li><a href="<?= url('impact.php') ?>">Impact</a></li>
          <li><a href="<?= url('content.php') ?>">Content</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-3">
        <h5>Contact</h5>
        <ul class="list-unstyled">
          <li><i class="bi bi-geo-alt me-2"></i><?= e(SITE_ADDRESS) ?></li>
          <li><i class="bi bi-envelope me-2"></i><?= e(SITE_EMAIL) ?></li>
          <li><i class="bi bi-telephone me-2"></i><?= e(SITE_PHONE) ?></li>
        </ul>
      </div>
      <div class="col-lg-3">
        <h5>Work With Us</h5>
        <p class="small">Partner with SLF for consultancy, research, and community programs.</p>
        <a href="<?= url('contact.php') ?>" class="btn btn-yellow btn-sm"><i class="bi bi-arrow-right me-1"></i> Request a Quote</a>
      </div>
    </div>
    <div class="copy d-flex flex-wrap justify-content-between">
      <span>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.</span>
      <span><a href="<?= url('admin/login.php') ?>">Admin</a></span>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
