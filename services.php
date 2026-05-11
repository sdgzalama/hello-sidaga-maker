<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/services.php';
$page_title = 'Services';
$page_description = 'Seven practice areas covering consultancy, technology, research, agriculture and training, senior-led teams delivering measurable impact across Tanzania.';
$page_heading = 'Our Services';
$page_crumb = 'Services';
$body_class = 'theme-consult';
$services = slf_services();
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';
?>

<!-- INTRO -->
<section class="section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <span class="badge-pill-ngo blue"><i class="bi bi-patch-check-fill me-1"></i> Registered on Tanzania NeST</span>
        <h2 class="section-title mt-3">End-to-end consultancy and implementation</h2>
        <p class="lead text-muted">
          SustainLife Foundation delivers professional services across the sectors that move Tanzania forward , strategy, technology, social development, research, agriculture and capacity building.
        </p>
        <p class="text-muted">
          Every engagement is senior-led, evidence-driven and measured by the outcomes we leave behind. Choose a service below to see exactly what we deliver, who it&rsquo;s for, and the results you can expect.
        </p>
        <div class="d-flex flex-wrap gap-2 mt-3">
          <a href="<?= url('contact.php') ?>" class="btn btn-primary-ngo"><i class="bi bi-chat-dots-fill me-1"></i> Request a Quote</a>
          <a href="<?= url('contact.php?type=partner') ?>" class="btn btn-yellow"><i class="bi bi-handshake me-1"></i> Partner With Us</a>
        </div>
      </div>
      <div class="col-lg-5">
        <img src="assets/images/consultancy-1.jpg"
             class="img-fluid rounded-4 shadow-sm" alt="SustainLife Foundation team in working session">
      </div>
    </div>
  </div>
</section>

