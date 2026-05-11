<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Content & Updates';
$page_description = 'Content hub for SustainLife Foundation, news, updates, stories and resources from our work across Tanzania.';
$page_heading = 'Content, News &amp; Updates';
$page_crumb = 'Content';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$items = [
  ['tag'=>'News','tone'=>'','date'=>'Apr 28, 2026','img'=>'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=800','title'=>'Community Health Outreach in Coastal Region','desc'=>'SLF reaches 4,200+ people with free screenings and nutrition education.'],
  ['tag'=>'Update','tone'=>'yellow','date'=>'Apr 12, 2026','img'=>'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800','title'=>'Climate-Smart Farming Pilot Expanded','desc'=>'Smallholder farmer program scales to three new districts this season.'],
  ['tag'=>'Story','tone'=>'blue','date'=>'Mar 30, 2026','img'=>'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800','title'=>'How Women Savings Groups Transformed a Village','desc'=>'A look at the long-term impact of inclusive economic empowerment.'],
];
?>
<section class="section">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($items as $n): ?>
        <div class="col-md-4">
          <article class="card-ngo">
            <img src="<?= e($n['img']) ?>" alt="<?= e($n['title']) ?>">
            <div class="card-body">
              <span class="badge-pill-ngo <?= e($n['tone']) ?>"><?= e($n['tag']) ?></span>
              <div class="meta mt-2"><i class="bi bi-calendar3 me-1"></i><?= e($n['date']) ?></div>
              <h3 class="card-title"><?= e($n['title']) ?></h3>
              <p class="text-muted small mb-3"><?= e($n['desc']) ?></p>
              <a href="#" class="fw-semibold">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php include __DIR__ . '/partials/footer.php'; ?>
