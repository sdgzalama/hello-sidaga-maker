<?php
require_once __DIR__ . '/includes/config.php';
$page_title       = 'Consultancy Services in Tanzania';
$page_description = 'Professional technical & advisory services across health, agriculture, environment and IT, every engagement reinvests into community programs run by SustainLife Foundation.';
$page_heading     = 'Technical & Consultancy Services';
$page_crumb       = 'Consultancy';
$body_class       = 'theme-consult';
$page_og_image    = asset('images/hero-1.jpg');

$page_jsonld = [
  '@context' => 'https://schema.org',
  '@type'    => 'Service',
  'serviceType' => 'Technical & Consultancy Services',
  'provider' => ['@type' => 'NGO', 'name' => SITE_NAME, 'url' => SITE_URL],
  'areaServed' => ['@type' => 'Country', 'name' => 'Tanzania'],
  'description' => 'Strategic, technical, social, research, and agricultural consultancy services delivered by SustainLife Foundation. Proceeds support community development programs.',
];

// Service catalogue
$categories = [
  [
    'icon'  => 'bi-briefcase',
    'title' => 'Strategic & Business Consultancy',
    'intro' => 'Sharpen direction, build resilient organisations, stay financially compliant.',
    'services' => ['Strategic Planning', 'Organisation & Change Management', 'Human Resources', 'Tax Consultancy'],
  ],
  [
    'icon'  => 'bi-cpu',
    'title' => 'Technical & IT Services',
    'intro' => 'Practical technology that fits your team, from advice to rollout.',
    'services' => ['IT Consultancy', 'Software Development', 'Systems Implementation'],
  ],
  [
    'icon'  => 'bi-people',
    'title' => 'Social & Development Consultancy',
    'intro' => 'Sector expertise rooted in community work across Tanzania.',
    'services' => ['Health Care Consultancy', 'Educational Consultancy', 'Food & Nutrition Services', 'Environmental Consultancy'],
  ],
  [
    'icon'  => 'bi-search',
    'title' => 'Research & Innovation',
    'intro' => 'Evidence you can act on, gathered, analysed and presented with care.',
    'services' => ['Baselines & Evaluations', 'Surveys & Market Research', 'Applied R&D for Development'],
  ],
  [
    'icon'  => 'bi-tree',
    'title' => 'Agricultural & Field Services',
    'intro' => 'Field-level support that connects farmers, value chains and sustainability goals.',
    'services' => ['Climate-Smart Cultivation', 'Agronomy Advisory', 'Demonstration Plots'],
  ],
];

$partners = [
  ['bi-bank',          'Government Institutions'],
  ['bi-globe2',        'Development Partners & Donors'],
  ['bi-people-fill',   'NGOs & Civil Society Organisations'],
  ['bi-building',      'Private-Sector Stakeholders'],
  ['bi-house-heart',   'Community Groups & Associations'],
];

include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
?>

<!-- HERO -->
<section class="consult-hero">
  <div class="container">
    <span class="eyebrow"><i class="bi bi-patch-check-fill me-2"></i>Technical & Consultancy Services</span>
    <h1>Technical &amp; Consultancy Services for Impact</h1>
    <p class="lead">
      SustainLife Foundation provides professional technical and advisory services to support institutions, communities, and development partners in achieving sustainable development outcomes. These services are designed not only to deliver expertise but also to generate resources that <strong>directly support community programs and long-term impact</strong>.
    </p>
    <div class="d-flex flex-wrap gap-2 mt-4">
      <a href="<?= url('contact.php') ?>" class="btn btn-yellow"><i class="bi bi-chat-dots-fill me-1"></i> Request a Quote</a>
      <a href="<?= url('contact.php?type=partner') ?>" class="btn btn-outline-light"><i class="bi bi-handshake me-1"></i> Partner With Us</a>
    </div>
  </div>
</section>

<!-- IMPACT STRIP -->
<section class="impact-strip">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-6">
        <p class="quote mb-0"><i class="bi bi-quote me-2"></i>Every engagement reinvests into the communities we serve.</p>
      </div>
      <div class="col-lg-6">
        <div class="row g-3 text-center">
          <div class="col-4"><div class="stat"><div class="num">7</div><div class="lbl">Service Lines</div></div></div>
          <div class="col-4"><div class="stat"><div class="num">5+</div><div class="lbl">Sectors Served</div></div></div>
          <div class="col-4"><div class="stat"><div class="num">100%</div><div class="lbl">Community-First</div></div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STRATEGIC PARTNERSHIPS -->
