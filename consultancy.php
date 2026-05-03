<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Consultancy Services';
$page_heading = 'Consultancy Services';
$page_crumb = 'Consultancy';
$body_class = 'theme-consult';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<section class="section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <span class="badge-pill-ngo blue">SLF Consultancy</span>
        <h2 class="section-title mt-2">Professional consultancy &amp; non-consultancy services for impact-driven organizations</h2>
        <p class="lead text-muted">SustainLife Foundation, through its consultancy arm, provides professional consultancy and non-consultancy services in areas such as agriculture, sustainability and community development to support organizational impact.</p>
        <p>We support development partners, government institutions, private-sector organizations and civil society with rigorous, evidence-based services delivered by a multi-disciplinary team.</p>
        <a href="<?= url('contact.php') ?>" class="btn btn-primary-ngo mt-2"><i class="bi bi-chat-dots-fill me-1"></i> Request a Quote</a>
      </div>
      <div class="col-lg-5">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=900" class="img-fluid rounded-4 shadow-sm" alt="SLF consultants at work">
      </div>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <div class="text-center">
      <span class="badge-pill-ngo blue">Service Categories</span>
      <h2 class="section-title mt-2">What we offer</h2>
    </div>
    <div class="row g-4 mt-2">
      <?php
      $cats = [
        ['i'=>'bi-clipboard-data','t'=>'Research &amp; Assessments','d'=>'Baseline, midline and endline studies, needs assessments and feasibility studies.'],
        ['i'=>'bi-bar-chart-line','t'=>'Monitoring &amp; Evaluation','d'=>'M&amp;E frameworks, data systems, evaluations and learning reviews.'],
        ['i'=>'bi-tree','t'=>'Sustainable Agriculture','d'=>'Value chain analysis, climate-smart agriculture and food-systems advisory.'],
        ['i'=>'bi-people','t'=>'Capacity Building','d'=>'Tailored training, mentorship and organizational development programs.'],
        ['i'=>'bi-shield-check','t'=>'Safety &amp; Risk Advisory','d'=>'Occupational, public and environmental safety strategies.'],
        ['i'=>'bi-diagram-3','t'=>'Strategy &amp; Program Design','d'=>'Theory of change, strategic planning and program design support.'],
      ];
      foreach ($cats as $c): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card-ngo p-4 h-100">
            <div class="icon-tile blue"><i class="bi <?= e($c['i']) ?>"></i></div>
            <h3 class="card-title"><?= $c['t'] ?></h3>
            <p class="text-muted mb-0"><?= $c['d'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-6">
        <span class="badge-pill-ngo yellow">Client Benefits</span>
        <h2 class="section-title mt-2">Why partner with SLF Consultancy</h2>
        <ul class="list-unstyled mt-3">
          <?php
          $benefits = [
            'Multi-disciplinary expertise across health, environment and livelihoods',
            'Deep field presence and trusted community relationships in Tanzania',
            'Rigorous, evidence-based methodology aligned with SDGs',
            'Transparent reporting and measurable, accountable outcomes',
            'Flexible engagement models — short-term advisory or long-term partnership',
          ];
          foreach ($benefits as $b): ?>
            <li class="mb-2"><i class="bi bi-check2-circle me-2" style="color:var(--blue);"></i><?= e($b) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-lg-6">
        <div class="card-ngo p-4 p-md-5 h-100" style="background:linear-gradient(135deg,#103e7a,#1a56a4);color:#fff;border:0;">
          <h3 style="color:#fff;">Ready to start a project?</h3>
          <p class="opacity-90">Tell us about your scope, timeline and objectives &mdash; we&rsquo;ll respond with a tailored proposal.</p>
          <a href="<?= url('contact.php') ?>" class="btn btn-yellow"><i class="bi bi-arrow-right me-1"></i> Request a Quote</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
