<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$page = max(1, intval($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

?>


<form method="get" action="/search">
  <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" placeholder="Search...">
  <br><br>
  <?php
  $modules = ['articles','books','photo_gallery','youtube_gallery','authors','categories','pages','products'];
  foreach ($modules as $mod) {
    $checked = (empty($_GET['modules']) || in_array($mod, $_GET['modules'])) ? 'checked' : '';
	if (empty($_GET['modules']) && in_array($mod, ['authors','categories','pages'])) $checked = '';
    echo "<label><input type='checkbox' name='modules[]' value='$mod' $checked> $mod</label> ";
  }
  ?>
  <br><br>
  <button type="submit">Search</button>
</form>


<?php

$q = $_GET['q'] ?? '';
$q = $conn->real_escape_string(trim($q));
$selected = $_GET['modules'] ?? $modules;

startLayout("Search: " . htmlspecialchars($q));
echo "<h1>Search Results for: " . htmlspecialchars($q) . "</h1>";


if (!$q) {
  echo "<p>Type something to search.</p>";
  endLayout();
  exit;
}

?>


<!-- articles -->
<?php
if (in_array('articles', $selected)) {
  echo "<h2>Articles</h2>";
  $res = $conn->query("SELECT title, title_sub, article_snippet, url FROM articles WHERE status = 'on' AND MATCH(title, title_sub, content_type, article_snippet, article_content) AGAINST ('$q')
  LIMIT $limit OFFSET $offset
  ");
  while ($a = $res->fetch_assoc()) {
    echo "<div><h3>{$a['title']}</h3><p>{$a['article_snippet']}</p><a href='/article/{$a['url']}'>Read More</a></div>";
  }
}
?>


<!-- books -->
<?php
if (in_array('books', $selected)) {
  echo "<hr><h2>Books</h2>";
  $res = $conn->query("SELECT title, subtitle, description, url FROM books WHERE status = 'on' AND MATCH(title, subtitle, publisher, description, author_name) AGAINST ('$q')
  LIMIT $limit OFFSET $offset
  ");
  while ($a = $res->fetch_assoc()) {
    echo "<div><h3>{$a['title']}</h3><p>{$a['description']}</p><a href='/article/{$a['url']}'>Read More</a></div>";
  }
}
?>


<!-- categories -->
<?php
if (in_array('categories', $selected)) {
  echo "<hr><h2>Categories</h2>";
  $res = $conn->query("SELECT name, description, url FROM categories WHERE status = 'on' AND MATCH(name, description) AGAINST ('$q')
  LIMIT $limit OFFSET $offset
  ");
  while ($a = $res->fetch_assoc()) {
    echo "<div><h3>{$a['name']}</h3><p>{$a['description']}</p><a href='/article/{$a['url']}'>Read More</a></div>";
  }
}
?>

<!-- pages -->
<?php
if (in_array('pages', $selected)) {
  echo "<hr><h2>Pages</h2>";
  $res = $conn->query("SELECT title, page_content, url FROM pages WHERE status = 'on' AND MATCH(title, page_content) AGAINST ('$q')
  LIMIT $limit OFFSET $offset
  ");
  while ($a = $res->fetch_assoc()) {
	  $snippet = firstWords($a['page_content'], 20);
    echo "<div><h3>{$a['title']}</h3><p>$snippet</p><a href='/article/{$a['url']}'>Read More</a></div>";
  }
}
?>


<!-- products -->
<?php
if (in_array('products', $selected)) {
  echo "<hr><h2>Products</h2>";
  $res = $conn->query("SELECT title, description, url FROM products WHERE status = 'on' AND MATCH(title, description) AGAINST ('$q')
  LIMIT $limit OFFSET $offset
  ");
  while ($a = $res->fetch_assoc()) {
    echo "<div><h3>{$a['title']}</h3><p>{$a['description']}</p><a href='/article/{$a['url']}'>Read More</a></div>";
  }
}
?>

<!-- photo gallery -->
<?php
if (in_array('photo_gallery', $selected)) {
  echo "<hr><h2>Photo Gallery</h2>";
  $res = $conn->query("SELECT title, description, url FROM photo_gallery WHERE status = 'on' AND MATCH(title, description) AGAINST ('$q')
  LIMIT $limit OFFSET $offset
  ");
  while ($a = $res->fetch_assoc()) {
    echo "<div><h3>{$a['title']}</h3><p>{$a['description']}</p><a href='/article/{$a['url']}'>Read More</a></div>";
  }
}
?>


<!-- youtube gallery -->
<?php
if (in_array('youtube_gallery', $selected)) {
  echo "<hr><h2>Youtube Gallery</h2>";
  $res = $conn->query("SELECT title, description, url FROM youtube_gallery WHERE status = 'on' AND MATCH(title, description) AGAINST ('$q')
  LIMIT $limit OFFSET $offset
  ");
  while ($a = $res->fetch_assoc()) {
    echo "<div><h3>{$a['title']}</h3><p>{$a['description']}</p><a href='/article/{$a['url']}'>Read More</a></div>";
  }
}
?>

<br><hr><br>

<!-- pager -->
<?php
echo "<div class='pagination'>";
if ($page > 1) {
  echo "<a href='?q=" . urlencode($q) . "&page=" . ($page - 1) . "'>Previous</a> ";
}
echo "<a href='?q=" . urlencode($q) . "&page=" . ($page + 1) . "'>Next</a>";
echo "</div>";

?>

<br>

<?php
endLayout();
?>