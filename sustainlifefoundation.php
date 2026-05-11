<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'SustainLifeFoundation - SustainLife Foundation NGO Tanzania';
$page_description = 'SustainLifeFoundation (SustainLife Foundation) is a Tanzanian NGO promoting health, safety, sustainable agriculture, environment and inclusive empowerment for women, youth and marginalized communities.';
$page_heading = 'SustainLifeFoundation';
$page_crumb = 'SustainLifeFoundation';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
?>

<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo blue">Welcome to SustainLifeFoundation</span>
      <h1 class="section-title mt-3">SustainLifeFoundation - Sustainable Communities Initiative</h1>
      <p class="lead text-muted">SustainLife Foundation (SustainLifeFoundation) is a Tanzanian NGO working at the intersection of health, environment, sustainable agriculture and inclusive empowerment.</p>
    </div>
    
    <div class="row g-5">
      <div class="col-lg-6">
        <h2 class="section-title">About SustainLifeFoundation</h2>
        <p>SustainLifeFoundation, officially known as SustainLife Foundation, is a registered Tanzanian NGO committed to building healthy, safe and sustainable communities. Our work spans across five key thematic areas:</p>
        <ul class="list-unstyled">
          <li class="mb-2"><i class="bi bi-heart-pulse text-primary me-2"></i><strong>Community Health & Well-being</strong> - Preventive care, nutrition and health programs</li>
          <li class="mb-2"><i class="bi bi-shield-check text-primary me-2"></i><strong>Safety & Risk Prevention</strong> - Public safety and disaster risk reduction</li>
          <li class="mb-2"><i class="bi bi-tree text-primary me-2"></i><strong>Sustainable Agriculture</strong> - Climate-smart farming and food security</li>
          <li class="mb-2"><i class="bi bi-gender-female text-primary me-2"></i><strong>Gender & Social Inclusion</strong> - Women and youth empowerment programs</li>
          <li class="mb-2"><i class="bi bi-graph-up-arrow text-primary me-2"></i><strong>Economic Empowerment</strong> - Livelihoods and inclusive development</li>
        </ul>
        <a href="<?= url('about.php') ?>" class="btn btn-primary-ngo mt-3"><i class="bi bi-arrow-right me-1"></i> Learn More About SustainLifeFoundation</a>
      </div>
      <div class="col-lg-6">
        <img src="assets/images/community-2.jpg" alt="SustainLifeFoundation community work in Tanzania" class="img-fluid rounded-4 shadow-sm">
      </div>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo">Our Impact</span>
      <h2 class="section-title mt-2">SustainLifeFoundation by the Numbers</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card-ngo p-4 text-center">
          <div class="icon-tile mx-auto"><i class="bi bi-person-heart"></i></div>
          <h3 class="card-title">100K+</h3>
          <p class="text-muted mb-0">Direct beneficiaries annually</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-ngo p-4 text-center">
          <div class="icon-tile mx-auto"><i class="bi bi-globe-africa"></i></div>
          <h3 class="card-title">1M+</h3>
          <p class="text-muted mb-0">Indirect beneficiaries reached</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-ngo p-4 text-center">
          <div class="icon-tile mx-auto"><i class="bi bi-geo-alt"></i></div>
          <h3 class="card-title">5</h3>
          <p class="text-muted mb-0">Thematic focus areas</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-ngo p-4 text-center">
          <div class="icon-tile mx-auto"><i class="bi bi-people"></i></div>
          <h3 class="card-title">100%</h3>
          <p class="text-muted mb-0">Community-driven approach</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo yellow">Get Involved</span>
      <h2 class="section-title mt-2">Partner with SustainLifeFoundation</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card-ngo p-4 text-center h-100">
          <div class="icon-tile mx-auto"><i class="bi bi-briefcase"></i></div>
          <h4 class="card-title">Professional Services</h4>
          <p class="text-muted">Hire SustainLifeFoundation for consultancy. Proceeds fund community programs.</p>
          <a href="<?= url('consultancy.php') ?>" class="btn btn-outline-secondary btn-sm">View Services</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-ngo p-4 text-center h-100">
          <div class="icon-tile mx-auto"><i class="bi bi-heart"></i></div>
          <h4 class="card-title">Donate & Support</h4>
          <p class="text-muted">Support SustainLifeFoundation programs for sustainable development in Tanzania.</p>
          <a href="<?= url('contact.php') ?>" class="btn btn-outline-secondary btn-sm">Contact Us</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-ngo p-4 text-center h-100">
          <div class="icon-tile mx-auto"><i class="bi bi-journal"></i></div>
          <h4 class="card-title">Resources</h4>
          <p class="text-muted">Access SustainLifeFoundation publications, reports and strategic documents.</p>
          <a href="<?= url('resources.php') ?>" class="btn btn-outline-secondary btn-sm">View Resources</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>