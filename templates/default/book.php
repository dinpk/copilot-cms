<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get book info
$book = $conn->query("SELECT b.*, m.file_url AS banner_url 
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

	<h1>
	Book: <?= htmlspecialchars($book['title']) ?>
	<div><?= htmlspecialchars($book['subtitle']) ?></div>
	</h1>
	

	<?php
		if ($book['banner_image_url']) { // pasted link url 
			echo "<div id='content-banner' style='background-image:url(" . $book['banner_image_url'] . ")'></div>";
		} else if ($book['banner_url']) { // uploaded file url
			echo "<div id='content-banner' style='background-image:url(" . $book['banner_url'] . ")'></div>";
		}
		
		if (!empty($book['author_name'])) {
			echo "<p><b>Author:</b> " . htmlspecialchars($book['author_name']) .  "</p>";
		}
	?>
	
	<p><em><?= htmlspecialchars($book['description']) ?></em></p>

	<hr>

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
