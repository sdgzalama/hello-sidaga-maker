<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'SustainLife Foundation, NGO in Tanzania';
$page_description = 'SustainLife Foundation is a Tanzanian NGO working at the intersection of health, environment, sustainable agriculture and inclusive empowerment for women, youth and marginalised communities.';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';

$slides = [
  ['img' => asset('images/agriculture-1.jpg'), 'badge' => 'Climate-Smart Agriculture', 'title' => 'Resilient livelihoods through sustainable farming.', 'sub' => 'Working hand-in-hand with farmers across Tanzania to scale climate-smart, food-secure communities.'],
  ['img' => asset('images/health-2.jpg'),     'badge' => 'Community Health & Nutrition', 'title' => 'Healthier mothers, stronger children.', 'sub' => 'Preventive care, nutrition and health information programs that reach families where they live.'],
  ['img' => asset('images/gender-2.jpg'),     'badge' => 'Women & Youth Empowerment',   'title' => 'Skills, voice and opportunity for every woman and youth.', 'sub' => 'Vocational training, livelihoods and inclusive empowerment for those most often left behind.'],
  ['img' => asset('images/community-2.jpg'),  'badge' => 'Safety & Well-being',          'title' => 'Safer streets, safer communities.', 'sub' => 'Road safety, risk prevention and community-led campaigns that protect children and families.'],
];
?>

<!-- HERO SLIDESHOW -->
<section class="hero hero-slider">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5500">
    <div class="carousel-indicators">
      <?php foreach ($slides as $i => $s): ?>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $i ?>" <?= $i===0?'class="active"':'' ?>></button>
      <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
      <?php foreach ($slides as $i => $s): ?>
        <div class="carousel-item <?= $i===0?'active':'' ?>" style="background-image:linear-gradient(135deg,rgba(20,60,40,.78),rgba(15,80,80,.65)),url('<?= e($s['img']) ?>');">
          <div class="container">
            <div class="row">
              <div class="col-lg-9">
                <span class="badge-hero mb-3 d-inline-block"><i class="bi bi-globe-africa me-1"></i> <?= $s['badge'] ?></span>
                <h1><?= $s['title'] ?></h1>
                <p><?= $s['sub'] ?></p>
                <div class="mt-4">
                  <a href="<?= url('contact.php') ?>" class="btn btn-light-cta me-2"><i class="bi bi-chat-dots-fill me-1"></i> Request a Quote</a>
                  <a href="<?= url('about.php') ?>" class="btn btn-outline-cta">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
  </div>
</section>

<!-- REINVEST GLOW BAND -->
<section class="reinvest-glow-band">
  <div class="container">
    <div class="row align-items-center g-3">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3">
          <span class="glow-dot" aria-hidden="true"></span>
          <div>
            <h2 class="shine-text mb-1">Every engagement reinvests into the communities we serve.</h2>
            <p class="mb-0 opacity-90">Hire us for consultancy. The surplus funds our community programs in health, agriculture, education and inclusion.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 text-lg-end">
        <a href="<?= url('consultancy.php') ?>" class="btn btn-yellow btn-lg"><i class="bi bi-arrow-right-circle-fill me-1"></i> See how it works</a>
      </div>
    </div>
  </div>
</section>

<!-- INTRO -->
<section class="section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="badge-pill-ngo blue">Who We Are</span>
        <h2 class="mt-3 section-title">A Tanzanian NGO at the intersection of health, environment &amp; livelihoods.</h2>
        <p>SustainLife Foundation (SLF) addresses the root causes of vulnerability and inequality through integrated, community-driven approaches, equipping people with the knowledge, skills, and opportunities to actively shape their own futures.</p>
        <p class="text-muted">Aligned with Tanzania&rsquo;s national development priorities and the UN Sustainable Development Goals (SDGs).</p>
        <a href="<?= url('about.php') ?>" class="btn btn-primary-ngo mt-2">More about us <i class="bi bi-arrow-right ms-1"></i></a>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          <div class="col-6">
            <div class="card-ngo p-4 text-center">
              <div class="icon-tile"><i class="bi bi-heart-pulse"></i></div>
              <h3 class="card-title">Health</h3>
              <p class="text-muted small mb-0">Community well-being &amp; preventive care</p>
            </div>
          </div>
          <div class="col-6">
            <div class="card-ngo p-4 text-center">
              <div class="icon-tile yellow"><i class="bi bi-shield-check"></i></div>
              <h3 class="card-title">Safety</h3>
              <p class="text-muted small mb-0">Risk prevention &amp; protection</p>
            </div>
          </div>
          <div class="col-6">
            <div class="card-ngo p-4 text-center">
              <div class="icon-tile"><i class="bi bi-tree"></i></div>
              <h3 class="card-title">Environment</h3>
              <p class="text-muted small mb-0">Sustainable agriculture &amp; stewardship</p>
            </div>
          </div>
          <div class="col-6">
            <div class="card-ngo p-4 text-center">
              <div class="icon-tile blue"><i class="bi bi-people"></i></div>
              <h3 class="card-title">Inclusion</h3>
              <p class="text-muted small mb-0">Women, youth &amp; marginalized groups</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES / FOCUS -->
