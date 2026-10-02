<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/environment.php';
require_once __DIR__ . '/proxy/config.php';
require_once __DIR__ . '/includes/cms-bootstrap.php';

$cms_page_slug = cmsResolveSlugFromPath('innovation') ?? 'innovation-hub-page-jhansi';
$cms_page_title_fallback = 'Innovation Hub';
require __DIR__ . '/includes/cms-dynamic-page.php';
