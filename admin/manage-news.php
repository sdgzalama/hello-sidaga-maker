<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/crud.php';
require_login();

$table = 'news';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        delete_row($table, (int)($_POST['id'] ?? 0));
    } else {
        $id = (int)($_POST['id'] ?? 0) ?: null;
        $img = handle_upload('image', 'news');
        $data = [
            'title'        => trim($_POST['title'] ?? ''),
            'slug'         => slugify($_POST['title'] ?? ''),
            'category'     => $_POST['category'] ?? null,
            'excerpt'      => $_POST['excerpt'] ?? null,
            'body'         => $_POST['content'] ?? null,
            'published_at' => !empty($_POST['date']) ? $_POST['date'] . ' 00:00:00' : null,
            'status'       => $_POST['status'] ?? 'draft',
        ];
        if ($img) $data['image'] = $img;
        save_row($table, $data, $id);
    }
    header('Location: manage-news.php'); exit;
}

$page_title = 'Manage News';
include __DIR__ . '/partials/head.php';
$rows = fetch_all($table);
?>

<?php render_flash(); ?>

<div class="panel">
  <div class="panel-head">
    <h3>News Articles</h3>
    <button class="btn btn-primary-ngo" data-bs-toggle="modal" data-bs-target="#newsModal" onclick="document.getElementById('newsForm').reset();document.getElementById('newsModalTitle').textContent='Add News';">
      <i class="bi bi-plus-lg"></i> Add News
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-ngo align-middle">
      <thead><tr><th>#</th><th>Title</th><th>Category</th><th>Date</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">No news yet. Click "Add News" to create one.</td></tr>
      <?php endif; foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($r['category']) ?></td>
          <td><?= e(!empty($r['published_at']) ? date('Y-m-d', strtotime($r['published_at'])) : '') ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary"
                    data-edit data-bs-toggle="modal" data-bs-target="#newsModal"
                    data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>"
                    data-category="<?= e($r['category']) ?>"
                    data-date="<?= e(!empty($r['published_at']) ? date('Y-m-d', strtotime($r['published_at'])) : '') ?>"
                    data-excerpt="<?= e($r['excerpt']) ?>"
                    data-content="<?= e($r['body']) ?>"
                    data-status="<?= e($r['status']) ?>"
                    onclick="document.getElementById('newsModalTitle').textContent='Edit News';">
              <i class="bi bi-pencil"></i>
            </button>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this item?');">
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

<div class="modal fade" id="newsModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="newsForm" class="modal-content" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="newsModalTitle">Add News</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <div class="mb-3"><label class="form-label">Title</label>
          <input class="form-control" name="title" required></div>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Category</label>
            <select class="form-select" name="category">
              <option>Health</option><option>Agriculture</option><option>Environment</option><option>Community</option><option>Safety</option><option>Education</option>
            </select></div>
          <div class="col-md-6"><label class="form-label">Date</label>
            <input class="form-control" type="date" name="date"></div>
        </div>
        <div class="mb-3 mt-3"><label class="form-label">Cover Image</label>
          <input class="form-control" type="file" name="image" accept="image/*"></div>
        <div class="mb-3"><label class="form-label">Excerpt</label>
          <textarea class="form-control" name="excerpt" rows="2"></textarea></div>
        <div class="mb-3"><label class="form-label">Content</label>
          <textarea class="form-control" name="content" rows="5"></textarea></div>
        <div class="mb-3"><label class="form-label">Status</label>
          <select class="form-select" name="status">
            <option value="draft">Draft</option><option value="published">Published</option>
          </select></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary-ngo">Save</button>
      </div>
    </form>
  </div>
</div>

<?php include __DIR__ . '/partials/foot.php'; ?>
