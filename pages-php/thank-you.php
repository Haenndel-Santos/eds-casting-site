<?php
require_once __DIR__ . '/../includes/seo.php';

$useMainPagesCss = true;
$pageTitle = 'Thank you for contacting EDS | EDS Casting & Forging';
$pageDescription = 'Confirmation that your EDS Casting & Forging inquiry has been received.';
$robots = 'noindex,follow';

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page thank-you-page">
  <section class="process-section process-intro" aria-labelledby="thank-you-title">
    <div class="process-intro__text">
      <p class="process-eyebrow">Inquiry Received</p>
      <h1 id="thank-you-title">Thank you for contacting EDS</h1>
      <p>
        Your inquiry has been received and will be reviewed by the EDS team. If your request involves a quotation,
        technical drawing review, second sourcing or supplier quality topic, we may ask for drawings, material
        specifications, expected quantities or documentation requirements.
      </p>
      <p>
        To help us assess your request efficiently, please make sure any shared project information is accurate and
        approved for external review. If confidential documents are involved, an NDA can be discussed before detailed
        technical exchange.
      </p>
      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/workflow#from-drawing-to-reliable-supply">Explore our workflow</a>
        <a class="process-btn process-btn--secondary" href="/projects#project-focus-areas">View project focus areas</a>
        <a class="process-btn process-btn--secondary" href="/contact">Return to contact page</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
