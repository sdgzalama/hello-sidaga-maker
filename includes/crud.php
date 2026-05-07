<?php
// Generic CRUD helpers backed by PDO. Pages degrade gracefully if DB is down.
require_once __DIR__ . '/db.php';

function flash_set($type, $msg) {
    $_SESSION['flash'][] = ['type' => $type, 'msg' => $msg];
}
function flash_pull() {
    $f = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $f;
}
function render_flash() {
    foreach (flash_pull() as $f) {
        $cls = $f['type'] === 'error' ? 'danger' : ($f['type'] === 'success' ? 'success' : 'info');
        echo '<div class="alert alert-' . $cls . ' alert-dismissible fade show" role="alert">'
           . e($f['msg'])
           . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
    }
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT//IGNORE', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    return $text ?: 'item-' . uniqid();
}

function table_columns($table) {
    static $cache = [];
    if (isset($cache[$table])) return $cache[$table];
    $pdo = db();
    if (!$pdo) return $cache[$table] = [];
    try {
        $cols = [];
        foreach ($pdo->query("DESCRIBE `$table`") as $row) {
            $cols[] = $row['Field'];
        }
        return $cache[$table] = $cols;
    } catch (Exception $e) { return $cache[$table] = []; }
}

function fetch_all($table, $orderBy = 'id DESC', $where = '') {
    $pdo = db();
    if (!$pdo) return [];
    try {
        $sql = "SELECT * FROM `$table`" . ($where ? " WHERE $where" : "") . " ORDER BY $orderBy";
        return $pdo->query($sql)->fetchAll();
    } catch (Exception $e) { return []; }
}

function fetch_one($table, $id) {
    $pdo = db();
    if (!$pdo) return null;
    try {
        $st = $pdo->prepare("SELECT * FROM `$table` WHERE id = ? LIMIT 1");
        $st->execute([$id]);
        return $st->fetch() ?: null;
    } catch (Exception $e) { return null; }
}

function save_row($table, array $data, $id = null) {
    $pdo = db();
    if (!$pdo) { flash_set('error', 'Database not connected. Import database/schema.sql and update credentials in includes/config.php.'); return false; }
    $cols = table_columns($table);
    $data = array_intersect_key($data, array_flip($cols));
    if (empty($data)) { flash_set('error', 'Nothing to save.'); return false; }
    try {
        if ($id) {
            $set = implode(',', array_map(fn($k) => "`$k` = :$k", array_keys($data)));
            $data['id'] = $id;
            $pdo->prepare("UPDATE `$table` SET $set WHERE id = :id")->execute($data);
            flash_set('success', 'Updated successfully.');
        } else {
            $keys = array_keys($data);
            $sql = "INSERT INTO `$table` (`" . implode('`,`', $keys) . "`) VALUES (:" . implode(',:', $keys) . ")";
            $pdo->prepare($sql)->execute($data);
            flash_set('success', 'Created successfully.');
        }
        return true;
    } catch (Exception $e) {
        flash_set('error', 'Save failed: ' . $e->getMessage());
        return false;
    }
}

function delete_row($table, $id) {
    $pdo = db();
    if (!$pdo) { flash_set('error', 'Database not connected.'); return false; }
    try {
        $pdo->prepare("DELETE FROM `$table` WHERE id = ?")->execute([$id]);
        flash_set('success', 'Deleted.');
        return true;
    } catch (Exception $e) {
        flash_set('error', 'Delete failed: ' . $e->getMessage());
        return false;
    }
}

function handle_upload($field, $subdir = 'uploads') {
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) return null;
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) { flash_set('error', 'Upload failed.'); return null; }
    $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) { flash_set('error', 'Unsupported image format.'); return null; }
    $dir = __DIR__ . '/../assets/images/' . $subdir;
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    $name = uniqid($subdir . '_') . '.' . $ext;
    $dest = $dir . '/' . $name;
    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $dest)) { flash_set('error', 'Could not save file.'); return null; }
    return 'assets/images/' . $subdir . '/' . $name;
}

function handle_pdf_upload($field, $subdir = 'docs') {
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) return null;
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) { flash_set('error', 'PDF upload failed.'); return null; }
    $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
    if ($ext !== 'pdf') { flash_set('error', 'Only PDF files are allowed.'); return null; }
    if ($_FILES[$field]['size'] > 20 * 1024 * 1024) { flash_set('error', 'PDF must be under 20 MB.'); return null; }
    $dir = __DIR__ . '/../assets/' . $subdir;
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    $base = preg_replace('/[^A-Za-z0-9_-]+/', '-', pathinfo($_FILES[$field]['name'], PATHINFO_FILENAME));
    $name = substr($base, 0, 60) . '_' . uniqid() . '.pdf';
    $dest = $dir . '/' . $name;
    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $dest)) { flash_set('error', 'Could not save PDF.'); return null; }
    return [
        'path' => 'assets/' . $subdir . '/' . $name,
        'size' => filesize($dest),
    ];
}
