<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$category_url = $_GET['category'] ?? '';
$category_url = $conn->real_escape_string($category_url);

// Get selected category ID
$category_id = null;
if ($category_url) {
  $cat = $conn->query("SELECT key_categories FROM categories 
                       WHERE url = '$category_url' AND status = 'on' AND category_type = 'video_gallery'")->fetch_assoc();
  $category_id = $cat['key_categories'] ?? null;
}

startLayout("YouTube Gallery");

?>

<div id="content">
	<h1>YouTube Gallery</h1>
	
	<!-- Category Tags -->
	<div class="category-tags">
	  <?php
	  $cats = $conn->query("SELECT name, url FROM categories 
							WHERE status = 'on' AND category_type = 'video_gallery' 
							ORDER BY sort");
	  while ($c = $cats->fetch_assoc()) {
		$active = ($c['url'] === $category_url) ? "style='font-weight:bold;'" : "";
		echo "<a href='/youtube-gallery?category={$c['url']}' class='tag' $active>" . htmlspecialchars($c['name']) . "</a> &nbsp; ";
	  }
	  ?>
	</div>
	<br>

	<?php
	// Fetch videos
	$sql = "SELECT y.title, y.youtube_id, y.description 
			FROM youtube_gallery y 
			WHERE y.status = 'on'";

	if ($category_id) {
	  $sql .= " AND EXISTS (
				  SELECT 1 FROM youtube_categories yc 
				  WHERE yc.key_youtube_gallery = y.key_youtube_gallery 
				  AND yc.key_categories = $category_id
				)";
	}

	$sql .= " ORDER BY y.entry_date_time DESC";

	$res = $conn->query($sql);

	echo "<div class='flex-wrap-center'>";
	while ($v = $res->fetch_assoc()) {
		echo '<div>';
		$thumb = "https://img.youtube.com/vi/{$v['youtube_id']}/hqdefault.jpg";
		$title = htmlspecialchars($v['title']);
		$desc = htmlspecialchars($v['description']);
		echo "<div class='video-card'>
				<img src='$thumb' width='300' onclick=\"openModal('{$v['youtube_id']}', '$title', '$desc')\">
				<h3>$title</h3>
			</div>";
		echo '</div>';
	}
	echo "</div>";
	?>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>




<!-- Modal -->
<div id="videoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:#000000cc; z-index:9999;">
	<div style="position:relative; width:80%; max-width:800px; margin:5% auto; background:#fff; padding:20px;">
		<span onclick="closeModal()" style="position:absolute; top:10px; right:20px; cursor:pointer; font-size:24px;">&times;</span>
		<h2 id="videoTitle"></h2>
		<iframe id="videoFrame" width="100%" height="450" frameborder="0" allowfullscreen></iframe>
		<p id="videoDesc" style="margin-top:10px;"></p>
	</div>
</div>

<script>
function openModal(videoId, title, desc) {
	document.getElementById('videoFrame').src = "https://www.youtube.com/embed/" + videoId + "?autoplay=1";
	document.getElementById('videoTitle').innerText = title;
	document.getElementById('videoDesc').innerText = desc;
	document.getElementById('videoModal').style.display = 'block';
}
function closeModal() {
	document.getElementById('videoFrame').src = "";
	document.getElementById('videoModal').style.display = 'none';
}
</script>

<?php endLayout(); ?>
