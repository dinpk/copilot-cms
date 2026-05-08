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
        <option value="not_featured" <?= ($_GET['filter'] ?? '') === 'not_featured' ? 'selected' : '' ?>>Not Featured</option>
        <option value="not_published" <?= ($_GET['filter'] ?? '') === 'not_published' ? 'selected' : '' ?>>Not Published</option>
    </select>
    
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
			$whereClauses[] = "key_media_banner != 0";
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
		case 'not_featured':
			$whereClauses[] = "is_featured = 0";
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
		  <a href='#' onclick='editItem({$row['key_articles']}, \"get_article.php\", [\"content_direction\",\"title\",\"title_sub\",\"article_snippet\",\"article_content\",\"url\",\"book_indent_level\",\"banner_image_url\",\"key_media_banner\",\"sort\",\"entry_date_time\",\"update_date_time\",\"is_featured\",\"show_in_listing\",\"show_on_home\",\"is_active\"])'>Edit</a> 
		  <a href='#' onclick='openAuthorModal({$row['key_articles']},\"{$row['title']}\")'>Authors</a> 
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
	<a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir)?>&filter=<?php echo urlencode($filter); ?>">⬅ Prev</a>
	<?php endif; ?>
	Page <?php echo $page; ?> of <?php echo $totalPages; ?>
	<?php if ($page < $totalPages): ?>
	<a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir)?>&filter=<?php echo urlencode($filter); ?>">Next ➡</a>
	<?php endif; ?>
</div>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Article</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_articles" id="key_articles">
		
		<select name="content_direction" id="content_direction" onchange="changeArticleDirection(this.value)">
			<option value="ltr">Left to Right</option>
			<option value="rtl">Right to Left</option>
		</select><br>
		
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" placeholder="Title" required maxlength="300"> <label>Title</label><br>
		<input type="text" name="title_sub" id="title_sub" placeholder="Subtitle" maxlength="300"> <label>Sub Title</label><br>
		<input type="text" name="url" id="url" placeholder="Slug" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, and hyphens only" required> <label>Slug</label><br>
		<textarea name="article_snippet" id="article_snippet" placeholder="Snippet" maxlength="1000"></textarea><br>
		
		
		
		
		<!-- content editable -->
		<div class='wysiwyg'>
			<select id="wysiwyg_block_elements" title="Block Elements">
				<option value="p"></option>
				<option value="p">Paragraph</option>
				<option value="blockquote">Quote</option>
				<option value="h1">Heading 1</option>
				<option value="h2">Heading 2</option>
				<option value="h3">Heading 3</option>
				<option value="h4">Heading 4</option>
				<option value="h5">Heading 5</option>
				<option value="h6">Heading 6</option>
				<option value="address">Address</option>
				<option value="pre">Pre</option>
				<option value="hr">Rule</option>
			</select> 
			<input type="button" onclick="convertBlock();" value="Set">
			
			<select id="wysiwyg_inline_elements" title="Inline Elements">
				<option value=""></option>
				<option value="abbr">Abbreviation</option>
				<option value="acronym">Acronym</option>
				<option value="bdo">Bi-directional</option>
				<option value="big">Big</option>
				<option value="cite">Citation</option>
				<option value="code">Code</option>
				<option value="dfn">Definition</option>
				<option value="em">Emphasis</option>
				<option value="i">Italic</option>
				<option value="kbd">Keyboard</option>
				<option value="output">Output</option>
				<option value="q">Short quote</option>
				<option value="samp">Sample</option>
				<option value="small">Small</option>
				<option value="span">Span</option>
				<option value="strike">Strikethrough</option>
				<option value="strong">Strong</option>
				<option value="sup">Superscript</option>
				<option value="sub">Subscript</option>
				<option value="time">Time</option>
				<option value="u">Underline</option>
				<option value="var">Var</option>
			</select> 
			<input type="button" onclick="convertSelection();" value="Set">

			<img src="../assets/images/wysiwyg_link.png" onclick="insertLink();"> 
			<img src="../assets/images/wysiwyg_unlink.png" onclick="unLink();"> 
			<img src="../assets/images/wysiwyg_remove_formatting.png" onclick="removeBlockFormatting();" title="Remove internal formatting"> 

		</div>
		
		<div name="article_content_editable" id="article_content_editable" contenteditable="true"
				onblur="updateCodeTextarea('article_content_editable', 'article_content');"
		>
		<p> <br></p>
		</div>
		
		<!-- code editor -->
		
		<details>
			<summary>Code</summary>
			<textarea name="article_content" id="article_content" placeholder="Content" 
				onblur="updateContentEditableDiv('article_content_editable', 'article_content');">
			</textarea><br>
		</details>
		
		
		
		
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
		<label><input type="checkbox" name="show_in_listing" id="show_in_listing" checked> Show in Listing</label><br>
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

  <h3>Assign Authors for:</h3>
  <div id="author-article-title"></div>
  <br>

  <form id="author-form" method="post" action="assign_authors.php">

    <input type="hidden" name="key_articles" id="author_article_id">

    <!-- Search box -->
    <input type="text" id="author-search" placeholder="Search author by name">

    <div id="author-list">
      <!-- JS will populate this with checkboxes + work label fields -->
    </div>

    <!-- datalist for work labels -->
    <datalist id="work-labels">
      <option value="Translation">
      <option value="Review">
      <option value="Editing">
      <option value="Proofreading">
      <option value="Contribution">
    </datalist>

    <input type="submit" value="Assign">
  </form>
