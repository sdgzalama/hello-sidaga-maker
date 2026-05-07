<?php
// Legacy URL — Promotions has been renamed to Campaigns (more NGO-appropriate).
require_once __DIR__ . '/includes/config.php';
header('Location: ' . url('campaigns.php'), true, 301);
exit;