<!-- SERVICES GRID -->
<section class="section alt">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo blue">What We Do</span>
      <h2 class="section-title mt-2">Our Service Lines</h2>
      <p class="section-sub mx-auto">Seven practice areas, one accountable team. Click any service for a detailed brief.</p>
    </div>

    <div class="row g-4">
      <?php foreach ($services as $svc):
        $modalId = 'svcModal_' . $svc['slug'];
      ?>
        <div class="col-md-6 col-lg-4" id="svc-<?= e($svc['slug']) ?>" style="scroll-margin-top: 100px;">
          <article class="card-ngo h-100 p-4 d-flex flex-column">
            <div class="icon-tile <?= e($svc['tone']) ?> mb-3"><i class="bi <?= e($svc['icon']) ?>"></i></div>
            <span class="badge-pill-ngo <?= e($svc['tone']) ?> align-self-start mb-2"><?= e($svc['sector']) ?></span>
            <h4 class="mb-1"><?= e($svc['title']) ?></h4>
            <p class="text-muted small mb-2"><em><?= e($svc['tagline']) ?></em></p>
            <p class="text-muted flex-grow-1"><?= e($svc['summary']) ?></p>
            <div class="d-flex flex-wrap gap-2 mt-3">
              <button type="button" class="btn btn-primary-ngo btn-sm" data-bs-toggle="modal" data-bs-target="#<?= e($modalId) ?>">
                <i class="bi bi-info-circle me-1"></i> Learn More
              </button>
              <a href="<?= url('contact.php?service=' . urlencode($svc['slug'])) ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-envelope me-1"></i> Request a Quote
              </a>
            </div>
          </article>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="<?= e($modalId) ?>" tabindex="-1" aria-labelledby="<?= e($modalId) ?>Label" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header" style="background: linear-gradient(135deg, var(--blue,#1366d6), var(--green,#1a8a5a)); color: #fff;">
                <div class="d-flex align-items-center gap-3">
                  <div class="icon-tile" style="background: rgba(255,255,255,.18); color:#fff;"><i class="bi <?= e($svc['icon']) ?>"></i></div>
                  <div>
                    <h5 class="modal-title mb-0" id="<?= e($modalId) ?>Label"><?= e($svc['title']) ?></h5>
                    <small class="opacity-75"><?= e($svc['tagline']) ?></small>
                  </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h6 class="text-uppercase text-muted small fw-bold">Overview</h6>
                <p><?= e($svc['details']['overview']) ?></p>

                <h6 class="text-uppercase text-muted small fw-bold mt-4">What we deliver</h6>
                <ul class="list-unstyled">
                  <?php foreach ($svc['details']['deliver'] as $d): ?>
                    <li class="mb-1"><i class="bi bi-check2-circle me-2" style="color:var(--blue);"></i><?= e($d) ?></li>
                  <?php endforeach; ?>
                </ul>

                <div class="row g-3 mt-2">
                  <div class="col-md-6">
                    <h6 class="text-uppercase text-muted small fw-bold">Typical engagements</h6>
                    <p class="small mb-0"><?= e($svc['details']['engagements']) ?></p>
                  </div>
                  <div class="col-md-6">
                    <h6 class="text-uppercase text-muted small fw-bold">Who it&rsquo;s for</h6>
                    <p class="small mb-0"><?= e($svc['details']['audience']) ?></p>
                  </div>
                </div>

                <h6 class="text-uppercase text-muted small fw-bold mt-4">Outcomes &amp; KPIs</h6>
                <ul class="list-unstyled">
                  <?php foreach ($svc['details']['outcomes'] as $o): ?>
                    <li class="mb-1"><i class="bi bi-graph-up-arrow me-2" style="color:var(--green,#1a8a5a);"></i><?= e($o) ?></li>
                  <?php endforeach; ?>
                </ul>

                <div class="alert alert-light border mt-4 mb-0">
                  <strong>Why SustainLife:</strong> <?= e($svc['details']['why']) ?>
                </div>
              </div>
              <div class="modal-footer">
                <?php if (!empty($svc['page_link'])): ?>
                  <a href="<?= url($svc['page_link']) ?>" class="btn btn-outline-secondary"><i class="bi bi-journal-text me-1"></i> View full <?= e($svc['title']) ?> page</a>
                <?php endif; ?>
                <a href="<?= url('contact.php?service=' . urlencode($svc['slug'])) ?>" class="btn btn-primary-ngo"><i class="bi bi-send me-1"></i> Request a Quote</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- WHY PARTNER -->
<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge-pill-ngo yellow">Why Partner With Us</span>
      <h2 class="section-title mt-2">Built for impact, structured for delivery</h2>
    </div>
    <div class="row g-4">
      <?php
      $why = [
        ['bi-award-fill',     'Sector depth',        'Years of frontline work across health, agriculture, environment, IT and governance.'],
        ['bi-person-badge',   'Senior-led teams',    'Every engagement is owned by a senior consultant accountable from kickoff to closeout.'],
        ['bi-bar-chart-fill', 'Evidence-driven',     'Decisions backed by data, not anecdotes , with peer-review-grade methods.'],
        ['bi-bullseye',       'Outcome-focused',     'We measure success by results delivered, not pages produced.'],
      ];
      foreach ($why as $w): ?>
        <div class="col-md-6 col-lg-3">
          <div class="why-tile h-100 p-4 card-ngo text-center">
            <div class="icon-tile blue mx-auto mb-3"><i class="bi <?= e($w[0]) ?>"></i></div>
            <h5><?= $w[1] ?></h5>
            <p class="text-muted small mb-0"><?= $w[2] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section alt">
  <div class="container">
    <div class="cta-strip d-md-flex align-items-center justify-content-between">
      <div class="me-md-4 mb-3 mb-md-0">
        <h3 class="mb-1">Ready to scope your next engagement?</h3>
        <p class="mb-0 opacity-90">Tell us your goals and timeline , we&rsquo;ll respond with a tailored proposal within a few working days.</p>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <a href="<?= url('contact.php') ?>" class="btn btn-yellow"><i class="bi bi-envelope-paper-fill me-1"></i> Request a Quote</a>
        <a href="<?= url('contact.php?type=partner') ?>" class="btn btn-outline-light"><i class="bi bi-handshake me-1"></i> Partner With Us</a>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
