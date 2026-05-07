<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/crud.php';
require_once __DIR__ . '/../includes/resources.php';
require_login();

$table = 'resources';
$types = slf_resource_types();
$has_table = slf_resources_table_exists();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $has_table) {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        delete_row($table, (int)($_POST['id'] ?? 0));
    } else {
        $id = (int)($_POST['id'] ?? 0) ?: null;
        $title = trim($_POST['title'] ?? '');
        $type  = $_POST['type'] ?? 'download';
        if (!isset($types[$type])) $type = 'download';
        $slug = !empty($_POST['slug']) ? slugify($_POST['slug']) : slugify($title);

        $data = [
            'title'         => $title,
            'slug'          => $slug,
            'type'          => $type,
            'summary'       => trim($_POST['summary'] ?? '') ?: null,
            'body'          => $_POST['body'] ?? null,
            'years_covered' => trim($_POST['years_covered'] ?? '') ?: null,
            'status'        => ($_POST['status'] ?? 'draft') === 'published' ? 'published' : 'draft',
            'published_at'  => !empty($_POST['published_at']) ? $_POST['published_at'] : date('Y-m-d H:i:s'),
        ];
        $cover = handle_upload('cover_image', 'resources');
        if ($cover) $data['cover_image'] = $cover;
        $pdf = handle_pdf_upload('pdf_file', 'docs');
        if ($pdf) {
            $data['file_path'] = $pdf['path'];
            $data['file_size'] = $pdf['size'];
        }

        if (!$id && empty($data['file_path'])) {
            flash_set('error', 'Please attach a PDF file.');
        } elseif (empty($title)) {
            flash_set('error', 'Title is required.');
        } else {
            save_row($table, $data, $id);
        }
    }
    header('Location: manage-resources.php'); exit;
}

$page_title = 'Manage Resources';
include __DIR__ . '/partials/head.php';
$rows = $has_table ? fetch_all($table) : [];
?>

<?php render_flash(); ?>

<?php if (!$has_table): ?>
  <div class="alert alert-warning">
    <strong>Resources table not found.</strong> Run the additional migration in <code>database/schema.sql</code> (it now includes a <code>resources</code> table) on your database, then reload this page.
  </div>
<?php endif; ?>

<div class="panel">
  <div class="panel-head">
    <h3>Resources &amp; Documents</h3>
    <button class="btn btn-primary-ngo" data-bs-toggle="modal" data-bs-target="#resModal"
      onclick="document.getElementById('resForm').reset();document.getElementById('resId').value='';document.getElementById('resModalTitle').textContent='Add Resource';">
      <i class="bi bi-plus-lg"></i> Add Resource
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-ngo align-middle">
      <thead><tr><th>#</th><th>Title</th><th>Type</th><th>Years</th><th>Size</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?>
        <tr><td colspan="7" class="text-center text-muted py-4">No resources uploaded yet.</td></tr>
      <?php endif; foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><span class="badge-pill-ngo blue"><?= e($types[$r['type']]['label'] ?? $r['type']) ?></span></td>
          <td><?= e($r['years_covered'] ?? '') ?></td>
          <td><?= e(slf_fmt_filesize($r['file_size'] ?? 0)) ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <a href="<?= e(slf_resource_file_url($r)) ?>" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#resModal"
              onclick='openResEdit(<?= json_encode($r, JSON_HEX_APOS|JSON_HEX_QUOT) ?>)'>
              <i class="bi bi-pencil"></i>
            </button>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this resource?');">
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

<div class="modal fade" id="resModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="resForm" class="modal-content" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="resModalTitle">Add Resource</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="resId">
        <div class="row g-3">
          <div class="col-md-8"><label class="form-label">Title</label>
            <input class="form-control" name="title" id="resTitle" required></div>
          <div class="col-md-4"><label class="form-label">Type</label>
            <select class="form-select" name="type" id="resType">
              <?php foreach ($types as $k=>$m): ?>
                <option value="<?= e($k) ?>"><?= e($m['label']) ?></option>
              <?php endforeach; ?>
            </select></div>
          <div class="col-md-6"><label class="form-label">Slug <small class="text-muted">(optional, auto-generated)</small></label>
            <input class="form-control" name="slug" id="resSlug"></div>
          <div class="col-md-3"><label class="form-label">Years Covered</label>
            <input class="form-control" name="years_covered" id="resYears" placeholder="2025–2030"></div>
          <div class="col-md-3"><label class="form-label">Status</label>
            <select class="form-select" name="status" id="resStatus">
              <option value="draft">Draft</option>
              <option value="published">Published</option>
            </select></div>
          <div class="col-12"><label class="form-label">Summary</label>
            <textarea class="form-control" name="summary" id="resSummary" rows="2"></textarea></div>
          <div class="col-12"><label class="form-label">Body / About this document</label>
            <textarea class="form-control" name="body" id="resBody" rows="4"></textarea></div>
          <div class="col-md-6"><label class="form-label">PDF File <small class="text-muted">(max 20 MB)</small></label>
            <input class="form-control" type="file" name="pdf_file" accept="application/pdf"></div>
          <div class="col-md-6"><label class="form-label">Cover Image (optional)</label>
            <input class="form-control" type="file" name="cover_image" accept="image/*"></div>
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
function openResEdit(r) {
  document.getElementById('resModalTitle').textContent = 'Edit Resource';
  document.getElementById('resId').value      = r.id || '';
  document.getElementById('resTitle').value   = r.title || '';
  document.getElementById('resType').value    = r.type || 'download';
  document.getElementById('resSlug').value    = r.slug || '';
  document.getElementById('resYears').value   = r.years_covered || '';
  document.getElementById('resStatus').value  = r.status || 'draft';
  document.getElementById('resSummary').value = r.summary || '';
  document.getElementById('resBody').value    = r.body || '';
}
</script>

<?php include __DIR__ . '/partials/foot.php'; ?>
