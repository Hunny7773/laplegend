<?php
include 'includes/dbconnection.php';
include 'includes/header.php';
?>

<?php
// Protect ticket booking: redirect if not logged in
$user_logged_in = isset($_SESSION['user_id']);
?>

<!-- ===== 1. Hero Section ===== -->
<section class="hero">
  <div class="hero-content">
    <h1>Upcoming <span>Races</span></h1>
    <p>Experience the thrill of Formula 1. Book your tickets before they run out!</p>
    <?php if($user_logged_in): ?>
      <a href="#race-list" class="btn-primary">Book Now</a>
    <?php else: ?>
      <a href="login.php" class="btn-primary">Login to Book</a>
    <?php endif; ?>
  </div>
</section>

<!-- ===== 2. Race Categories ===== -->
<section class="why-choose">
  <h2 class="section-title">Race Categories</h2>
  <div class="features">
    <div class="feature-box">
      <i class="fa-solid fa-flag-checkered"></i>
      <h3>Grand Prix</h3>
      <p>The main event: witness the fastest cars on iconic circuits.</p>
    </div>
    <div class="feature-box">
      <i class="fa-solid fa-bolt"></i>
      <h3>Time Trials</h3>
      <p>Practice sessions & qualifiers with top-tier F1 teams.</p>
    </div>
    <div class="feature-box">
      <i class="fa-solid fa-trophy"></i>
      <h3>VIP Packages</h3>
      <p>Premium seats, paddock access, and exclusive experiences.</p>
    </div>
  </div>
</section>

<!-- ===== 3. Race List ===== -->
<section id="race-list" class="upcoming-races">
  <h2 class="section-title">Upcoming Races</h2>
  <div class="race-grid">
    <?php
    $query = "SELECT * FROM races ORDER BY race_date ASC";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
      while($race = mysqli_fetch_assoc($result)){
        ?>
        <div class="race-card">
          <img src="assets/images/<?php echo $race['image']; ?>" alt="<?php echo $race['race_name']; ?>">
          <div class="race-info">
            <h3><?php echo $race['race_name']; ?></h3>
            <p>Date: <?php echo date('d M Y', strtotime($race['race_date'])); ?></p>
            <p>Location: <?php echo $race['location']; ?></p>
            <p class="price">Price: ₹<?php echo number_format($race['ticket_price']); ?></p>
            <?php if($user_logged_in): ?>
              <a href="book.php?race_id=<?php echo $race['race_id']; ?>" class="btn-primary">Book Now</a>
            <?php else: ?>
              <a href="login.php" class="btn-primary">Login to Book</a>
            <?php endif; ?>
          </div>
        </div>
        <?php
      }
    } else {
      echo '<p class="no-races">No upcoming races available at the moment.</p>';
    }
    ?>
  </div>
</section>

<!-- ===== 4. Race Info Section ===== -->
<section class="mission">
  <div class="container mission-grid">
    <div class="mission-img">
      <img src="assets/images/car.jpg" alt="Race Info">
    </div>
    <div class="mission-text">
      <h2>Race Experience</h2>
      <p>From the roar of engines to the adrenaline on the track, every race is an unforgettable journey. 
      Enjoy premium viewing areas, fan zones, and meet F1 legends in our VIP experiences.</p>
    </div>
  </div>
</section>

<!-- ===== 5. Fan Testimonials ===== -->
<section class="values">
  <div class="container">
    <h2 class="section-title">Fan Experiences</h2>
    <div class="value-grid">
      <div class="value-box">
        <i class="fa-solid fa-quote-left"></i>
        <h3>Rohit K.</h3>
        <p>"Attending the Monaco GP was a dream come true! Lap Legends made the whole process smooth and exciting."</p>
      </div>
      <div class="value-box">
        <i class="fa-solid fa-quote-left"></i>
        <h3>Ananya S.</h3>
        <p>"The VIP package was worth every penny. Amazing seats and access to the paddock!"</p>
      </div>
      <div class="value-box">
        <i class="fa-solid fa-quote-left"></i>
        <h3>Vikram P.</h3>
        <p>"Booking through Lap Legends is super easy, and the race atmosphere is electrifying."</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== 6. CTA Section ===== -->
<section class="cta">
  <div class="cta-content">
    <h2>Don’t Miss Your <span>Next Race</span></h2>
    <p>Book now and secure your spot for the most thrilling Formula 1 events!</p>
    <?php if($user_logged_in): ?>
      <a href="#race-list" class="btn-primary">Book Now</a>
    <?php else: ?>
      <a href="login.php" class="btn-primary">Login to Book</a>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
