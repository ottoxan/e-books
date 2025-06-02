<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hubungi Kami - Contact Page</title>
  <link rel="stylesheet" href="css/contact.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
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
        Hubungi
        <span class="highlight">Kami</span>
      </h1>

      <p class="hero-subtitle">
        Siap untuk berkolaborasi? Mari wujudkan ide Anda menjadi kenyataan bersama tim kreatif kami.
      </p>

      <div class="hero-features">
        <div class="feature">
          <i class="fas fa-comments"></i>
          <span>Respons dalam 24 jam</span>
        </div>
        <div class="divider"></div>
        <div class="feature">
          <i class="fas fa-envelope"></i>
          <span>Konsultasi gratis</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Form Section -->
  <section class="form-section">
    <div class="container">
      <div class="contact-form-card">
        <div class="form-header">
          <h2>Kirim Pesan</h2>
          <p>Ceritakan proyek impian Anda kepada kami</p>
        </div>

        <form class="contact-form" id="contactForm">
          <div class="form-row">
            <div class="form-group">
              <label for="firstName">Nama Depan *</label>
              <input type="text" id="firstName" name="firstName" placeholder="John" required>
            </div>
            <div class="form-group">
              <label for="lastName">Nama Belakang *</label>
              <input type="text" id="lastName" name="lastName" placeholder="Doe" required>
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" placeholder="john@example.com" required>
          </div>

          <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="phone" name="phone" placeholder="+62 812-3456-7890">
          </div>

          <div class="form-group">
            <label for="subject">Subjek *</label>
            <input type="text" id="subject" name="subject" placeholder="Tentang proyek website saya" required>
          </div>

          <div class="form-group">
            <label for="message">Pesan *</label>
            <textarea id="message" name="message" rows="6" placeholder="Ceritakan lebih detail tentang proyek atau kebutuhan Anda..." required></textarea>
          </div>

          <button type="submit" class="submit-btn">
            <i class="fas fa-paper-plane"></i>
            <span>Kirim Pesan</span>
          </button>
        </form>

        <div class="success-message" id="successMessage">
          <div class="success-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <h3>Pesan Berhasil Dikirim!</h3>
          <p>Tim kami akan menghubungi Anda dalam waktu 24 jam.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Info Section -->
  <section class="info-section">
    <div class="container">
      <div class="section-header">
        <h2>Informasi Kontak</h2>
        <p>Berbagai cara untuk terhubung dengan kami</p>
      </div>

      <div class="info-grid">
        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <h3>Alamat Kantor</h3>
          <p>Jl. Sudirman No. 123<br>Jakarta Pusat, 10220<br>Indonesia</p>
        </div>

        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-phone"></i>
          </div>
          <h3>Telepon</h3>
          <p>+62 21 1234 5678<br>+62 812 3456 7890</p>
        </div>

        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <h3>Email</h3>
          <p>hello@company.com<br>support@company.com</p>
        </div>

        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h3>Jam Operasional</h3>
          <p>Senin - Jumat: 09:00 - 18:00<br>Sabtu: 09:00 - 15:00<br>Minggu: Tutup</p>
        </div>

        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-globe"></i>
          </div>
          <h3>Website</h3>
          <p>www.company.com<br>www.portfolio.com</p>
        </div>

        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-comment"></i>
          </div>
          <h3>Media Sosial</h3>
          <p>@company_id<br>@companyofficial<br>LinkedIn: Company</p>
        </div>
      </div>

      <!-- Map placeholder -->
      <div class="map-card">
        <div class="map-placeholder">
          <i class="fas fa-map-marker-alt"></i>
          <h3>Lokasi Kantor Kami</h3>
          <p>Klik untuk membuka Google Maps</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <h3>Mari Berkolaborasi</h3>
        <p>Wujudkan ide kreatif Anda bersama tim profesional kami</p>
      </div>

      <div class="footer-bottom">
        <p>© 2024 Company Name. Seluruh hak cipta dilindungi.</p>
      </div>
    </div>
  </footer>

  <script src="contact.js"></script>
</body>

</html>