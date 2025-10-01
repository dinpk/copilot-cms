<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Articles List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Article</a></p>

<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search articles..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Snippet</th>
	  <th>Authors</th>
		<th>Created</th>
		<th>Updated</th>
      <th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
	
	// pager
	$limit = 10; // articles per page
	$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
	$offset = ($page - 1) * $limit;
	
	// search
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);


	// sort
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';


	$sql = "SELECT * FROM articles";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(title, title_sub,content_type, article_snippet, article_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
		$keyArticles = $row['key_articles'];
		
		// display created/updated by
		$createdUpdated = $conn->query("SELECT
			  a.key_articles,
			  u1.username AS creator,
			  u2.username AS updater
			FROM articles a
			LEFT JOIN users u1 ON a.created_by = u1.key_user
			LEFT JOIN users u2 ON a.updated_by = u2.key_user
			WHERE key_articles = $keyArticles")->fetch_assoc();	
			
		// display authors
		$authRes = $conn->query("SELECT a.name FROM authors a JOIN article_authors aa ON a.key_authors = aa.key_authors WHERE aa.key_articles = $keyArticles");
		$authorNames = [];
		while ($a = $authRes->fetch_assoc()) {
		  $authorNames[] = $a['name'];
		}
		$authorDisplay = implode(', ', $authorNames);
		
		echo "<tr>
		<td>{$row['title']}</td>
		<td>{$row['article_snippet']}</td>
		<td>" . htmlspecialchars($authorDisplay) . "</td>
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
		<td>{$row['status']}</td>
		<td>
		  <a href='#' onclick='editItem({$row['key_articles']}, \"get_article.php\", [\"title\",\"title_sub\",\"article_snippet\",\"article_content\",\"url\",\"banner_image_url\",\"sort\",\"status\"])'>Edit</a> |
		  <a href='#' onclick='openAuthorModal({$row['key_articles']})'>Assign Authors</a> |
		  <a href='delete.php?id={$row['key_articles']}' onclick='return confirm(\"Delete this article?\")'>Delete</a>
		</td>
		</tr>";
    }
	
	// count records for pager
	$countSql = "SELECT COUNT(*) AS total FROM articles";
	if ($q !== '') {
	  $countSql .= " WHERE MATCH(title, title_sub, content_type, article_snippet, article_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
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


<!-- Add/Edit Article Modal Form -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;height:80vh">
  <h3 id="modal-title">Add Article</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_articles" id="key_articles">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <input type="text" name="title_sub" id="title_sub" placeholder="Subtitle"><br>
    <textarea name="article_snippet" id="article_snippet" placeholder="Snippet"></textarea><br>
    <textarea name="article_content" id="article_content" placeholder="Content"></textarea><br>
	<select name="content_type" id="content_type" required>
	  <option value="article">Article</option>
	  <option value="book">Post</option>
	  <option value="photo_gallery">News Release</option>
	  <option value="video_gallery">Translation</option>
	  <option value="global">Transcript</option>
	</select><br>
    <input type="text" name="url" id="url" placeholder="URL"><br>
    <input type="text" name="banner_image_url" id="banner_image_url" placeholder="Banner Image URL"><br>
    <input type="number" value="0" name="sort" id="sort" placeholder="Sort Order"><br>
	<label>
	  <input type="checkbox" name="status" id="status" value="on" checked>
	  Active
	</label><br>
	
	
	<div style="margin:10px 0;border:1px solid #777;padding:20px;">
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

<!-- Assign Authors Model Form -->
<div id="author-modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3>Assign Authors</h3>
  <form id="author-form" method="post" action="assign_authors.php">
    <input type="hidden" name="key_articles" id="author_article_id">
    <div id="author-list">
      <!-- JS will populate this with checkboxes -->
    </div>
    <input type="submit" value="Assign">
    <button type="button" onclick="closeAuthorModal()">Cancel</button>
  </form>
</div>


<?php endLayout(); ?>
