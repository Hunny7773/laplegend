<?php
include 'includes/dbconnection.php';
include 'includes/header.php';
?>

<!-- ===== 1. About Hero Section ===== -->
<section class="about-hero">
  <div class="hero-overlay">
    <div class="hero-text">
      <h1>About <span>Lap Legends</span></h1>
      <p>Where passion meets the race track – experience Formula 1 like never before.</p>
    </div>
  </div>
</section>

<!-- ===== 2. Our Story Section ===== -->
<section class="our-story">
  <div class="container story-grid">
    <div class="story-text">
      <h2>Our Story</h2>
      <p>Lap Legends was born from a love of speed, precision, and the roar of engines. 
         We started as a small fan community and evolved into a global Formula 1 ticketing platform 
         connecting thousands of fans to the most electrifying races worldwide.</p>
      <p>From Monaco to Monza, we’ve made it our mission to deliver unforgettable F1 experiences that 
         bring you closer to the action than ever before.</p>
    </div>
    <div class="story-img">
      <img src="assets/images/story.jpg" alt="Our Story">
    </div>
  </div>
</section>

<!-- ===== 3. Our Mission Section ===== -->
<section class="mission">
  <div class="container mission-grid">
    <div class="mission-img">
      <img src="assets/images/mission.jpg" alt="Our Mission">
    </div>
    <div class="mission-text">
      <h2>Our Mission</h2>
      <p>To make Formula 1 ticket booking fast, reliable, and exciting — just like the sport itself. 
         Lap Legends empowers every fan to witness the world’s fastest cars, best drivers, and historic 
         circuits live, without barriers or complications.</p>
    </div>
  </div>
</section>

<!-- ===== 4. Our Values Section ===== -->
<section class="values">
  <div class="container">
    <h2 class="section-title">Our Core Values</h2>
    <div class="value-grid">
      <div class="value-box">
        <i class="fa-solid fa-flag-checkered"></i>
        <h3>Passion</h3>
        <p>We live and breathe motorsport — every race fuels our fire to serve fans better.</p>
      </div>
      <div class="value-box">
        <i class="fa-solid fa-lock"></i>
        <h3>Trust</h3>
        <p>Every ticket is authentic, every transaction secure. Your trust drives us forward.</p>
      </div>
      <div class="value-box">
        <i class="fa-solid fa-people-group"></i>
        <h3>Community</h3>
        <p>Lap Legends is more than a service — it’s a family of Formula 1 lovers around the world.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== 5. Team Section ===== -->
<section class="team">
  <div class="container">
    <h2 class="section-title">Meet the Team</h2>
    <div class="team-grid">
      <div class="team-member">
        <img src="assets/images/max.jpg" alt="Team Member">
        <h3>Pruthvi Rao</h3>
        <p>Founder & CEO</p>
      </div>
      <div class="team-member">
        <img src="assets/images/lewis.jpg" alt="Team Member">
        <h3>Riya Sharma</h3>
        <p>Marketing Head</p>
      </div>
      <div class="team-member">
        <img src="assets/images/russel.jpg" alt="Team Member">
        <h3>Arjun Mehta</h3>
        <p>Lead Developer</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== 6. Call-to-Action Section ===== -->
<section class="cta">
  <div class="cta-content">
    <h2>Join the <span>Lap Legends</span> Movement</h2>
    <p>Be part of the global Formula 1 fan experience. Book, cheer, and race with us.</p>
    <?php if(isset($_SESSION['user_id'])): ?>
      <a href="races.php" class="btn-primary">Explore Races</a>
    <?php else: ?>
      <a href="login.php" class="btn-primary">Join Now</a>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
