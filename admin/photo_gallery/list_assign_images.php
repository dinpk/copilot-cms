<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Photo Gallery"); ?>

<p><a href="list.php">Full List</a></p>

<form method="get">
  <input type="text" name="q" placeholder="Search photos..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th></th>
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
	$allowedSorts = ['title', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	
    $sql = "SELECT * FROM photo_gallery";
    if ($q !== '') {
      $sql .= " WHERE MATCH(title, description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
    }
    $sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      $key = $row['key_photo_gallery'];
      $createdUpdated = $conn->query("SELECT u1.username AS creator, u2.username AS updater 
        FROM photo_gallery p 
        LEFT JOIN users u1 ON p.created_by = u1.key_user 
        LEFT JOIN users u2 ON p.updated_by = u2.key_user 
        WHERE p.key_photo_gallery = $key")->fetch_assoc();

      echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='openImageModal($key)'>Assign Images</a>
        </td>
      </tr>";
    }
	
	$countSql = "SELECT COUNT(*) AS total FROM photo_gallery";
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



<div id="image-modal" class="modal">
  <h3>Assign Images to Album</h3>
  <form method="post" id="image-form">
    <input type="hidden" name="key_photo_gallery" id="image_hidden_key">
    <input type="hidden" name="key_media_banner" id="key_media_banner">
    <div id="media-preview"></div>
    <button type="button" onclick="openMediaModal()">Select Image</button>
    <br><br>
    <input type="number" name="sort_order" placeholder="Sort Order" value="0"><br>
    <input type="submit" value="Add Image">
  </form>
  <div id="image-list"></div>
  <button type="button" onclick="closeImageModal()">Close</button>
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
