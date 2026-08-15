<?php
include 'includes/dbconnection.php';
include 'includes/header.php';
?>

<!-- ===== 1. Hero Section ===== -->
<section class="hero">
  <div class="hero-content">
    <h1>Experience the <span>Thrill of Speed</span></h1>
    <p>Book your Formula 1 tickets now and feel the rush of Lap Legends!</p>
    <?php if(isset($_SESSION['user_id'])): ?>
      <a href="races.php" class="btn-primary">Book Tickets</a>
    <?php else: ?>
      <a href="login.php" class="btn-primary">Login to Book</a>
    <?php endif; ?>
  </div>
</section>

<!-- ===== 2. Upcoming Races Section ===== -->
<section class="races">
  <div class="container">
    <h2 class="section-title">Upcoming Races</h2>

    <div class="race-grid">
      <?php
      $query = "SELECT * FROM races ORDER BY race_date ASC LIMIT 3";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo '
              <div class="race-card">
                <img src="assets/images/monaco.jpg' . $row['image'] . '" alt="' . $row['race_name'] . '">
                <div class="race-info">
                  <h3>' . $row['race_name'] . '</h3>
                  <p><i class="fa-solid fa-location-dot"></i> ' . $row['location'] . '</p>
                  <p><i class="fa-regular fa-calendar"></i> ' . date("F j, Y", strtotime($row['race_date'])) . '</p>
                  <p class="price">₹' . number_format($row['ticket_price'], 2) . '</p>
                  ';
                  if(isset($_SESSION['user_id'])) {
                    echo '<a href="book.php?race_id=' . $row['race_id'] . '" class="btn-primary">Book Now</a>';
                  } else {
                    echo '<a href="login.php" class="btn-primary">Login to Book</a>';
                  }
              echo '</div></div>';
          }
      } else {
          echo "<p class='no-races'>No upcoming races at the moment.</p>";
      }
      ?>
    </div>
  </div>
</section>

<!-- ===== 3. About Lap Legends Section ===== -->
<section class="about-home">
  <div class="container about-grid">
    <div class="about-text">
      <h2>About <span>Lap Legends</span></h2>
      <p>Lap Legends is your gateway to the world’s most thrilling Formula 1 experiences. We make it effortless to reserve your seats at the fastest circuits across the globe. Whether you’re a lifelong fan or new to the sport, Lap Legends ensures you never miss a race-day heartbeat.</p>
      <a href="about.php" class="btn-primary">Learn More</a>
    </div>
    <div class="about-img">
      <img src="assets/images/car.jpg" alt="About Lap Legends">
    </div>
  </div>
</section>

<!-- ===== 4. Why Choose Us Section ===== -->
<section class="why-choose">
  <div class="container">
    <h2 class="section-title">Why Choose Us</h2>
    <div class="features">
      <div class="feature-box">
        <i class="fa-solid fa-ticket"></i>
        <h3>Easy Booking</h3>
        <p>Reserve your tickets in just a few clicks with our smooth online process.</p>
      </div>
      <div class="feature-box">
        <i class="fa-solid fa-helmet-safety"></i>
        <h3>Authentic Events</h3>
        <p>Access official F1 races and premium seating directly from trusted sources.</p>
      </div>
      <div class="feature-box">
        <i class="fa-solid fa-users"></i>
        <h3>Community of Fans</h3>
        <p>Join thousands of racing enthusiasts who live for the thrill of the track.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== 5. Gallery Preview Section ===== -->
<section class="gallery-preview">
  <div class="container">
    <h2 class="section-title">Race Moments</h2>
    <div class="gallery-grid">
      <img src="assets/images/r1.jpg" alt="Race 1">
      <img src="assets/images/r2.jpg" alt="Race 2">
      <img src="assets/images/r3.jpg" alt="Race 3">
      <img src="assets/images/r4.jpg" alt="Race 4">
    </div>
    <div class="center-btn">
      <a href="gallery.php" class="btn-primary">View Full Gallery</a>
    </div>
  </div>
</section>

<!-- ===== 6. Contact / CTA Section ===== -->
<section class="cta">
  <div class="cta-content">
    <h2>Ready to Feel the <span>Adrenaline?</span></h2>
    <p>Get your Formula 1 tickets today and be part of the Lap Legends experience!</p>
    <?php if(isset($_SESSION['user_id'])): ?>
      <a href="races.php" class="btn-primary">Book Now</a>
    <?php else: ?>
      <a href="login.php" class="btn-primary">Login to Get Started</a>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
