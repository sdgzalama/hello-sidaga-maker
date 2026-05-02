<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
$page_title = 'Manage Promotions';
include __DIR__ . '/partials/head.php';

$rows = [
  ['id'=>1,'title'=>'Match-the-Donation Week','start'=>'2026-05-10','end'=>'2026-05-17','status'=>'published'],
  ['id'=>2,'title'=>'Sponsor a Child','start'=>'2026-01-01','end'=>'2026-12-31','status'=>'published'],
  ['id'=>3,'title'=>'Corporate Volunteering','start'=>'2026-01-01','end'=>'2026-12-31','status'=>'draft'],
];
?>

<div class="panel">
  <div class="panel-head">
    <h3>Promotions</h3>
    <button class="btn btn-primary-ngo" data-bs-toggle="modal" data-bs-target="#promoModal"
      onclick="document.getElementById('promoForm').reset();document.getElementById('promoModalTitle').textContent='Add Promotion';">
      <i class="bi bi-plus-lg"></i> Add Promotion
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-ngo align-middle">
      <thead><tr><th>#</th><th>Title</th><th>Start</th><th>End</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
      <?php foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($r['start']) ?></td>
          <td><?= e($r['end']) ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary" data-edit data-bs-toggle="modal" data-bs-target="#promoModal"
              data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>"
              data-start="<?= e($r['start']) ?>" data-end="<?= e($r['end']) ?>" data-status="<?= e($r['status']) ?>"
              onclick="document.getElementById('promoModalTitle').textContent='Edit Promotion';">
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

<div class="modal fade" id="promoModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="promoForm" class="modal-content" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="promoModalTitle">Add Promotion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="mb-3"><label class="form-label">Title</label>
          <input class="form-control" name="title" required></div>
        <div class="row g-3">
          <div class="col-md-4"><label class="form-label">Start Date</label>
            <input class="form-control" type="date" name="start"></div>
          <div class="col-md-4"><label class="form-label">End Date</label>
            <input class="form-control" type="date" name="end"></div>
          <div class="col-md-4"><label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="draft">Draft</option><option value="published">Published</option>
            </select></div>
        </div>
        <div class="mb-3 mt-3"><label class="form-label">Banner Image</label>
          <input class="form-control" type="file" name="image"></div>
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
