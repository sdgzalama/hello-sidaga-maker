<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'About Us';
$page_heading = 'About ' . SITE_NAME;
$page_crumb = 'About';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<section class="section">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=900" class="img-fluid rounded-4 shadow-sm" alt="Our team">
      </div>
      <div class="col-lg-6">
        <span class="badge-pill-ngo">Our Story</span>
        <h2 class="mt-3">Care, Compassion, Community</h2>
        <p>Founded in 2010, <?= e(SITE_NAME) ?> began as a small group of doctors and volunteers serving rural villages. Today we operate across 12 regions, partnering with local clinics, schools, and government agencies.</p>
        <p>Our work focuses on healthcare access, child education, women empowerment, and emergency relief.</p>
        <div class="row mt-4">
          <div class="col-6">
            <h3 class="mb-0" style="color:var(--primary);">15+</h3>
            <small class="text-muted">Years of impact</small>
          </div>
          <div class="col-6">
            <h3 class="mb-0" style="color:var(--primary);">12K+</h3>
            <small class="text-muted">People served</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <h2 class="section-title text-center">Our Values</h2>
    <p class="section-sub text-center">The principles that guide every project and partnership.</p>
    <div class="row g-4">
      <?php
      $values = [
        ['icon'=>'bi-heart-pulse', 'title'=>'Compassion', 'text'=>'We center our work around the dignity of every individual we serve.'],
        ['icon'=>'bi-people',      'title'=>'Community', 'text'=>'We co-create solutions with the communities themselves.'],
        ['icon'=>'bi-shield-check','title'=>'Integrity', 'text'=>'Transparent finances, honest reporting, accountable leadership.'],
      ];
      foreach ($values as $v): ?>
        <div class="col-md-4">
          <div class="card-ngo p-4 text-center h-100">
            <div class="mb-3"><i class="bi <?= e($v['icon']) ?>" style="font-size:2.2rem;color:var(--primary);"></i></div>
            <h3 class="card-title"><?= e($v['title']) ?></h3>
            <p class="text-muted mb-0"><?= e($v['text']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
