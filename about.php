<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'About SustainLife Foundation - SustainLifeFoundation Tanzania NGO';
$page_description = 'About SustainLife Foundation (SustainLifeFoundation) - A Tanzanian NGO advancing health, environment, sustainable agriculture and inclusive empowerment for marginalized communities.';
$page_heading = 'About SustainLife Foundation';
$page_crumb = 'About';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<section class="section">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <img src="assets/images/community-1.jpg" class="img-fluid rounded-4 shadow-sm" alt="SLF community work">
      </div>
      <div class="col-lg-6">
        <span class="badge-pill-ngo">Our Story</span>
        <h2 class="mt-3 section-title">SustainLife Foundation - A Tanzanian NGO empowering communities for lasting change</h2>
        <p>SustainLife Foundation (SustainLifeFoundation), also known as SLF, is a non-governmental organization based in Tanzania, working at the intersection of community health, environmental sustainability, safety, sustainable agriculture and social inclusion.</p>
        <p>We are SustainLifeFoundation - addressing the root causes of vulnerability and inequality through integrated, community-driven approaches, with particular emphasis on women, youth and marginalized populations.</p>
        <p class="text-muted">SustainLife Foundation designs and implements evidence-based programs aligned with Tanzania&rsquo;s national development priorities and the Sustainable Development Goals (SDGs).</p>
      </div>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card-ngo p-4 h-100">
          <div class="icon-tile blue"><i class="bi bi-eye"></i></div>
          <h3 class="card-title">Our Vision</h3>
          <p class="mb-0">Thriving communities where people live healthy and safe lives in harmony with the environment and sustainable agriculture , empowered to create inclusive futures for themselves and generations to come.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-ngo p-4 h-100">
          <div class="icon-tile"><i class="bi bi-bullseye"></i></div>
          <h3 class="card-title">Our Mission</h3>
          <p class="mb-0">To promote healthy, safe, and sustainable communities by strengthening community capacity through health promotion, environmental stewardship, safety awareness, sustainable agriculture and inclusive social and economic empowerment initiatives.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="badge-pill-ngo yellow">Who We Serve</span>
      <h2 class="section-title mt-2">Our target groups</h2>
      <p class="section-sub mx-auto">SLF targets vulnerable and marginalized groups within Tanzanian communities most affected by challenges in health, safety, environmental sustainability and socio-economic development.</p>
    </div>
    <div class="row g-4 mt-2">
      <?php
      $tg = [
        ['i'=>'bi-gender-female','t'=>'Women','d'=>'Empowered through education, entrepreneurship, health awareness and social inclusion.'],
        ['i'=>'bi-person-arms-up','t'=>'Youth','d'=>'Skills, livelihoods, environmental stewardship and safety awareness initiatives.'],
        ['i'=>'bi-people','t'=>'Marginalized populations','d'=>'Households facing economic hardship or limited access to basic services.'],
        ['i'=>'bi-globe-africa','t'=>'Local communities','d'=>'Public health, sustainable agriculture, conservation and resilience programs.'],
      ];
      foreach ($tg as $g): ?>
        <div class="col-md-6 col-lg-3">
          <div class="card-ngo p-4 text-center h-100">
            <div class="icon-tile"><i class="bi <?= e($g['i']) ?>"></i></div>
            <h3 class="card-title"><?= $g['t'] ?></h3>
            <p class="text-muted small mb-0"><?= $g['d'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <div class="text-center">
      <span class="badge-pill-ngo blue">Our Values</span>
      <h2 class="section-title mt-2">Principles that guide our work</h2>
    </div>
    <div class="row g-4 mt-2">
      <?php
      $vals = ['Integrity','Collaboration','Sustainability','Inclusivity','Resilience','Innovation','Technology'];
      foreach ($vals as $v): ?>
        <div class="col-6 col-md-3">
          <div class="card-ngo p-4 text-center h-100">
            <i class="bi bi-check-circle-fill" style="font-size:1.6rem;color:var(--green);"></i>
            <h3 class="card-title mt-2 mb-0" style="font-size:1rem;"><?= e($v) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
