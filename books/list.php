<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Books List"); ?>

<a href="#" onclick="openModal()">➕ Add New Book</a>


<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Publisher</th>
      <th>Year</th>
      <th>Status</th>
	  <th>Assigned Articles</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT b.*, 
  GROUP_CONCAT(a.title SEPARATOR ', ') AS assigned_articles
  FROM books b
  LEFT JOIN book_articles ba ON b.key_books = ba.key_books
  LEFT JOIN articles a ON ba.key_articles = a.key_articles
  GROUP BY b.key_books
  ORDER BY b.entry_date_time DESC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['author_name']}</td>
        <td>{$row['publisher']}</td>
        <td>{$row['publish_year']}</td>
        <td>{$row['status']}</td>
		<td>" . htmlspecialchars($row['assigned_articles'] ?? '—') . "</td>
        <td>
          <a href='#' onclick='editItem({$row['key_books']}, \"get_book.php\", [\"title\",\"subtitle\",\"description\",\"cover_image_url\",\"url\",\"author_name\",\"publisher\",\"publish_year\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_books']}' onclick='return confirm(\"Delete this book?\")'>Delete</a> | 
		  <a href='#' onclick='openAssignModal({$row['key_books']})'>Assign Articles</a>

        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<div id="assign-modal" style="display:none;"></div>


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
<div id="assign-modal" style="display:none;">
  <h3>Assign Articles to Book</h3>
  <input type="text" id="search" placeholder="Search articles...">
  <div id="article-list"></div>
  <button onclick="saveAssignments()">Save</button>
  <button onclick="closeModal()">Cancel</button>
</div>


<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
