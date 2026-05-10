<?php
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../includes/config.php';
}
$page_title       = $page_title ?? SITE_NAME;
$page_description = $page_description ?? (SITE_NAME . ' — ' . SITE_TAGLINE . '. A Tanzanian NGO promoting health, safety, sustainable agriculture, environment and inclusive empowerment.');
$page_og_image    = $page_og_image ?? asset('images/hero-1.jpg');
$page_robots      = $page_robots ?? 'index,follow';
$body_class       = $body_class ?? '';

$full_title = $page_title === SITE_NAME
    ? SITE_NAME . ' — ' . SITE_TAGLINE
    : $page_title . ' | ' . SITE_NAME;
$full_title = clip($full_title, 60);
$meta_desc  = clip($page_description, 158);
$canonical  = canonical_url();
$og_image   = (strpos($page_og_image, 'http') === 0) ? $page_og_image : (rtrim(SITE_URL, '/') . $page_og_image);

$org_jsonld = [
  '@context' => 'https://schema.org',
  '@type'    => 'NGO',
  'name'     => SITE_NAME,
  'alternateName' => SITE_SHORT,
  'url'      => SITE_URL,
  'logo'     => rtrim(SITE_URL, '/') . asset('images/logo.png'),
  'description' => SITE_TAGLINE,
  'address'  => ['@type' => 'PostalAddress', 'addressCountry' => 'TZ', 'addressRegion' => SITE_ADDRESS],
  'contactPoint' => [
    '@type' => 'ContactPoint',
    'contactType' => 'customer service',
    'email' => SITE_EMAIL,
    'telephone' => '+255656891338',
    'areaServed' => 'TZ',
  ],
  'sameAs' => [],
];
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($full_title) ?></title>
  <meta name="description" content="<?= e($meta_desc) ?>">
  <meta name="robots" content="<?= e($page_robots) ?>">
  <meta name="author" content="<?= e(SITE_NAME) ?>">
  <link rel="canonical" href="<?= e($canonical) ?>">

  <!-- Open Graph -->
  <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= e($full_title) ?>">
  <meta property="og:description" content="<?= e($meta_desc) ?>">
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:image" content="<?= e($og_image) ?>">
  <meta property="og:locale" content="en_US">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($full_title) ?>">
  <meta name="twitter:description" content="<?= e($meta_desc) ?>">
  <meta name="twitter:image" content="<?= e($og_image) ?>">

  <link rel="icon" href="<?= asset('images/logo.png') ?>" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= asset('css/style.css') ?>" rel="stylesheet">

  <script type="application/ld+json"><?= json_encode($org_jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
  <?php if (!empty($page_jsonld)): ?>
  <script type="application/ld+json"><?= json_encode($page_jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
  <?php endif; ?>
</head>
<body class="<?= e($body_class) ?>">
