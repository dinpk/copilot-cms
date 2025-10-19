<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>

<?php startLayout("Books List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Book</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search books..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Author</th>
			<th><?= sortLink('Publisher', 'publisher', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Year', 'publish_year', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Created</th>
			<th>Updated</th>
			<th>Status</th>
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
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'publisher', 'publish_year', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM books";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(title,subtitle,publisher,description,author_name) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$keyBooks = $row["key_books"];
		$createdUpdated = $conn->query("SELECT b.key_books, u1.username AS creator, u2.username AS updater 
			FROM books b 
			LEFT JOIN users u1 ON b.created_by = u1.key_user
			LEFT JOIN users u2 ON b.updated_by = u2.key_user 
			WHERE key_books = $keyBooks")->fetch_assoc();		
	  echo "<tr>
		<td>{$row['title']}</td>
		<td>{$row['author_name']}</td>
		<td>{$row['publisher']}</td>
		<td>{$row['publish_year']}</td>
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
		<td>{$row['status']}</td>
		<td class='record-action-links'>
		<a href='#' onclick='editItem({$row['key_books']}, \"get_book.php\", [\"title\",\"subtitle\",\"description\",\"url\",\"banner_image_url\",\"author_name\",\"publisher\",\"publish_year\",\"key_media_banner\",\"status\"])'>Edit</a> 
		<a href='delete.php?id={$row['key_books']}' onclick='return confirm(\"Delete this book?\")' style='display:none'>Delete</a> 
		<a href='#' onclick='openAssignModal({$row['key_books']})'>Assign Articles</a>
		</td>
	  </tr>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM books";
	if ($q !== '') {
		$countSql .= " WHERE MATCH(title,subtitle,publisher,description,author_name) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$countResult = $conn->query($countSql);
	$totalArticles = $countResult->fetch_assoc()['total'];
	$totalPages = ceil($totalArticles / $limit);
	?>
	</tbody>
</table>

<div id="pager">
	<?php if ($page > 1): ?>
	<a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">⬅ Prev</a>
	<?php endif; ?>
	Page <?php echo $page; ?> of <?php echo $totalPages; ?>
	<?php if ($page < $totalPages): ?>
	<a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">Next ➡</a>
	<?php endif; ?>
</div>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Book</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_books" id="key_books">
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" required maxlength="200"> <label>Title</label><br>
		<input type="text" name="subtitle" id="subtitle" maxlength="200"> <label>Sub Title</label><br>
		<textarea name="description" id="description" placeholder="Description"></textarea><br>
		<input type="text" name="url" id="url" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, and hyphens only"> <label>Slug</label><br>
		<input type="text" name="author_name" id="author_name" maxlength="200"> <label>Author Name</label><br>
		<input type="text" name="publisher" id="publisher" maxlength="200"> <label>Publisher</label><br>
		<input type="text" name="publish_year" id="publish_year" maxlength="4" pattern="^[0-9]{4}$" title="Enter a 4-digit year"> <label>Publish Year</label><br>
		<input type="text" name="isbn" id="isbn" maxlength="17"> <label>ISBN</label><br>
		<input type="text" name="language" id="language" maxlength="50"> <label>Language</label><br>
		<input type="text" name="format" id="format" maxlength="50"> <label>Format</label><br>
		<input type="number" name="weight_grams" id="weight_grams" min="0" max="99999999999" value="0"> <label>Weight (grams)</label><br>
		<input type="text" name="sku" id="sku" maxlength="50"> <label>SKU</label><br>
		<input type="checkbox" name="is_featured" id="is_featured" value="1"> <label>Featured</label><br>
		<input type="number" name="sort" id="sort" value="0" min="0" max="2000"> <label>Sort</label><br>
		<input type="url" name="banner_image_url" id="banner_image_url" placeholder="Full Banner Image URL"> <label>URL</label><br><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="galleryImage_openMediaModal(document.querySelector('#key_books').value)">Select Banner Image from Media Library</button><br>
		<input type="checkbox" name="status" id="status" value="on" checked> <label>Active</label><br>
		<details id="select-categories">
			<summary>Categories</summary>
			<div>
			<?php
			$types = ['article', 'book', 'photo_gallery', 'video_gallery', 'global'];
			foreach ($types as $type) {
			  echo "<h4>" . ucfirst(str_replace('_', ' ', $type)) . "</h4>";
			  $catResult = $conn->query("SELECT key_categories, name FROM categories WHERE category_type = '$type' AND status='on' ORDER BY sort");
			  while ($cat = $catResult->fetch_assoc()) {
				echo "<label><input type='checkbox' name='categories[]' value='{$cat['key_categories']}'> {$cat['name']}</label>";
			  }
			}
			?>
			</div>
		</details>
		<input type="submit" value="Save">
	</form>
</div>

<div id="assign-modal" class="modal">
	<a href="#" onclick="closeAssignModal();" class="close-icon">✖</a>
	<h3 id="assign-modal-title">Assign Articles to Book</h3>
	<form id="assign-form" method="post" action="assign_articles.php">
		<input type="hidden" name="key_books" id="assign_book_id">
		<input type="text" id="article_search" placeholder="Search articles..." oninput="filterArticles()"><br><br>
		<div id="article-list"></div>
		<input type="submit" value="Save">
	</form>
</div>

<div id="media-library-modal" class="modal modal-90"></div>

<?php endLayout(); ?>