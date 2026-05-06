<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/services.php';
$page_title = 'Contact';
$preselect_service = isset($_GET['service']) ? (string)$_GET['service'] : '';
$page_heading = 'Contact &amp; Request a Quote';
$page_crumb = 'Contact';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<section class="section">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-7">
        <span class="badge-pill-ngo blue">Get in Touch</span>
        <h2 class="section-title mt-2">Tell us about your project</h2>
        <p class="text-muted">Fill out the form and our team will respond within two business days.</p>
        <form method="post" action="" class="row g-3 mt-2">
          <div class="col-md-6">
            <label class="form-label">Full name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Organization</label>
            <input type="text" name="organization" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Service needed</label>
            <select name="service" class="form-select">
              <option value="">Select a service</option>
              <?php foreach (slf_services() as $svc): ?>
                <option value="<?= e($svc['slug']) ?>" <?= $preselect_service === $svc['slug'] ? 'selected' : '' ?>><?= e($svc['title']) ?></option>
              <?php endforeach; ?>
              <option value="other" <?= $preselect_service === 'other' ? 'selected' : '' ?>>Partnership / Other</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Message</label>
            <textarea name="message" rows="5" class="form-control" required></textarea>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary-ngo"><i class="bi bi-send me-1"></i> Send Message</button>
          </div>
        </form>
      </div>
      <div class="col-lg-5">
        <div class="card-ngo p-4 h-100">
          <h3 class="card-title">Contact details</h3>
          <ul class="list-unstyled mt-3">
            <li class="mb-3"><i class="bi bi-geo-alt-fill me-2" style="color:var(--green);"></i><?= e(SITE_ADDRESS) ?></li>
            <li class="mb-3"><i class="bi bi-envelope-fill me-2" style="color:var(--green);"></i><a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li class="mb-3"><i class="bi bi-telephone-fill me-2" style="color:var(--green);"></i><?= e(SITE_PHONE) ?></li>
          </ul>
          <hr>
          <h5 class="mt-3">Director of Foundation</h5>
          <p class="mb-1"><strong>Damson Jacob Ntyuki</strong></p>
          <p class="text-muted small mb-0">Available Mon &ndash; Fri, 8:00 AM &ndash; 5:00 PM (EAT)</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
