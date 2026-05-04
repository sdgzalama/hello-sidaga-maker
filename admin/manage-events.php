<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/crud.php';
require_login();

$table = 'events';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        delete_row($table, (int)($_POST['id'] ?? 0));
    } else {
        $id = (int)($_POST['id'] ?? 0) ?: null;
        $img = handle_upload('image', 'events');
        $start = (!empty($_POST['date']) ? $_POST['date'] . ' ' . (!empty($_POST['time']) ? $_POST['time'] . ':00' : '00:00:00') : null);
        $data = [
            'title'       => trim($_POST['title'] ?? ''),
            'slug'        => slugify($_POST['title'] ?? ''),
            'location'    => $_POST['place'] ?? null,
            'start_at'    => $start,
            'description' => $_POST['description'] ?? null,
            'status'      => $_POST['status'] ?? 'draft',
        ];
        if ($img) $data['image'] = $img;
        save_row($table, $data, $id);
    }
    header('Location: manage-events.php'); exit;
}

$page_title = 'Manage Events';
include __DIR__ . '/partials/head.php';
$rows = fetch_all($table, 'start_at DESC');
?>

<?php render_flash(); ?>

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
      <?php if (!$rows): ?>
        <tr><td colspan="7" class="text-center text-muted py-4">No events yet.</td></tr>
      <?php endif; foreach ($rows as $i => $r): ?>
        <?php $d = !empty($r['start_at']) ? date('Y-m-d', strtotime($r['start_at'])) : '';
              $t = !empty($r['start_at']) ? date('H:i', strtotime($r['start_at'])) : ''; ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($d) ?></td>
          <td><?= e($t) ?></td>
          <td><?= e($r['location']) ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary" data-edit data-bs-toggle="modal" data-bs-target="#eventModal"
              data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>" data-date="<?= e($d) ?>"
              data-time="<?= e($t) ?>" data-place="<?= e($r['location']) ?>"
              data-description="<?= e($r['description']) ?>" data-status="<?= e($r['status']) ?>"
              onclick="document.getElementById('eventModalTitle').textContent='Edit Event';">
              <i class="bi bi-pencil"></i>
            </button>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this event?');">
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
              <option value="published">Published</option>
              <option value="draft">Draft</option>
              <option value="cancelled">Cancelled</option>
            </select></div>
        </div>
        <div class="mb-3 mt-3"><label class="form-label">Location</label>
          <input class="form-control" name="place"></div>
        <div class="mb-3"><label class="form-label">Cover Image</label>
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
