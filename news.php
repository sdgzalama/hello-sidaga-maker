<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
$page_title = 'News';
$page_description = 'Latest news and updates from SustainLife Foundation, announcements, program milestones and stories from the field in Tanzania.';
$page_heading = 'Latest News';
$page_crumb = 'News';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$articles = [];
$pdo = db();
if ($pdo) {
    try {
        $articles = $pdo->query("SELECT * FROM news WHERE status='published' ORDER BY published_at DESC, id DESC")->fetchAll();
    } catch (Exception $e) { $articles = []; }
}
if (!$articles) {
    $articles = [
      ['title'=>'Free Health Camp in Riverbend','published_at'=>'2026-05-01','category'=>'Health','image'=>'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800','excerpt'=>'Over 600 patients received free check-ups, medication, and follow-up plans.'],
      ['title'=>'Scholarships for 200 Students','published_at'=>'2026-04-22','category'=>'Education','image'=>'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800','excerpt'=>'A new partnership with local universities expands our scholarship program.'],
      ['title'=>'Clean Water Project Launched','published_at'=>'2026-04-10','category'=>'Community','image'=>'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800','excerpt'=>'Three new wells now serve more than 4,000 villagers with safe drinking water.'],
    ];
}
?>

<section class="section">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($articles as $a): ?>
        <?php
          $img = $a['image'] ?? '';
          if ($img && !preg_match('~^https?://~', $img)) $img = url($img);
          if (!$img) $img = 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800';
          $date = !empty($a['published_at']) ? date('M j, Y', strtotime($a['published_at'])) : '';
        ?>
        <div class="col-md-6 col-lg-4">
          <article class="card-ngo">
            <img src="<?= e($img) ?>" alt="<?= e($a['title']) ?>">
            <div class="card-body">
              <?php if (!empty($a['category'])): ?><span class="badge-pill-ngo"><?= e($a['category']) ?></span><?php endif; ?>
              <div class="meta mt-2"><i class="bi bi-calendar3 me-1"></i><?= e($date) ?></div>
              <h3 class="card-title"><?= e($a['title']) ?></h3>
              <p class="text-muted small mb-3"><?= e($a['excerpt'] ?? '') ?></p>
              <a href="#" class="fw-semibold">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
