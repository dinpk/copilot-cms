<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("Articles"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Article</a></p>

<form method="get">
    <input type="text" name="q" placeholder="Search articles..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    
    <select name="filter" onchange="this.form.submit()">
        <option value="">All Articles</option>
        <option value="media_banner" <?= ($_GET['filter'] ?? '') === 'media_banner' ? 'selected' : '' ?>>Have Media Banner</option>
        <option value="no_media_banner" <?= ($_GET['filter'] ?? '') === 'no_media_banner' ? 'selected' : '' ?>>No Media Banner</option>
        <option value="url_banner" <?= ($_GET['filter'] ?? '') === 'url_banner' ? 'selected' : '' ?>>Have URL Banner</option>
        <option value="no_url_banner" <?= ($_GET['filter'] ?? '') === 'no_url_banner' ? 'selected' : '' ?>>No URL Banner</option>
        <option value="featured" <?= ($_GET['filter'] ?? '') === 'featured' ? 'selected' : '' ?>>Featured</option>
        <option value="not_published" <?= ($_GET['filter'] ?? '') === 'not_published' ? 'selected' : '' ?>>Not Published</option>
    </select>
    
    <input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Authors</th>
			<th><?= sortLink('Created', 'entry_date_time', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Updated', 'update_date_time', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Status', 'is_active', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
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
	$allowedSorts = ['title', 'is_active', 'entry_date_time', 'update_date_time'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	
	$sql = "SELECT key_articles, title, article_snippet, entry_date_time, update_date_time, is_active 
			FROM articles";

	$whereClauses = [];

	// Search condition
	if ($q !== '') {
		$whereClauses[] = "MATCH(title, title_sub, article_snippet, article_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}

	// Filter condition
	$filter = $_GET['filter'] ?? '';
	switch ($filter) {
		case 'media_banner':
			$whereClauses[] = "key_media_banner = 1";
			break;
		case 'no_media_banner':
			$whereClauses[] = "key_media_banner = 0";
			break;
		case 'url_banner':
			$whereClauses[] = "banner_image_url != ''";
			break;
		case 'no_url_banner':
			$whereClauses[] = "banner_image_url = ''";
			break;
		case 'featured':
			$whereClauses[] = "is_featured = 1";
			break;
		case 'not_published':
			$whereClauses[] = "is_active != 1";
			break;
	}

	if (!empty($whereClauses)) {
		$sql .= " WHERE " . implode(" AND ", $whereClauses);
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
		$date_created = date_format(date_create($row["entry_date_time"]), "d M, Y - H:i a");
		$date_updated = date_format(date_create($row["update_date_time"]), "d M, Y - H:i a");
		echo "<tr>
		<td>{$row['title']}</td>
		<td>" . htmlspecialchars($authorDisplay) . "</td>
		<td><small>{$createdUpdated['creator']} $date_created</small></td>
		<td><small>{$createdUpdated['updater']} $date_updated</small></td>
		<td>{$row['is_active']}</td>
		<td class='record-action-links'>
		  <a href='#' onclick='editItem({$row['key_articles']}, \"get_article.php\", [\"title\",\"title_sub\",\"article_snippet\",\"article_content\",\"url\",\"book_indent_level\",\"banner_image_url\",\"key_media_banner\",\"sort\",\"entry_date_time\",\"update_date_time\",\"is_featured\",\"show_on_home\",\"is_active\"])'>Edit</a> 
		  <a href='#' onclick='openAuthorModal({$row['key_articles']})'>Authors</a> 
		  <a href='preview.php?id={$row['key_articles']}' target='_blank'>Preview</a> 
		  <a href='delete.php?id={$row['key_articles']}' onclick='return confirm(\"Delete this article?\")'>Delete</a>
		</td>
		</tr>";
	}

	$countSql = "SELECT COUNT(*) AS total FROM articles";
	if (!empty($whereClauses)) {
		$countSql .= " WHERE " . implode(" AND ", $whereClauses);
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
	<h3 id="modal-title">Add Article</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_articles" id="key_articles">
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" placeholder="Title" required maxlength="300"> <label>Title</label><br>
		<input type="text" name="title_sub" id="title_sub" placeholder="Subtitle" maxlength="300"> <label>Sub Title</label><br>
		<input type="text" name="url" id="url" placeholder="Slug" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, and hyphens only" required> <label>Slug</label><br>
		<textarea name="article_snippet" id="article_snippet" placeholder="Snippet" maxlength="1000"></textarea><br>
		<textarea name="article_content" id="article_content" placeholder="Content"></textarea><br>
		<input type="number" name="book_indent_level" id="book_indent_level" value="0" min="0" max="3000"> <label>Book Indent Level</label><br>
		<input type="url" name="banner_image_url" id="banner_image_url" placeholder="Full Banner Image URL"> <label>URL</label><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="galleryImage_openMediaModal(document.querySelector('#key_articles').value)">Select Banner Image from Media Library</button><br>
		<!-- 
		<input type="date" name="entry_date_time" id="entry_date_time" required> <label>Published</label><br>
		<input type="date" name="update_date_time" id="update_date_time" required> <label>Updated</label><br>
		-->
		<input type="number" name="sort" id="sort" placeholder="Sort Order" value="0" min="0" max="32767"> <label>Sort</label><br>

		<details class="detail-checkboxes">
			<summary>Content Types</summary>
			<div>
			<?php
			  $contResult = $conn->query("SELECT key_content_types, name FROM content_types WHERE is_active = 1 ORDER BY sort, name");
			  while ($cat = $contResult->fetch_assoc()) {
				echo "<label><input type='checkbox' name='content_types[]' value='{$cat['key_content_types']}'> {$cat['name']}</label>";
			  }
			?>
			</div>
		</details>
		
		<details class="detail-checkboxes">
			<summary>Categories</summary>
			<div>
			<?php
			$types = ['article', 'book', 'photo_gallery', 'video_gallery', 'global'];
			foreach ($types as $type) {
			  echo "<h4>" . ucfirst(str_replace('_', ' ', $type)) . "</h4>";
			  $catResult = $conn->query("SELECT key_categories, name FROM categories WHERE category_type = '$type' AND is_active = 1 ORDER BY sort");
			  while ($cat = $catResult->fetch_assoc()) {
				echo "<label><input type='checkbox' name='categories[]' value='{$cat['key_categories']}'> {$cat['name']}</label>";
			  }
			}
			?>
			</div>
		</details>
		
		<details class="detail-checkboxes">
			<summary>Tags</summary>
			<div>
			<?php
			  $contResult = $conn->query("SELECT key_tags, name FROM tags WHERE is_active = 1 ORDER BY sort, name");
			  while ($cat = $contResult->fetch_assoc()) {
				echo "<label><input type='checkbox' name='tags[]' value='{$cat['key_tags']}'> {$cat['name']}</label>";
			  }
			?>
			</div>
		</details>
		
		<label><input type="checkbox" name="is_featured" id="is_featured"> Featured</label><br>
		<label><input type="checkbox" name="show_on_home" id="show_on_home" checked> Show on Home</label><br>
		<select name="is_active" id="is_active">
			<option value="1">Published</option>
			<option value="0">Not Published</option>
		</select><br>
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

<div id="media-library-modal" class="modal modal-90"></div>

<?php endLayout(); ?>