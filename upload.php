<?php
include "config.php";

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $video = $_FILES['video']['name'];
    $tmp = $_FILES['video']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $video);

    mysqli_query($conn, "INSERT INTO videos (title, filename) VALUES ('$title', '$video')");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Video</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="upload-container">
    <h2>🎬 Upload Your Video</h2>

    <form method="post" enctype="multipart/form-data">
        <label>Video Title</label>
        <input type="text" name="title" placeholder="Enter video title" required>

        <label>Choose Video</label>
        <input type="file" name="video" accept="video/*" required>

        <button name="upload">🚀 Upload Video</button>
    </form>
</div>

</body>
</html>