<section class="section alt">
  <div class="container">
    <div class="text-center">
      <span class="badge-pill-ngo">Our Services</span>
      <h2 class="section-title mt-2">What we deliver</h2>
      <p class="section-sub mx-auto">From grassroots programs to professional consultancy, our work is integrated, evidence-based and measurable.</p>
    </div>
    <div class="row g-4 mt-2">
      <?php
      $services = [
        ['icon'=>'bi-heart-pulse','tone'=>'',       'title'=>'Community Health &amp; Well-being', 'desc'=>'Health information &amp; services, nutrition, hygiene and preventive healthcare programs.'],
        ['icon'=>'bi-shield-check','tone'=>'yellow','title'=>'Safety &amp; Risk Prevention',       'desc'=>'Public, occupational and environmental safety, awareness and disaster risk reduction.'],
        ['icon'=>'bi-tree',        'tone'=>'',     'title'=>'Sustainable Agriculture',            'desc'=>'Climate-smart agriculture, soil &amp; water conservation, food security and resilience.'],
        ['icon'=>'bi-gender-female','tone'=>'blue','title'=>'Gender &amp; Social Inclusion',      'desc'=>'Empowering women, youth and marginalized groups through capacity building and advocacy.'],
        ['icon'=>'bi-graph-up-arrow','tone'=>'blue','title'=>'Economic Empowerment',              'desc'=>'Entrepreneurship, livelihoods and inclusive local economic development.'],
        ['icon'=>'bi-briefcase',   'tone'=>'yellow','title'=>'Professional Consultancy',          'desc'=>'Consultancy &amp; non-consultancy services for development organizations and partners.'],
      ];
      foreach ($services as $s): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card-ngo p-4 h-100">
            <div class="icon-tile <?= e($s['tone']) ?>"><i class="bi <?= e($s['icon']) ?>"></i></div>
            <h3 class="card-title"><?= $s['title'] ?></h3>
            <p class="text-muted mb-0"><?= $s['desc'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-4">
      <a href="<?= url('services.php') ?>" class="btn btn-primary-ngo"><i class="bi bi-grid me-1"></i> View all services</a>
    </div>
  </div>
</section>

<!-- IMPACT BAND -->
<section class="section">
  <div class="container">
    <div class="impact-band">
      <div class="row text-center align-items-center g-4">
        <div class="col-md-3"><div class="num">100K+</div><div class="lbl">Direct beneficiaries / year</div></div>
        <div class="col-md-3"><div class="num">1M+</div><div class="lbl">Indirect beneficiaries</div></div>
        <div class="col-md-3"><div class="num">5</div><div class="lbl">Thematic focus areas</div></div>
        <div class="col-md-3"><div class="num">100%</div><div class="lbl">Community-driven</div></div>
      </div>
    </div>
  </div>
</section>

<!-- WHY US -->
<section class="section alt">
  <div class="container">
    <div class="text-center">
      <span class="badge-pill-ngo blue">Why Choose Us</span>
      <h2 class="section-title mt-2">A credible, accountable partner for sustainable impact</h2>
    </div>
    <div class="row g-4 mt-2">
      <?php
      $why = [
        ['i'=>'bi-award','t'=>'Proven Expertise','d'=>'Multi-disciplinary team with deep community development experience.'],
        ['i'=>'bi-people-fill','t'=>'Community-Driven','d'=>'Programs designed with, not for, the people we serve.'],
        ['i'=>'bi-clipboard-data','t'=>'Evidence-Based','d'=>'Aligned with Tanzania&rsquo;s priorities and the SDGs.'],
        ['i'=>'bi-shield-lock','t'=>'Transparent &amp; Accountable','d'=>'Honest reporting, measurable outcomes, responsible stewardship.'],
      ];
      foreach ($why as $w): ?>
        <div class="col-md-6 col-lg-3">
          <div class="card-ngo p-4 h-100 text-center">
            <div class="icon-tile blue"><i class="bi <?= e($w['i']) ?>"></i></div>
            <h3 class="card-title"><?= $w['t'] ?></h3>
            <p class="text-muted small mb-0"><?= $w['d'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- RESOURCES HIGHLIGHT -->
<section class="section">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <span class="badge-pill-ngo blue">Resources</span>
        <h2 class="section-title mt-2">Strategic Plan, Annual Reports &amp; Publications</h2>
        <p class="text-muted">Read and download our strategic plan, annual reports, policies and other publications , everything we publish is available for preview and download.</p>
        <div class="d-flex flex-wrap gap-2 mt-3">
          <a href="<?= url('strategic-plan.php') ?>" class="btn btn-primary-ngo"><i class="bi bi-bullseye me-1"></i> View Strategic Plan</a>
          <a href="<?= url('resources.php') ?>" class="btn btn-outline-secondary"><i class="bi bi-folder2-open me-1"></i> All Resources</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          <div class="col-6"><a class="card-ngo p-3 d-block text-decoration-none text-dark" href="<?= url('resources.php?type=annual-report') ?>"><i class="bi bi-journal-bookmark text-primary"></i> <strong>Annual Reports</strong></a></div>
          <div class="col-6"><a class="card-ngo p-3 d-block text-decoration-none text-dark" href="<?= url('resources.php?type=publication') ?>"><i class="bi bi-book text-primary"></i> <strong>Publications</strong></a></div>
          <div class="col-6"><a class="card-ngo p-3 d-block text-decoration-none text-dark" href="<?= url('resources.php?type=policy') ?>"><i class="bi bi-shield-check text-primary"></i> <strong>Policies</strong></a></div>
          <div class="col-6"><a class="card-ngo p-3 d-block text-decoration-none text-dark" href="<?= url('resources.php') ?>"><i class="bi bi-download text-primary"></i> <strong>Downloads</strong></a></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section alt">
  <div class="container">
    <div class="cta-strip d-md-flex justify-content-between align-items-center">
      <div>
        <h3 class="mb-1">Let&rsquo;s build sustainable impact, together.</h3>
        <p class="mb-0 opacity-75">Partner with SLF for consultancy, research or community programs.</p>
      </div>
      <a href="<?= url('contact.php') ?>" class="btn btn-yellow btn-lg mt-3 mt-md-0"><i class="bi bi-chat-dots-fill me-1"></i> Work With Us</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
