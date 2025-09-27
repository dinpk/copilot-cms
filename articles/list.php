<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Articles List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Article</a></p>

<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search articles..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Snippet</th>
      <th>Categories</th>
	  <th>Authors</th>
      <th>Status</th>
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
	$sql = "SELECT * FROM articles";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(title, title_sub,content_type, categories, article_snippet, article_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY sort ASC, key_articles DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
		$aid = $row['key_articles'];
		$authRes = $conn->query("SELECT a.name FROM authors a JOIN article_authors aa ON a.key_authors = aa.key_authors WHERE aa.key_articles = $aid");
		$authorNames = [];
		while ($a = $authRes->fetch_assoc()) {
		  $authorNames[] = $a['name'];
		}
		$authorDisplay = implode(', ', $authorNames);
		
		echo "<tr>
		<td>{$row['title']}</td>
		<td>{$row['article_snippet']}</td>
		<td>{$row['categories']}</td>
		<td>" . htmlspecialchars($authorDisplay) . "</td>
		<td>{$row['status']}</td>
		<td>
		  <a href='#' onclick='editItem({$row['key_articles']}, \"get_article.php\", [\"title\",\"title_sub\",\"article_snippet\",\"article_content\",\"url\",\"banner_image_url\",\"sort\",\"categories\",\"status\"])'>Edit</a> |
		  <a href='#' onclick='openAuthorModal({$row['key_articles']})'>Assign Authors</a> |
		  <a href='delete.php?id={$row['key_articles']}' onclick='return confirm(\"Delete this article?\")'>Delete</a>
		</td>
		</tr>";
    }
	
	// count records for pager
	$countSql = "SELECT COUNT(*) AS total FROM articles";
	if ($q !== '') {
	  $countSql .= " WHERE MATCH(title, title_sub, content_type, categories, article_snippet, article_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
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
    <a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>">⬅ Prev</a>
  <?php endif; ?>
  Page <?php echo $page; ?> of <?php echo $totalPages; ?>
  <?php if ($page < $totalPages): ?>
    <a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>">Next ➡</a>
  <?php endif; ?>
</div>


<!-- Add/Edit Article Modal Form -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Article</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_articles" id="key_articles">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <input type="text" name="title_sub" id="title_sub" placeholder="Subtitle"><br>
    <textarea name="article_snippet" id="article_snippet" placeholder="Snippet"></textarea><br>
    <textarea name="article_content" id="article_content" placeholder="Content"></textarea><br>
    <input type="text" name="url" id="url" placeholder="URL"><br>
    <input type="text" name="banner_image_url" id="banner_image_url" placeholder="Banner Image URL"><br>
    <input type="text" name="sort" id="sort" placeholder="Sort Order"><br>
    <input type="text" name="categories" id="categories" placeholder="Categories"><br>
    <input type="text" name="status" id="status" placeholder="Status"><br>
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



<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
