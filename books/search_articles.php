<?php include '../db.php';

$book_id = intval($_GET['book']);
$query = trim($_GET['q']);
$assigned = [];

$res = $conn->query("SELECT key_articles FROM book_articles WHERE key_books = $book_id");
while ($row = $res->fetch_assoc()) {
  $assigned[] = $row['key_articles'];
}

$sql = "SELECT key_articles, title FROM articles WHERE title LIKE ? ORDER BY sort ASC LIMIT 50";
$stmt = $conn->prepare($sql);
$search = "%$query%";
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

while ($a = $result->fetch_assoc()) {
  $checked = in_array($a['key_articles'], $assigned) ? 'checked' : '';
  echo "<label class='article-item'>
    <input type='checkbox' name='key_articles[]' value='{$a['key_articles']}' $checked>
    " . htmlspecialchars($a['title']) . "
  </label><br>";
}
