<?php
include 'includes/dbconnection.php';
include 'includes/header.php';
?>

<!-- ===== 1. Hero Section ===== -->
<section class="hero">
    <div class="hero-content">
        <h1>Contact <span>Us</span></h1>
        <p>Get in touch with Lap Legends for ticket inquiries or support.</p>
    </div>
</section>

<!-- ===== 2. Contact Info ===== -->
<section class="mission">
    <div class="container mission-grid">
        <div class="mission-text">
            <h2>Our Contact Details</h2>
            <p><i class="fa-solid fa-phone"></i> Phone: +91 9876543210</p>
            <p><i class="fa-brands fa-whatsapp"></i> WhatsApp: +91 9876543210</p>
            <p><i class="fa-solid fa-envelope"></i> Email: support@laplegends.com</p>
        </div>
        <div class="mission-img">
            <img src="assets/images/contact.jpg" alt="Contact">
        </div>
    </div>
</section>

<!-- ===== 3. Map Section ===== -->
<section class="values">
    <div class="container">
        <h2 class="section-title">Our Location</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799144048!2d-74.2598676888863!3d40.69767006386918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQxJzQ2LjAiTiA3NMKwMTUnMzAuMCJX!5e0!3m2!1sen!2sin!4v1694146685840!5m2!1sen!2sin"
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<!-- ===== 4. Contact Form ===== -->
<section class="mission">
    <div class="container mission-grid">
        <div class="mission-img">
            <img src="assets/images/contactform.png" alt="Contact Form">
        </div>
        <div class="mission-text">
            <h2>Send Us a Message</h2>
            <form action="" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit" class="btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</section>

<!-- ===== 5. Social Links ===== -->
<section class="values">
    <div class="container">
        <h2 class="section-title">Follow Us</h2>
        <div class="value-grid">
            <a href="#" class="value-box"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#" class="value-box"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#" class="value-box"><i class="fab fa-instagram"></i> Instagram</a>
        </div>
    </div>
</section>

<!-- ===== 6. CTA Section ===== -->
<section class="cta">
    <div class="cta-content">
        <h2>Book Your <span>F1 Tickets</span> Now!</h2>
        <p>Don’t miss out on the most thrilling Formula 1 experiences.</p>
        <a href="races.php" class="btn-primary">Book Now</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
