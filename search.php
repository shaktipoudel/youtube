<?php

include "config.php";

$q = isset($_GET['q']) ? $_GET['q'] : "";

if($q !== "") {
    $q = mysqli_real_escape_string($conn, $q);
    $sql = "SELECT * FROM videos WHERE title LIKE '%$q%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM videos ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
$videos = [];

while($row = mysqli_fetch_assoc($result)) {
    $videos[] = [
        "id" => $row['id'],
        "title" => $row['title'],
        "filename" => $row['filename']
    ];
}

header('Content-Type: application/json');
echo json_encode($videos);
