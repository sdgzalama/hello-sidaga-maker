<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Consultancy Services';
$page_heading = 'Consultancy Services';
$page_crumb = 'Consultancy';
$body_class = 'theme-consult';

// Service catalogue — easy to swap for a DB query later (see database/schema.sql)
$categories = [
  [
    'icon'  => 'bi-briefcase',
    'title' => 'Strategic & Business Consultancy',
    'intro' => 'We help leadership teams sharpen direction, build resilient organisations and stay financially compliant.',
    'services' => [
      ['Strategic Planning',            'Long-term roadmaps, theory of change and board-ready strategy documents.'],
      ['Organisation & Change Management', 'Restructuring, culture change and hands-on support through transitions.'],
      ['Human Resources',               'HR policies, recruitment, performance systems and staff development.'],
      ['Tax Consultancy',               'TRA-aligned tax advisory, compliance reviews and filings for NGOs and SMEs.'],
    ],
  ],
  [
    'icon'  => 'bi-cpu',
    'title' => 'Technical & IT Services',
    'intro' => 'Practical technology that fits your team — from advice to building and rolling out the system.',
    'services' => [
      ['IT Consultancy',         'Digital strategy, infrastructure assessments and technology selection.'],
      ['Software Development',   'Custom web and mobile platforms, MIS and data dashboards.'],
      ['Systems Implementation', 'End-to-end deployment, integration and user training for new systems.'],
    ],
  ],
  [
    'icon'  => 'bi-people',
    'title' => 'Social & Development Consultancy',
    'intro' => 'Sector expertise rooted in years of community work across Tanzania.',
    'services' => [
      ['Health Care Consultancy',     'Public health programme design, facility assessments and quality improvement.'],
      ['Educational Consultancy',     'Curriculum reviews, school improvement plans and teacher training.'],
      ['Food & Nutrition Services',   'Nutrition assessments, school-feeding design and food-security programming.'],
      ['Environmental Consultancy',   'EIAs, climate adaptation strategies and natural resource management.'],
    ],
  ],
  [
    'icon'  => 'bi-search',
    'title' => 'Research & Innovation',
    'intro' => 'Evidence you can act on — gathered, analysed and presented with care.',
    'services' => [
      ['Research, Survey & Development Consultancy', 'Baselines, evaluations, market research and applied R&D for development programmes.'],
    ],
  ],
  [
    'icon'  => 'bi-tree',
    'title' => 'Agricultural & Field Services',
    'intro' => 'Field-level support that connects farmers, value chains and sustainability goals.',
    'services' => [
      ['Crop Cultivation Services', 'Climate-smart cultivation, agronomy advisory and demonstration plots.'],
    ],
  ],
];

include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<!-- SECTION 1: INTRO -->
<section class="section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <span class="badge-pill-ngo blue"><i class="bi bi-patch-check-fill me-1"></i> Registered on Tanzania NeST</span>
        <h2 class="section-title mt-3">Professional consultancy across the sectors that matter most</h2>
        <p class="lead text-muted">
          SustainLife Foundation, through its consultancy arm, provides professional services across multiple sectors &mdash; including business strategy, technology, environment, health and agriculture &mdash; to support sustainable development and organizational impact.
        </p>
        <p class="text-muted">
          We work alongside government institutions, development partners, private companies and civil society. Every engagement is led by a senior consultant and delivered by a small, accountable team that knows the local context.
        </p>
        <div class="d-flex flex-wrap gap-2 mt-3">
          <a href="<?= url('contact.php') ?>" class="btn btn-primary-ngo"><i class="bi bi-chat-dots-fill me-1"></i> Request a Quote</a>
          <a href="<?= url('contact.php?type=partner') ?>" class="btn btn-yellow"><i class="bi bi-handshake me-1"></i> Partner With Us</a>
        </div>
      </div>
      <div class="col-lg-5">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=900"
             class="img-fluid rounded-4 shadow-sm" alt="SLF consultants in a working session">
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2 + 3: CATEGORIES & SERVICE CARDS -->
<section class="section alt">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo blue">Our Services</span>
      <h2 class="section-title mt-2">Our Consultancy Services</h2>
      <p class="section-sub mx-auto">We organise our consultancy work into five practice areas. Each area is led by specialists with real field experience, so you get advice that works on the ground &mdash; not just on paper.</p>
    </div>

    <?php foreach ($categories as $i => $cat): ?>
      <div class="service-group mb-4">
        <div class="service-group-head">
          <div class="icon-tile blue"><i class="bi <?= e($cat['icon']) ?>"></i></div>
          <div>
            <div class="text-muted small fw-bold">CATEGORY <?= str_pad((string)($i+1), 2, '0', STR_PAD_LEFT) ?></div>
            <h3 class="mb-1"><?= $cat['title'] ?></h3>
            <p class="text-muted mb-0"><?= e($cat['intro']) ?></p>
          </div>
        </div>
        <div class="row g-3 mt-2">
          <?php foreach ($cat['services'] as $s): ?>
            <div class="col-md-6 col-lg-4">
              <div class="sub-service h-100">
                <h5 class="mb-1"><i class="bi bi-check2-circle me-2" style="color:var(--blue);"></i><?= $s[0] ?></h5>
                <p class="text-muted small mb-0"><?= e($s[1]) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- SECTION 4: WHY CHOOSE US -->
<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo yellow">Why Choose Us</span>
      <h2 class="section-title mt-2">Why Choose SustainLife Foundation as Your Consultancy Partner</h2>
    </div>
    <div class="row g-4">
      <?php
      $why = [
        ['bi-people-fill',    'Community-driven expertise',  'We&rsquo;ve worked side-by-side with rural and urban communities across Tanzania for years.'],
        ['bi-grid-3x3-gap',   'Multi-sector experience',     'Health, education, agriculture, environment, IT and governance &mdash; under one roof.'],
        ['bi-bank',           'Government-aligned services', 'Registered on NeST and aligned with national priorities and SDG targets.'],
        ['bi-graph-up-arrow', 'Impact-focused approach',     'We measure success by what changes for people, not by the size of the report.'],
      ];
      foreach ($why as $w): ?>
        <div class="col-md-6 col-lg-3">
          <div class="why-tile h-100">
            <div class="icon-tile blue mb-3"><i class="bi <?= e($w[0]) ?>"></i></div>
            <h5><?= $w[1] ?></h5>
            <p class="text-muted small mb-0"><?= $w[2] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SECTION 5: CTA -->
<section class="section alt">
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
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
