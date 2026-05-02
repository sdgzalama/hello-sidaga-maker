<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Events';
$page_heading = 'Upcoming Events';
$page_crumb = 'Events';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$events = [
  ['title'=>'Annual Charity Run',     'date'=>'May 15, 2026', 'time'=>'7:00 AM', 'place'=>'Central Park',  'desc'=>'A 5K run to raise funds for childhood education programs.'],
  ['title'=>'Community Health Fair',  'date'=>'Jun 02, 2026', 'time'=>'9:00 AM', 'place'=>'Town Hall',     'desc'=>'Free check-ups, dental screenings, and nutrition counseling.'],
  ['title'=>'Volunteer Orientation',  'date'=>'Jun 18, 2026', 'time'=>'5:30 PM', 'place'=>'HQ Office',     'desc'=>'Learn how to join our volunteer corps and make an impact.'],
  ['title'=>'Back-to-School Drive',   'date'=>'Aug 05, 2026', 'time'=>'10:00 AM','place'=>'Riverbend School','desc'=>'Distributing school kits to 500 children in need.'],
];
?>

<section class="section">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($events as $ev): ?>
        <div class="col-md-6">
          <div class="card-ngo p-4 h-100">
            <div class="d-flex align-items-start">
              <div class="me-3 text-center" style="background:#1f8a8a;color:#fff;border-radius:12px;padding:.7rem 1rem;min-width:70px;">
                <div style="font-weight:700;font-size:1.3rem;line-height:1;"><?= e(date('d', strtotime($ev['date']))) ?></div>
                <div style="font-size:.75rem;text-transform:uppercase;"><?= e(date('M Y', strtotime($ev['date']))) ?></div>
              </div>
              <div class="flex-grow-1">
                <h3 class="card-title mb-1"><?= e($ev['title']) ?></h3>
                <div class="meta mb-2">
                  <span class="me-3"><i class="bi bi-clock me-1"></i><?= e($ev['time']) ?></span>
                  <span><i class="bi bi-geo-alt me-1"></i><?= e($ev['place']) ?></span>
                </div>
                <p class="text-muted mb-3"><?= e($ev['desc']) ?></p>
                <a href="#" class="btn btn-primary-ngo btn-sm">Register</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
