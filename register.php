<?php
include 'includes/header.php';
include 'includes/dbconnection.php';

$message = '';

if(isset($_POST['register'])){
    $fullname = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $message = "Email already registered!";
    } else {
        $insert = "INSERT INTO users (name, email, password) VALUES ('$fullname', '$email', '$password')";
        if(mysqli_query($conn, $insert)){
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_name'] = $fullname; // Use correct field
            header("Location: index.php");
            exit();
        } else {
            $message = "Registration failed. Try again.";
        }
    }
}

?>

<section class="hero">
    <div class="hero-content">
        <h1>Register <span>Account</span></h1>
    </div>
</section>

<section class="mission">
    <div class="container">
        <div class="mission-grid">
            <div class="mission-img">
                <img src="assets/images/registration.jpg" alt="Register">
            </div>
            <div class="mission-text">
                <h2>Create Your Account</h2>
                <?php if($message != '') echo '<p style="color:#d90429;">'.$message.'</p>'; ?>
                <form action="" method="POST">
                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="register" class="btn-primary">Register</button>
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
