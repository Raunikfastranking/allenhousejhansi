<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/environment.php';
require_once __DIR__ . '/proxy/config.php';
require_once __DIR__ . '/includes/cms-bootstrap.php';

$cms_page_slug = cmsResolveSlugFromPath('images') ?? cmsResolveSlugFromPath('photo-gallery') ?? 'photo-gallery-page-jhansi';
$cms_page_title_fallback = 'Photo Gallery';
require __DIR__ . '/includes/cms-dynamic-page.php';
