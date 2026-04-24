<?php require_once __DIR__ . '/../includes/seo.php';?>
<?php include(__DIR__ . '/../includes/head.php'); ?>
<?php include(__DIR__ . '/../includes/header.php'); ?>





<main class="workflow-page"> 
  <!-- HERO -->
  <section class="page-hero-workflow">
    <h1>Our Workflow</h1>
    <p>From material selection to assembly — a fully engineered process built on precision, efficiency, and value.</p>
  </section>

     <section class="workflow-section workflow-overview">
    <h2>Interact with the workflow map to understand each stage of EDS’s engineering process.</h2>
   </section>

  <!-- WORKFLOW CONTENT -->
  <section class="workflow-container">

    <!-- Núcleo com imagem e pontos interativos -->
    <div class="workflow-core show-guides" id="workflow-core">
      <img src="/assets/img/CoreCircle.png"
           alt="EDS Workflow Core"
           class="workflow-image" />

      <!-- Pontos polares -->
      <!-- Machining -->
      <button class="wf-dot welding"
              data-target="popup-machining"
              aria-label="Machining / Welding"></button>

      <!-- Material (sem popup específico) -->
      <button class="wf-dot material"
              data-target="popup-material"
              aria-label="Material Selection"></button>

      <!-- Weight Optimization -->
      <button class="wf-dot weight"
              data-target="popup-weight"
              aria-label="Weight Optimization"></button>

      <!-- Load Case / FEM -->
      <button class="wf-dot testing"
              data-target="popup-testing"
              aria-label="Load Case / FEM Calculations"></button>

      <!-- Assembly (sem popup específico) -->
      <button class="wf-dot assembly"
              data-target="popup-assembly"
              aria-label="Assembly Line"></button>

      <!-- Supply Chain (sem popup específico) -->
      <button class="wf-dot tools"
              data-target="popup-supply-chain"
              aria-label="Supply Chain Engineering"></button>

      <!-- Ponto central: visão geral do processo -->
      <button class="wf-dot towere"
              data-target="popup-towere"
              aria-label="EDS Comprehensive Workflow"></button>
    </div>

    <!-- POP-UPS DE CONTEÚDO -->

    <!-- Popup: Machining & Finishing -->
    <div class="popup-overlay" id="popup-machining">
      <div class="popup-box1">
        <span class="close-popup">&times;</span>
        <h7>Machining &amp; Finishing</h7>
      <p>At EDS, machining and finishing are not merely the final stages of production — 
        they are the precise link between engineering design and tangible performance. 
        Through advanced CNC machining, multi-axis milling, and precision grinding, 
        every cast or forged part is refined to meet the most demanding dimensional and surface quality requirements. 
        Our processes are developed to eliminate imperfections, optimize fit and alignment, and guarantee that 
        each component performs exactly as designed, whether destined for assembly or direct integration into critical applications.</p>
      <p><strong>Key benefits:</strong> exceptional dimensional accuracy, optimized component lifespan, reduction of rework and material waste, 
      and a consistently superior surface finish that ensures seamless compatibility with downstream processes and assemblies.</p>
      </div>
    </div>

    <!-- Popup: Weight Optimization -->
    <div class="popup-overlay" id="popup-weight">
      <div class="popup-box1">
        <span class="close-popup">&times;</span>
        <h7>Weight Optimization</h7>
        <p>At EDS, weight optimization is an integral part of our engineering philosophy — 
          a process that combines material science, mechanical simulation, and design efficiency to achieve 
          the ideal balance between strength and lightness. During the early design phase, our engineers apply 
          advanced CAD and topology optimization techniques to refine geometries, removing unnecessary mass 
          while maintaining structural integrity and mechanical performance. 
          By integrating finite element analysis (FEA) and using high-performance alloys, 
          we ensure that every component is optimized for functionality, durability, and manufacturability.</p>
          <p><strong>Key benefits:</strong> lower overall component weight, improved fuel and energy efficiency, reduced raw material 
          consumption and logistics costs, and enhanced product sustainability without compromising performance or safety.</p>
      </div>
    </div>

    <!-- Popup: Load Case / FEM Analysis -->
    <div class="popup-overlay" id="popup-testing">
      <div class="popup-box1">
        <span class="close-popup">&times;</span>
        <h7>Load Case &amp; FEM Analysis</h7>
        <p>Finite Element Method (FEM) analysis at EDS is a cornerstone of our design validation process, 
          enabling us to simulate real-world operating conditions long before production begins. Through detailed 
          digital modelling, our engineers evaluate stress distribution, deformation patterns, fatigue life, and safety 
          factors under various load cases. This advanced predictive approach allows us to optimize material allocation, 
          enhance component rigidity, and identify potential failure zones early in development. By combining numerical accuracy 
          with engineering expertise, we ensure that every part delivers the highest levels of reliability, durability, 
          and performance consistency throughout its lifecycle.</p>
          <p><strong>Key benefits:</strong> improved structural integrity, reduced need for physical prototyping, faster design 
          validation, and accelerated time-to-market with greater confidence in product safety and endurance.</p>
      </div>
    </div>

      <div class="popup-overlay" id="popup-material">
      <div class="popup-box1">
        <span class="close-popup">&times;</span>
        <h7>Material Selection</h7>
        <p>At EDS, every project starts with a meticulous material selection process — 
          the foundation upon which performance, durability, and cost-efficiency are built. Our engineers 
          evaluate not only the chemical composition and mechanical properties of alloys but also factors such 
          as thermal behavior, corrosion resistance, and manufacturability. Through close collaboration with 
          foundries and forging partners, we ensure that each material is perfectly matched to the functional 
          and environmental requirements of the final application. This integrated approach guarantees that 
          every component achieves the optimal balance between structural integrity, longevity, and economic efficiency.</p>
          <p><strong>Key benefits:</strong> enhanced mechanical performance, extended product lifetime, improved production consistency, 
          and optimized balance between cost, strength, and sustainability.</p>
      </div>
    </div>

      <div class="popup-overlay" id="popup-assembly">
      <div class="popup-box1">
        <span class="close-popup">&times;</span>
        <h7>Assembly Lines</h7>
        <p>At EDS, assembly is more than the final step — it is a critical phase where precision engineering meets 
          functional validation. When required, components are pre-assembled and subjected to detailed fit, 
          alignment, and functional checks to ensure that all interfaces perform flawlessly. Our engineers oversee every 
          stage of the assembly process, from tolerance verification to operational testing, ensuring consistency, 
          repeatability, and compliance with customer specifications. This attention to detail guarantees that each 
          delivery integrates seamlessly into the client’s production line or end system.</p>
          <p><strong>Key benefits:</strong> improved assembly accuracy, enhanced quality consistency across batches, 
          reduced non-conformities, and assurance of full functionality before shipment.</p>
      </div>
    </div>

      <div class="popup-overlay" id="popup-supply-chain">
      <div class="popup-box1">
        <span class="close-popup">&times;</span>
        <h7>Supply Chain</h7>
        <p>At EDS, supply chain management is approached as an integrated engineering process — 
          ensuring that every stage, from raw material sourcing to final delivery, operates with precision and transparency. 
          We coordinate procurement, production scheduling, quality control, and logistics to create a seamless 
          flow of information and materials across continents. Our expertise in international trading, 
          combined with long-term partnerships with foundries and machining suppliers, enables us to anticipate 
          challenges, minimize lead times, and reduce total cost of ownership for our clients. Through proactive 
          communication and real-time tracking, we guarantee on-time deliveries and sustained supply reliability for every project.</p>
          <p><strong>Key benefits:</strong> optimized lead times, enhanced cost control, improved traceability, and consistent delivery 
          performance through a fully integrated and transparent supply chain.</p>
      </div>
    </div>

    <!-- Popup: Visão Geral (Towere) -->
    <div class="popup-overlay" id="popup-towere">
      <div class="popup-box">
        <span class="close-popup">&times;</span>
              <!-- Imagem central -->
        <img src="/assets/img/towere.png"
     alt="EDS Core Process"
     class="towere-image">

        </div>
    </div>

    <!-- BOTÕES EXTERNOS PARA ABRIR POP‑UPS -->
    <!--<div class="workflow-buttons">
      <button class="btn-workflow" data-target="popup-machining">Machining &amp; Finishing</button>
      <button class="btn-workflow" data-target="popup-weight">Weight Optimization</button>
      <button class="btn-workflow" data-target="popup-testing">Load Case / FEM Analysis</button>
      <button class="btn-workflow" data-target="popup-machining">Machining &amp; Finishing</button>
      <button class="btn-workflow" data-target="popup-weight">Weight Optimization</button>
      <button class="btn-workflow" data-target="popup-testing">Load Case / FEM Analysis</button>
    </div> -->

  </section>

<!-- CTA SECTION -->
  <section class="mainpage-cta1">
    <p>Want to learn more about how EDS optimizes workflow efficiency and project delivery?</p>
    <a href="/pages-php/contact.php" class="cta-button">Get in Touch</a>
  </section>
</main>

<!-- Script de interação -->
<script src="/assets/js/workflow.js"></script>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/bottombar.php'; ?>
