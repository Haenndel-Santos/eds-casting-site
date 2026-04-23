
<?php include(__DIR__ . '/../includes/head.php'); ?>
<?php include(__DIR__ . '/../includes/header.php'); ?>



<?php if (isset($_GET['sent']) && $_GET['sent'] === 'success'): ?>
  <div class="careers-popup-overlay">
    <div class="careers-popup">
      <h3>Thank you for your application!</h3>
      <p>Your CV has been successfully received and added to our database.</p>
      <p>Our HR team will review your qualifications, and if a matching opportunity arises, we’ll get in touch.</p>
      <button id="closePopup" class="careers-popup-btn">Close</button>
    </div>
  </div>



  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const popup = document.querySelector('.careers-popup-overlay');
      const closeBtn = document.getElementById('closePopup');
      closeBtn.addEventListener('click', () => {
        popup.classList.add('hidden');
        history.replaceState(null, '', '/careers');
      });
    });
  </script>
	
<?php endif; ?>



<main class="careers-content">

  <!-- HERO SECTION -->
  <section class="careers-hero hero-fullimage"
           style="background-image: url('/assets/img/hero/careers.webp');">
    <div class="careers-hero-overlay"></div>
    <div class="careers-hero-text">
      <h1>Careers</h1>
      <p>Join a team driven by innovation, precision, and engineering excellence — shaping the future of casting and forging solutions.</p>
    </div>
  </section>

  <!-- CALL TO ACTION BUTTON -->
  
    <div style="text-align: center; margin-bottom: 20px;">
      <a href="/vacancies" class="careers-btn">Check Our Opportunities</a>
    </div>
  
  <!-- OUR CULTURE -->
  <section class="careers-section careers-overview">
    <h2>Our Culture</h2>
    <p>
      At EDS Casting & Forging, innovation is not just a goal — it’s part of who we are.
      We encourage creativity, problem-solving, and continuous learning in every project.
      Our team combines deep technical knowledge with a collaborative spirit, ensuring that every idea contributes to real results.
    </p>
    <p>
      We believe in open communication, trust, and accountability — values that guide us in building
      long-term partnerships with both our employees and our global network of clients.
    </p>
  </section>

  <!-- ENGINEERING EXCELLENCE -->
  <section class="careers-section alt">
    <h2>Engineering Excellence</h2>
    <p>
      Precision and quality define our engineering mindset.
      We continuously invest in advanced technologies and professional development to deliver
      solutions that meet the most demanding technical requirements.
    </p>
    <ul class="careers-list">
      <li>Collaborative international environment</li>
      <li>Focus on continuous improvement and innovation</li>
      <li>Exposure to real industrial projects and modern technologies</li>
      <li>Strong commitment to quality and safety standards</li>
    </ul>
  </section>

  <!-- INTERNSHIPS AND DEVELOPMENT -->
  <section class="careers-section">
    <h2>Internship & Student Opportunities</h2>
    <p>
      We support the next generation of engineers and professionals by offering internship
      opportunities to students eager to learn about product design, manufacturing, and
      international supply chain operations.
    </p>
    <ul class="careers-list">
      <li>Hands-on experience with real engineering projects</li>
      <li>Guidance from experienced mentors and engineers</li>
      <li>Possibility of long-term collaboration after internship</li>
      <li>Dynamic, multicultural environment</li>
    </ul>
  </section>

  <!-- CAREER PATHS -->
  <section class="careers-section alt">
    <h2>Career Paths</h2>
    <p>
      Whether you’re an experienced professional or just starting your career,
      EDS offers diverse opportunities in technical, commercial, and operations areas.
      We value dedication, creativity, and the desire to grow with us.
    </p>
    <ul class="careers-list">
      <li>Engineering & Product Development</li>
      <li>Project Management & Customer Support</li>
      <li>Supply Chain & Logistics</li>
      <li>Quality Assurance & Technical Documentation</li>
    </ul>
  </section>

  <!-- UPLOAD YOUR CV -->
  <!-- === APPLICATION SECTION === -->
  <section class="careers-section-form careers-form-title">
    <h3>Submit Your Application</h3>
    <h4>
      Interested in joining our team? Upload your resume below — we’ll get in touch 
      when a suitable position becomes available.
    </h4>
  
  <form id="careerForm" class="careers-form"
        action="/careers-mail"
        method="POST"
        enctype="multipart/form-data">

    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" required placeholder="Your full name">

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required placeholder="you@example.com">

    <label for="cv">Upload your CV (PDF only):</label>
    <input type="file" id="cv" name="cv" accept=".pdf" required>

    <!-- CAPTCHA -->
    <div class="g-recaptcha" data-sitekey="6LeWDOArAAAAAFKopj1_XZIoQIJTupCJzKEdJAtz"></div>

    <!-- HONEYPOT FIELD -->
    <div class="honeypot-field" aria-hidden="true">
      <label for="website">Website</label> 
      <input type="text" id="website" name="website" autocomplete="off" tabindex="-1">
    </div>

    <button class="careers-btn" type="submit">Send Application</button>

    <!-- CAPTCHA SCRIPT -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </form>
</section>



 

</main>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/bottombar.php'; ?>


