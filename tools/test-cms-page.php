<?php

declare(strict_types=1);

chdir(dirname(__DIR__));
$_GET['cms_path'] = $argv[1] ?? 'about-us';
$_SERVER['HTTP_HOST'] = 'allenhousejhansi.com';
$_SERVER['REQUEST_URI'] = '/' . $_GET['cms_path'];
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTPS'] = 'on';

error_reporting(E_ALL);
ini_set('display_errors', '1');

ob_start();
try {
    include 'cms-page.php';
    $out = ob_get_clean();
    echo 'OK bytes=' . strlen($out) . PHP_EOL;
} catch (Throwable $e) {
    ob_end_clean();
    echo 'FATAL: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(1);
}
