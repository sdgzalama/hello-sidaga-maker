<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/resources.php';

$plans = slf_fetch_resources('strategic-plan');

// If exactly one plan, jump straight to its detail page.
if (count($plans) === 1) {
    header('Location: ' . url('resource.php?slug=' . urlencode($plans[0]['slug'])));
    exit;
}

$page_title = 'Strategic Plan';
$page_heading = 'Strategic Plan';
$page_crumb = 'Strategic Plan';
$body_class = 'theme-consult';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<section class="section">
  <div class="container">
    <a href="<?= url('resources.php') ?>" class="text-muted small d-inline-block mb-3">
      <i class="bi bi-arrow-left me-1"></i> Back to all resources
    </a>

    <?php if (!$plans): ?>
      <div class="row align-items-center g-5">
        <div class="col-lg-7">
          <span class="badge-pill-ngo blue"><i class="bi bi-bullseye me-1"></i> Strategic Direction</span>
          <h2 class="section-title mt-3">Our Strategic Plan is being prepared for publication</h2>
          <p class="text-muted">SustainLife Foundation's multi-year strategic plan outlines our priorities, programmes and targets across health, environment, agriculture and inclusion. Once approved by our board it will be published here for preview and download.</p>
          <a href="<?= url('contact.php') ?>" class="btn btn-primary-ngo mt-2">
            <i class="bi bi-envelope me-1"></i> Request a copy
          </a>
        </div>
        <div class="col-lg-5 text-center">
          <i class="bi bi-file-earmark-pdf" style="font-size:8rem;color:var(--blue);opacity:.4;"></i>
        </div>
      </div>
    <?php else: ?>
      <h2 class="section-title">Strategic Plans</h2>
      <p class="text-muted mb-4">Choose a strategic plan to preview or download.</p>
      <div class="row g-4">
        <?php foreach ($plans as $r): ?>
          <div class="col-md-6">
            <article class="card-ngo p-4 h-100">
              <span class="badge-pill-ngo blue mb-2"><i class="bi bi-bullseye me-1"></i>Strategic Plan</span>
              <h4><?= e($r['title']) ?></h4>
              <?php if (!empty($r['years_covered'])): ?>
                <p class="text-muted small"><i class="bi bi-calendar3 me-1"></i><?= e($r['years_covered']) ?></p>
              <?php endif; ?>
              <p class="text-muted"><?= e($r['summary'] ?? '') ?></p>
              <div class="d-flex gap-2">
                <a href="<?= url('resource.php?slug=' . urlencode($r['slug'])) ?>" class="btn btn-primary-ngo btn-sm">
                  <i class="bi bi-eye me-1"></i> View Document
                </a>
                <a href="<?= e(slf_resource_file_url($r)) ?>" download class="btn btn-outline-secondary btn-sm">
                  <i class="bi bi-download me-1"></i> Download
                </a>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
