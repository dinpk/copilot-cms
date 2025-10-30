<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? '';
$book = getBookBySlug($conn, $slug);
if (!$book) {
	echo "⚠ Book not found.";
	exit;
}
startLayout("Book: " . htmlspecialchars($book['title']));
?>

<div id="content">
	<?php
	echo "<h1>Book:" . htmlspecialchars($book['title']) . "<div>" . htmlspecialchars($book['subtitle']) . "</div></h1>";
	if ($book['banner_image_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $book['banner_image_url'] . ")'></div>";
	} else if ($book['banner_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $book['banner_url'] . ")'></div>";
	}
	if (!empty($book['author_name'])) {
		echo "<div><b>Author:</b> " . htmlspecialchars($book['author_name']) .  "</div>";
	}
	
	echo "<div><em>" . htmlspecialchars($book['description']) . "</em></div><hr>";
	
	$articles = getArticlesForBook($conn, $book['key_books']);
	while ($record = $articles->fetch_assoc()) {
	  echo "<div>
				<div class='indent-level-{$record['book_indent_level']}'><a href='/article/{$record['url']}'>{$record['title']}</a></div>
			</div>";
	}
	?>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
