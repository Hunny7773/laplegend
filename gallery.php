<?php
include 'includes/dbconnection.php';
include 'includes/header.php';
?>

<!-- ===== 1. Hero Section ===== -->
<section class="hero">
    <div class="hero-content">
        <h1>Our <span>Gallery</span></h1>
        <p>Relive the excitement of Formula 1 with our photo gallery.</p>
    </div>
</section>

<!-- ===== 2. Gallery Categories ===== -->
<section class="why-choose">
    <h2 class="section-title">Gallery Categories</h2>
    <div class="features">
        <div class="feature-box">
            <i class="fa-solid fa-flag-checkered"></i>
            <h3>Race Moments</h3>
            <p>Catch the adrenaline of live races and podium celebrations.</p>
        </div>
        <div class="feature-box">
            <i class="fa-solid fa-camera"></i>
            <h3>Fan Zone</h3>
            <p>Snapshots of fans cheering and enjoying the races.</p>
        </div>
        <div class="feature-box">
            <i class="fa-solid fa-user-tie"></i>
            <h3>Behind the Scenes</h3>
            <p>Exclusive photos of teams, pit stops, and race prep.</p>
        </div>
    </div>
</section>

<!-- ===== 3. Photo Gallery ===== -->
<section class="gallery-preview">
    <div class="container">
        <h2 class="section-title">Photo Gallery</h2>
        <div class="gallery-grid">
            <?php
            $gallery_query = "SELECT * FROM gallery ORDER BY id DESC";
            $gallery_result = mysqli_query($conn, $gallery_query);

            if(mysqli_num_rows($gallery_result) > 0){
                while($photo = mysqli_fetch_assoc($gallery_result)){
                    echo '<img src="assets/images/gallery/'.$photo['image'].'" alt="'.$photo['title'].'">';
                }
            } else {
                echo '<p class="no-races">No photos available at the moment.</p>';
            }
            ?>
        </div>
    </div>
</section>

<!-- ===== 4. Fan Testimonials ===== -->
<section class="values">
    <div class="container">
        <h2 class="section-title">Fan Testimonials</h2>
        <div class="value-grid">
            <div class="value-box">
                <i class="fa-solid fa-quote-left"></i>
                <h3>Rohit K.</h3>
                <p>"The gallery brings back memories of the races. Amazing shots!"</p>
            </div>
            <div class="value-box">
                <i class="fa-solid fa-quote-left"></i>
                <h3>Ananya S.</h3>
                <p>"I love seeing fan moments and behind-the-scenes pictures."</p>
            </div>
            <div class="value-box">
                <i class="fa-solid fa-quote-left"></i>
                <h3>Vikram P.</h3>
                <p>"Every photo shows the energy and thrill of F1 races."</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== 5. CTA Section ===== -->
<section class="cta">
    <div class="cta-content">
        <h2>Don’t Miss Your <span>Next Race</span></h2>
        <p>Book now and become a part of these unforgettable moments!</p>
        <a href="car.jpg" class="btn-primary">Book Now</a>
    </div>
</section>

<!-- ===== 6. Social Media Highlights ===== -->
<section class="values">
    <div class="container">
        <h2 class="section-title">Follow Us on Instagram</h2>
        <div class="gallery-grid">
            <?php
            // Fetch latest 6 Instagram posts from gallery table
            $insta_query = "SELECT * FROM gallery ORDER BY id DESC LIMIT 6";
            $insta_result = mysqli_query($conn, $insta_query);

            if(mysqli_num_rows($insta_result) > 0){
                while($insta = mysqli_fetch_assoc($insta_result)){
                    echo '<a href="#"><img src="assets/images/gallery/'.$insta['image'].'" alt="'.$insta['title'].'"></a>';
                }
            } else {
                echo '<p class="no-races">No social media highlights available.</p>';
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