<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo blue">Who We Work With</span>
      <h2 class="section-title mt-2">Our Strategic Partnerships</h2>
      <p class="section-sub mx-auto">We collaborate across sectors to deliver evidence-based solutions and lasting community impact.</p>
    </div>
    <div class="row g-3 g-md-4">
      <?php foreach ($partners as $p): ?>
        <div class="col-6 col-md-4 col-lg">
          <div class="partner-card">
            <div class="icon-wrap"><i class="bi <?= e($p[0]) ?>"></i></div>
            <h6><?= e($p[1]) ?></h6>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="section" style="background: var(--cream);">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo">Our Services</span>
      <h2 class="section-title mt-2">Our Consultancy Services</h2>
      <p class="section-sub mx-auto">Five practice areas, one accountable team, each led by specialists with real field experience in Tanzania.</p>
    </div>
    <div class="row g-4">
      <?php foreach ($categories as $cat): ?>
        <div class="col-md-6 col-lg-4">
          <article class="service-card-warm">
            <div class="head">
              <div class="icon-tile"><i class="bi <?= e($cat['icon']) ?>"></i></div>
              <div>
                <h3><?= e($cat['title']) ?></h3>
                <p class="intro"><?= e($cat['intro']) ?></p>
              </div>
            </div>
            <ul class="checks">
              <?php foreach ($cat['services'] as $s): ?>
                <li><i class="bi bi-check2-circle"></i><span><?= e($s) ?></span></li>
              <?php endforeach; ?>
            </ul>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- HOW PROCEEDS RETURN -->
<section class="section">
  <div class="container">
    <div class="reinvest-band">
      <div class="row align-items-center g-5">
        <div class="col-lg-7">
          <span class="badge-pill-ngo">Our Promise</span>
          <h2 class="section-title mt-2">How proceeds return to the community</h2>
          <p class="text-muted mb-4">We are an NGO that consults &mdash; not a firm that occasionally gives back. Surplus from every engagement directly funds our community programs in health, agriculture, education and inclusion.</p>
          <div class="row g-4 mt-1">
            <div class="col-md-4"><div class="flow-step"><span class="step-num">1</span><h5>Engagement</h5><p>You hire us for senior-led, evidence-driven consultancy work.</p></div></div>
            <div class="col-md-4"><div class="flow-step"><span class="step-num">2</span><h5>Surplus Reinvested</h5><p>Net proceeds flow into our community program fund.</p></div></div>
            <div class="col-md-4"><div class="flow-step"><span class="step-num">3</span><h5>Impact Delivered</h5><p>Programs reach women, youth and rural communities across Tanzania.</p></div></div>
          </div>
        </div>
        <div class="col-lg-5">
          <img src="assets/images/community-1.jpg" loading="lazy" class="img-fluid rounded-4 shadow-sm" alt="Community members participating in a SustainLife Foundation program in Tanzania">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY -->
<section class="section" style="background: var(--cream);">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo yellow">Why Partner With Us</span>
      <h2 class="section-title mt-2">A consultancy partner with roots in the community</h2>
    </div>
    <div class="row g-4">
      <?php
      $why = [
        ['bi-people-fill',    'Community-driven',     'Side-by-side with rural and urban communities across Tanzania.'],
        ['bi-grid-3x3-gap',   'Multi-sector',         'Health, education, agriculture, environment, IT and governance.'],
        ['bi-bank',           'Government-aligned',   'Registered on NeST, aligned with national priorities & SDGs.'],
        ['bi-graph-up-arrow', 'Impact-focused',       'Measured by what changes for people, not by report length.'],
      ];
      foreach ($why as $w): ?>
        <div class="col-md-6 col-lg-3">
          <div class="why-tile-warm">
            <div class="icon-tile"><i class="bi <?= e($w[0]) ?>"></i></div>
            <h5><?= e($w[1]) ?></h5>
            <p><?= e($w[2]) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section">
  <div class="container">
    <div class="cta-strip d-md-flex align-items-center justify-content-between">
      <div class="me-md-4 mb-3 mb-md-0">
        <h3 class="mb-1">Have a project in mind?</h3>
        <p class="mb-0 opacity-90">Tell us your scope and timeline &mdash; we&rsquo;ll come back with a tailored proposal within a few working days.</p>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <a href="<?= url('contact.php') ?>" class="btn btn-yellow"><i class="bi bi-envelope-paper-fill me-1"></i> Request a Quote</a>
        <a href="<?= url('contact.php?type=partner') ?>" class="btn btn-outline-light"><i class="bi bi-handshake me-1"></i> Partner With Us</a>
      </div>
    </div>

    <div class="row g-4 mt-2">
      <div class="col-md-4">
        <div class="card-ngo p-4 h-100 text-center">
          <div class="icon-tile mx-auto"><i class="bi bi-envelope-fill"></i></div>
          <h6 class="mb-1">Email</h6>
          <a href="mailto:<?= e(SITE_EMAIL) ?>" class="text-muted small"><?= e(SITE_EMAIL) ?></a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-ngo p-4 h-100 text-center">
          <div class="icon-tile mx-auto"><i class="bi bi-telephone-fill"></i></div>
          <h6 class="mb-1">Phone</h6>
          <p class="text-muted small mb-0"><?= e(SITE_PHONE) ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-ngo p-4 h-100 text-center">
          <div class="icon-tile mx-auto"><i class="bi bi-geo-alt-fill"></i></div>
          <h6 class="mb-1">Location</h6>
          <p class="text-muted small mb-0"><?= e(SITE_ADDRESS) ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
