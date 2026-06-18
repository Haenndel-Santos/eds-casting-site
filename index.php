
<?php require_once __DIR__ . '/includes/seo.php';?>
<?php
$pageCssExtras = [
  '/assets/css/pages-css/home-solutions-overview.css',
  '/assets/css/pages-css/home-commercial-sourcing.css',
  '/assets/css/pages-css/home-project-results.css',
  '/assets/css/pages-css/home-final-cta.css',
];
?>
<?php include 'includes/head.php'; ?>
<?php include 'includes/header.php'; ?>



<main>

 <?php include 'includes/hero.php'; ?>
 <?php include 'includes/home-solutions-overview.php'; ?>

<?php include 'includes/home-project-results.php'; ?>

<?php include 'includes/home-commercial-sourcing.php'; ?>



<?php include 'includes/hero-double-images.php'; ?>


 <?php include 'includes/home-final-cta.php'; ?>

</main>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/bottombar.php'; ?>


</body>
</html>
