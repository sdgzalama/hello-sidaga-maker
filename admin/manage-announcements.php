<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
$page_title = 'Manage Announcements';
include __DIR__ . '/partials/head.php';

$rows = [
  ['id'=>1,'title'=>'Office closed on May 5 for staff training','date'=>'2026-05-01','urgent'=>1,'status'=>'published'],
  ['id'=>2,'title'=>'Volunteer applications open for summer cohort','date'=>'2026-04-28','urgent'=>0,'status'=>'published'],
  ['id'=>3,'title'=>'Quarterly transparency report published','date'=>'2026-04-15','urgent'=>0,'status'=>'draft'],
];
?>

<div class="panel">
  <div class="panel-head">
    <h3>Announcements</h3>
    <button class="btn btn-primary-ngo" data-bs-toggle="modal" data-bs-target="#annModal"
      onclick="document.getElementById('annForm').reset();document.getElementById('annModalTitle').textContent='Add Announcement';">
      <i class="bi bi-plus-lg"></i> Add Announcement
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-ngo align-middle">
      <thead><tr><th>#</th><th>Title</th><th>Date</th><th>Urgent</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
      <?php foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($r['date']) ?></td>
          <td><?= $r['urgent'] ? '<span class="badge bg-danger">Urgent</span>' : '<span class="text-muted">No</span>' ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary" data-edit data-bs-toggle="modal" data-bs-target="#annModal"
              data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>" data-date="<?= e($r['date']) ?>"
              data-status="<?= e($r['status']) ?>"
              onclick="document.getElementById('annModalTitle').textContent='Edit Announcement';">
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

<div class="modal fade" id="annModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="annForm" class="modal-content" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="annModalTitle">Add Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="mb-3"><label class="form-label">Title</label>
          <input class="form-control" name="title" required></div>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Date</label>
            <input class="form-control" type="date" name="date"></div>
          <div class="col-md-6"><label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="draft">Draft</option><option value="published">Published</option>
            </select></div>
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="checkbox" name="urgent" id="urgent" value="1">
          <label class="form-check-label" for="urgent">Mark as urgent</label>
        </div>
        <div class="mb-3 mt-3"><label class="form-label">Message</label>
          <textarea class="form-control" name="message" rows="4"></textarea></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary-ngo">Save</button>
      </div>
    </form>
  </div>
</div>

<?php include __DIR__ . '/partials/foot.php'; ?>
