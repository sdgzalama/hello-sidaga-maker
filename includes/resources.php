<?php
// Resources helper, works whether or not the `resources` table has been created yet.
require_once __DIR__ . '/db.php';

function slf_resource_types() {
    return [
        'strategic-plan' => ['label' => 'Strategic Plan',  'icon' => 'bi-bullseye',         'tone' => 'blue'],
        'annual-report'  => ['label' => 'Annual Report',   'icon' => 'bi-journal-bookmark', 'tone' => 'green'],
        'publication'    => ['label' => 'Publication',     'icon' => 'bi-book',             'tone' => 'blue'],
        'policy'         => ['label' => 'Policy',          'icon' => 'bi-shield-check',     'tone' => 'yellow'],
        'download'       => ['label' => 'Download',        'icon' => 'bi-download',         'tone' => ''],
    ];
}

function slf_resources_table_exists() {
    $pdo = db();
    if (!$pdo) return false;
    static $exists = null;
    if ($exists !== null) return $exists;
    try {
        $pdo->query("SELECT 1 FROM `resources` LIMIT 1");
        return $exists = true;
    } catch (Exception $e) {
        return $exists = false;
    }
}

function slf_fetch_resources($type = null, $publishedOnly = true) {
    if (!slf_resources_table_exists()) return [];
    $pdo = db();
    $sql = "SELECT * FROM `resources` WHERE 1=1";
    $params = [];
    if ($publishedOnly) $sql .= " AND status='published'";
    if ($type)         { $sql .= " AND type = ?"; $params[] = $type; }
    $sql .= " ORDER BY COALESCE(published_at, created_at) DESC";
    try {
        $st = $pdo->prepare($sql);
        $st->execute($params);
        return $st->fetchAll();
    } catch (Exception $e) { return []; }
}

function slf_fetch_resource($slug) {
    if (!slf_resources_table_exists()) return null;
    $pdo = db();
    try {
        $st = $pdo->prepare("SELECT * FROM `resources` WHERE slug = ? LIMIT 1");
        $st->execute([$slug]);
        return $st->fetch() ?: null;
    } catch (Exception $e) { return null; }
}

function slf_fmt_filesize($bytes) {
    if (!$bytes) return '';
    $units = ['B','KB','MB','GB'];
    $i = 0; $b = (float)$bytes;
    while ($b >= 1024 && $i < count($units)-1) { $b /= 1024; $i++; }
    return number_format($b, $b < 10 && $i > 0 ? 1 : 0) . ' ' . $units[$i];
}

function slf_related_resources($type, $excludeId, $limit = 4) {
    if (!slf_resources_table_exists()) return [];
    $pdo = db();
    try {
        $st = $pdo->prepare("SELECT id, title, slug, type, years_covered FROM `resources`
            WHERE status='published' AND type = ? AND id <> ? ORDER BY COALESCE(published_at, created_at) DESC LIMIT " . (int)$limit);
        $st->execute([$type, (int)$excludeId]);
        return $st->fetchAll();
    } catch (Exception $e) { return []; }
}

function slf_resource_file_url($res) {
    $p = $res['file_path'] ?? '';
    if (!$p) return '';
    if (preg_match('~^https?://~', $p)) return $p;
    if (str_starts_with($p, 'assets/')) return url($p);
    return url('assets/docs/' . ltrim($p, '/'));
}
