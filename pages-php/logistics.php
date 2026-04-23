<?php require_once __DIR__ . '/../includes/seo.php';?>
<?php include(__DIR__ . '/../includes/head.php'); ?>
<?php include(__DIR__ . '/../includes/header.php'); ?>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q1KDBYP4CG"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Q1KDBYP4CG');
</script>




<main>

<!-- HERO BOX -->
<div class="logistics-hero">
  <h1>Logistics</h1>
  <p>Explore our logistics capabilities, from traditional methods to advanced manufacturing solutions.</p>
</div>

<!-- GRID BOX: TEXT + IMAGE -->

<section class="logistics-grid">

  <div class="logistics-left">
    <h1>What is logistics?</h1>
      <p>
      logistics is a manufacturing process in which a liquid material is 
      poured into a mold and allowed to solidify into a specific shape. 
      It is ideal for producing complex parts with precision, strength,
      and cost-efficiency. At EDS, we offer a wide variety of logistics methods
      to meet your technical and economic requirements.
    </p>
  </div>

  <div class="logistics-right">
    <div class="logistics-img-container">
      <img src="/assets/img/logistics/logistics-intro.jpg" alt="logistics Overview Image">
    </div>
  
</section>


<!-- SUBTYPES CONTAINERS -->
<div class="logistics-subtypes">

  <section class="supply-chain">
    <div>
      <h3>Supply Chain Management</h3>
    <p>Supply Chain Management is one of the oldest and most versatile logistics techniques. It uses sand as the mold material and is ideal for large components with complex geometries and moderate production volumes.</p>
    <div class="action-button">
      <a href="../pages-php/supply-chain.php" class="btn-supply-chain">Supply Chain Management</a>
    </div>
    <div>
  </section>

 <section class="warehouse-stock">
  <div>
    <h3>Warehouse & Stock</h3>
    <p>Also known as lost-wax logistics, this process produces high-precision components with excellent surface finish. It is suitable for intricate parts used in aerospace, automotive, and medical industries.</p>
    <div class="action-button">
      <a href="../pages-php/warehouse-stock.php" class="btn-warehouse-stock">Warehouse & Stock</a>
    </div>
  <div>
  </section>

 </div>
  

<?php include '../includes/footer.php'; ?>
<?php include '../includes/bottombar.php'; ?>
