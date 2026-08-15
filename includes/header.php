<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lap Legends - Formula 1 Ticket Reservation</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ===== Navigation Bar ===== -->
<header class="navbar">
  <div class="container">
    <h1 class="logo"><a href="index.php">Lap<span>Legends</span></a></h1>

    <nav>
      <ul class="nav-links">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="races.php">Races</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="contact.php">Contact</a></li>

        <?php if(isset($_SESSION['user_id'])): ?>
          <li><a href="logout.php" class="btn">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php" class="btn">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
