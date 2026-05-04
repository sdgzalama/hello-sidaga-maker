<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/crud.php';
require_login();

$table = 'promotions';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        delete_row($table, (int)($_POST['id'] ?? 0));
    } else {
        $id = (int)($_POST['id'] ?? 0) ?: null;
        $img = handle_upload('image', 'promotions');
        $status = $_POST['status'] ?? 'draft';
        if ($status === 'published') $status = 'active';
        $data = [
            'title'     => trim($_POST['title'] ?? ''),
            'body'      => $_POST['description'] ?? null,
            'starts_on' => !empty($_POST['start']) ? $_POST['start'] : null,
            'ends_on'   => !empty($_POST['end']) ? $_POST['end'] : null,
            'status'    => $status,
        ];
        if ($img) $data['image'] = $img;
        save_row($table, $data, $id);
    }
    header('Location: manage-promotions.php'); exit;
}

$page_title = 'Manage Promotions';
include __DIR__ . '/partials/head.php';
$rows = fetch_all($table);
?>

<?php render_flash(); ?>

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
      <?php if (!$rows): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">No promotions yet.</td></tr>
      <?php endif; foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($r['starts_on']) ?></td>
          <td><?= e($r['ends_on']) ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary" data-edit data-bs-toggle="modal" data-bs-target="#promoModal"
              data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>"
              data-start="<?= e($r['starts_on']) ?>" data-end="<?= e($r['ends_on']) ?>"
              data-description="<?= e($r['body']) ?>" data-status="<?= e($r['status']) ?>"
              onclick="document.getElementById('promoModalTitle').textContent='Edit Promotion';">
              <i class="bi bi-pencil"></i>
            </button>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete?');">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= e($r['id']) ?>">
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
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
              <option value="active">Active</option>
              <option value="draft">Draft</option>
              <option value="expired">Expired</option>
            </select></div>
        </div>
        <div class="mb-3 mt-3"><label class="form-label">Banner Image</label>
          <input class="form-control" type="file" name="image" accept="image/*"></div>
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
