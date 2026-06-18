<?php
require_once __DIR__ . '/bootstrap.php';

$edsBreadcrumbItems = $edsBreadcrumbItems ?? [];

if (empty($edsBreadcrumbItems)) {
  $edsPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
  $edsPath = rtrim($edsPath, '/');
  $edsPath = $edsPath === '' ? '/' : $edsPath;
  $edsSegments = array_values(array_filter(explode('/', trim($edsPath, '/'))));

  $edsBreadcrumbItems[] = ['label' => 'Home', 'url' => '/'];
  $edsCurrentPath = '';

  foreach ($edsSegments as $edsSegment) {
    $edsSafeSegment = preg_replace('/[^a-z0-9-]/', '', strtolower($edsSegment));
    if ($edsSafeSegment === '') continue;

    $edsCurrentPath .= '/' . $edsSafeSegment;
    $edsBreadcrumbItems[] = [
      'label' => ucwords(str_replace('-', ' ', $edsSafeSegment)),
      'url' => $edsCurrentPath,
    ];
  }
}

if (count($edsBreadcrumbItems) > 1):
?>
  <nav class="eds-breadcrumbs" aria-label="Breadcrumb">
    <ol>
      <?php foreach ($edsBreadcrumbItems as $index => $item): ?>
        <?php $isLast = $index === count($edsBreadcrumbItems) - 1; ?>
        <li>
          <?php if ($isLast): ?>
            <span aria-current="page"><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
          <?php else: ?>
            <a href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></a>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ol>
  </nav>
<?php endif; ?>
