<?php
/* ======================================================
   STANDARD PARTS – HOME INCLUDE
   Purpose: Showcase selected standard parts with carousel
   ====================================================== */

$sp_home_items = [
  [ 'name' => 'Ring Gear Housing',  'img' => '/assets/img/standard-parts/placeholder-01.jpg' ],
  [ 'name' => 'Heavy Duty Bracket', 'img' => '/assets/img/standard-parts/placeholder-02.jpg' ],
  [ 'name' => 'Machined Flange',    'img' => '/assets/img/standard-parts/placeholder-03.jpg' ],
  [ 'name' => 'Standard Part 04',   'img' => '/assets/img/standard-parts/placeholder-04.jpg' ],
  [ 'name' => 'Standard Part 05',   'img' => '/assets/img/standard-parts/placeholder-05.jpg' ],
  [ 'name' => 'Standard Part 06',   'img' => '/assets/img/standard-parts/placeholder-06.jpg' ],
  [ 'name' => 'Standard Part 07',   'img' => '/assets/img/standard-parts/placeholder-07.jpg' ],
  [ 'name' => 'Standard Part 08',   'img' => '/assets/img/standard-parts/placeholder-08.jpg' ],
];
?>

<section class="sp-home" aria-label="Standard parts showcase">
  <div class="sp-home__inner">

    <header class="sp-home__header">
      <div class="sp-home__heading">
        <p class="hero-eyebrow">Standard Parts</p>
        <h2 class="sp-home__title">Repeat-Supply Parts with Controlled Specifications</h2>
        <p class="sp-home__subtitle">
          Explore selected EDS standard parts developed for recurring industrial demand,
          with stable specifications, repeatable supply and dependable sourcing support.
        </p>
      </div>
    </header>

    <div class="sp-home__carousel" data-sp-home-carousel>
      <button class="sp-home__nav sp-home__nav--prev" type="button" aria-label="Previous standard part">‹</button>

      <div class="sp-home__viewport" data-sp-home-viewport>
        <div class="sp-home__track" data-sp-home-track>
          <?php foreach ($sp_home_items as $item): ?>
            <a class="sp-home__slide" href="/standard-parts" aria-label="Explore standard parts">
              <div class="sp-home__imgWrap">
                <img
                  class="sp-home__img"
                  src="<?= htmlspecialchars($item['img']) ?>"
                  alt="<?= htmlspecialchars($item['name']) ?>"
                  loading="lazy"
                >
              </div>
              <div class="sp-home__caption"><?= htmlspecialchars($item['name']) ?></div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <button class="sp-home__nav sp-home__nav--next" type="button" aria-label="Next standard part">›</button>
    </div>

    <a class="sp-home__cta" href="/standard-parts">Explore Standard Parts</a>
  </div>
</section>
