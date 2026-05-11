<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
$page_title = 'Projects';
$page_description = 'Explore SustainLife Foundation projects in health, agriculture, environment, education and inclusion across Tanzania.';
$page_heading = 'Our Projects & Initiatives';
$page_crumb = 'Projects';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$active_sector = trim($_GET['sector'] ?? '');
$projects = [];
$sectors  = [];
$pdo = db();
if ($pdo) {
    try {
        $sql = "SELECT * FROM projects WHERE status IN ('active','completed')";
        $params = [];
        if ($active_sector !== '') { $sql .= " AND sector = ?"; $params[] = $active_sector; }
        $sql .= " ORDER BY id DESC";
        $st = $pdo->prepare($sql); $st->execute($params);
        $projects = $st->fetchAll();

        $s = $pdo->query("SELECT DISTINCT sector FROM projects WHERE status IN ('active','completed') AND sector IS NOT NULL AND sector <> '' ORDER BY sector");
        foreach ($s as $row) $sectors[] = $row['sector'];
    } catch (Exception $e) {}
}

$tone_map = ['Agriculture'=>'yellow','Community'=>'blue','Environment'=>'','Health'=>'','Education'=>'blue','Water'=>'blue'];
?>

<section class="section">
  <div class="container">
    <?php if ($sectors): ?>
    <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
      <a href="<?= url('projects.php') ?>" class="badge-pill-ngo <?= $active_sector === '' ? 'blue' : '' ?>" style="text-decoration:none;">All</a>
      <?php foreach ($sectors as $s): ?>
        <a href="<?= url('projects.php?sector=' . urlencode($s)) ?>"
           class="badge-pill-ngo <?= $active_sector === $s ? e($tone_map[$s] ?? 'blue') : '' ?>"
           style="text-decoration:none;"><?= e($s) ?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!$projects): ?>
      <div class="alert alert-light border text-center py-5">
        <i class="bi bi-kanban" style="font-size:2.5rem;color:var(--blue);"></i>
        <h4 class="mt-3">No projects published yet</h4>
        <p class="text-muted mb-0">Our team is preparing project pages. Please check back soon, or <a href="<?= url('contact.php') ?>">get in touch</a> to learn about ongoing work.</p>
      </div>
    <?php else: ?>
    <div class="row g-4">
      <?php foreach ($projects as $p):
        $img = $p['image'] ?? '';
        if ($img && !preg_match('~^https?://~', $img)) $img = url($img);
        $sector = $p['sector'] ?? '';
        $tone = $tone_map[$sector] ?? '';
      ?>
        <div class="col-md-6 col-lg-4">
          <article class="card-ngo h-100">
            <?php if ($img): ?>
              <img src="<?= e($img) ?>" alt="<?= e($p['title']) ?>">
            <?php else: ?>
              <div class="p-4 text-center" style="background:linear-gradient(135deg,var(--green-soft),var(--blue-soft));min-height:160px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-kanban" style="font-size:3rem;color:var(--blue);opacity:.6;"></i>
              </div>
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
              <?php if ($sector): ?><span class="badge-pill-ngo <?= e($tone) ?>"><?= e($sector) ?></span><?php endif; ?>
              <h3 class="card-title mt-2"><?= e($p['title']) ?></h3>
              <p class="text-muted small mb-3 flex-grow-1"><?= e($p['summary'] ?? '') ?></p>
              <a href="<?= url('project.php?slug=' . urlencode($p['slug'])) ?>" class="fw-semibold mt-auto">
                Read more <i class="bi bi-arrow-right"></i>
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
