<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
$page_title = 'Manage Events';
include __DIR__ . '/partials/head.php';

$rows = [
  ['id'=>1,'title'=>'Annual Charity Run','date'=>'2026-05-15','time'=>'07:00','place'=>'Central Park','status'=>'upcoming'],
  ['id'=>2,'title'=>'Community Health Fair','date'=>'2026-06-02','time'=>'09:00','place'=>'Town Hall','status'=>'upcoming'],
  ['id'=>3,'title'=>'Volunteer Orientation','date'=>'2026-06-18','time'=>'17:30','place'=>'HQ Office','status'=>'draft'],
];
?>

<div class="panel">
  <div class="panel-head">
    <h3>Events</h3>
    <button class="btn btn-primary-ngo" data-bs-toggle="modal" data-bs-target="#eventModal"
      onclick="document.getElementById('eventForm').reset();document.getElementById('eventModalTitle').textContent='Add Event';">
      <i class="bi bi-plus-lg"></i> Add Event
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-ngo align-middle">
      <thead><tr><th>#</th><th>Title</th><th>Date</th><th>Time</th><th>Location</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
      <?php foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($r['date']) ?></td>
          <td><?= e($r['time']) ?></td>
          <td><?= e($r['place']) ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary" data-edit data-bs-toggle="modal" data-bs-target="#eventModal"
              data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>" data-date="<?= e($r['date']) ?>"
              data-time="<?= e($r['time']) ?>" data-place="<?= e($r['place']) ?>" data-status="<?= e($r['status']) ?>"
              onclick="document.getElementById('eventModalTitle').textContent='Edit Event';">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="eventModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="eventForm" class="modal-content" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="eventModalTitle">Add Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="mb-3"><label class="form-label">Title</label>
          <input class="form-control" name="title" required></div>
        <div class="row g-3">
          <div class="col-md-4"><label class="form-label">Date</label>
            <input class="form-control" type="date" name="date"></div>
          <div class="col-md-4"><label class="form-label">Time</label>
            <input class="form-control" type="time" name="time"></div>
          <div class="col-md-4"><label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="upcoming">Upcoming</option><option value="draft">Draft</option>
            </select></div>
        </div>
        <div class="mb-3 mt-3"><label class="form-label">Location</label>
          <input class="form-control" name="place"></div>
        <div class="mb-3"><label class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="4"></textarea></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary-ngo">Save</button>
      </div>
    </form>
  </div>
</div>

<?php include __DIR__ . '/partials/foot.php'; ?>
