<?php
// Router for PHP built-in server (`php -S localhost:8000 router.php`).
// Mirrors the .htaccess rewrite rules so pretty URLs work locally.

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$path = rawurldecode($path);
$docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$file = $docRoot . $path;

// Serve real files and directories as-is.
if ($path !== '/' && (is_file($file) || is_dir($file))) {
    return false;
}

$path = rtrim($path, '/');
if ($path === '') {
    $path = '/';
}

// cms-dynamic-page.php resolves the CMS slug from SCRIPT_FILENAME,
// so point it at the script Apache would have executed.
$dispatch = static function (string $target): void {
    $_SERVER['SCRIPT_FILENAME'] = $target;
    $_SERVER['SCRIPT_NAME'] = '/' . basename($target);
    $_SERVER['PHP_SELF'] = '/' . basename($target);
    require $target;
};

// /proxy/name -> /proxy/name.php
if (preg_match('#^/proxy/([A-Za-z0-9_-]+)$#', $path, $m)) {
    $dispatch($docRoot . '/proxy/' . $m[1] . '.php');
    return true;
}

// /home -> index.php
if (preg_match('#^/home$#i', $path)) {
    $dispatch($docRoot . '/index.php');
    return true;
}

// /blog/slug -> cms-page.php?cms_path=blog/slug
if (preg_match('#^/blog/([A-Za-z0-9_-]+)$#i', $path, $m)) {
    $_GET['cms_path'] = 'blog/' . $m[1];
    $dispatch($docRoot . '/cms-page.php');
    return true;
}

// /view/slug -> detail-view.php?slug=slug
if (preg_match('#^/view/([A-Za-z0-9_-]+)$#i', $path, $m)) {
    $_GET['slug'] = $m[1];
    $dispatch($docRoot . '/detail-view.php');
    return true;
}

// /page -> /page.php when it exists
if (is_file($file . '.php')) {
    $dispatch($file . '.php');
    return true;
}

// Single-segment fallback -> cms-page.php?cms_path=seg
if (preg_match('#^/([A-Za-z0-9_-]+)$#', $path, $m)) {
    $_GET['cms_path'] = $m[1];
    $dispatch($docRoot . '/cms-page.php');
    return true;
}

// Everything else -> index.php
$dispatch($docRoot . '/index.php');
return true;
