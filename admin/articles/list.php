<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>

<?php startLayout("Articles"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Article</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search articles..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Type', 'content_type', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Authors</th>
			<th><?= sortLink('Created', 'entry_date_time', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Updated', 'update_date_time', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
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
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'status', 'entry_date_time', 'update_date_time'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT key_articles, title, content_type, article_snippet, entry_date_time, update_date_time, status FROM articles";
	if ($q !== '') {
		$sql .= " WHERE MATCH(title, title_sub, content_type, article_snippet, article_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$keyArticles = $row['key_articles'];
		$content_type = strtoupper(str_replace("_", " ", $row['content_type']));
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
		$date_created = date_format(date_create($row["entry_date_time"]), "d M, Y - H:i a");
		$date_updated = date_format(date_create($row["update_date_time"]), "d M, Y - H:i a");
		echo "<tr>
		<td>{$row['title']}</td>
		<td><small>$content_type</small></td>
		<td>" . htmlspecialchars($authorDisplay) . "</td>
		<td><small>{$createdUpdated['creator']} $date_created</small></td>
		<td><small>{$createdUpdated['updater']} $date_updated</small></td>
		<td>{$row['status']}</td>
		<td class='record-action-links'>
		  <a href='#' onclick='editItem({$row['key_articles']}, \"get_article.php\", [\"title\",\"title_sub\",\"article_snippet\",\"article_content\",\"url\",\"content_type\",\"book_indent_level\",\"banner_image_url\",\"sort\",\"status\"])'>Edit</a> 
		  <a href='#' onclick='openAuthorModal({$row['key_articles']})'>Authors</a> 
		  <a href='preview.php?id={$row['key_articles']}' target='_blank'>Preview</a> 
		  <a href='delete.php?id={$row['key_articles']}' onclick='return confirm(\"Delete this article?\")' style='display:none'>Delete</a>
		</td>
		</tr>";
	}
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
	<a href="#" onclick="document.getElementById('modal').style.display='none'" class="close-icon">✖</a>
	<h3 id="modal-title">Add Article</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_articles" id="key_articles">
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" placeholder="Title" required maxlength="300"> <label>Title</label><br>
		<input type="text" name="title_sub" id="title_sub" placeholder="Subtitle" maxlength="300"> <label>Sub Title</label><br>
		<textarea name="article_snippet" id="article_snippet" placeholder="Snippet" maxlength="1000"></textarea><br>
		<textarea name="article_content" id="article_content" placeholder="Content"></textarea><br>
		<select name="content_type" id="content_type" required>
			<option value="article">Article</option>
			<option value="post">Post</option>
			<option value="news_release">News Release</option>
			<option value="translation">Translation</option>
			<option value="transcript">Transcript</option>
		</select> <label>Content Type</label><br>
		<input type="number" name="book_indent_level" id="book_indent_level" value="0" min="0" max="3000"> <label>Book Indent Level</label><br>
		<input type="text" name="url" id="url" placeholder="Slug" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, and hyphens only"> <label>Slug</label><br>
		<input type="url" name="banner_image_url" id="banner_image_url" placeholder="Full Banner Image URL"> <label>URL</label><br><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="openMediaModal()">Select Banner Image from Media Library</button><br><br>
		<input type="number" name="sort" id="sort" placeholder="Sort Order" value="0" min="0" max="32767"> <label>Sort</label><br>
		<label><input type="checkbox" name="status" id="status" value="on" checked> Active</label><br>
		<fieldset id="select-categories">
			<legend>Categories</legend>
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
		</fieldset>
		<input type="submit" value="Save">
	</form>
</div>

<div id="author-modal" class="modal">
	<a href="#" onclick="document.getElementById('author-modal').style.display='none'" class="close-icon">✖</a>
	<h3>Assign Authors</h3>
	<form id="author-form" method="post" action="assign_authors.php">
		<input type="hidden" name="key_articles" id="author_article_id">
		<div id="author-list">
			<!-- JS will populate this with checkboxes -->
		</div>
		<input type="submit" value="Assign">
	</form>
</div>

<div id="media-modal" class="modal">
	<a href="#" onclick="closeMediaModal();" class="close-icon">✖</a>
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
</div>

<?php endLayout(); ?>