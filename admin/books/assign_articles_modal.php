<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$book_id = intval($_GET['book']);
$assigned = [];
$res = $conn->query("SELECT a.key_articles, a.title FROM book_articles ba JOIN articles a ON ba.key_articles = a.key_articles WHERE ba.key_books = $book_id");
while ($row = $res->fetch_assoc()) {
	$assigned[] = $row;
}
?>
<form id="assign-form">
	<input type="hidden" name="key_books" value="<?= $book_id ?>">
	<input type="text" id="article-search" placeholder="Search articles..." onkeyup="searchArticles(<?= $book_id ?>)">
	<div id="article-list">
		<?php foreach ($assigned as $a): ?>
			<label class="article-item">
				<input type="checkbox" name="key_articles[]" value="<?= $a['key_articles'] ?>" checked>
				<?= htmlspecialchars($a['title']) ?>
			</label><br>
		<?php endforeach; ?>
	</div>
</form>
<button type="button" onclick="saveAssignments()">Save</button>
