<?php

require_once __DIR__ . '/includes/environment.php';
require_once __DIR__ . '/proxy/config.php';
require_once __DIR__ . '/includes/cms-bootstrap.php';

$cms_page_slug = cmsResolveSlugFromPath('print-media-detail') ?? cmsResolveSlugFromPath('print-media') ?? 'print-media-page-jhansi';
require __DIR__ . '/includes/cms-dynamic-page.php';