</div>

<div id="media-library-modal" class="modal modal-90"></div>


<script>

function changeArticleDirection(direction) {
	document.getElementById("title").style.direction = direction;
	document.getElementById("title_sub").style.direction = direction;
	document.getElementById("article_snippet").style.direction = direction;
	//document.getElementById("article_content").style.direction = direction;
	document.getElementById("article_content_editable").style.direction = direction;
}



// ---------------- WYSIWYG

function updateContentEditableDiv(contenteditable, textarea) {
	document.getElementById(contenteditable).innerHTML = document.getElementById(textarea).value;
}

function updateCodeTextarea(contenteditable, textarea) {
	document.getElementById(textarea).value = document.getElementById(contenteditable).innerHTML.replaceAll('</p><p>', '</p>\n\n<p>');
}




const editable = document.getElementById("article_content_editable");


editable.addEventListener("input", () => { // avoid <span> insertion
  editable.querySelectorAll("span").forEach(span => {
      span.replaceWith(...span.childNodes); // replace span with its children
    
  });
});


editable.addEventListener("keydown", e => { // insert <p>, not <div>
  if (e.key === "Enter") {
    e.preventDefault(); // stop the browser from inserting <div>

    const sel = window.getSelection();
    if (!sel.rangeCount) return;

    const range = sel.getRangeAt(0);

    // create a new paragraph
    const p = document.createElement("p");
    p.appendChild(document.createElement("br")); // empty line

    // insert it after the current block
    range.insertNode(p);

    // move cursor inside the new paragraph
    range.setStart(p, 0);
    range.collapse(true);
    sel.removeAllRanges();
    sel.addRange(range);
  }
});


function setEditorFocus() {
	document.getElementById("article_content_editable").focus();
}


function convertSelection(className) {

	setEditorFocus();

	const tagName = document.getElementById("wysiwyg_inline_elements").value;

	if (!tagName) return;

	const sel = window.getSelection();
	if (!sel.rangeCount || sel.toString().length < 1) return;

	const range = sel.getRangeAt(0);
	const wrapper = document.createElement(tagName);
	
	if (className) wrapper.className = className;

	// Extract contents and wrap them
	const contents = range.extractContents();
	wrapper.appendChild(contents);
	range.insertNode(wrapper);

	// Reset cursor after inserted node
	sel.removeAllRanges();
	const newRange = document.createRange();
	newRange.selectNodeContents(wrapper);
	newRange.collapse(false);
	sel.addRange(newRange);
}



function convertBlock() {
	
  setEditorFocus();
  
  const tagName = document.getElementById("wysiwyg_block_elements").value;
  const sel = window.getSelection();
  
  if (!sel.rangeCount) return;

  // Find the block-level ancestor of the cursor
  let node = sel.anchorNode;
  while (node && node.nodeType === Node.TEXT_NODE) {
    node = node.parentNode;
  }

  if (!node) return;

  // Only convert the following blocks (avoid replacing div (contenteditable))
  const blockTags = ["H1", "H2", "H3", "H4", "H5", "H6", "P", "BLOCKQUOTE", "ADDRESS", "PRE"];
  if (blockTags.includes(node.tagName)) {
    const wrapper = document.createElement(tagName);

    // Move the block’s children into the wrapper
    while (node.firstChild) {
      wrapper.appendChild(node.firstChild);
    }

    // Replace the block with the new wrapper
    node.replaceWith(wrapper);

    // Reset cursor inside the new wrapper
    const range = document.createRange();
    range.selectNodeContents(wrapper);
    range.collapse(true);
    sel.removeAllRanges();
    sel.addRange(range);
  }
}


function insertLink(prefix = "") {
  setEditorFocus();
  const url = prompt("Enter Link");
  if (!url) return;

  const sel = window.getSelection();
  if (!sel.rangeCount) return;

  const range = sel.getRangeAt(0);
  const anchor = document.createElement("a");
  anchor.href = prefix + url;

  const contents = range.extractContents();
  if (contents.textContent.trim()) {
    anchor.appendChild(contents);
  } else {
    anchor.textContent = url;
  }

  range.insertNode(anchor);
}


function unLink() {
  setEditorFocus();
  const sel = window.getSelection();
  if (!sel.rangeCount) return;

  // Find the nearest anchor around the cursor
  let node = sel.anchorNode;
  while (node && node.nodeType === Node.TEXT_NODE) {
    node = node.parentNode;
  }

  if (node && node.tagName === "A") {
    const parent = node.parentNode;

    // Move all children of the <a> back into the parent
    while (node.firstChild) {
      parent.insertBefore(node.firstChild, node);
    }

    // Remove the <a> itself
    parent.removeChild(node);

    // Reset cursor inside the unwrapped content
    const range = document.createRange();
    range.selectNodeContents(parent);
    range.collapse(false);
    sel.removeAllRanges();
    sel.addRange(range);
  }
}


function removeBlockFormatting() {
	setEditorFocus();
	let selection = window.getSelection();
	if (selection.rangeCount) {
		if (selection.anchorNode.parentNode.tagName != "DIV") {
			selection.anchorNode.parentNode.innerHTML = selection.anchorNode.parentNode.innerText;
		}
	}
}

</script>



<?php endLayout(); ?>