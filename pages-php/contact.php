<?php
$sent_success = isset($_GET['sent']) && $_GET['sent'] == '1';
require_once __DIR__ . '/../includes/seo.php';
include(__DIR__ . '/../includes/head.php');
include(__DIR__ . '/../includes/header.php');
?>


<div class="page-contact">

  <section class="contact-hero" role="banner">
    <div class="contact-hero-inner">
      <h1>Contact Us & Request a Quotation</h1>
      <p>Tell us about your project, technical requirements, or inquiry — our engineering team is ready to support you.</p>
      <p>We review all requests promptly and provide clear feedback, feasibility insights, and next steps.</p>
      <p>To speed up the process, you can upload drawings or technical documents directly in the form.</p>
    </div>
  </section>

  <div class="form-section-title">
    <h2>Contact Information</h2>
    <p>Please share your details so we can get back to you.</p>
  </div>

  <main class="contact-section" role="main">

    <?php if ($sent_success): ?>
      <script>
        window.addEventListener('DOMContentLoaded', function () {
          const modal = document.getElementById('successModal');
          if (modal) modal.classList.add('open');
        });
      </script>
    <?php endif; ?>



    <form class="form-lead form-lead-smart" action="/pages-php/new-leads.php" method="POST" enctype="multipart/form-data">

       <div class="form-grid form-grid-2">
        <div class="name-row">
          <label for="name">Name*</label>
          <input type="text" id="name" name="name" placeholder="Your full name" required>
        </div>

        <div class="name-row">
          <label for="email">Email*</label>
          <input type="email" id="email" name="email" placeholder="your@email.com" required>
        </div>
      </div>

      <div class="form-grid form-grid-2">
        <div class="name-row">
          <label for="company">Company</label>
          <input type="text" id="company" name="company" placeholder="Your company name">
        </div>

        <div class="name-row">
          <label for="phone">Phone</label>
          <input type="text" id="phone" name="phone" placeholder="Your phone number">
        </div>
      </div>

      <div class="form-grid form-grid-2">
        <div class="name-row">
          <label for="country">Country</label>
          <input type="text" id="country" name="country" placeholder="Country / region">
        </div>

        <div class="name-row">
          <label for="request_type">Request Type*</label>
          <select id="request_type" name="request_type" required>
            <option value="">-- Select --</option>
            <option value="general">General Inquiry</option>
            <option value="quotation">Request a Quotation</option>
            <option value="technical">Technical Support</option>
            <option value="partnership">Partnership</option>
          </select>
        </div>
      </div>

      <div class="rfq-trigger-row" id="rfqTriggerRow" style="display:none;">
        <button type="button" class="btn-rfq-details" id="openRfqModal">Fill in additional quotation details</button>
        <p class="rfq-status" id="rfqStatus" style="display:none;">Quotation details added.</p>
      </div>
      

     
      <div class="name-row">
        <label for="message">Message*</label>
        <textarea id="message" name="message" rows="6" placeholder="Tell us about your project, specifications, timing, or any questions you may have." required></textarea>
      </div>

      <div class="g-recaptcha" data-sitekey="6LeWDOArAAAAAFKopj1_XZIoQIJTupCJzKEdJAtz"></div>

      <div class="honeypot-field" aria-hidden="true">
        <label for="website">Website</label>
        <input type="text" id="website" name="website" autocomplete="off" tabindex="-1">
      </div>

      
      <button class="btn-submit1" id="submitButton" type="submit"> Send Message</button>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     


      <!-- RFQ Modal -->
      <div id="rfqModal" class="rfq-modal" aria-hidden="true">
        <div class="rfq-modal-backdrop" id="closeRfqModalBackdrop"></div>

        <div class="rfq-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="rfqModalTitle">
          <div class="rfq-modal-header">
            <h2 id="rfqModalTitle">Quotation Details</h2>
            </div>

            <div class="rfq-modal-header-button">
            <button type="button" class="rfq-modal-close" id="closeRfqModal" aria-label="Close quotation details">&times;</button>
          </div>

          <div class="rfq-modal-body">
            <div class="form-grid form-grid-2">
              <div class="name-row">
                <label for="service">Process / Area of Interest</label>
                <select id="service" name="service">
                  <option value="">-- Select --</option>
                  <option value="casting">Casting</option>
                  <option value="forging">Forging</option>
                  <option value="machining">Machining</option>
                  <option value="add-value">Add Value Services</option>
                  <option value="logistics">Logistics Solutions</option>
                  <option value="not-sure">Not sure yet</option>
                </select>
              </div>

              <div class="name-row">
                <label for="material">Material</label>
                <input type="text" id="material" name="material" placeholder="e.g. Carbon steel, stainless steel, ductile iron">
              </div>
            </div>

            <div class="form-grid form-grid-3">
              <div class="name-row">
                <label for="quantity">Quantity</label>
                <input type="text" id="quantity" name="quantity" placeholder="e.g. 250 pcs">
              </div>

              <div class="name-row">
                <label for="annual_volume">Annual Volume</label>
                <input type="text" id="annual_volume" name="annual_volume" placeholder="e.g. 2,000 pcs/year">
              </div>

              <div class="name-row">
                <label for="target_price">Target Price / Budget</label>
                <input type="text" id="target_price" name="target_price" placeholder="Optional">
              </div>
            </div>

            <div class="form-grid form-grid-1">
              <div class="name-row">
                <label for="delivery_destination">Delivery Destination</label>
                <input type="text" id="delivery_destination" name="delivery_destination" placeholder="City / country">
              </div>
            </div>

            <div class="name-row">
              <label for="attachments">Upload Drawings / Documents</label>
              <input
                type="file"
                id="attachments"
                name="attachments[]"
                multiple
                accept=".pdf,.step,.stp,.igs,.iges,.zip,.rar,.7z,.dwg,.dxf">
              <small class="form-note">Accepted formats: PDF, STEP, STP, IGS, IGES, ZIP, RAR, 7Z, DWG and DXF.</small>
            </div>
          </div>

          <div class="rfq-modal-footer">
            <button type="button" class="btn-submit btn-submit-secondary" id="saveRfqDetails">Save quotation details</button>
          </div>
        </div>
      </div>
    </form>

    <aside class="contact-text-block" aria-label="Direct contact information">
      <img class="contact-illustration" src="/assets/img/ToWeRe.png" alt="EDS Contact Illustration">

       <!--<p class="contact-explainer">
        Whether you need a quotation, technical guidance, or a general discussion about your project, this form helps us direct your request to the right team from the start.
      </p>-->

      <div class="contact-direct">
        <h3>Direct Contact</h3>
        <p><strong>Phone:</strong> <a href="tel:+31203585066">+31 20 358 5066</a></p>
        <p><strong>Email:</strong> <a href="mailto:info@edsinnovation.com">info@edsinnovation.com</a></p>
        <p><strong>Address:</strong> Keienbergweg 95, 1101 GE, Amsterdam</p>
        <p>The Netherlands</p>
      </div>

     
    </aside>

  <div id="successModal" class="modal-success" aria-hidden="true">
  <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="successModalTitle" aria-describedby="successModalText">
    <div class="modal-success-icon" aria-hidden="true">
      <span>✓</span>
    </div>

    <div class="modal-success-copy">
      <p class="modal-eyebrow">Message successfully sent</p>
      <h3 id="successModalTitle">Thank you for contacting EDS</h3>
      <p id="successModalText">
        Your request has been received successfully. Our team will review your message and get back to you as soon as possible.
      </p>
    </div>

    <div class="modal-success-actions">
      <button class="modal-close" onclick="closeModalAndRedirect()">Return to homepage</button>
    </div>
  </div>
</div>

    <script>
      function closeModalAndRedirect() {
        const modal = document.getElementById('successModal');
        if (modal) modal.classList.remove('open');
        setTimeout(() => {
          window.location.href = '/';
        }, 300);
      }
    </script>

    <script src="/assets/js/contact.js"></script>
  </main>
</div>

<?php include(__DIR__ . '/../includes/footer.php'); ?>
<?php include(__DIR__ . '/../includes/bottombar.php'); ?>