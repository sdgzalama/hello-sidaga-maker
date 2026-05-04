<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/crud.php';
require_login();
$page_title = 'Dashboard';
include __DIR__ . '/partials/head.php';

function tcount($t) {
    $pdo = db(); if (!$pdo) return 0;
    try { return (int)$pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn(); } catch (Exception $e) { return 0; }
}
$cNews = tcount('news');
$cEvents = tcount('events');
$cAnn = tcount('announcements');
$cPromo = tcount('promotions');

$recent = [];
foreach (['news'=>'News','events'=>'Event','announcements'=>'Announcement','promotions'=>'Promotion'] as $tbl => $label) {
    foreach (fetch_all($tbl, 'id DESC') as $r) {
        $recent[] = [
            'title' => $r['title'] ?? '',
            'type'  => $label,
            'date'  => $r['published_at'] ?? $r['start_at'] ?? $r['starts_on'] ?? $r['created_at'] ?? '',
            'status'=> $r['status'] ?? '',
        ];
    }
}
usort($recent, fn($a,$b) => strcmp((string)$b['date'], (string)$a['date']));
$recent = array_slice($recent, 0, 8);
?>

<?php render_flash(); ?>

<div class="row g-3 mb-4">
  <div class="col-md-3 col-sm-6">
    <div class="stat-card"><div class="icon"><i class="bi bi-newspaper"></i></div>
      <div><div class="num"><?= $cNews ?></div><div class="lbl">News articles</div></div></div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card info"><div class="icon"><i class="bi bi-calendar-event"></i></div>
      <div><div class="num"><?= $cEvents ?></div><div class="lbl">Events</div></div></div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card warn"><div class="icon"><i class="bi bi-megaphone"></i></div>
      <div><div class="num"><?= $cAnn ?></div><div class="lbl">Announcements</div></div></div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card danger"><div class="icon"><i class="bi bi-gift"></i></div>
      <div><div class="num"><?= $cPromo ?></div><div class="lbl">Promotions</div></div></div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-8">
    <div class="panel">
      <div class="panel-head">
        <h3>Recent Activity</h3>
        <a href="manage-news.php" class="btn btn-sm btn-primary-ngo">Manage News</a>
      </div>
      <table class="table table-ngo align-middle">
        <thead><tr><th>Item</th><th>Type</th><th>Date</th><th>Status</th></tr></thead>
        <tbody>
        <?php if (!$recent): ?>
          <tr><td colspan="4" class="text-center text-muted py-4">No content yet. Use the buttons on the right to add content, or import <code>database/schema.sql</code> if your database isn't connected.</td></tr>
        <?php endif; foreach ($recent as $r): ?>
          <tr>
            <td><?= e($r['title']) ?></td>
            <td><?= e($r['type']) ?></td>
            <td><?= e($r['date'] ? date('M j, Y', strtotime($r['date'])) : '') ?></td>
            <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="panel">
      <div class="panel-head"><h3>Quick Actions</h3></div>
      <div class="d-grid gap-2">
        <a class="btn btn-primary-ngo" href="manage-news.php"><i class="bi bi-plus-lg me-1"></i> Add News</a>
        <a class="btn btn-outline-secondary" href="manage-events.php"><i class="bi bi-plus-lg me-1"></i> Add Event</a>
        <a class="btn btn-outline-secondary" href="manage-announcements.php"><i class="bi bi-plus-lg me-1"></i> Add Announcement</a>
        <a class="btn btn-outline-secondary" href="manage-promotions.php"><i class="bi bi-plus-lg me-1"></i> Add Promotion</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/partials/foot.php'; ?>
