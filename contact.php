<?php include "partials/header.php" ?>
<!-- Hero Section -->
<section class="hero">
  <div class="hero-bg">
    <div class="floating-circle circle-1"></div>
    <div class="floating-circle circle-2"></div>
    <div class="floating-circle circle-3"></div>
  </div>

  <div class="hero-content">
    <div class="hero-icon">
      <div class="icon-glow"></div>
      <div class="icon-container">
        <i class="fas fa-envelope"></i>
      </div>
    </div>

    <h1 class="hero-title">
      <?= __('Contact') ?>
      <span class="highlight-contact"><?= __('Us') ?> </span>
    </h1>

    <p class="hero-subtitle">
      <?= __('Ready to collaborate? Let\'s turn your ideas into reality with our creative team.') ?>
    </p>

    <div class="hero-features">
      <div class="feature">
        <i class="fas fa-comments"></i>
        <span>
          <?= __('Response In 24 Hours') ?></span>
      </div>
      <div class="divider"></div>
      <div class="feature">
        <i class="fas fa-envelope"></i>
        <span><?= __('Free Consultation') ?></span>
      </div>
    </div>
  </div>
</section>

<!-- Contact Form Section -->
<section class="form-section">
  <div class="container">
    <div class="contact-form-card">
      <div class="form-header">
        <h2><?= __('Send Us a Message') ?></h2>
        <p><?= __('Tell us about your dream project') ?></p>
      </div>

      <form class="contact-form" id="contactForm">
        <div class="form-row">
          <div class="form-group">
            <label for="firstName"><?= __('First Name *') ?></label>
            <input type="text" id="firstName" name="firstName" placeholder="<?= __('John') ?>" required>
          </div>
          <div class="form-group">
            <label for="lastName"><?= __('Last Name *') ?></label>
            <input type="text" id="lastName" name="lastName" placeholder="<?= __('Doe') ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="email"><?= __('Email *') ?></label>
          <input type="email" id="email" name="email" placeholder="<?= __('john@example.com') ?>" required>
        </div>

        <div class="form-group">
          <label for="phone"><?= __('Phone Number') ?></label>
          <input type="tel" id="phone" name="phone" placeholder="<?= __('+62 812-3456-7890') ?>">
        </div>

        <div class="form-group">
          <label for="subject"><?= __('Subject *') ?></label>
          <input type="text" id="subject" name="subject" placeholder="<?= __('About my website project') ?>" required>
        </div>

        <div class="form-group">
          <label for="message"><?= __('Message *') ?></label>
          <textarea id="message" name="message" rows="6" placeholder="<?= __('Tell us more about your project or needs...') ?>" required></textarea>
        </div>

        <button type="submit" class="submit-btn">
          <i class="fas fa-paper-plane"></i>
          <span><?= __('Send Message') ?></span>
        </button>
      </form>

      <div class="success-message" id="successMessage">
        <div class="success-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <h3><?= __('Message Sent Successfully!') ?></h3>
        <p><?= __('Our team will contact you within 24 hours.') ?></p>
      </div>
    </div>
  </div>
</section>

<!-- Contact Info Section -->
<section class="info-section">
  <div class="container">
    <div class="section-header">
      <h2><?= __('Contact Information') ?></h2>
      <p><?= __('Various ways to connect with us') ?></p>
    </div>

    <div class="info-grid">
      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-map-marker-alt"></i>
        </div>
        <h3><?= __('Office Address') ?></h3>
        <p><?= __('Jl. Sudirman No. 123') ?><br><?= __('Central Jakarta, 10220') ?><br><?= __('Indonesia') ?></p>
      </div>

      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-phone"></i>
        </div>
        <h3><?= __('Phone') ?></h3>
        <p><?= __('+62 21 1234 5678') ?><br><?= __('+62 812 3456 7890') ?></p>
      </div>

      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-envelope"></i>
        </div>
        <h3><?= __('Email') ?></h3>
        <p><?= __('hello@company.com') ?><br><?= __('support@company.com') ?></p>
      </div>

      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-clock"></i>
        </div>
        <h3><?= __('Operating Hours') ?></h3>
        <p><?= __('Monday - Friday: 09:00 - 18:00') ?><br><?= __('Saturday: 09:00 - 15:00') ?><br><?= __('Sunday: Closed') ?></p>
      </div>

      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-globe"></i>
        </div>
        <h3><?= __('Website') ?></h3>
        <p><?= __('www.company.com') ?><br><?= __('www.portfolio.com') ?></p>
      </div>

      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-comment"></i>
        </div>
        <h3><?= __('Social Media') ?></h3>
        <p><?= __('@company_id') ?><br><?= __('@companyofficial') ?><br><?= __('LinkedIn: Company') ?></p>
      </div>
    </div>

    <!-- Map placeholder -->
    <div class="map-card">
      <div class="map-placeholder">
        <i class="fas fa-map-marker-alt"></i>
        <h3><?= __('Our Office Location') ?></h3>
        <p><?= __('Click to open Google Maps') ?></p>
      </div>
    </div>
  </div>
</section>

<script src="js/contact.js"></script>

<?php include "partials/footer.php" ?>