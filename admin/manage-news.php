<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
$page_title = 'Manage News';
include __DIR__ . '/partials/head.php';

$rows = [
  ['id'=>1,'title'=>'Free Health Camp in Riverbend','category'=>'Health','date'=>'2026-05-01','status'=>'published'],
  ['id'=>2,'title'=>'Scholarships for 200 Students','category'=>'Education','date'=>'2026-04-22','status'=>'published'],
  ['id'=>3,'title'=>'Clean Water Project Launched','category'=>'Community','date'=>'2026-04-10','status'=>'draft'],
];
?>

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
      <?php foreach ($rows as $i => $r): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= e($r['title']) ?></td>
          <td><?= e($r['category']) ?></td>
          <td><?= e($r['date']) ?></td>
          <td><span class="status-pill <?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="actions text-end">
            <button class="btn btn-sm btn-outline-secondary"
                    data-edit data-bs-toggle="modal" data-bs-target="#newsModal"
                    data-id="<?= e($r['id']) ?>" data-title="<?= e($r['title']) ?>"
                    data-category="<?= e($r['category']) ?>" data-date="<?= e($r['date']) ?>"
                    data-status="<?= e($r['status']) ?>"
                    onclick="document.getElementById('newsModalTitle').textContent='Edit News';">
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

<!-- Modal -->
<div class="modal fade" id="newsModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="newsForm" class="modal-content" method="post" enctype="multipart/form-data" action="">
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
              <option>Health</option><option>Education</option><option>Community</option>
            </select></div>
          <div class="col-md-6"><label class="form-label">Date</label>
            <input class="form-control" type="date" name="date"></div>
        </div>
        <div class="mb-3 mt-3"><label class="form-label">Cover Image</label>
          <input class="form-control" type="file" name="image"></div>
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
