<?php
/**
 * Basic server-side language layer.
 *
 * Current strategy:
 * - English remains canonical without a URL prefix.
 * - Secondary languages use URL prefixes: /pt, /nl, /fr.
 * - Page slugs stay unchanged for now to avoid breaking routing during phase 1.
 */

if (!defined('EDS_DEFAULT_LANG')) {
  define('EDS_DEFAULT_LANG', 'en');
}

if (!defined('EDS_LANG_COOKIE')) {
  define('EDS_LANG_COOKIE', 'eds_lang');
}

if (!function_exists('eds_supported_languages')) {
  function eds_supported_languages(): array {
    return [
      'en' => [
        'code' => 'en',
        'hreflang' => 'en',
        'label' => 'EN',
        'name' => 'English',
        'prefix' => '',
      ],
      'pt' => [
        'code' => 'pt',
        'hreflang' => 'pt',
        'label' => 'PT',
        'name' => 'Português',
        'prefix' => 'pt',
      ],
      'nl' => [
        'code' => 'nl',
        'hreflang' => 'nl',
        'label' => 'NL',
        'name' => 'Nederlands',
        'prefix' => 'nl',
      ],
      'fr' => [
        'code' => 'fr',
        'hreflang' => 'fr',
        'label' => 'FR',
        'name' => 'Français',
        'prefix' => 'fr',
      ],
    ];
  }
}

if (!function_exists('eds_i18n_path_no_query')) {
  function eds_i18n_path_no_query(): string {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $path = rtrim($path, '/');
    return $path === '' ? '/' : $path;
  }
}

if (!function_exists('eds_strip_base_url')) {
  function eds_strip_base_url(string $path): string {
    $base = defined('BASE_URL_NORM') ? BASE_URL_NORM : '';
    if ($base !== '' && strpos($path, $base) === 0) {
      $path = substr($path, strlen($base));
      $path = rtrim($path, '/');
      if ($path === '') {
        $path = '/';
      }
    }

    return $path;
  }
}

if (!function_exists('eds_detect_lang_from_path')) {
  function eds_detect_lang_from_path(?string $path = null): string {
    $path = eds_strip_base_url($path ?? eds_i18n_path_no_query());
    $segments = array_values(array_filter(explode('/', trim($path, '/'))));
    $first = strtolower($segments[0] ?? '');

    $languages = eds_supported_languages();
    if ($first !== '' && isset($languages[$first]) && $first !== EDS_DEFAULT_LANG) {
      return $first;
    }

    return EDS_DEFAULT_LANG;
  }
}

if (!function_exists('eds_path_without_lang')) {
  function eds_path_without_lang(?string $path = null): string {
    $path = eds_strip_base_url($path ?? eds_i18n_path_no_query());
    $segments = array_values(array_filter(explode('/', trim($path, '/'))));
    $first = strtolower($segments[0] ?? '');
    $languages = eds_supported_languages();

    if ($first !== '' && isset($languages[$first]) && $first !== EDS_DEFAULT_LANG) {
      array_shift($segments);
    }

    if (!$segments) {
      return '/';
    }

    return '/' . implode('/', $segments);
  }
}

if (!function_exists('eds_current_lang')) {
  function eds_current_lang(): string {
    static $lang = null;

    if ($lang !== null) {
      return $lang;
    }

    $lang = eds_detect_lang_from_path();
    return $lang;
  }
}

if (!function_exists('eds_lang_prefix')) {
  function eds_lang_prefix(?string $lang = null): string {
    $lang = $lang ?: eds_current_lang();
    $languages = eds_supported_languages();

    if (!isset($languages[$lang]) || $lang === EDS_DEFAULT_LANG) {
      return '';
    }

    return '/' . $languages[$lang]['prefix'];
  }
}

if (!function_exists('eds_url')) {
  function eds_url(string $path = '/', ?string $lang = null): string {
    $lang = $lang ?: eds_current_lang();
    $path = '/' . ltrim($path, '/');

    if ($path !== '/') {
      $path = rtrim($path, '/');
    }

    $base = defined('BASE_URL_NORM') ? BASE_URL_NORM : '';
    return $base . eds_lang_prefix($lang) . ($path === '/' ? '/' : $path);
  }
}

if (!function_exists('eds_switch_lang_url')) {
  function eds_switch_lang_url(string $lang): string {
    return eds_url(eds_path_without_lang(), $lang);
  }
}

if (!function_exists('eds_abs_url')) {
  function eds_abs_url(string $path): string {
    if ($path === '') {
      return '';
    }

    if (preg_match('/^https?:\/\//i', $path)) {
      return $path;
    }

    $siteUrl = defined('SITE_URL') ? SITE_URL : '';
    if ($siteUrl === '') {
      $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);
      $siteUrl = ($isHttps ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    }

    return rtrim($siteUrl, '/') . '/' . ltrim($path, '/');
  }
}

if (!function_exists('eds_load_translations')) {
  function eds_load_translations(string $lang): array {
    static $cache = [];

    if (isset($cache[$lang])) {
      return $cache[$lang];
    }

    $defaultFile = EDS_ROOT . '/lang/' . EDS_DEFAULT_LANG . '.php';
    $langFile = EDS_ROOT . '/lang/' . $lang . '.php';

    $defaultTranslations = is_file($defaultFile) ? require $defaultFile : [];
    $langTranslations = ($lang !== EDS_DEFAULT_LANG && is_file($langFile)) ? require $langFile : [];

    $cache[$lang] = array_replace($defaultTranslations, $langTranslations);
    return $cache[$lang];
  }
}

if (!function_exists('eds_t')) {
  function eds_t(string $key, array $replace = []): string {
    $translations = eds_load_translations(eds_current_lang());
    $value = $translations[$key] ?? $key;

    foreach ($replace as $token => $replacement) {
      $value = str_replace('{' . $token . '}', (string) $replacement, $value);
    }

    return $value;
  }
}

$edsCurrentLang = eds_current_lang();
