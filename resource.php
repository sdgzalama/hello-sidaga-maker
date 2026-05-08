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
<?php include __DIR__ . '/partials/footer.php'; ?>

