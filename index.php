<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Home';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';

// Sample data — replace with DB queries later
$news = [
  ['title'=>'Free Health Camp in Riverbend', 'date'=>'May 1, 2026', 'tag'=>'Health',    'img'=>'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800'],
  ['title'=>'Scholarships for 200 Students', 'date'=>'Apr 22, 2026', 'tag'=>'Education', 'img'=>'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800'],
  ['title'=>'Clean Water Project Launched',  'date'=>'Apr 10, 2026', 'tag'=>'Community','img'=>'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800'],
];
$events = [
  ['title'=>'Annual Charity Run',     'date'=>'May 15, 2026', 'place'=>'Central Park'],
  ['title'=>'Community Health Fair',  'date'=>'Jun 02, 2026', 'place'=>'Town Hall'],
  ['title'=>'Volunteer Orientation',  'date'=>'Jun 18, 2026', 'place'=>'HQ Office'],
];
?>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <span class="badge bg-light text-dark mb-3"><i class="bi bi-stars me-1"></i> Together we make change</span>
        <h1>Bringing care &amp; hope to communities that need it most</h1>
        <p>We mobilize volunteers, doctors, and partners to deliver healthcare, education, and emergency aid where it matters.</p>
        <div class="mt-4">
          <a href="#donate" class="btn btn-light-cta me-2"><i class="bi bi-heart-fill me-1"></i> Donate Now</a>
          <a href="<?= url('about.php') ?>" class="btn btn-outline-cta">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-6"><div class="stat"><div class="num">12K+</div><div class="lbl">Lives helped</div></div></div>
      <div class="col-md-3 col-6"><div class="stat"><div class="num">320</div><div class="lbl">Volunteers</div></div></div>
      <div class="col-md-3 col-6"><div class="stat"><div class="num">48</div><div class="lbl">Active projects</div></div></div>
      <div class="col-md-3 col-6"><div class="stat"><div class="num">15</div><div class="lbl">Years of service</div></div></div>
    </div>
  </div>
</section>

<!-- LATEST NEWS -->
<section class="section alt">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <h2 class="section-title">Latest News</h2>
        <p class="section-sub mb-0">Stories from the field and recent updates.</p>
      </div>
      <a href="<?= url('news.php') ?>" class="btn btn-primary-ngo d-none d-md-inline-block">View all</a>
    </div>
    <div class="row g-4">
      <?php foreach ($news as $n): ?>
        <div class="col-md-4">
          <article class="card-ngo">
            <img src="<?= e($n['img']) ?>" alt="<?= e($n['title']) ?>">
            <div class="card-body">
              <span class="badge-pill-ngo"><?= e($n['tag']) ?></span>
              <div class="meta mt-2"><i class="bi bi-calendar3 me-1"></i><?= e($n['date']) ?></div>
              <h3 class="card-title"><?= e($n['title']) ?></h3>
              <p class="text-muted small mb-3">A short summary of the news item goes here. Replace with content from the database.</p>
              <a href="<?= url('news.php') ?>" class="fw-semibold">Read more <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- UPCOMING EVENTS -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Upcoming Events</h2>
    <p class="section-sub">Join us, volunteer, or simply spread the word.</p>
    <div class="row g-4">
      <?php foreach ($events as $ev): ?>
        <div class="col-md-4">
          <div class="card-ngo p-4">
            <div class="d-flex align-items-center mb-2">
              <div class="me-3 text-center" style="background:#1f8a8a;color:#fff;border-radius:10px;padding:.6rem .8rem;">
                <div style="font-weight:700;font-size:1.1rem;line-height:1;"><?= e(date('d', strtotime($ev['date']))) ?></div>
                <div style="font-size:.7rem;text-transform:uppercase;"><?= e(date('M', strtotime($ev['date']))) ?></div>
              </div>
              <div>
                <h3 class="card-title mb-0"><?= e($ev['title']) ?></h3>
                <div class="meta"><i class="bi bi-geo-alt me-1"></i><?= e($ev['place']) ?></div>
              </div>
            </div>
            <a href="<?= url('events.php') ?>" class="fw-semibold">Event details <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section" id="donate">
  <div class="container">
    <div class="cta-strip d-md-flex justify-content-between align-items-center px-4 px-md-5">
      <div>
        <h3 class="mb-1">Your support changes lives</h3>
        <p class="mb-0 opacity-75">Every contribution funds clean water, vaccines, and education for children.</p>
      </div>
      <a href="#" class="btn btn-light btn-lg mt-3 mt-md-0 fw-semibold">Donate Now</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
