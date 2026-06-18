<?php
require_once __DIR__ . '/content-loader.php';

$projectCases = eds_load_data('project-cases.php', []);
$homeProjectResults = [];

foreach (eds_sort_by_order($projectCases) as $projectCase) {
  if (!is_array($projectCase) || !eds_project_is_visible($projectCase, 'show_on_home')) {
    continue;
  }

  $metricNote = strtolower((string) ($projectCase['metric_publication_note'] ?? ''));
  $approvalNote = strtolower((string) ($projectCase['approval_notes'] ?? ''));
  $metricsConfirmed = !str_contains($metricNote, 'must be confirmed')
    && !str_contains($approvalNote, 'confirm technical accuracy');

  $homeProjectResults[] = [
    'id' => $projectCase['id'] ?? '',
    'title' => $projectCase['title'] ?? '',
    'category' => $projectCase['industry'] ?? ($projectCase['category'] ?? ''),
    'summary' => $projectCase['public_summary'] ?? ($projectCase['short_description'] ?? ($projectCase['result'] ?? '')),
    'material' => $projectCase['material'] ?? '',
    'process' => $projectCase['process'] ?? '',
    'tags' => $metricsConfirmed ? ($projectCase['highlights'] ?? ($projectCase['outcomes'] ?? [])) : [],
    'image' => $projectCase['image'] ?? null,
    'link' => $projectCase['cta_url'] ?? ('/projects#' . ($projectCase['id'] ?? 'project-cases')),
    'cta_label' => $projectCase['cta_label'] ?? 'View project',
  ];

  if (count($homeProjectResults) >= 8) {
    break;
  }
}

if ($homeProjectResults === []) {
  $homeProjectResults = eds_load_data('home-project-results.php', []);
}

if (!function_exists('eds_home_project_text')) {
  function eds_home_project_text(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
}

if (!function_exists('eds_home_project_image_path')) {
  function eds_home_project_image_path(?string $image): string {
    $image = trim((string) $image);

    if ($image === '') {
      return '';
    }

    $relative = $image[0] === '/' ? $image : '/' . $image;
    $absolute = defined('EDS_ROOT') ? EDS_ROOT . $relative : dirname(__DIR__) . $relative;

    return is_file($absolute) ? $relative : '';
  }
}
?>

<section class="eds-home-project-results" id="selected-engineering-redesign-examples" aria-labelledby="eds-home-project-results-title">
  <div class="eds-home-project-results__inner">
    <div class="eds-home-project-results__intro">
      <p class="eds-home-project-results__eyebrow">Project Examples</p>
      <h2 id="eds-home-project-results-title">Engineering projects built around real industrial challenges</h2>
      <p>
        Explore selected casting, forging and value-added component projects. Each card provides a short preview;
        open the full project to review the technical context, production route and EDS support in more detail.
      </p>
        </div>

 <?php if (false): ?>
  <div class="eds-home-project-results__secondary-cta">
    <p>Looking for ready-to-use component options?</p>
    <a
      href="/original-parts"
      data-eds-track
      data-eds-event="internal_strategy_link_click"
      data-eds-label="home_project_examples_original_parts"
      data-eds-category="home_project_results"
    >Check also our original parts</a>
  </div>
<?php endif; ?>

    <div class="eds-home-project-results__grid" aria-label="Selected EDS project examples">
      <?php foreach ($homeProjectResults as $project): ?>
        <?php
          $imagePath = eds_home_project_image_path($project['image'] ?? null);
          $projectId = eds_home_project_text($project['id'] ?? 'project-case');
          $projectTitle = eds_home_project_text($project['title'] ?? '');
          $projectLink = eds_home_project_text($project['link'] ?? '/projects#project-focus-areas');
        ?>
        <article class="eds-home-project-card" id="<?= $projectId ?>">
          <a class="eds-home-project-card__media<?= $imagePath !== '' ? ' eds-home-project-card__media--image' : '' ?>" href="<?= $projectLink ?>" aria-label="View <?= $projectTitle ?>">
            <?php if ($imagePath !== ''): ?>
              <img
                src="<?= eds_home_project_text($imagePath) ?>"
                alt="<?= eds_home_project_text($project['title'] . ' project image') ?>"
                loading="lazy"
                decoding="async"
              >
            <?php else: ?>
              <span>Project image to be added</span>
            <?php endif; ?>
          </a>

          <div class="eds-home-project-card__body">
            <p class="eds-home-project-card__category"><?= eds_home_project_text($project['category'] ?? $project['process']) ?></p>
            <h3><?= $projectTitle ?></h3>
            <p class="eds-home-project-card__summary"><?= eds_home_project_text($project['summary']) ?></p>

            <dl class="eds-home-project-card__meta" aria-label="<?= $projectTitle ?> material and process">
              <div>
                <dt>Material</dt>
                <dd><?= eds_home_project_text($project['material']) ?></dd>
              </div>
              <div>
                <dt>Process</dt>
                <dd><?= eds_home_project_text($project['process']) ?></dd>
              </div>
            </dl>

            <?php if (!empty($project['tags']) && is_array($project['tags'])): ?>
              <div class="eds-home-project-card__tags" aria-label="<?= $projectTitle ?> result tags">
                <?php foreach (array_slice($project['tags'], 0, 2) as $tag): ?>
                  <span class="eds-home-project-card__tag"><?= eds_home_project_text($tag) ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <a
              class="eds-home-project-card__link"
              href="<?= $projectLink ?>"
              data-eds-track
              data-eds-event="internal_strategy_link_click"
              data-eds-label="<?= $projectId ?>"
              data-eds-category="home_project_grid"
            ><?= eds_home_project_text($project['cta_label'] ?? 'View project') ?> </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="eds-home-project-results__actions" aria-label="Project result actions">
      <a
        class="eds-home-project-results__action eds-home-project-results__action--primary"
        href="/contact#sourcing-challenge"
        data-eds-track
        data-eds-event="commercial_cta_click"
        data-eds-label="home_project_results_discuss_similar_project"
        data-eds-category="home_project_results"
      >Discuss a similar project</a>
      <a
        class="eds-home-project-results__action"
        href="/projects"
        data-eds-track
        data-eds-event="internal_strategy_link_click"
        data-eds-label="home_project_results_view_projects_page"
        data-eds-category="home_project_results"
      >View all projects</a>
    </div>
  </div>
</section>
