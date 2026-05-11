<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Our Impact';
$page_description = 'See the measurable impact of SustainLife Foundation programs, communities reached, lives changed, and outcomes delivered across Tanzania.';
$page_heading = 'Our Impact';
$page_crumb = 'Impact';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<section class="section">
  <div class="container">
    <div class="text-center mb-4">
      <span class="badge-pill-ngo yellow">By the Numbers</span>
      <h2 class="section-title mt-2">Reach &amp; results</h2>
      <p class="section-sub mx-auto">SLF aims to impact at least <strong>100,000 direct beneficiaries</strong> annually and indirectly benefit over <strong>1,000,000 people</strong> across targeted communities.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-3 col-6"><div class="stat"><div class="num" data-counter="100000">100,000+</div><div class="lbl">Direct beneficiaries</div></div></div>
      <div class="col-md-3 col-6"><div class="stat"><div class="num blue" data-counter="1000000">1,000,000+</div><div class="lbl">Indirect beneficiaries</div></div></div>
      <div class="col-md-3 col-6"><div class="stat"><div class="num yellow" data-counter="5">5</div><div class="lbl">Thematic focus areas</div></div></div>
      <div class="col-md-3 col-6"><div class="stat"><div class="num" data-counter="100">100%</div><div class="lbl">Community-driven</div></div></div>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <div class="text-center">
      <span class="badge-pill-ngo">Where We Work</span>
      <h2 class="section-title mt-2">Sectors of impact</h2>
    </div>
    <div class="row g-4 mt-2">
      <?php
      $sectors = [
        ['i'=>'bi-heart-pulse',     't'=>'Community Health',           'd'=>'Preventive care, nutrition, hygiene and access to information.'],
        ['i'=>'bi-tree',            't'=>'Agriculture &amp; Food Security','d'=>'Climate-smart, sustainable farming and resilient livelihoods.'],
        ['i'=>'bi-shield-check',    't'=>'Safety &amp; Protection',    'd'=>'Public, occupational and environmental safety awareness.'],
        ['i'=>'bi-globe-europe-africa','t'=>'Environment Conservation','d'=>'Soil &amp; water conservation, ecosystem stewardship.'],
        ['i'=>'bi-graph-up-arrow',  't'=>'Economic Empowerment',       'd'=>'Entrepreneurship, savings groups and market access.'],
        ['i'=>'bi-people',          't'=>'Social Inclusion',           'd'=>'Voice, participation and equity for marginalized groups.'],
      ];
      foreach ($sectors as $s): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card-ngo p-4 h-100">
            <div class="icon-tile"><i class="bi <?= e($s['i']) ?>"></i></div>
            <h3 class="card-title"><?= $s['t'] ?></h3>
            <p class="text-muted mb-0"><?= $s['d'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section brand-strip">
  <div class="container text-center">
    <h2 class="section-title">Our Theory of Change</h2>
    <p class="opacity-90 mx-auto" style="max-width:760px;">We <strong>Target</strong> the most underserved, <strong>Train</strong> with up-to-date skills, <strong>Test</strong> through pilots backed by mentorship, and <strong>Tie</strong> communities into networks that protect ecosystems and sustain impact.</p>
    <div class="row g-4 mt-3">
      <?php foreach (['Target','Train','Test','Tie'] as $i=>$step): ?>
        <div class="col-md-3">
          <div class="card-ngo p-4 text-center h-100" style="background:#103e7a;color:var(--dark);">
            <div class="icon-tile yellow mx-auto"><strong><?= $i+1 ?></strong></div>
            <h3 class="card-title"><?= e($step) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
