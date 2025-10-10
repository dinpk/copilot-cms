<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("YouTube Gallery"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Video</a></p>

<form method="get">
  <input type="text" name="q" placeholder="Search videos..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Thumbnail</th>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
	  <th>Created</th>
	  <th>Updated</th>
      <th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $limit;
    $q = $_GET['q'] ?? '';
    $q = $conn->real_escape_string($q);
	
	// sort
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['name', 'email', 'city', 'country', 'status', 'entry_date_time'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	
	
    $sql = "SELECT * FROM youtube_gallery";
    if ($q !== '') {
      $sql .= " WHERE MATCH(title,description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
    }
    $sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
	
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
		
		// Show created by updated by
		$keyYoutubeGallery = $row["key_youtube_gallery"];
		$createdUpdated = $conn->query("SELECT p.key_youtube_gallery, u1.username AS creator, u2.username AS updater 
			FROM youtube_gallery p 
			LEFT JOIN users u1 ON p.created_by = u1.key_user
			LEFT JOIN users u2 ON p.updated_by = u2.key_user 
			WHERE key_youtube_gallery = $keyYoutubeGallery")->fetch_assoc();		
		
      echo "<tr>
        <td><img src='{$row['thumbnail_url']}' width='120'></td>
        <td>{$row['title']}</td>
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_youtube_gallery']}, \"get_video.php\", [\"title\",\"youtube_id\",\"thumbnail_url\",\"url\",\"description\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_youtube_gallery']}' onclick='return confirm(\"Delete this video?\")'>Delete</a>
        </td>
      </tr>";
    }
	
	
	$countSql = "SELECT COUNT(*) AS total FROM youtube_gallery";
	if ($q !== '') {
	  $countSql .= " WHERE MATCH(title,description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$countResult = $conn->query($countSql);
	$totalArticles = $countResult->fetch_assoc()['total'];
	$totalPages = ceil($totalArticles / $limit);
	
    ?>
  </tbody>
</table>


<!-- Pager -->
<div id="pager">
	<?php if ($page > 1): ?>
	  <a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">⬅ Prev</a>
	<?php endif; ?>

	Page <?php echo $page; ?> of <?php echo $totalPages; ?>

	<?php if ($page < $totalPages): ?>
	  <a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">Next ➡</a>
	<?php endif; ?>
</div>


<!-- Modal Form -->
<div id="modal" class="modal">
  <h3 id="modal-title">Add Video</h3>
  <form id="modal-form" method="post">
	<input type="hidden" name="key_youtube_gallery" id="key_youtube_gallery">

	<input type="text" name="title" id="title" 
		   onchange="setCleanURL(this.value)" 
		   placeholder="Title" 
		   required maxlength="255"><br>

	<input type="text" name="youtube_id" id="youtube_id" 
		   placeholder="YouTube ID" 
		   required maxlength="20" 
		   pattern="^[a-zA-Z0-9_-]{11,20}$" 
		   title="Enter a valid YouTube video ID"><br>

	<input type="url" name="thumbnail_url" id="thumbnail_url" 
		   placeholder="Thumbnail URL" 
		   maxlength="2000"><br>
		   
	<br>
	<input type="hidden" name="key_media_banner" id="key_media_banner">
	<div id="media-preview"></div>
	<button type="button" onclick="openMediaModal()">Select Banner Image</button>
	
	<br><br>

	<input type="text" name="url" id="url" 
		   placeholder="Slug" 
		   maxlength="200" 
		   pattern="^[a-z0-9\-\/]+$" 
		   title="Lowercase letters, numbers, and hyphens only"><br>

	<textarea name="description" id="description" 
			  placeholder="Description"></textarea><br>

	<label>
	  <input type="checkbox" name="status" id="status" 
			 value="on" checked>
	  Active
	</label><br>

	
	<div id="select-categories">
	  <h3>Categories</h3>
		<?php
		$types = ['photo_gallery', 'book', 'article', 'video_gallery', 'global'];

		foreach ($types as $type) {
		  echo "<div style='color:margin:10px 0;'>";
		  echo "<div style='color:Navy;padding:10px 0 10px 0;'>" . ucfirst(str_replace('_', ' ', $type)) . "</div>";

		  $catResult = $conn->query("SELECT key_categories, name FROM categories WHERE category_type = '$type' AND status='on' ORDER BY sort");

		  while ($cat = $catResult->fetch_assoc()) {
			echo "<label style='display:block;'>
					<input type='checkbox' name='categories[]' value='{$cat['key_categories']}'> {$cat['name']}
				  </label>";
		  }

		  echo "</div>";
		}
		?>
	</div>
	
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>


<!-- Media Modal Form -->
<div id="media-modal" class="modal">
  <h3>Select Banner Image</h3>
  <div id="media-grid">
    <?php
    $mediaRes = $conn->query("SELECT key_media, file_url, alt_text FROM media_library WHERE file_type='image' ORDER BY entry_date_time DESC");
    while ($media = $mediaRes->fetch_assoc()) {
      echo "<div class='media-thumb' onclick='selectMedia({$media['key_media']}, \"{$media['file_url']}\")'>
              <img src='{$media['file_url']}' width='100'><br>
              <small>" . htmlspecialchars($media['alt_text']) . "</small>
            </div>";
    }
    ?>
  </div>
  <button type="button" onclick="closeMediaModal()">Cancel</button>
</div>


<?php endLayout(); ?>
