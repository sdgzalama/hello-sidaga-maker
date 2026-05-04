<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
$page_title = 'Events';
$page_heading = 'Upcoming Events';
$page_crumb = 'Events';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$events = [];
$pdo = db();
if ($pdo) {
    try { $events = $pdo->query("SELECT * FROM events WHERE status='published' ORDER BY start_at ASC")->fetchAll(); }
    catch (Exception $e) { $events = []; }
}
if (!$events) {
    $events = [
      ['title'=>'Annual Charity Run','start_at'=>'2026-05-15 07:00:00','location'=>'Central Park','description'=>'A 5K run to raise funds for childhood education programs.'],
      ['title'=>'Community Health Fair','start_at'=>'2026-06-02 09:00:00','location'=>'Town Hall','description'=>'Free check-ups, dental screenings, and nutrition counseling.'],
    ];
}
?>

<section class="section">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($events as $ev): ?>
        <?php $ts = !empty($ev['start_at']) ? strtotime($ev['start_at']) : null; ?>
        <div class="col-md-6">
          <div class="card-ngo p-4 h-100">
            <div class="d-flex align-items-start">
              <div class="me-3 text-center" style="background:#1f8a8a;color:#fff;border-radius:12px;padding:.7rem 1rem;min-width:70px;">
                <div style="font-weight:700;font-size:1.3rem;line-height:1;"><?= e($ts ? date('d', $ts) : '--') ?></div>
                <div style="font-size:.75rem;text-transform:uppercase;"><?= e($ts ? date('M Y', $ts) : '') ?></div>
              </div>
              <div class="flex-grow-1">
                <h3 class="card-title mb-1"><?= e($ev['title']) ?></h3>
                <div class="meta mb-2">
                  <span class="me-3"><i class="bi bi-clock me-1"></i><?= e($ts ? date('g:i A', $ts) : '') ?></span>
                  <span><i class="bi bi-geo-alt me-1"></i><?= e($ev['location'] ?? '') ?></span>
                </div>
                <p class="text-muted mb-3"><?= e($ev['description'] ?? '') ?></p>
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
