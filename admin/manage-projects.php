<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/crud.php';
require_login();

$table = 'projects';

// Detect table
$has_table = false;
$pdo = db();
if ($pdo) {
    try { $pdo->query("SELECT 1 FROM `projects` LIMIT 1"); $has_table = true; }
    catch (Exception $e) { $has_table = false; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $has_table) {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        delete_row($table, (int)($_POST['id'] ?? 0));
    } else {
        $id = (int)($_POST['id'] ?? 0) ?: null;
        $title = trim($_POST['title'] ?? '');
        $slug  = !empty($_POST['slug']) ? slugify($_POST['slug']) : slugify($title);
        $img = handle_upload('image', 'projects');
        $data = [
            'title'   => $title,
            'slug'    => $slug,
            'sector'  => trim($_POST['sector'] ?? '') ?: null,
            'summary' => trim($_POST['summary'] ?? '') ?: null,
            'body'    => $_POST['body'] ?? null,
            'status'  => in_array($_POST['status'] ?? 'draft', ['draft','active','completed']) ? $_POST['status'] : 'draft',
        ];
        if ($img) $data['image'] = $img;
        if (empty($title)) {
            flash_set('error', 'Title is required.');
        } else {
            save_row($table, $data, $id);
        }
    }
    header('Location: manage-projects.php'); exit;
}

$page_title = 'Manage Projects';
include __DIR__ . '/partials/head.php';
$rows = $has_table ? fetch_all($table) : [];
$sectors = ['Health','Agriculture','Environment','Community','Education','Water','Other'];
?>

<?php render_flash(); ?>

<?php if (!$has_table): ?>
  <div class="alert alert-warning">
    <strong>Projects table not found.</strong> Run <code>database/schema.sql</code> on your database, then reload.
  </div>
<?php endif; ?>

<div class="panel">
  <div class="panel-head">
    <h3>Projects &amp; Initiatives</h3>
    <button class="btn btn-primary-ngo" data-bs-toggle="modal" data-bs-target="#projModal"
      onclick="document.getElementById('projForm').reset();document.getElementById('projId').value='';document.getElementById('projModalTitle').textContent='Add Project';">
      <i class="bi bi-plus-lg"></i> Add Project
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-ngo align-middle">
      <thead><tr><th>#</th><th>Title</th><th>Sector</th><th>Status</th><th>Created</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">No projects yet. Click "Add Project" to create one.</td></tr>
      <?php endif; foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($r['sector'] ?? '') ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td><?= e(!empty($r['created_at']) ? date('Y-m-d', strtotime($r['created_at'])) : '') ?></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#projModal"
              onclick='openProjEdit(<?= json_encode($r, JSON_HEX_APOS|JSON_HEX_QUOT) ?>)'>
              <i class="bi bi-pencil"></i>
            </button>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this project?');">
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

<div class="modal fade" id="projModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="projForm" class="modal-content" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="projModalTitle">Add Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="projId">
        <div class="row g-3">
          <div class="col-md-8"><label class="form-label">Title</label>
            <input class="form-control" name="title" id="projTitle" required></div>
          <div class="col-md-4"><label class="form-label">Sector</label>
            <select class="form-select" name="sector" id="projSector">
              <option value="">— Select —</option>
              <?php foreach ($sectors as $s): ?><option><?= e($s) ?></option><?php endforeach; ?>
            </select></div>
          <div class="col-md-8"><label class="form-label">Slug <small class="text-muted">(optional)</small></label>
            <input class="form-control" name="slug" id="projSlug"></div>
          <div class="col-md-4"><label class="form-label">Status</label>
            <select class="form-select" name="status" id="projStatus">
              <option value="draft">Draft</option>
              <option value="active">Active</option>
              <option value="completed">Completed</option>
            </select></div>
          <div class="col-12"><label class="form-label">Summary <small class="text-muted">(short, ~25 words)</small></label>
            <textarea class="form-control" name="summary" id="projSummary" rows="2"></textarea></div>
          <div class="col-12"><label class="form-label">Full description</label>
            <textarea class="form-control" name="body" id="projBody" rows="6"></textarea></div>
          <div class="col-12"><label class="form-label">Cover image</label>
            <input class="form-control" type="file" name="image" accept="image/*"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary-ngo">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
function openProjEdit(r) {
  document.getElementById('projModalTitle').textContent = 'Edit Project';
  document.getElementById('projId').value      = r.id || '';
  document.getElementById('projTitle').value   = r.title || '';
  document.getElementById('projSector').value  = r.sector || '';
  document.getElementById('projSlug').value    = r.slug || '';
  document.getElementById('projStatus').value  = r.status || 'draft';
  document.getElementById('projSummary').value = r.summary || '';
  document.getElementById('projBody').value    = r.body || '';
}
</script>

<?php include __DIR__ . '/partials/foot.php'; ?>
