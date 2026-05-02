<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
$page_title = 'Dashboard';
include __DIR__ . '/partials/head.php';
?>

<div class="row g-3 mb-4">
  <div class="col-md-3 col-sm-6">
    <div class="stat-card"><div class="icon"><i class="bi bi-newspaper"></i></div>
      <div><div class="num">24</div><div class="lbl">News articles</div></div></div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card info"><div class="icon"><i class="bi bi-calendar-event"></i></div>
      <div><div class="num">8</div><div class="lbl">Upcoming events</div></div></div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card warn"><div class="icon"><i class="bi bi-megaphone"></i></div>
      <div><div class="num">5</div><div class="lbl">Announcements</div></div></div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card danger"><div class="icon"><i class="bi bi-gift"></i></div>
      <div><div class="num">3</div><div class="lbl">Active promotions</div></div></div>
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
          <tr><td>Free Health Camp in Riverbend</td><td>News</td><td>May 1, 2026</td><td><span class="status-pill published">Published</span></td></tr>
          <tr><td>Annual Charity Run</td><td>Event</td><td>May 15, 2026</td><td><span class="status-pill upcoming">Upcoming</span></td></tr>
          <tr><td>Office closed May 5</td><td>Announcement</td><td>May 1, 2026</td><td><span class="status-pill published">Published</span></td></tr>
          <tr><td>Match-the-Donation Week</td><td>Promotion</td><td>May 10, 2026</td><td><span class="status-pill draft">Draft</span></td></tr>
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
