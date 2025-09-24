<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Articles List"); ?>

<a href="#" onclick="openModal()">➕ Add New Article</a>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Snippet</th>
      <th>Categories</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM articles ORDER BY sort ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['article_snippet']}</td>
        <td>{$row['categories']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_articles']}, \"get_article.php\", [\"title\",\"title_sub\",\"article_snippet\",\"article_content\",\"url\",\"banner_image_url\",\"sort\",\"categories\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_articles']}' onclick='return confirm(\"Delete this article?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal Form -->
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

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
