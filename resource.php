<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/resources.php';

$slug = $_GET['slug'] ?? '';
$res = $slug ? slf_fetch_resource($slug) : null;
$types = slf_resource_types();

$page_title = $res['title'] ?? 'Resource';
$body_class = 'theme-consult';

include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';

if (!$res):
?>
  <section class="section">
    <div class="container text-center py-5">
      <i class="bi bi-file-earmark-x" style="font-size:4rem;color:var(--muted);opacity:.5;"></i>
      <h2 class="mt-3">Resource not found</h2>
      <p class="text-muted">The document you're looking for has been moved, removed, or is not yet published.</p>
      <a href="<?= url('resources.php') ?>" class="btn btn-primary-ngo mt-2">
        <i class="bi bi-arrow-left me-1"></i> Browse all resources
      </a>
    </div>
  </section>
<?php
  include __DIR__ . '/partials/footer.php';
  exit;
endif;

$meta = $types[$res['type']] ?? ['label'=>'Document','icon'=>'bi-file-earmark','tone'=>''];
$file_url = slf_resource_file_url($res);
?>

<section class="doc-hero">
  <div class="container">
    <div class="breadcrumb-doc">
      <a href="<?= url('resources.php') ?>">Resources</a>
      <span class="mx-2">/</span>
      <a href="<?= url('resources.php?type=' . urlencode($res['type'])) ?>"><?= e($meta['label']) ?>s</a>
    </div>
    <div class="row align-items-end g-4">
      <div class="col-lg-8">
        <span class="badge-pill-ngo mb-3 d-inline-block">
          <i class="bi <?= e($meta['icon']) ?> me-1"></i><?= e($meta['label']) ?>
        </span>
        <h1><?= e($res['title']) ?></h1>
        <?php if (!empty($res['summary'])): ?>
          <p class="lead mb-3" style="color:rgba(255,255,255,.92);max-width:780px;"><?= e($res['summary']) ?></p>
        <?php endif; ?>
        <div class="doc-meta-inline">
          <?php if (!empty($res['years_covered'])): ?>
            <span><i class="bi bi-calendar3"></i><?= e($res['years_covered']) ?></span>
          <?php endif; ?>
          <?php if (!empty($res['published_at'])): ?>
            <span><i class="bi bi-calendar-check"></i>Published <?= e(date('M j, Y', strtotime($res['published_at']))) ?></span>
          <?php endif; ?>
          <?php if (!empty($res['file_size'])): ?>
            <span><i class="bi bi-hdd"></i><?= e(slf_fmt_filesize($res['file_size'])) ?></span>
          <?php endif; ?>
          <span><i class="bi bi-file-earmark-pdf"></i>PDF</span>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
          <a href="<?= e($file_url) ?>" download class="btn btn-warning fw-semibold">
            <i class="bi bi-download me-1"></i> Download PDF
          </a>
          <a href="<?= e($file_url) ?>" target="_blank" rel="noopener" class="btn btn-light">
            <i class="bi bi-box-arrow-up-right me-1"></i> Open
          </a>
          <button type="button" class="btn btn-outline-light" id="docShareBtn" title="Share">
            <i class="bi bi-share"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  var btn = document.getElementById('docShareBtn');
  if (!btn) return;
  btn.addEventListener('click', async function(){
    var data = { title: document.title, url: window.location.href };
    try {
      if (navigator.share) { await navigator.share(data); }
      else {
        await navigator.clipboard.writeText(data.url);
        btn.innerHTML = '<i class="bi bi-check2"></i>';
        setTimeout(function(){ btn.innerHTML = '<i class="bi bi-share"></i>'; }, 1800);
      }
    } catch(e) {}
  });
})();
</script>

<?php include __DIR__ . '/partials/footer.php'; ?>

