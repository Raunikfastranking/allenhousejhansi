<?php

require_once __DIR__ . '/config.php';

if (!function_exists('fetchApiData')) {
    function fetchApiData($endpoint)
    {
        $normalized = ltrim((string) $endpoint, '/');
        $normalized = preg_replace('/SCLID\d+/i', (string) BRANCH_ID, $normalized) ?? $normalized;
        $data = cms_fetch_json_endpoint($normalized);

        return is_array($data) ? $data : ['status' => 'error', 'data' => []];
    }
}
