<?php
include 'includes/dbconnection.php';
include 'includes/header.php';

// Redirect if user not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Get race ID from URL
if(!isset($_GET['race_id'])){
    header("Location: races.php");
    exit();
}

$race_id = intval($_GET['race_id']);
$user_id = $_SESSION['user_id'];

// Fetch race details
$race_query = "SELECT * FROM races WHERE race_id = $race_id LIMIT 1";
$race_result = mysqli_query($conn, $race_query);
if(mysqli_num_rows($race_result) == 0){
    echo "<p class='no-races'>Race not found.</p>";
    include 'includes/footer.php';
    exit();
}

$race = mysqli_fetch_assoc($race_result);

// Handle form submission
$message = '';
if(isset($_POST['book_ticket'])){
    $quantity = intval($_POST['quantity']);
    $total_price = $race['ticket_price'] * $quantity;

    $insert_query = "INSERT INTO bookings (user_id, race_id, quantity, total_price, booking_date) 
                     VALUES ('$user_id', '$race_id', '$quantity', '$total_price', NOW())";

    if(mysqli_query($conn, $insert_query)){
        $message = "Ticket booked successfully! Total: ₹" . number_format($total_price);
    } else {
        $message = "Error booking ticket. Please try again.";
    }
}
?>

<!-- ===== Booking Hero ===== -->
<section class="hero">
    <div class="hero-content">
        <h1>Book Tickets for <span><?php echo $race['race_name']; ?></span></h1>
        <p>Location: <?php echo $race['location']; ?> | Date: <?php echo date('d M Y', strtotime($race['race_date'])); ?></p>
    </div>
</section>

<!-- ===== Booking Form ===== -->
<section class="mission">
    <div class="container">
        <div class="mission-grid">
            <div class="mission-img">
                <img src="assets/images/races/<?php echo $race['image']; ?>" alt="<?php echo $race['race_name']; ?>">
            </div>
            <div class="mission-text">
                <h2>Reserve Your Tickets</h2>
                <?php if($message != ''): ?>
                    <p style="color: #d90429; font-weight: 600;"><?php echo $message; ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <label for="quantity">Number of Tickets:</label>
                    <input type="number" name="quantity" id="quantity" min="1" max="10" value="1" required>
                    <p>Price per Ticket: ₹<?php echo number_format($race['ticket_price']); ?></p>
                    <button type="submit" name="book_ticket" class="btn-primary">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
