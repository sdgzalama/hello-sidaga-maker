<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../includes/config.php';
}
?>
<footer class="footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <h5><?= e(SITE_NAME) ?></h5>
        <p><?= e(SITE_TAGLINE) ?>. We work to bring healthcare, education, and hope to underserved communities.</p>
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
          <li><a href="<?= url('news.php') ?>">News</a></li>
          <li><a href="<?= url('events.php') ?>">Events</a></li>
          <li><a href="<?= url('promotions.php') ?>">Promotions</a></li>
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
        <h5>Newsletter</h5>
        <p class="small">Get our latest stories in your inbox.</p>
        <form class="d-flex">
          <input type="email" class="form-control me-2" placeholder="Email">
          <button class="btn btn-donate" type="submit"><i class="bi bi-arrow-right"></i></button>
        </form>
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
