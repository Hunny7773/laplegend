<?php
session_start();
include 'includes/dbconnection.php';


$message = '';

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $admin = mysqli_fetch_assoc($result);
        if(password_verify($password, $admin['password'])){
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: admin.php");
            exit();
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "Username not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
.login-container { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; }
h1 { color: #d90429; text-align: center; margin-bottom: 25px; }
input { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc; }
button { width: 100%; padding: 10px; background: #d90429; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
button:hover { background: #ff002b; }
.message { color: #d90429; font-weight: 600; margin-bottom: 15px; text-align: center; }
</style>
</head>
<body>

<div class="login-container">
<h1>Admin Login</h1>
<?php if($message != '') echo "<p class='message'>$message</p>"; ?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
</div>

</body>
</html>
