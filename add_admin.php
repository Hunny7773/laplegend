<?php
include 'includes/dbconnection.php';

$message = '';

if(isset($_POST['add_admin'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if username already exists
    $check = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");
    if(mysqli_num_rows($check) > 0){
        $message = "Username already exists!";
    } else {
        $insert = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";
        if(mysqli_query($conn, $insert)){
            $message = "Admin added successfully!";
        } else {
            $message = "Error adding admin!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Admin</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
.container { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; }
h1 { color: #d90429; text-align: center; margin-bottom: 25px; }
input { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc; }
button { width: 100%; padding: 10px; background: #d90429; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
button:hover { background: #ff002b; }
.message { color: #d90429; font-weight: 600; margin-bottom: 15px; text-align: center; }
</style>
</head>
<body>

<div class="container">
<h1>Add Admin</h1>
<?php if($message != '') echo "<p class='message'>$message</p>"; ?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="add_admin">Add Admin</button>
</form>
</div>

</body>
</html>
