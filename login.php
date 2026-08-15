<?php
include 'includes/header.php';
include 'includes/dbconnection.php';

$message = '';

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name']; // Matches your table column
            header("Location: index.php");
            exit();
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "Email not registered!";
    }
}

?>

<section class="hero">
    <div class="hero-content">
        <h1>Login <span>Account</span></h1>
    </div>
</section>

<section class="mission">
    <div class="container">
        <div class="mission-grid">
            <div class="mission-img">
                <img src="assets/images/login.png" alt="Login">
            </div>
            <div class="mission-text">
                <h2>Welcome Back</h2>
                <?php if($message != '') echo '<p style="color:#d90429;">'.$message.'</p>'; ?>
                <form action="" method="POST">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login" class="btn-primary">Login</button>
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
