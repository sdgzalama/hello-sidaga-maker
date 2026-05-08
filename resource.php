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
$related  = slf_related_resources($res['type'], $res['id'] ?? 0, 4);
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

<section class="doc-section">
  <div class="container">
    <div class="row g-4">
      <!-- PDF viewer -->
      <div class="col-lg-8">
        <div class="doc-viewer">
          <object data="<?= e($file_url) ?>#view=FitH" type="application/pdf">
            <iframe src="<?= e($file_url) ?>#view=FitH" title="<?= e($res['title']) ?>"></iframe>
            <div class="doc-viewer-fallback">
              <i class="bi bi-file-earmark-pdf" style="font-size:3.5rem;color:var(--blue);"></i>
              <h4 class="mt-3">Your browser can't display this PDF inline</h4>
              <p class="text-muted">No problem — you can still open or download the document.</p>
              <a href="<?= e($file_url) ?>" download class="btn btn-primary-ngo">
                <i class="bi bi-download me-1"></i> Download PDF
              </a>
            </div>
          </object>
        </div>
        <p class="text-muted small mt-2 text-center">
          <i class="bi bi-info-circle me-1"></i>
          Use the toolbar above the document to zoom, navigate pages, search or print.
        </p>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="doc-info-card">
          <h5>Document information</h5>
          <ul class="doc-meta-list">
            <li><span class="lbl">Type</span><span class="val"><?= e($meta['label']) ?></span></li>
            <?php if (!empty($res['years_covered'])): ?>
              <li><span class="lbl">Period</span><span class="val"><?= e($res['years_covered']) ?></span></li>
            <?php endif; ?>
            <?php if (!empty($res['published_at'])): ?>
              <li><span class="lbl">Published</span><span class="val"><?= e(date('M j, Y', strtotime($res['published_at']))) ?></span></li>
            <?php endif; ?>
            <?php if (!empty($res['file_size'])): ?>
              <li><span class="lbl">File size</span><span class="val"><?= e(slf_fmt_filesize($res['file_size'])) ?></span></li>
            <?php endif; ?>
            <li><span class="lbl">Format</span><span class="val">PDF</span></li>
            <li><span class="lbl">Language</span><span class="val">English</span></li>
          </ul>
        </div>

        <?php if (!empty($res['body'])): ?>
        <div class="doc-info-card">
          <h5>About this document</h5>
          <div class="text-muted" style="font-size:.94rem;"><?= nl2br(e($res['body'])) ?></div>
        </div>
        <?php endif; ?>

        <div class="doc-info-card" style="background:linear-gradient(135deg,var(--blue-soft),#fff);">
          <h5 style="color:var(--blue-dark);">Need this in another format?</h5>
          <p class="small text-muted mb-3">We can provide accessible versions, translations, or a printed copy on request.</p>
          <a href="<?= url('contact.php') ?>" class="btn btn-primary-ngo btn-sm w-100">
            <i class="bi bi-envelope me-1"></i> Contact us
          </a>
        </div>

        <?php if ($related): ?>
        <div class="doc-info-card">
          <h5>Related <?= e(strtolower($meta['label'])) ?>s</h5>
          <ul class="related-doc-list">
            <?php foreach ($related as $rr): ?>
              <li>
                <a href="<?= url('resource.php?slug=' . urlencode($rr['slug'])) ?>">
                  <i class="bi <?= e($meta['icon']) ?>"></i>
                  <span>
                    <strong class="d-block"><?= e($rr['title']) ?></strong>
                    <?php if (!empty($rr['years_covered'])): ?>
                      <small class="text-muted"><?= e($rr['years_covered']) ?></small>
                    <?php endif; ?>
                  </span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
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
