<?php

require dirname(__DIR__) . '/proxy/config.php';
require dirname(__DIR__) . '/includes/cms-bootstrap.php';

$menu = cms_curl_get_json(CMS_API_URL . '/menus/branch/' . BRANCH_ID);
$pages = cms_curl_get_json(CMS_API_URL . '/pages?branch_id=' . BRANCH_ID);
$byId = [];
foreach ($pages['data'] ?? [] as $p) {
    $byId[(string) $p['id']] = $p['slug'];
}

function walkMenu(array $items, array $byId, int $depth = 0): void
{
    foreach ($items as $item) {
        $url = trim($item['url'] ?? '', '/');
        $lid = (string) ($item['linkable_id'] ?? '');
        $name = $item['name'] ?? '';
        if ($url && $lid && str_contains($item['linkable_type'] ?? '', 'Page')) {
            $menuSlug = $byId[$lid] ?? '';
            $resolved = cmsResolveSlugFromPath($url) ?? '';
            $scriptSlug = function_exists('cmsJhansiSlugFromScript') ? cmsJhansiSlugFromScript(basename($url)) : '';
            echo str_repeat('  ', $depth) . "/{$url} => menu:{$menuSlug} resolved:{$resolved} script:{$scriptSlug}\n";
        }
        walkMenu($item['children'] ?? [], $byId, $depth + 1);
    }
}

$items = $menu['data'][0]['menu_items'] ?? $menu['data'] ?? [];
walkMenu(is_array($items) ? $items : [], $byId);
