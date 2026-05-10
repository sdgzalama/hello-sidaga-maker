<?php
require_once __DIR__ . '/includes/config.php';
header('Content-Type: application/xml; charset=utf-8');

$pages = [
  ['index.php', '1.0', 'weekly'],
  ['about.php', '0.9', 'monthly'],
  ['services.php', '0.9', 'monthly'],
  ['consultancy.php', '0.9', 'monthly'],
  ['projects.php', '0.8', 'weekly'],
  ['impact.php', '0.7', 'monthly'],
  ['resources.php', '0.7', 'weekly'],
  ['strategic-plan.php', '0.6', 'yearly'],
  ['faq.php', '0.5', 'monthly'],
  ['news.php', '0.8', 'weekly'],
  ['events.php', '0.7', 'weekly'],
  ['announcements.php', '0.6', 'weekly'],
  ['campaigns.php', '0.6', 'weekly'],
  ['promotions.php', '0.5', 'weekly'],
  ['content.php', '0.5', 'monthly'],
  ['contact.php', '0.7', 'yearly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($pages as $p) {
  $path = __DIR__ . '/' . $p[0];
  $lastmod = file_exists($path) ? date('Y-m-d', filemtime($path)) : date('Y-m-d');
  $loc = rtrim(SITE_URL, '/') . '/' . $p[0];
  echo "  <url>\n";
  echo "    <loc>" . htmlspecialchars($loc) . "</loc>\n";
  echo "    <lastmod>$lastmod</lastmod>\n";
  echo "    <changefreq>{$p[2]}</changefreq>\n";
  echo "    <priority>{$p[1]}</priority>\n";
  echo "  </url>\n";
}
echo '</urlset>';
