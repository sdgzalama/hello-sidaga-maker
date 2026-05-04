<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/crud.php';
require_login();

$table = 'announcements';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        delete_row($table, (int)($_POST['id'] ?? 0));
    } else {
        $id = (int)($_POST['id'] ?? 0) ?: null;
        $body = trim($_POST['message'] ?? '');
        if (!empty($_POST['urgent'])) $body = "[URGENT] " . $body;
        $data = [
            'title'        => trim($_POST['title'] ?? ''),
            'body'         => $body,
            'published_at' => !empty($_POST['date']) ? $_POST['date'] . ' 00:00:00' : null,
            'status'       => $_POST['status'] ?? 'draft',
        ];
        save_row($table, $data, $id);
    }
    header('Location: manage-announcements.php'); exit;
}

$page_title = 'Manage Announcements';
include __DIR__ . '/partials/head.php';
$rows = fetch_all($table);
?>

<?php render_flash(); ?>

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
      <?php if (!$rows): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">No announcements yet.</td></tr>
      <?php endif; foreach ($rows as $i => $r): ?>
        <?php $urgent = strpos((string)$r['body'], '[URGENT]') === 0;
              $msg = $urgent ? trim(substr($r['body'], 8)) : (string)$r['body'];
              $d = !empty($r['published_at']) ? date('Y-m-d', strtotime($r['published_at'])) : ''; ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($d) ?></td>
          <td><?= $urgent ? '<span class="badge bg-danger">Urgent</span>' : '<span class="text-muted">No</span>' ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary" data-edit data-bs-toggle="modal" data-bs-target="#annModal"
              data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>" data-date="<?= e($d) ?>"
              data-message="<?= e($msg) ?>" data-urgent="<?= $urgent ? '1' : '' ?>"
              data-status="<?= e($r['status']) ?>"
              onclick="document.getElementById('annModalTitle').textContent='Edit Announcement';">
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
              <option value="published">Published</option>
              <option value="draft">Draft</option>
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
