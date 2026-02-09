<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>YouTube Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h2>YouTube Clone</h2>
    <div class="search-container">
        <input type="text" id="search" placeholder="Search videos..." autocomplete="off">
        <div id="suggestions"></div>
    </div>
    <a href="upload.php" class="upload-btn">Upload Video</a>
</header>

<div class="container" id="video-list">
<?php
$result = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="video-card">
        <a href="watch.php?id=<?php echo $row['id']; ?>">
            <video src="uploads/<?php echo $row['filename']; ?>" muted></video>
            <h4><?php echo $row['title']; ?></h4>
        </a>
    </div>
<?php } ?>
</div>

<script>
// ===== LIVE SEARCH =====
const searchInput = document.getElementById("search");
const suggestions = document.getElementById("suggestions");
const videoList = document.getElementById("video-list");

searchInput.addEventListener("input", function() {
    const query = this.value.trim();
    if(query.length === 0) {
        suggestions.innerHTML = "";
        loadAllVideos();
        return;
    }

    fetch("search.php?q=" + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {
        suggestions.innerHTML = "";
        data.forEach(video => {
            const div = document.createElement("div");
            div.classList.add("suggestion-item");
            div.textContent = video.title;
            div.onclick = () => {
                window.location.href = "watch.php?id=" + video.id;
            }
            suggestions.appendChild(div);
        });
        // Optional: filter video list as well
        displayFilteredVideos(data);
    });
});

// Load all videos (reset)
function loadAllVideos() {
    fetch("search.php?q=")
    .then(res => res.json())
    .then(data => {
        displayFilteredVideos(data);
    });
}

// Update video list dynamically
function displayFilteredVideos(videos) {
    videoList.innerHTML = "";
    videos.forEach(video => {
        const div = document.createElement("div");
        div.classList.add("video-card");
        div.innerHTML = `
            <a href="watch.php?id=${video.id}">
                <video src="uploads/${video.filename}" muted></video>
                <h4>${video.title}</h4>
            </a>
        `;
        videoList.appendChild(div);
    });
}
</script>

</body>
</html>
