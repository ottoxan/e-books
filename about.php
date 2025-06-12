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
         <i class="fas fa-users"></i>
       </div>
     </div>

     <h1 class="hero-title">
       <?= __('About') ?>
       <span class="highlight"><?= __('Us') ?></span>
     </h1>

     <p class="hero-subtitle">
       <?= __('We are a creative team dedicated to delivering the best and most innovative digital solutions for your business.') ?>
     </p>

     <div class="hero-features">
       <div class="feature">
         <i class="fas fa-rocket"></i>
         <span><?= __('Innovative Solutions') ?></span>
       </div>
       <div class="divider"></div>
       <div class="feature">
         <i class="fas fa-heart"></i>
         <span><?= __('Passion for Excellence') ?></span>
       </div>
     </div>
   </div>
 </section>

 <!-- Company Story Section -->
 <section class="story-section">
   <div class="container">
     <div class="story-card">
       <div class="story-header">
         <h2><?= __('Our Story') ?></h2>
         <p><?= __('Our Journey to Success Together') ?></p>
       </div>

       <div class="story-content">
         <div class="story-text">
           <h3><?= __('Starting with Big Dreams') ?></h3>
           <p>
             <?= __('Founded in 2025, our company started with a simple dream to create digital solutions that can transform the way businesses operate. With a team of experienced professionals, we are committed to providing the best service to every client.') ?>

           </p>

           <h3><?= __('Vision & Mission') ?></h3>
           <p>
             <strong><?= __('Our Vision') ?>: </strong><?= __('Our vision is to be a trusted partner in digital transformation, creating a better future.') ?>
           </p>
           <p>
             <strong><?= __('Our Mission') ?>: </strong><?= __('We strive to be a leader in the digital solutions industry, continuously pushing the boundaries of what is possible.') ?>
           </p>
         </div>
       </div>

       <div class="achievements">
         <div class="achievement-item">
           <div class="achievement-number">50+</div>
           <div class="achievement-label"><?= __('Finised Projects') ?></div>
         </div>
         <div class="achievement-item">
           <div class="achievement-number">30+</div>
           <div class="achievement-label"><?= __('Satisfied Clients') ?></div>
         </div>
         <div class="achievement-item">
           <div class="achievement-number">4</div>
           <div class="achievement-label"><?= __('Years of Experience') ?></div>
         </div>
         <div class="achievement-item">
           <div class="achievement-number">24/7</div>
           <div class="achievement-label"><?= __('Support') ?></div>
         </div>
       </div>
     </div>
   </div>
 </section>

 <!-- Values Section -->
 <section class="values-section">
   <div class="container">
     <div class="section-header">
       <h2><?= __('Our Values') ?></h2>
       <p><?= __('Principles that guide our work and relationships.') ?></p>
     </div>

     <div class="values-grid">
       <div class="value-card">
         <div class="value-icon">
           <i class="fas fa-lightbulb"></i>
         </div>
         <h3><?= __('Inovation') ?></h3>
         <p><?= __('We believe in continuous innovation to provide the best solutions.') ?></p>
       </div>

       <div class="value-card">
         <div class="value-icon">
           <i class="fas fa-handshake"></i>
         </div>
         <h3><?= __('Integrity') ?></h3>
         <p><?= __('We uphold integrity in every action and decision.') ?></p>
       </div>

       <div class="value-card">
         <div class="value-icon">
           <i class="fas fa-users"></i>
         </div>
         <h3><?= __('Collaboration') ?></h3>
         <p><?= __('We work together to achieve common goals.') ?></p>
       </div>

       <div class="value-card">
         <div class="value-icon">
           <i class="fas fa-target"></i>
         </div>
         <h3><?= __('Excellence') ?></h3>
         <p><?= __('We strive for excellence in everything we do.') ?></p>
       </div>

       <div class="value-card">
         <div class="value-icon">
           <i class="fas fa-clock"></i>
         </div>
         <h3><?= __('Efficiency') ?></h3>
         <p><?= __('We focus on efficiency to maximize results.') ?></p>
       </div>

       <div class="value-card">
         <div class="value-icon">
           <i class="fas fa-shield-alt"></i>
         </div>
         <h3><?= __('Security') ?></h3>
         <p><?= __('We prioritize the security and privacy of our clients.') ?></p>
       </div>
     </div>
   </div>
 </section>

 <!-- Team Section -->
 <section class="team-section">
   <div class="container">
     <div class="section-header">
       <h2><?= __('Our Team') ?></h2>
       <p><?= __('Meet the talented individuals behind our success.') ?></p>
     </div>

     <div class="team-grid">
       <div class="team-card">
         <div class="team-photo">
           <div class="photo-placeholder">
             <i class="fas fa-user"></i>
           </div>
         </div>
         <h3>Usman Bin Affan</h3>
         <p class="role">CEO & Founder</p>
         <p class="description"><?= __('Visioner with a passion for technology and innovation.') ?></p>
       </div>

       <div class="team-card">
         <div class="team-photo">
           <div class="photo-placeholder">
             <i class="fas fa-user"></i>
           </div>
         </div>
         <h3>Hilmi Yahya</h3>
         <p class="role">CTO</p>
         <p class="description"><?= __('Expert in Website development') ?></p>
       </div>

       <div class="team-card">
         <div class="team-photo">
           <div class="photo-placeholder">
             <i class="fas fa-user"></i>
           </div>
         </div>
         <h3>Rahma</h3>
         <p class="role">Lead Designer</p>
         <p class="description"><?= __('Specialist in UI/UX with passion and user friendly designs') ?></p>
       </div>

       <div class="team-card">
         <div class="team-photo">
           <div class="photo-placeholder">
             <i class="fas fa-user"></i>
           </div>
         </div>
         <h3>Badriyah</h3>
         <p class="role">Project Manager</p>
         <p class="description"><?= __('Project coordinator with efficiency and effectiveness') ?></p>
       </div>
     </div>
   </div>
 </section>

 <?php include "partials/footer.php" ?>