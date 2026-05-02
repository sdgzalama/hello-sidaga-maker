<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Promotions';
$page_heading = 'Promotions &amp; Campaigns';
$page_crumb = 'Promotions';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$promos = [
  ['title'=>'Match-the-Donation Week', 'date'=>'May 10–17, 2026', 'img'=>'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800', 'desc'=>'Every dollar donated this week is matched by our partner foundation.'],
  ['title'=>'Sponsor a Child', 'date'=>'Year-round', 'img'=>'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800', 'desc'=>'Support a child\'s education for as little as $25 per month.'],
  ['title'=>'Corporate Volunteering', 'date'=>'Year-round', 'img'=>'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800', 'desc'=>'Bring your team for a day of meaningful service.'],
];
?>

<section class="section">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($promos as $p): ?>
        <div class="col-md-6 col-lg-4">
          <article class="card-ngo">
            <img src="<?= e($p['img']) ?>" alt="<?= e($p['title']) ?>">
            <div class="card-body">
              <div class="meta"><i class="bi bi-calendar3 me-1"></i><?= e($p['date']) ?></div>
              <h3 class="card-title"><?= e($p['title']) ?></h3>
              <p class="text-muted small mb-3"><?= e($p['desc']) ?></p>
              <a href="#" class="btn btn-primary-ngo btn-sm">Get involved</a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
