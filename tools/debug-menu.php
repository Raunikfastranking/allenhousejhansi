<?php
require dirname(__DIR__) . '/proxy/config.php';
$m = cms_curl_get_json(CMS_API_URL . '/menus/branch/' . BRANCH_ID);
echo json_encode(array_keys($m ?? []), JSON_PRETTY_PRINT) . "\n";
$data = $m['data'] ?? [];
echo 'data count: ' . (is_array($data) ? count($data) : 0) . "\n";
if (is_array($data) && isset($data[0])) {
    echo 'first keys: ' . implode(',', array_keys($data[0])) . "\n";
}
