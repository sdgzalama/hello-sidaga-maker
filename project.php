<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$slug = $_GET['slug'] ?? '';
$project = null;
$related = [];
$pdo = db();
if ($pdo && $slug) {
    try {
        $st = $pdo->prepare("SELECT * FROM projects WHERE slug = ? LIMIT 1");
        $st->execute([$slug]);
        $project = $st->fetch() ?: null;
        if ($project) {
            $rs = $pdo->prepare("SELECT id,title,slug,sector,summary,image FROM projects
                WHERE status IN ('active','completed') AND id <> ? AND sector = ? ORDER BY id DESC LIMIT 3");
            $rs->execute([$project['id'], $project['sector']]);
            $related = $rs->fetchAll();
        }
    } catch (Exception $e) {}
}

$page_title = $project['title'] ?? 'Project';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';

if (!$project):
?>
  <section class="section">
    <div class="container text-center py-5">
      <i class="bi bi-folder-x" style="font-size:4rem;color:var(--muted);opacity:.5;"></i>
      <h2 class="mt-3">Project not found</h2>
      <p class="text-muted">The project you're looking for is not available.</p>
      <a href="<?= url('projects.php') ?>" class="btn btn-primary-ngo">
        <i class="bi bi-arrow-left me-1"></i> All projects
      </a>
    </div>
  </section>
<?php
  include __DIR__ . '/partials/footer.php';
  exit;
endif;

$img = $project['image'] ?? '';
if ($img && !preg_match('~^https?://~', $img)) $img = url($img);
?>

<section class="project-hero">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <div class="breadcrumb-doc small mb-2" style="opacity:.85;text-transform:uppercase;letter-spacing:.08em;">
          <a href="<?= url('projects.php') ?>" style="color:#fff;">Projects</a>
          <?php if (!empty($project['sector'])): ?>
            <span class="mx-2">/</span><?= e($project['sector']) ?>
          <?php endif; ?>
        </div>
        <?php if (!empty($project['sector'])): ?>
          <span class="badge-pill-ngo mb-3 d-inline-block"><?= e($project['sector']) ?></span>
        <?php endif; ?>
        <h1><?= e($project['title']) ?></h1>
        <?php if (!empty($project['summary'])): ?>
          <p class="lead" style="color:rgba(255,255,255,.92);max-width:680px;"><?= e($project['summary']) ?></p>
        <?php endif; ?>
        <div class="mt-3 d-flex gap-2 flex-wrap">
          <a href="<?= url('contact.php?type=partner') ?>" class="btn btn-warning fw-semibold">
            <i class="bi bi-handshake me-1"></i> Partner With Us
          </a>
          <a href="<?= url('projects.php') ?>" class="btn btn-outline-light">
            <i class="bi bi-arrow-left me-1"></i> All projects
          </a>
        </div>
      </div>
      <?php if ($img): ?>
      <div class="col-lg-5">
        <img src="<?= e($img) ?>" alt="<?= e($project['title']) ?>" class="img-fluid rounded shadow-lg" style="max-height:340px;object-fit:cover;width:100%;">
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-8">
        <h3>About this project</h3>
        <div class="text-muted" style="font-size:1.02rem;line-height:1.75;">
          <?= nl2br(e($project['body'] ?? $project['summary'] ?? '')) ?>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="doc-info-card">
          <h5>Project details</h5>
          <ul class="doc-meta-list">
            <?php if (!empty($project['sector'])): ?>
              <li><span class="lbl">Sector</span><span class="val"><?= e($project['sector']) ?></span></li>
            <?php endif; ?>
            <li><span class="lbl">Status</span><span class="val"><?= e(ucfirst($project['status'] ?? 'active')) ?></span></li>
            <?php if (!empty($project['created_at'])): ?>
              <li><span class="lbl">Started</span><span class="val"><?= e(date('M Y', strtotime($project['created_at']))) ?></span></li>
            <?php endif; ?>
          </ul>
        </div>
        <div class="doc-info-card" style="background:linear-gradient(135deg,var(--green-soft),#fff);">
          <h5 style="color:var(--green-dark);">Get involved</h5>
          <p class="small text-muted mb-3">Support this initiative through partnership, volunteering or funding.</p>
          <a href="<?= url('contact.php') ?>" class="btn btn-primary-ngo btn-sm w-100">
            <i class="bi bi-envelope me-1"></i> Contact our team
          </a>
        </div>
      </div>
    </div>

    <?php if ($related): ?>
    <hr class="my-5">
    <h4 class="mb-4">Related projects</h4>
    <div class="row g-4">
      <?php foreach ($related as $r):
        $rimg = $r['image'] ?? '';
        if ($rimg && !preg_match('~^https?://~', $rimg)) $rimg = url($rimg);
      ?>
        <div class="col-md-4">
          <article class="card-ngo h-100">
            <?php if ($rimg): ?><img src="<?= e($rimg) ?>" alt="<?= e($r['title']) ?>"><?php endif; ?>
            <div class="card-body">
              <?php if (!empty($r['sector'])): ?><span class="badge-pill-ngo blue"><?= e($r['sector']) ?></span><?php endif; ?>
              <h5 class="mt-2"><?= e($r['title']) ?></h5>
              <p class="text-muted small"><?= e($r['summary'] ?? '') ?></p>
              <a href="<?= url('project.php?slug=' . urlencode($r['slug'])) ?>" class="fw-semibold">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
