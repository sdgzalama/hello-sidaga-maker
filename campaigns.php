<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
$page_title = 'Campaigns';
$page_description = 'Active campaigns and community programs run by SustainLife Foundation, health, agriculture, environment and inclusion across Tanzania.';
$page_heading = 'Campaigns &amp; Community Programs';
$page_crumb = 'Campaigns';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$promos = [];
$pdo = db();
if ($pdo) {
    try { $promos = $pdo->query("SELECT * FROM promotions WHERE status='active' ORDER BY id DESC")->fetchAll(); }
    catch (Exception $e) { $promos = []; }
}
if (!$promos) {
    $promos = [
      ['title'=>'Match-the-Donation Week','starts_on'=>'2026-05-10','ends_on'=>'2026-05-17','image'=>'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800','body'=>'Every dollar contributed this week is matched by our partner foundation.'],
      ['title'=>'Sponsor a Child','starts_on'=>null,'ends_on'=>null,'image'=>'assets/images/community-1.jpg','body'=>'Support a child\'s education for as little as $25 per month.'],
    ];
}
?>

<section class="section">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($promos as $p):
        $img = $p['image'] ?? '';
        if ($img && !preg_match('~^https?://~', $img)) $img = url($img);
        if (!$img) $img = 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800';
        $date = (!empty($p['starts_on']) && !empty($p['ends_on']))
          ? date('M j', strtotime($p['starts_on'])) . ' – ' . date('M j, Y', strtotime($p['ends_on']))
          : 'Year-round';
      ?>
        <div class="col-md-6 col-lg-4">
          <article class="card-ngo">
            <img src="<?= e($img) ?>" alt="<?= e($p['title']) ?>">
            <div class="card-body">
              <div class="meta"><i class="bi bi-calendar3 me-1"></i><?= e($date) ?></div>
              <h3 class="card-title"><?= e($p['title']) ?></h3>
              <p class="text-muted small mb-3"><?= e($p['body'] ?? '') ?></p>
              <a href="<?= url('contact.php') ?>" class="btn btn-primary-ngo btn-sm">Get involved</a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
