<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

if (!isset($case) || !is_array($case)) {
    return;
}

$isPreview = $isPreview ?? false;
$outcomeFrameworkById = $outcomeFrameworkById ?? [];

if (!function_exists('eds_case_card_text')) {
    function eds_case_card_text($value): string {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('eds_case_card_image_path')) {
    function eds_case_card_image_path($path): string {
        if (!is_string($path) || trim($path) === '') {
            return '';
        }

        $path = trim($path);
        $relativePath = str_starts_with($path, '/') ? $path : '/' . $path;
        $filesystemPath = dirname(__DIR__) . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

        return file_exists($filesystemPath) ? $relativePath : '';
    }
}

if (!function_exists('eds_case_card_metric_label')) {
    function eds_case_card_metric_label(string $key): string {
        $labels = [
            'weight_before' => 'Weight before',
            'weight_after' => 'Weight after',
            'weight_reduction_percent' => 'Weight reduction',
            'cost_reduction_percent' => 'Cost reduction',
            'stress_optimization_percent' => 'Stress optimization',
            'deadline_weeks' => 'Project window',
            'assembly_improvement' => 'Assembly improvement',
        ];

        return $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
    }
}

if (!function_exists('eds_case_card_metric_value')) {
    function eds_case_card_metric_value(string $key, $value): string {
        if ($value === '' || $value === null) {
            return '';
        }

        if (in_array($key, ['weight_reduction_percent', 'cost_reduction_percent', 'stress_optimization_percent'], true)) {
            return (string) $value . '%';
        }

        if ($key === 'deadline_weeks') {
            return (string) $value . ' weeks';
        }

        return (string) $value;
    }
}

if (!function_exists('eds_case_card_metrics_confirmed')) {
    function eds_case_card_metrics_confirmed(array $case): bool {
        $note = strtolower((string) ($case['metric_publication_note'] ?? ''));
        $approvalNote = strtolower((string) ($case['approval_notes'] ?? ''));

        if (str_contains($note, 'must be confirmed') || str_contains($approvalNote, 'confirm technical accuracy')) {
            return false;
        }

        return true;
    }
}

$imagePath = eds_case_card_image_path($case['image'] ?? null);
$metrics = is_array($case['metrics'] ?? null) ? $case['metrics'] : [];
$highlights = is_array($case['highlights'] ?? null) ? $case['highlights'] : [];
$outcomeIds = is_array($case['outcome_categories'] ?? null) ? $case['outcome_categories'] : [];
$metricsConfirmed = $isPreview || eds_case_card_metrics_confirmed($case);
if (!$metricsConfirmed) {
    $metrics = [];
    $highlights = [];
}
?>

<article class="eds-project-case-card" id="<?= eds_case_card_text($case['id'] ?? '') ?>">
  <?php if ($isPreview): ?>
    <div class="eds-draft-badge">Local preview only &mdash; not public</div>
  <?php endif; ?>

  <?php if ($imagePath !== ''): ?>
    <img class="eds-project-case-card__image" src="<?= eds_case_card_text($imagePath) ?>" alt="<?= eds_case_card_text($case['image_alt'] ?? '') ?>" loading="lazy" decoding="async">
  <?php endif; ?>

  <div class="eds-project-case-card__body">
    <p class="eds-project-case-card__kicker"><?= eds_case_card_text($case['industry'] ?? '') ?></p>
    <h3><?= eds_case_card_text($case['title'] ?? '') ?></h3>

    <?php if ($isPreview): ?>
      <p class="eds-preview-note">Draft data. Validate before publication.</p>
    <?php endif; ?>

    <?php if (!empty($case['public_summary'])): ?>
      <p><?= eds_case_card_text($case['public_summary']) ?></p>
    <?php endif; ?>

    <ul class="eds-card-meta">
      <?php if (!empty($case['component_type'])): ?>
        <li><strong>Component:</strong> <?= eds_case_card_text($case['component_type']) ?></li>
      <?php endif; ?>
      <?php if (!empty($case['material'])): ?>
        <li><strong>Material:</strong> <?= eds_case_card_text($case['material']) ?></li>
      <?php endif; ?>
      <?php if (!empty($case['process'])): ?>
        <li><strong>Process:</strong> <?= eds_case_card_text($case['process']) ?></li>
      <?php endif; ?>
    </ul>

    <?php if (!empty($outcomeIds)): ?>
      <div class="eds-outcome-badges" aria-label="Outcome categories">
        <?php foreach ($outcomeIds as $outcomeId): ?>
          <?php $outcomeTitle = $outcomeFrameworkById[$outcomeId]['title'] ?? $outcomeId; ?>
          <span><?= eds_case_card_text($outcomeTitle) ?></span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($case['before_state']) || !empty($case['after_state'])): ?>
      <div class="eds-before-after">
        <?php if (!empty($case['before_state'])): ?>
          <div>
            <strong>Before</strong>
            <p><?= eds_case_card_text($case['before_state']) ?></p>
          </div>
        <?php endif; ?>
        <?php if (!empty($case['after_state'])): ?>
          <div>
            <strong>After</strong>
            <p><?= eds_case_card_text($case['after_state']) ?></p>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($metricsConfirmed && !empty($metrics)): ?>
      <div class="eds-metric-group" aria-label="Reported project metrics">
        <p class="eds-metric-group__label"><?= $isPreview ? 'Internal project result - to be confirmed before publication' : 'Reported result' ?></p>
        <div class="eds-metric-chips">
          <?php foreach ($metrics as $metricKey => $metricValue): ?>
            <?php $displayValue = eds_case_card_metric_value((string) $metricKey, $metricValue); ?>
            <?php if ($displayValue !== ''): ?>
              <span><strong><?= eds_case_card_text(eds_case_card_metric_label((string) $metricKey)) ?>:</strong> <?= eds_case_card_text($displayValue) ?></span>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($isPreview && !empty($case['metric_publication_note'])): ?>
      <p class="eds-preview-note"><?= eds_case_card_text($case['metric_publication_note']) ?></p>
    <?php endif; ?>

    <?php if ($metricsConfirmed && !empty($highlights)): ?>
      <ul class="eds-project-highlights">
        <?php foreach ($highlights as $highlight): ?>
          <li><?= eds_case_card_text($highlight) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if ($isPreview && !empty($case['approval_notes'])): ?>
      <p class="eds-approval-note"><strong>Approval note:</strong> <?= eds_case_card_text($case['approval_notes']) ?></p>
    <?php endif; ?>

    <div class="eds-card-actions">
      <a href="/contact#sourcing-challenge" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="<?= eds_case_card_text($case['id'] ?? 'project_case') ?>" data-eds-category="project_case_card">Discuss a similar project</a>
    </div>
  </div>
</article>
