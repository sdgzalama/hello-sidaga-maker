<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'News';
$page_heading = 'Latest News';
$page_crumb = 'News';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

// Replace with DB query later
$articles = [
  ['title'=>'Free Health Camp in Riverbend', 'date'=>'May 1, 2026', 'tag'=>'Health', 'img'=>'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800', 'excerpt'=>'Over 600 patients received free check-ups, medication, and follow-up plans.'],
  ['title'=>'Scholarships for 200 Students', 'date'=>'Apr 22, 2026', 'tag'=>'Education', 'img'=>'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800', 'excerpt'=>'A new partnership with local universities expands our scholarship program.'],
  ['title'=>'Clean Water Project Launched', 'date'=>'Apr 10, 2026', 'tag'=>'Community', 'img'=>'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800', 'excerpt'=>'Three new wells now serve more than 4,000 villagers with safe drinking water.'],
  ['title'=>'Vaccination Drive Reaches 5K', 'date'=>'Mar 28, 2026', 'tag'=>'Health', 'img'=>'https://images.unsplash.com/photo-1584515933487-779824d29309?w=800', 'excerpt'=>'A coordinated vaccination effort across 8 districts wraps up successfully.'],
];
?>

<section class="section">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($articles as $a): ?>
        <div class="col-md-6 col-lg-4">
          <article class="card-ngo">
            <img src="<?= e($a['img']) ?>" alt="<?= e($a['title']) ?>">
            <div class="card-body">
              <span class="badge-pill-ngo"><?= e($a['tag']) ?></span>
              <div class="meta mt-2"><i class="bi bi-calendar3 me-1"></i><?= e($a['date']) ?></div>
              <h3 class="card-title"><?= e($a['title']) ?></h3>
              <p class="text-muted small mb-3"><?= e($a['excerpt']) ?></p>
              <a href="#" class="fw-semibold">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
