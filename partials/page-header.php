<?php
// Reusable page header for non-home public pages.
// Set $page_heading and optionally $page_crumb before include.
$page_heading = $page_heading ?? 'Page';
$page_crumb   = $page_crumb   ?? $page_heading;
?>
<section class="page-header">
  <div class="container">
    <div class="crumbs mb-2">
      <a href="<?= url('index.php') ?>">Home</a> <span class="mx-1">/</span> <?= e($page_crumb) ?>
    </div>
    <h1><?= e($page_heading) ?></h1>
  </div>
</section>
