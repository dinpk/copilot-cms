<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get book info
$book = $conn->query("SELECT b.*, m.file_url AS banner 
                      FROM books b 
                      LEFT JOIN media_library m ON b.key_media_banner = m.key_media 
                      WHERE b.url = '$slug' AND b.status = 'on'")->fetch_assoc();

if (!$book) {
  echo "⚠ Book not found.";
  exit;
}

startLayout("Book: " . htmlspecialchars($book['title']));
?>

<div id="content">

	<h1><?= htmlspecialchars($book['title']) ?></h1>
	<h3><?= htmlspecialchars($book['subtitle']) ?></h3>

	<?php if ($book['banner']): ?>
	  <img src="<?= htmlspecialchars($book['banner']) ?>" width="600"><br>
	<?php endif; ?>

	<p>Author: <em><?= htmlspecialchars($book['author_name']) ?></em></p>
	<p><em><?= htmlspecialchars($book['description']) ?></em></p>

	<br><hr><br>

	<!-- Linked Articles -->
	<h2>Articles in this Book</h2>
	<?php
	$articles = $conn->query("SELECT a.*, m.file_url AS banner 
							  FROM articles a
							  JOIN book_articles ba ON a.key_articles = ba.key_articles
							  LEFT JOIN media_library m ON a.key_media_banner = m.key_media
							  WHERE ba.key_books = {$book['key_books']} AND a.status = 'on'
							  ORDER BY a.sort");

	while ($a = $articles->fetch_assoc()) {
	  echo "<div class='snippet-card'>
				<div class='snippet-content'>
					<h3>{$a['title']}</h3>
					<p>{$a['article_snippet']}</p>
					<a href='/article/{$a['url']}'>Read More</a>
				</div>
			</div>";
	}
	?>

</div>


<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
