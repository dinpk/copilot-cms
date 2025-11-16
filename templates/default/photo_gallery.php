<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$category_url = $_GET['category'] ?? '';
$category_url = $conn->real_escape_string($category_url);


// Get selected category ID
$category_id = null;
if ($category_url) {
  $cat = $conn->query("SELECT key_categories FROM categories 
                       WHERE url = '$category_url' AND is_active = 1 AND category_type = 'photo_gallery'")->fetch_assoc();
  $category_id = $cat['key_categories'] ?? null;
}

startLayout(getSetting('photo_gallery_label'));

?>
<div id="content">

	<h1><?= getSetting('photo_gallery_label') ?></h1>
	<!-- Category Filters -->
	<div class="category-tags">
	  <?php
	  $cats = $conn->query("SELECT name, url FROM categories 
							WHERE is_active = 1 AND category_type = 'photo_gallery' 
							ORDER BY sort");
	  while ($c = $cats->fetch_assoc()) {
		$active = ($c['url'] === $category_url) ? "style='font-weight:bold;'" : "";
		echo "<a href='/photo-gallery?category={$c['url']}' class='tag' $active>" . htmlspecialchars($c['name']) . "</a> &nbsp; ";
	  }
	  ?>
	</div>
	<br>

	<!-- Album Grid -->
	<?php
	$page = max(1, intval($_GET['page'] ?? 1));
	$limit = 6;
	$offset = ($page - 1) * $limit;
	$sql = "SELECT key_photo_gallery, title, image_url FROM photo_gallery WHERE is_active = 1";
	if ($category_id) {
	  $sql .= " AND EXISTS (
				  SELECT 1 FROM photo_categories pc 
				  WHERE pc.key_photo_gallery = photo_gallery.key_photo_gallery 
				  AND pc.key_categories = $category_id
				)";
	}
	$sql .= " ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$res = $conn->query($sql);

	echo "<div class='flex-wrap-center'>";
	while ($a = $res->fetch_assoc()) {
		echo '<div>';
		$thumb = $a['image_url'];
		$title = htmlspecialchars($a['title']);
		$id = $a['key_photo_gallery'];
		echo "<div class='album-card'>
				<img src='$thumb' width='300' onclick=\"loadAlbum($id, '$title')\">
				<h3>$title</h3>
			</div>";
		echo '</div>';
	}
	echo "</div>";

	// Pagination
	$countSql = "SELECT COUNT(*) AS total FROM photo_gallery WHERE is_active = 1";
	if ($category_id) {
		$countSql .= " AND EXISTS (
						SELECT 1 FROM photo_categories pc 
						WHERE pc.key_photo_gallery = photo_gallery.key_photo_gallery 
						AND pc.key_categories = $category_id
					)";
	}
	$total = $conn->query($countSql)->fetch_assoc()['total'];
	$totalPages = ceil($total / $limit);

	echo "<div id='pager'>";
	if ($page > 1) {
		echo "<a href='?page=" . ($page - 1) . "&category=" . urlencode($category_url) . "'>⬅ Prev</a> ";
	}
	echo "Page $page of $totalPages ";
	if ($page < $totalPages) {
		echo "<a href='?page=" . ($page + 1) . "&category=" . urlencode($category_url) . "'>Next ➡</a>";
	}
	echo "</div>";
	?>

</div>



<!-- Modal Viewer with Arrows -->
<div id="albumModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:#000000cc; z-index:9999;">
	<div style="position:relative; width:90vw; height:90vh; margin:3% auto; background:#fff; padding:20px; border-radius:8px;overflow:auto;">
		<span onclick="closeAlbum()" style="position:absolute; top:10px; right:20px; cursor:pointer; font-size:24px;">&times;</span>
		<h2 id="albumTitle"></h2>
		<div style="position:relative;">
			<button onclick="prevImage()" style="position:absolute; left:0; top:35vh; transform:translateY(-50%); font-size:24px;">⬅</button>
			<img id="albumImage" src="" alt="" style="max-width:90%; max-height:75vh; display:block; margin:10px auto;">
			<button onclick="nextImage()" style="position:absolute; right:0; top:35vh; transform:translateY(-50%); font-size:24px;">➡</button>
		</div>
		<p id="albumCaption" style="text-align:center; margin-top:10px;"></p>
	</div>
</div>

<script>
let albumImages = [];
let currentIndex = 0;

function loadAlbum(id, title) {
	fetch('/templates/default/get_album_images.php?id=' + id)
		.then(res => res.json())
		.then(data => {
			albumImages = data;
			currentIndex = 0;
			document.getElementById('albumTitle').innerText = title;
			showImage();
			document.getElementById('albumModal').style.display = 'block';
		});
}

function showImage() {
	if (albumImages.length === 0) return;
	const img = albumImages[currentIndex];
	document.getElementById('albumImage').src = img.file_url;
	document.getElementById('albumImage').alt = img.alt_text;
	document.getElementById('albumCaption').innerText = img.alt_text || '';
}

function nextImage() {
	currentIndex = (currentIndex + 1) % albumImages.length;
	showImage();
}

function prevImage() {
	currentIndex = (currentIndex - 1 + albumImages.length) % albumImages.length;
	showImage();
}

function closeAlbum() {
	document.getElementById('albumModal').style.display = 'none';
	albumImages = [];
}
</script>

<?php endLayout(); ?>
