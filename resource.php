<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/resources.php';

$slug = $_GET['slug'] ?? '';
$res = $slug ? slf_fetch_resource($slug) : null;
$types = slf_resource_types();

$page_title = $res['title'] ?? 'Resource';
$page_heading = $res['title'] ?? 'Resource not found';
$page_crumb = 'Resource';
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

    <?php if (!$res): ?>
      <div class="alert alert-warning">Resource not found. It may have been removed or unpublished.</div>
    <?php else:
      $meta = $types[$res['type']] ?? ['label'=>'Document','icon'=>'bi-file-earmark','tone'=>''];
      $file_url = slf_resource_file_url($res);
    ?>
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="card-ngo p-3">
            <iframe src="<?= e($file_url) ?>"
                    title="<?= e($res['title']) ?>"
                    width="100%" height="800"
                    style="border:0;border-radius:10px;background:#f5f5f5;">
              <p>Your browser cannot display PDFs inline.
                 <a href="<?= e($file_url) ?>" download>Download the PDF</a> instead.</p>
            </iframe>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card-ngo p-4">
            <span class="badge-pill-ngo <?= e($meta['tone']) ?> mb-3"><i class="bi <?= e($meta['icon']) ?> me-1"></i><?= e($meta['label']) ?></span>
            <h3 class="mb-2"><?= e($res['title']) ?></h3>
            <?php if (!empty($res['years_covered'])): ?>
              <p class="text-muted mb-2"><i class="bi bi-calendar3 me-1"></i><?= e($res['years_covered']) ?></p>
            <?php endif; ?>
            <?php if (!empty($res['summary'])): ?>
              <p class="text-muted"><?= e($res['summary']) ?></p>
            <?php endif; ?>

            <ul class="list-unstyled small text-muted mt-3">
              <?php if (!empty($res['file_size'])): ?>
                <li><i class="bi bi-hdd me-2"></i>File size: <?= e(slf_fmt_filesize($res['file_size'])) ?></li>
              <?php endif; ?>
              <?php if (!empty($res['published_at'])): ?>
                <li><i class="bi bi-calendar-check me-2"></i>Published: <?= e(date('M j, Y', strtotime($res['published_at']))) ?></li>
              <?php endif; ?>
            </ul>

            <div class="d-grid gap-2 mt-3">
              <a href="<?= e($file_url) ?>" download class="btn btn-primary-ngo">
                <i class="bi bi-download me-1"></i> Download PDF
              </a>
              <a href="<?= e($file_url) ?>" target="_blank" rel="noopener" class="btn btn-outline-secondary">
                <i class="bi bi-box-arrow-up-right me-1"></i> Open in new tab
              </a>
            </div>
          </div>

          <?php if (!empty($res['body'])): ?>
            <div class="card-ngo p-4 mt-3">
              <h5>About this document</h5>
              <div class="text-muted"><?= nl2br(e($res['body'])) ?></div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
