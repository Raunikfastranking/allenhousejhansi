<?php

declare(strict_types=1);

/**
 * Legacy IIS / Nginx fallback — some vhosts rewrite to page-template.php?page=...
 * Forward to the CMS page router (same as .htaccess → cms-page.php?cms_path=).
 */
$path = trim((string) ($_GET['page'] ?? $_GET['cms_path'] ?? ''), '/');
if ($path !== '') {
    $_GET['cms_path'] = $path;
}

require __DIR__ . '/cms-page.php';
