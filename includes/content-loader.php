<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

if (!defined('EDS_ROOT')) {
    define('EDS_ROOT', dirname(__DIR__));
}

function eds_load_data(string $file, array $fallback = []): array {
    $file = ltrim($file, '/\\');
    $path = EDS_ROOT . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $file;

    if (!is_file($path)) {
        return $fallback;
    }

    $data = require $path;

    return is_array($data) ? $data : $fallback;
}

function eds_safe_text($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function eds_safe_url($value): string {
    $url = trim((string) $value);

    if ($url === '') {
        return '';
    }

    if (preg_match('/^(https?:\/\/|\/|#|mailto:|tel:)/i', $url) !== 1) {
        return '';
    }

    return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

function eds_filter_public_items(array $items): array {
    return array_values(array_filter($items, static function ($item): bool {
        if (!is_array($item)) {
            return false;
        }

        if (array_key_exists('is_active', $item)) {
            return (bool) $item['is_active'];
        }

        if (array_key_exists('can_publish', $item)) {
            return (bool) $item['can_publish'];
        }

        if (array_key_exists('status', $item)) {
            return in_array($item['status'], ['active', 'open', 'public'], true);
        }

        return true;
    }));
}

function eds_sort_by_order(array $items): array {
    usort($items, static function ($a, $b): int {
        return ((int) ($a['display_order'] ?? 999)) <=> ((int) ($b['display_order'] ?? 999));
    });

    return $items;
}

function eds_project_is_visible(array $project, string $visibilityField): bool {
    if (($project['can_publish'] ?? false) !== true) {
        return false;
    }

    if (($project['approval_status'] ?? '') !== 'public_approved') {
        return false;
    }

    if (array_key_exists($visibilityField, $project)) {
        return (bool) $project[$visibilityField];
    }

    return $visibilityField === 'show_on_projects';
}
