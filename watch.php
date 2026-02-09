<?php
include "config.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM videos WHERE id=$id");
$video = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $video['title']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2><?php echo $video['title']; ?></h2>

<video width="800" controls>
    <source src="uploads/<?php echo $video['filename']; ?>" type="video/mp4">
</video>

<br><br>
<a href="index.php">⬅ Back</a>

</body>
</html>
