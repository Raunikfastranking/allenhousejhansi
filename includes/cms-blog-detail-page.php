<?php

require_once __DIR__ . '/environment.php';
require_once dirname(__DIR__) . '/proxy/config.php';
require_once __DIR__ . '/apis.php';
require_once __DIR__ . '/cms-bootstrap.php';

$GLOBALS['cms_blog_detail_config'] = [
    'site_name' => 'Allenhouse Jhansi',
    'canonical_host' => 'https://allenhousejhansi.com',
    'includes_dir' => __DIR__,
];

require_once dirname(__DIR__) . '/shared/includes/cms-blog-detail.php';
