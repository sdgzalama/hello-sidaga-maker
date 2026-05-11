<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
$page_title = 'Announcements';
$page_description = 'Official announcements from SustainLife Foundation, calls for proposals, partnerships, and program updates.';
$page_heading = 'Announcements';
$page_crumb = 'Announcements';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$items = [];
$pdo = db();
if ($pdo) {
    try { $items = $pdo->query("SELECT * FROM announcements WHERE status='published' ORDER BY published_at DESC")->fetchAll(); }
    catch (Exception $e) { $items = []; }
}
if (!$items) {
    $items = [
      ['title'=>'Office closed on May 5 for staff training','published_at'=>'2026-05-01','body'=>'[URGENT] '],
      ['title'=>'Volunteer applications open for summer cohort','published_at'=>'2026-04-28','body'=>''],
    ];
}
?>

<section class="section">
  <div class="container">
    <div class="row g-3">
      <?php foreach ($items as $it): ?>
        <?php $urgent = strpos((string)($it['body'] ?? ''), '[URGENT]') === 0;
              $date = !empty($it['published_at']) ? date('M j, Y', strtotime($it['published_at'])) : ''; ?>
        <div class="col-12">
          <div class="card-ngo p-3 d-flex flex-row align-items-center">
            <div class="me-3" style="font-size:1.6rem;color:<?= $urgent?'#ef4444':'var(--primary)' ?>;">
              <i class="bi <?= $urgent?'bi-exclamation-circle-fill':'bi-megaphone-fill' ?>"></i>
            </div>
            <div class="flex-grow-1">
              <h3 class="card-title mb-1"><?= e($it['title']) ?></h3>
              <div class="meta"><i class="bi bi-calendar3 me-1"></i><?= e($date) ?>
                <?php if ($urgent): ?><span class="badge bg-danger ms-2">Urgent</span><?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
