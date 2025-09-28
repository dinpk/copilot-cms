<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("YouTube Gallery"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Video</a></p>

<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search videos..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Thumbnail</th>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
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
      echo "<tr>
        <td><img src='{$row['thumbnail_url']}' width='120'></td>
        <td>{$row['title']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_youtube_gallery']}, \"get_video.php\", [\"title\",\"youtube_id\",\"thumbnail_url\",\"description\",\"status\"])'>Edit</a> |
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
<div style="margin-top:20px;">
	<?php if ($page > 1): ?>
	  <a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">⬅ Prev</a>
	<?php endif; ?>

	Page <?php echo $page; ?> of <?php echo $totalPages; ?>

	<?php if ($page < $totalPages): ?>
	  <a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">Next ➡</a>
	<?php endif; ?>
</div>


<!-- Modal Form -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Video</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_youtube_gallery" id="key_youtube_gallery">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <input type="text" name="youtube_id" id="youtube_id" placeholder="YouTube ID" required><br>
    <input type="text" name="thumbnail_url" id="thumbnail_url" placeholder="Thumbnail URL"><br>
    <textarea name="description" id="description" placeholder="Description"></textarea><br>
    <input type="text" name="status" id="status" placeholder="Status"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>
<?php endLayout(); ?>
