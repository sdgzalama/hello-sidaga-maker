<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Projects';
$page_heading = 'Our Projects & Initiatives';
$page_crumb = 'Projects';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$projects = [
  ['cat'=>'Health',     'tone'=>'',      'img'=>'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800', 'title'=>'Community Health Outreach', 'desc'=>'Mobile clinics, nutrition and preventive healthcare in underserved villages.'],
  ['cat'=>'Agriculture','tone'=>'yellow','img'=>'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800', 'title'=>'Climate-Smart Farming',     'desc'=>'Training smallholder farmers in sustainable, climate-resilient practices.'],
  ['cat'=>'Environment','tone'=>'',      'img'=>'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800', 'title'=>'Water &amp; Conservation',  'desc'=>'Soil and water conservation, reforestation and ecosystem stewardship.'],
  ['cat'=>'Community',  'tone'=>'blue',  'img'=>'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800', 'title'=>'Women Entrepreneurship',    'desc'=>'Capacity building, savings groups and market access for women in business.'],
  ['cat'=>'Health',     'tone'=>'',      'img'=>'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=800', 'title'=>'Maternal &amp; Child Health','desc'=>'Awareness campaigns and referral support to reduce maternal mortality.'],
  ['cat'=>'Community',  'tone'=>'blue',  'img'=>'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800', 'title'=>'Youth Skills Program',      'desc'=>'TVET-aligned skills training for sustainable livelihoods among youth.'],
];
?>

<section class="section">
  <div class="container">
    <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
      <span class="badge-pill-ngo">All</span>
      <span class="badge-pill-ngo">Health</span>
      <span class="badge-pill-ngo yellow">Agriculture</span>
      <span class="badge-pill-ngo">Environment</span>
      <span class="badge-pill-ngo blue">Community</span>
    </div>
    <div class="row g-4">
      <?php foreach ($projects as $p): ?>
        <div class="col-md-6 col-lg-4">
          <article class="card-ngo">
            <img src="<?= e($p['img']) ?>" alt="<?= e($p['title']) ?>">
            <div class="card-body">
              <span class="badge-pill-ngo <?= e($p['tone']) ?>"><?= e($p['cat']) ?></span>
              <h3 class="card-title mt-2"><?= $p['title'] ?></h3>
              <p class="text-muted small mb-3"><?= $p['desc'] ?></p>
              <a href="#" class="fw-semibold">Learn more <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
