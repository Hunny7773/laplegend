<?php
session_start();
include 'includes/dbconnection.php';

// Admin login check
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$message = '';

// -----------------------
// HANDLE RACES FORM
// -----------------------
if(isset($_POST['add_race'])){
    $race_name = mysqli_real_escape_string($conn, $_POST['race_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $race_date = $_POST['race_date'];
    $ticket_price = $_POST['ticket_price'];

    $image = $_FILES['race_image']['name'];
    $tmp_name = $_FILES['race_image']['tmp_name'];
    $image_path = '../assets/images/races/' . $image;
    move_uploaded_file($tmp_name, $image_path);

    $insert_race = "INSERT INTO races (race_name, location, race_date, ticket_price, image)
                    VALUES ('$race_name', '$location', '$race_date', '$ticket_price', '$image')";
    $message = mysqli_query($conn, $insert_race) ? "Race added successfully!" : "Failed to add race!";
}

// -----------------------
// HANDLE EDIT RACE
// -----------------------
if(isset($_POST['edit_race'])){
    $race_id = intval($_POST['race_id']);
    $race_name = mysqli_real_escape_string($conn, $_POST['race_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $race_date = $_POST['race_date'];
    $ticket_price = $_POST['ticket_price'];

    // Check if new image uploaded
    if($_FILES['race_image']['name']){
        $image = $_FILES['race_image']['name'];
        $tmp_name = $_FILES['race_image']['tmp_name'];
        $image_path = '../assets/images/races/' . $image;
        move_uploaded_file($tmp_name, $image_path);
        $update_race = "UPDATE races SET race_name='$race_name', location='$location', race_date='$race_date', ticket_price='$ticket_price', image='$image' WHERE race_id=$race_id";
    } else {
        $update_race = "UPDATE races SET race_name='$race_name', location='$location', race_date='$race_date', ticket_price='$ticket_price' WHERE race_id=$race_id";
    }

    $message = mysqli_query($conn, $update_race) ? "Race updated successfully!" : "Failed to update race!";
}

// -----------------------
// HANDLE GALLERY FORM
// -----------------------
if(isset($_POST['add_gallery'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image_file = $_FILES['image_file']['name'];
    $tmp_name = $_FILES['image_file']['tmp_name'];
    $upload_path = '../assets/images/gallery/' . $image_file;
    move_uploaded_file($tmp_name, $upload_path);

    $insert_gallery = "INSERT INTO gallery (title, image) VALUES ('$title', '$image_file')";
    $message = mysqli_query($conn, $insert_gallery) ? "Gallery image added successfully!" : "Failed to add gallery image!";
}

// -----------------------
// HANDLE EDIT GALLERY
// -----------------------
if(isset($_POST['edit_gallery'])){
    $id = intval($_POST['gallery_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);

    if($_FILES['image_file']['name']){
        $image_file = $_FILES['image_file']['name'];
        $tmp_name = $_FILES['image_file']['tmp_name'];
        $upload_path = '../assets/images/gallery/' . $image_file;
        move_uploaded_file($tmp_name, $upload_path);
        $update_gallery = "UPDATE gallery SET title='$title', image='$image_file' WHERE id=$id";
    } else {
        $update_gallery = "UPDATE gallery SET title='$title' WHERE id=$id";
    }

    $message = mysqli_query($conn, $update_gallery) ? "Gallery updated successfully!" : "Failed to update gallery!";
}

// -----------------------
// HANDLE DELETE
// -----------------------
if(isset($_GET['delete_race'])){
    $id = intval($_GET['delete_race']);
    mysqli_query($conn, "DELETE FROM races WHERE race_id=$id");
    header("Location: admin.php");
    exit();
}

if(isset($_GET['delete_gallery'])){
    $id = intval($_GET['delete_gallery']);
    mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");
    header("Location: admin.php");
    exit();
}

// -----------------------
// FETCH DATA
// -----------------------
$races = mysqli_query($conn, "SELECT * FROM races ORDER BY race_date DESC");
$gallery = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");

// Get data for editing if requested
$edit_race_data = null;
$edit_gallery_data = null;
if(isset($_GET['edit_race'])){
    $race_id = intval($_GET['edit_race']);
    $edit_race_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM races WHERE race_id=$race_id"));
}

if(isset($_GET['edit_gallery'])){
    $gallery_id = intval($_GET['edit_gallery']);
    $edit_gallery_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gallery WHERE id=$gallery_id"));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<style>
body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
.container { width: 90%; max-width: 1200px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);}
h1, h2 { color: #d90429; }
form input, form button { padding: 8px; margin: 5px 0; border-radius: 4px; border: 1px solid #ccc; }
form button { background: #d90429; color: #fff; border: none; cursor: pointer; }
form button:hover { background: #ff002b; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
table, th, td { border: 1px solid #ccc; }
th, td { padding: 8px; text-align: center; }
img { border-radius: 5px; }
a { color: #d90429; text-decoration: none; }
a:hover { text-decoration: underline; }
.message { color: green; font-weight: 600; }
section { margin-top: 40px; }
</style>
</head>
<body>

<div class="container">
<h1>Admin Panel</h1>
<p style="text-align:right;">
    Logged in as <strong><?php echo $_SESSION['admin_username']; ?></strong> | 
    <a href="admin_logout.php" style="color:#d90429; text-decoration:none;">Logout</a>
</p>

<?php if($message != '') echo "<p class='message'>$message</p>"; ?>

<!-- ===== RACES SECTION ===== -->
<section>
<h2>Manage Races</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="race_id" value="<?php echo $edit_race_data['race_id'] ?? ''; ?>">
    <input type="text" name="race_name" placeholder="Race Name" value="<?php echo $edit_race_data['race_name'] ?? ''; ?>" required>
    <input type="text" name="location" placeholder="Location" value="<?php echo $edit_race_data['location'] ?? ''; ?>" required>
    <input type="date" name="race_date" value="<?php echo $edit_race_data['race_date'] ?? ''; ?>" required>
    <input type="number" step="0.01" name="ticket_price" placeholder="Ticket Price" value="<?php echo $edit_race_data['ticket_price'] ?? ''; ?>" required>
    <input type="file" name="race_image">
    <button type="submit" name="<?php echo isset($edit_race_data) ? 'edit_race' : 'add_race'; ?>">
        <?php echo isset($edit_race_data) ? 'Update Race' : 'Add Race'; ?>
    </button>
    <?php if(isset($edit_race_data)): ?><a href="admin.php">Cancel Edit</a><?php endif; ?>
</form>

<table>
<tr>
<th>ID</th><th>Name</th><th>Location</th><th>Date</th><th>Price</th><th>Image</th><th>Actions</th>
</tr>
<?php while($race = mysqli_fetch_assoc($races)): ?>
<tr>
<td><?php echo $race['race_id']; ?></td>
<td><?php echo $race['race_name']; ?></td>
<td><?php echo $race['location']; ?></td>
<td><?php echo $race['race_date']; ?></td>
<td>₹<?php echo number_format($race['ticket_price']); ?></td>
<td><img src="assets/images/races/<?php echo $race['image']; ?>" width="80"></td>
<td>
<a href="admin.php?edit_race=<?php echo $race['race_id']; ?>">Edit</a> |
<a href="admin.php?delete_race=<?php echo $race['race_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</section>

<!-- ===== GALLERY SECTION ===== -->
<section>
<h2>Manage Gallery</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="gallery_id" value="<?php echo $edit_gallery_data['id'] ?? ''; ?>">
    <input type="text" name="title" placeholder="Image Title" value="<?php echo $edit_gallery_data['title'] ?? ''; ?>" required>
    <input type="file" name="image_file">
    <button type="submit" name="<?php echo isset($edit_gallery_data) ? 'edit_gallery' : 'add_gallery'; ?>">
        <?php echo isset($edit_gallery_data) ? 'Update Image' : 'Add Image'; ?>
    </button>
    <?php if(isset($edit_gallery_data)): ?><a href="admin.php">Cancel Edit</a><?php endif; ?>
</form>

<table>
<tr>
<th>ID</th><th>Title</th><th>Image</th><th>Actions</th>
</tr>
<?php while($img = mysqli_fetch_assoc($gallery)): ?>
<tr>
<td><?php echo $img['id']; ?></td>
<td><?php echo $img['title']; ?></td>
<td><img src="../assets/images/gallery/<?php echo $img['image']; ?>" width="80"></td>
<td>
<a href="admin.php?edit_gallery=<?php echo $img['id']; ?>">Edit</a> |
<a href="admin.php?delete_gallery=<?php echo $img['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</section>

</div>
</body>
</html>
