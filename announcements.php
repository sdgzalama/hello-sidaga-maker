<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'Announcements';
$page_heading = 'Announcements';
$page_crumb = 'Announcements';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$items = [
  ['title'=>'Office closed on May 5 for staff training', 'date'=>'May 1, 2026', 'urgent'=>true],
  ['title'=>'Volunteer applications open for summer cohort', 'date'=>'Apr 28, 2026', 'urgent'=>false],
  ['title'=>'Quarterly transparency report published', 'date'=>'Apr 15, 2026', 'urgent'=>false],
  ['title'=>'New partnership with City Hospital', 'date'=>'Apr 02, 2026', 'urgent'=>false],
];
?>

<section class="section">
  <div class="container">
    <div class="row g-3">
      <?php foreach ($items as $it): ?>
        <div class="col-12">
          <div class="card-ngo p-3 d-flex flex-row align-items-center">
            <div class="me-3" style="font-size:1.6rem;color:<?= $it['urgent']?'#ef4444':'var(--primary)' ?>;">
              <i class="bi <?= $it['urgent']?'bi-exclamation-circle-fill':'bi-megaphone-fill' ?>"></i>
            </div>
            <div class="flex-grow-1">
              <h3 class="card-title mb-1"><?= e($it['title']) ?></h3>
              <div class="meta"><i class="bi bi-calendar3 me-1"></i><?= e($it['date']) ?>
                <?php if ($it['urgent']): ?><span class="badge bg-danger ms-2">Urgent</span><?php endif; ?>
              </div>
            </div>
            <a href="#" class="btn btn-outline-secondary btn-sm">Details</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
