<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/resources.php';

$types = slf_resource_types();
$active_type = $_GET['type'] ?? '';
if ($active_type && !isset($types[$active_type])) $active_type = '';

$page_title = $active_type ? $types[$active_type]['label'] . 's' : 'Resources';
$page_description = 'Annual reports, publications, policies and downloads from SustainLife Foundation, evidence-based resources for partners and the public.';
$page_heading = $active_type ? $types[$active_type]['label'] . 's' : 'Resources &amp; Downloads';
$page_crumb = 'Resources';
$body_class = 'theme-consult';

include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$resources = slf_fetch_resources($active_type ?: null);
$has_table = slf_resources_table_exists();
?>

<section class="section">
  <div class="container">

    <!-- Filter chips -->
    <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
      <a href="<?= url('resources.php') ?>" class="badge-pill-ngo <?= $active_type === '' ? 'blue' : '' ?>" style="text-decoration:none;">All</a>
      <?php foreach ($types as $key => $meta): ?>
        <a href="<?= url('resources.php?type=' . urlencode($key)) ?>"
           class="badge-pill-ngo <?= $active_type === $key ? e($meta['tone'] ?: 'blue') : '' ?>"
           style="text-decoration:none;">
          <i class="bi <?= e($meta['icon']) ?> me-1"></i><?= e($meta['label']) ?>s
        </a>
      <?php endforeach; ?>
    </div>

    <?php if (!$has_table): ?>
      <div class="alert alert-info">
        <strong>No resources uploaded yet.</strong> Once your administrator uploads documents (Strategic Plan, Annual Reports, Policies&hellip;) they'll appear here for preview and download.
      </div>
    <?php elseif (!$resources): ?>
      <div class="alert alert-light border text-center py-5">
        <i class="bi bi-folder2-open" style="font-size:2rem;color:var(--blue);"></i>
        <h4 class="mt-2">No documents in this category yet</h4>
        <p class="text-muted mb-0">Check back soon , we publish new resources regularly.</p>
      </div>
    <?php else: ?>
      <div class="row g-4">
        <?php foreach ($resources as $r):
          $meta = $types[$r['type']] ?? ['label'=>'Document','icon'=>'bi-file-earmark','tone'=>''];
          $cover = $r['cover_image'] ?? '';
          if ($cover && !preg_match('~^https?://~', $cover)) $cover = url($cover);
        ?>
          <div class="col-md-6 col-lg-4">
            <article class="card-ngo h-100 d-flex flex-column">
              <?php if ($cover): ?>
                <img src="<?= e($cover) ?>" alt="<?= e($r['title']) ?>">
              <?php else: ?>
                <div class="p-4 text-center" style="background:linear-gradient(135deg,var(--blue-soft),#fff);">
                  <i class="bi <?= e($meta['icon']) ?>" style="font-size:3rem;color:var(--blue);"></i>
                </div>
              <?php endif; ?>
              <div class="card-body d-flex flex-column">
                <span class="badge-pill-ngo <?= e($meta['tone']) ?> align-self-start mb-2"><?= e($meta['label']) ?></span>
                <h3 class="card-title"><?= e($r['title']) ?></h3>
                <?php if (!empty($r['years_covered'])): ?>
                  <div class="text-muted small mb-1"><i class="bi bi-calendar3 me-1"></i><?= e($r['years_covered']) ?></div>
                <?php endif; ?>
                <p class="text-muted small flex-grow-1"><?= e($r['summary'] ?? '') ?></p>
                <div class="d-flex justify-content-between align-items-center mt-2">
                  <small class="text-muted"><?= e(slf_fmt_filesize($r['file_size'] ?? 0)) ?></small>
                  <div class="d-flex gap-2">
                    <a href="<?= url('resource.php?slug=' . urlencode($r['slug'])) ?>" class="btn btn-sm btn-primary-ngo">
                      <i class="bi bi-eye me-1"></i>View
                    </a>
                    <a href="<?= e(slf_resource_file_url($r)) ?>" download class="btn btn-sm btn-outline-secondary">
                      <i class="bi bi-download"></i>
                    </a>
                  </div>
                </div>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
