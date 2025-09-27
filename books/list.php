<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Books List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Book</a></p>

<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search books..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Publisher</th>
      <th>Year</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
	
	$limit = 10;
	$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
	$offset = ($page - 1) * $limit;
	
	// search
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sql = "SELECT * FROM books";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(title,subtitle,publisher,description,author_name) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY sort ASC, key_books DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['author_name']}</td>
        <td>{$row['publisher']}</td>
        <td>{$row['publish_year']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_books']}, \"get_book.php\", [\"title\",\"subtitle\",\"description\",\"cover_image_url\",\"url\",\"author_name\",\"publisher\",\"publish_year\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_books']}' onclick='return confirm(\"Delete this book?\")'>Delete</a> | 
		  <a href='#' onclick='openAssignModal({$row['key_books']})'>Assign Articles</a>

        </td>
      </tr>";
    }
	
	// count records for pager
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



<!-- Pager -->
<div style="margin-top:20px;">
  <?php if ($page > 1): ?>
    <a href="?page=<?php echo $page - 1; ?>">⬅ Prev</a>
  <?php endif; ?>

  Page <?php echo $page; ?> of <?php echo $totalPages; ?>

  <?php if ($page < $totalPages): ?>
    <a href="?page=<?php echo $page + 1; ?>">Next ➡</a>
  <?php endif; ?>
</div>






<!-- Modal Form — add / edit -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Book</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_books" id="key_books">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <input type="text" name="subtitle" id="subtitle" placeholder="Subtitle"><br>
    <textarea name="description" id="description" placeholder="Description"></textarea><br>
    <input type="text" name="cover_image_url" id="cover_image_url" placeholder="Cover Image URL"><br>
    <input type="text" name="url" id="url" placeholder="URL"><br>
    <input type="text" name="author_name" id="author_name" placeholder="Author Name"><br>
    <input type="text" name="publisher" id="publisher" placeholder="Publisher"><br>
    <input type="text" name="publish_year" id="publish_year" placeholder="Publish Year"><br>
    <input type="text" name="status" id="status" placeholder="Status"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>



<!-- Modal Form — assign articles -->
<div id="assign-modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="assign-modal-title">Assign Articles to Book</h3>

  <form id="assign-form" method="post" action="assign_articles.php">
    <input type="hidden" name="key_books" id="assign_book_id">
    <input type="text" id="article_search" placeholder="Search articles..." oninput="filterArticles()"><br><br>
    <div id="article-list" style="max-height:300px; overflow-y:auto;"></div>
    <input type="submit" value="Save">
    <button type="button" onclick="closeAssignModal()">Cancel</button>
  </form>
</div>


<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
