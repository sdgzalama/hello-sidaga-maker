<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

$error = '';
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    $ok = false;
    $pdo = db();
    if ($pdo) {
        try {
            $st = $pdo->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
            $st->execute([$u]);
            $row = $st->fetch();
            if ($row && password_verify($p, $row['password_hash'])) $ok = true;
        } catch (Exception $e) { /* fall through */ }
    }
    // Fallback for fresh installs / UI demo
    if (!$ok && $u === 'admin' && $p === 'admin') $ok = true;
    if ($ok) {
        $_SESSION['admin_user'] = $u;
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Invalid credentials.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login &mdash; <?= e(SITE_NAME) ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= asset('css/admin.css') ?>" rel="stylesheet">
  <style>
    body { display:flex;align-items:center;justify-content:center;min-height:100vh;
      background:linear-gradient(135deg,#1f8a8a,#166b6b);}
    .login-card { background:#fff;border-radius:16px;padding:2.25rem;width:100%;max-width:400px;
      box-shadow:0 20px 50px -10px rgba(0,0,0,.25);}
    .login-card .brand { display:flex;align-items:center;gap:.6rem;font-weight:700;font-size:1.2rem;margin-bottom:1.5rem;}
    .login-card .brand-mark{width:38px;height:38px;border-radius:10px;background:#1f8a8a;color:#fff;
      display:inline-flex;align-items:center;justify-content:center;}
  </style>
</head>
<body>
  <div class="login-card">
    <div class="brand">
      <span class="brand-mark"><i class="bi bi-heart-pulse-fill"></i></span>
      <?= e(SITE_NAME) ?>
    </div>
    <h2 class="h4 mb-1">Welcome back</h2>
    <p class="text-muted small">Sign in to manage your content.</p>

    <?php if ($error): ?>
      <div class="alert alert-danger small"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label class="form-label small fw-semibold">Username</label>
        <input class="form-control" name="username" required autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label small fw-semibold">Password</label>
        <input class="form-control" type="password" name="password" required>
      </div>
      <button class="btn btn-primary-ngo w-100" type="submit">Sign in</button>
    </form>
    <p class="text-muted small mt-3 mb-0 text-center">Demo: admin / admin</p>
  </div>
</body>
</html>
