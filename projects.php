<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
$page_title = 'Projects';
$page_heading = 'Our Projects & Initiatives';
$page_crumb = 'Projects';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$projects = [];
$pdo = db();
if ($pdo) {
    try {
        $projects = $pdo->query("SELECT * FROM projects WHERE status IN ('active','completed') ORDER BY id DESC")->fetchAll();
    } catch (Exception $e) { $projects = []; }
}

// Fallback demo data when DB not connected
if (!$projects) {
    $projects = [
      ['id'=>1,'sector'=>'Health',     'tone'=>'',      'image'=>'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800', 'title'=>'Community Health Outreach', 'summary'=>'Mobile clinics, nutrition and preventive healthcare in underserved villages.', 'body'=>'Our community health outreach program brings mobile clinics, nutrition support, and preventive healthcare directly to underserved villages. Working with local health workers, we deliver maternal care, immunisations, screenings, and health education to thousands of families each year.'],
      ['id'=>2,'sector'=>'Agriculture','tone'=>'yellow','image'=>'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800', 'title'=>'Climate-Smart Farming',     'summary'=>'Training smallholder farmers in sustainable, climate-resilient practices.', 'body'=>'We train smallholder farmers in climate-resilient techniques: drought-tolerant seeds, conservation agriculture, agroforestry, and post-harvest handling. The program improves food security, raises household incomes, and protects the surrounding ecosystem.'],
      ['id'=>3,'sector'=>'Environment','tone'=>'',      'image'=>'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800', 'title'=>'Water & Conservation',  'summary'=>'Soil and water conservation, reforestation and ecosystem stewardship.', 'body'=>'From spring protection to community-led reforestation, this initiative restores watersheds and safeguards drinking water sources. Tree nurseries, terracing, and clean-water points are co-managed with the villages we serve.'],
      ['id'=>4,'sector'=>'Community',  'tone'=>'blue',  'image'=>'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800', 'title'=>'Women Entrepreneurship',    'summary'=>'Capacity building, savings groups and market access for women in business.', 'body'=>'A flagship program that combines business training, village savings groups, and market linkages so women-led enterprises can grow. Participants gain access to mentorship, micro-loans, and digital tools.'],
      ['id'=>5,'sector'=>'Health',     'tone'=>'',      'image'=>'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=800', 'title'=>'Maternal & Child Health','summary'=>'Awareness campaigns and referral support to reduce maternal mortality.', 'body'=>'Targeted awareness campaigns, antenatal outreach, and emergency referral support work together to reduce maternal and infant mortality across our partner districts.'],
      ['id'=>6,'sector'=>'Community',  'tone'=>'blue',  'image'=>'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800', 'title'=>'Youth Skills Program',      'summary'=>'TVET-aligned skills training for sustainable livelihoods among youth.', 'body'=>'A TVET-aligned program that equips young people with vocational skills, entrepreneurship training, and apprenticeship placements — opening pathways to dignified, sustainable livelihoods.'],
    ];
}

// Tone mapping for badges by sector
$tone_map = ['Agriculture'=>'yellow','Community'=>'blue','Environment'=>'','Health'=>''];
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
      <?php foreach ($projects as $p):
        $img = $p['image'] ?? '';
        if ($img && !preg_match('~^https?://~', $img)) $img = url($img);
        if (!$img) $img = 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800';
        $sector = $p['sector'] ?? '';
        $tone = $p['tone'] ?? ($tone_map[$sector] ?? '');
        $modalId = 'projectModal' . (int)($p['id'] ?? 0);
      ?>
        <div class="col-md-6 col-lg-4">
          <article class="card-ngo h-100">
            <img src="<?= e($img) ?>" alt="<?= e($p['title']) ?>">
            <div class="card-body d-flex flex-column">
              <?php if ($sector): ?><span class="badge-pill-ngo <?= e($tone) ?>"><?= e($sector) ?></span><?php endif; ?>
              <h3 class="card-title mt-2"><?= e($p['title']) ?></h3>
              <p class="text-muted small mb-3 flex-grow-1"><?= e($p['summary'] ?? '') ?></p>
              <a href="#" class="fw-semibold mt-auto" data-bs-toggle="modal" data-bs-target="#<?= e($modalId) ?>">
                Read more <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </article>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="<?= e($modalId) ?>" tabindex="-1" aria-labelledby="<?= e($modalId) ?>Label" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="<?= e($modalId) ?>Label"><?= e($p['title']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="<?= e($img) ?>" alt="<?= e($p['title']) ?>" class="img-fluid rounded mb-3">
                <?php if ($sector): ?><span class="badge-pill-ngo <?= e($tone) ?> mb-2 d-inline-block"><?= e($sector) ?></span><?php endif; ?>
                <p class="lead"><?= e($p['summary'] ?? '') ?></p>
                <div class="text-muted">
                  <?= nl2br(e($p['body'] ?? $p['summary'] ?? '')) ?>
                </div>
              </div>
              <div class="modal-footer">
                <a href="<?= url('contact.php?type=partner') ?>" class="btn btn-primary-ngo">Partner With Us</a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
