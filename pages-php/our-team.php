<?php
require_once __DIR__ . '/../includes/seo.php';

/* Our Team uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;

$pageTitle = 'Our Team | Engineering, Operations & Supply Chain Support | EDS Casting & Forging';
$pageDescription = 'Meet the EDS Casting & Forging team supporting industrial customers with engineering review, supplier coordination, quality documentation, operations, finance and supply chain follow-up.';

$teamMembers = [
  [
    'name' => 'Markus Rahusen',
    'role' => 'Chief Executive Officer',
    'level' => 'leader',
    'linkedin' => 'https://www.linkedin.com/in/markus-rahusen-0023862/',
    'bio' => 'Leads EDS with a focus on long-term partnerships, technical reliability and sustainable growth across international industrial supply programs.',
  ],
  [
    'name' => 'Enzio Lette',
    'role' => 'Head of Engineering',
    'level' => 'management',
    'linkedin' => 'https://www.linkedin.com/in/enziolette/',
    'bio' => 'Supports engineering development, supplier validation and technical decision-making for casting, forging and machined component projects.',
  ],
  [
    'name' => 'Teuta Neziri',
    'role' => 'Head of Operations',
    'level' => 'management',
    'linkedin' => 'https://www.linkedin.com/in/teuta-neziri-sulejmani-83a59997/',
    'bio' => 'Coordinates operational workflows, project follow-up and internal communication to keep customer orders moving from quotation to delivery.',
  ],
  [
    'name' => 'Soraya Pengel',
    'role' => 'Head of Finance',
    'level' => 'management',
    'linkedin' => '',
    'bio' => 'Oversees financial administration and reporting, supporting stable decision-making, planning and commercial control within EDS.',
  ],
  [
    'name' => 'Mike Badoux',
    'role' => 'Engineering',
    'level' => 'team',
    'linkedin' => 'https://www.linkedin.com/in/mike-badoux-automotive-engineer/',
    'bio' => 'Supports technical documentation, supplier communication and project follow-up to help translate requirements into consistent manufacturing results.',
  ],
  [
    'name' => 'Haenndel Santos',
    'role' => 'Business Development & Operations',
    'level' => 'team',
    'linkedin' => 'https://www.linkedin.com/in/haenndel-santos-736077269/',
    'bio' => 'Focuses on operational improvement, digital development, customer support and process clarity to strengthen EDS as an engineering-driven sourcing partner.',
  ],
  [
    'name' => 'Myriam Aceves',
    'role' => 'Finance & Operations',
    'level' => 'team',
    'linkedin' => 'https://www.linkedin.com/in/myriam-aceves-gomez-96081572/',
    'bio' => 'Bridges financial administration and operational execution, helping the team stay aligned on priorities, documentation and delivery timing.',
  ],
  [
    'name' => 'Caroline Smeenk',
    'role' => 'Finance',
    'level' => 'team',
    'linkedin' => 'https://www.linkedin.com/in/caroline-smeenk/',
    'bio' => 'Supports accurate financial administration and smooth order-to-invoice processes for customer and supplier transactions.',
  ],
];

$teamSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  'name' => 'EDS Casting & Forging B.V.',
  'url' => 'https://www.edscasting.com',
  'employee' => array_map(function ($member) {
    $person = [
      '@type' => 'Person',
      'name' => $member['name'],
      'jobTitle' => $member['role'],
      'worksFor' => [
        '@type' => 'Organization',
        'name' => 'EDS Casting & Forging B.V.',
      ],
    ];

    if (!empty($member['linkedin'])) {
      $person['sameAs'] = [$member['linkedin']];
    }

    return $person;
  }, $teamMembers),
];

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page our-team-page">

  <section
    class="process-hero our-team-hero"
    aria-labelledby="our-team-hero-title"
    style="background-image: url('/assets/img/hero/our-team-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="our-team-hero-title">Meet the EDS Team Behind Engineering-Driven Industrial Supply</h1>

      <p class="process-hero__summary">
        Our team connects engineering knowledge, supplier coordination, quality documentation, finance,
        operations and customer communication to support reliable industrial component sourcing.
      </p>

      <div class="process-hero__actions" aria-label="Our team page actions">
        <a class="process-btn process-btn--primary" href="/contact">Contact Our Team</a>
        <a class="process-btn process-btn--secondary" href="/workflow">See How We Work</a>
      </div>
    </div>
  </section>

  <nav class="process-anchor-nav" aria-label="Our team page navigation">
    <a href="#overview">Overview</a>
    <a href="#team">Team Roles</a>
    <a href="#how-we-work">How We Work</a>
    <a href="#related">Related</a>
  </nav>

  <div class="process-content">

    <section class="process-section process-intro our-team-intro-band" id="overview" aria-labelledby="overview-title">
      <div class="process-intro__text our-team-intro-copy">
        <p class="process-eyebrow">Our Team</p>
        <h2 id="overview-title">A compact team with technical, operational and commercial ownership</h2>
        <p>
          EDS Casting &amp; Forging works as an engineering and trading partner for industrial metal components.
          Our team coordinates projects that involve casting, forging, machining, surface finishing, quality
          documentation and international supply chain follow-up.
        </p>
        <p>
          Because EDS does not operate its own foundry or forging plant, teamwork is essential. Each project depends
          on clear communication between customers, engineering, suppliers, finance, operations and logistics partners.
        </p>
        <p>
          The people below support the practical work behind every project: reviewing technical requirements,
          coordinating supplier input, following documentation, managing internal workflows and helping customers
          receive reliable industrial components.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="EDS team strengths">
        <article>
          <h3>Engineering Coordination</h3>
          <p>Technical review, supplier input and process selection are connected before and during production.</p>
        </article>

        <article>
          <h3>Operational Follow-Up</h3>
          <p>Projects are supported through quotation, order coordination, documentation and delivery planning.</p>
        </article>

        <article>
          <h3>Customer Support</h3>
          <p>Communication remains focused on clarity, realistic expectations and long-term industrial reliability.</p>
        </article>
      </div>
    </section>

    <section class="process-section team-section" id="team" aria-labelledby="team-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Team Roles</p>
        <h2 id="team-title">Daily project support across technical, operational and financial workflows</h2>
        <p>
          The EDS team supports customer projects through technical review, supplier coordination, quality
          documentation follow-up, operational communication, finance administration and customer support.
        </p>
      </div>

      <div class="team-grid team-grid--all" aria-label="EDS team roles">
        <?php foreach ($teamMembers as $member): ?>
          <article class="team-card">
            <h3 class="team-name">
              <?php if (!empty($member['linkedin'])): ?>
                <a href="<?= htmlspecialchars($member['linkedin'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="View <?= htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8') ?> on LinkedIn">
                  <?= htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8') ?>
                </a>
              <?php else: ?>
                <?= htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8') ?>
              <?php endif; ?>
            </h3>
            <p class="team-role"><?= htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8') ?></p>
            <p class="team-bio"><?= htmlspecialchars($member['bio'], ENT_QUOTES, 'UTF-8') ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="process-section process-split" id="how-we-work" aria-labelledby="how-we-work-title">
      <div>
        <p class="process-eyebrow">How We Work Together</p>
        <h2 id="how-we-work-title">Cross-functional teamwork for reliable industrial component sourcing</h2>
        <p>
          EDS projects move through several stages: customer inquiry, technical review, quotation, supplier
          coordination, production follow-up, quality documentation, logistics and delivery. Our team works across
          these stages so that technical, commercial and operational details remain connected.
        </p>
        <p>
          This structure helps customers work with one coordinated partner instead of managing every supplier,
          document and logistics step separately.
        </p>
      </div>

      <aside class="process-callout process-callout--neutral" aria-label="EDS team collaboration focus areas">
        <h3>Team collaboration focus</h3>
        <ul>
          <li>Technical and commercial clarification during quotation</li>
          <li>Supplier coordination and project follow-up</li>
          <li>Quality documentation and traceability control</li>
          <li>Operational communication from order to delivery</li>
          <li>Long-term improvement of workflows and customer support</li>
        </ul>
      </aside>
    </section>

    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Explore EDS</p>
        <h2 id="related-title">Learn more about how our team supports industrial projects</h2>
        <p>
          Our team works across engineering, quality, supply chain and customer support. Explore the related pages
          below to understand how EDS supports customers in practice.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/about-us">
          <h3>About EDS</h3>
          <p>Learn more about EDS as an engineering-driven sourcing and supply coordination partner.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/workflow">
          <h3>Workflow</h3>
          <p>See how projects move from technical review to supplier coordination, quality follow-up and delivery.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/quality">
          <h3>Quality Support</h3>
          <p>Understand how EDS coordinates inspection, documentation and supplier follow-up.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <section class="process-section process-final-cta" aria-labelledby="team-cta-title">
      <div>
        <p class="process-eyebrow">Contact EDS</p>
        <h2 id="team-cta-title">Need support from a team that understands industrial component sourcing?</h2>
        <p>
          Send us your drawing, quotation request or technical question. Our team can help review the project scope,
          coordinate the right production route and define the next steps.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/contact">Contact Our Team</a>
        <a class="process-btn process-btn--secondary" href="/careers">Work at EDS</a>
      </div>
    </section>

  </div>
</main>

<script type="application/ld+json">
<?= json_encode($teamSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
