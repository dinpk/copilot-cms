<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>

<?php startLayout("Media Library"); ?>

<p>
<a href="#" onclick="openModal()">➕ Upload New Media</a> &nbsp; 
<a href="#" onclick="openBulkModal()">📁 Upload Bulk Images</a>
</p>

<form method="get">
	<input type="text" name="q" placeholder="Search tags..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th>Preview</th>
			<th>Type</th>
			<th>Tags</th>
			<th>Alt Text</th>
			<th>Uploaded By</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$q = trim($_GET['q'] ?? '');
	$page = max(1, intval($_GET['page'] ?? 1));
	$limit = 6;
	$offset = ($page - 1) * $limit;

	// Base WHERE clause
	$where = '';
	if ($q !== '') {
		$escaped = $conn->real_escape_string($q);
		$where = " WHERE MATCH(m.alt_text, m.tags) AGAINST('$escaped' IN BOOLEAN MODE)";
	}

	// Main paginated query
	$sql = "SELECT m.*, u.username 
			FROM media_library m 
			LEFT JOIN users u ON m.uploaded_by = u.key_user
			$where
			ORDER BY m.entry_date_time DESC 
			LIMIT $limit OFFSET $offset";
	$result = $conn->query($sql);

	// Output rows
	while ($row = $result->fetch_assoc()) {
		echo "<tr>
			<td><img src='" . ($row['file_url_thumbnail'] ?: $row['file_url']) . "' width='100'></td>
			<td>{$row['file_type']}</td>
			<td>{$row['tags']}</td>
			<td>{$row['alt_text']}</td>
			<td>{$row['username']}</td>
			<td class='record-action-links'>
			  <a href='#' onclick='editItem({$row['key_media']}, \"get_media.php\", [\"file_url\",\"file_type\",\"alt_text\",\"tags\"])'>Edit</a> 
			  <a href='delete.php?id={$row['key_media']}' onclick='return confirm(\"Delete this media item?\")'>Delete</a>
			</td>
		  </tr>";
	}

	// Separate COUNT(*) query
	$countSql = "SELECT COUNT(*) AS total 
				 FROM media_library m 
				 $where";
	$total = $conn->query($countSql)->fetch_assoc()['total'];
	$totalPages = ceil($total / $limit);
	?>
	</tbody>
</table>

<div id='pager'>
	<?php
	if ($page > 1) {
		echo "<a href='?q=" . urlencode($q) . "&page=" . ($page - 1) . "'>⬅ Prev</a> ";
	}
	echo "Page $page of $totalPages ";
	if ($page < $totalPages) {
		echo "<a href='?q=" . urlencode($q) . "&page=" . ($page + 1) . "'>Next ➡</a>";
	}
	?>
</div>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Upload Media</h3>
	<form id="modal-form" method="post" enctype="multipart/form-data" action="add.php" class="skip-submit-listener">
		<input type="file" name="media_file"> <label>Select File</label><br>
		<input type="text" name="file_url" id="file_url" maxlength="2000"> <label>Or Paste URL</label><br>
		<select name="file_type" id="file_type" required>
			<option value="images">Image</option>
			<!--
			<option value="audios">audio</option>
			<option value="videos">Video</option>
			<option value="pdf">PDF</option>
			<option value="other">Other</option>
			-->
		</select> <label>File Type</label><br>
		<input type="text" name="alt_text" id="alt_text" maxlength="500"> <label>Alt Text</label><br>
		<input type="text" name="tags" id="tags" placeholder="Comma separated" maxlength="500"> <label>Tags</label><br>
		<input type="submit" value="Save">
	</form>
</div>


<div id="bulk-modal" class="modal">
  <a href="#" onclick="closeBulkModal();" class="close-icon">✖</a>
  <h3>Upload Bulk Images</h3>
  <form id="bulk-form" method="post" enctype="multipart/form-data" action="bulk_upload.php" onsubmit="preventDoubleSubmit(this);">
    <input type="file" name="bulk_files[]" multiple accept="image/*" required><br>
    <input type="text" name="tags" placeholder="Comma separated tags"><br>
    <input type="submit" name="bulk_submit_button" value="Upload All">
  </form>
</div>

<script>
function openBulkModal() {
  document.getElementById('bulk-modal').style.display = 'block';
}
function closeBulkModal() {
  document.getElementById('bulk-modal').style.display = 'none';
}
function preventDoubleSubmit(the_form) {
	const submitBtn = the_form.querySelector('input[type="submit"]');
	if (submitBtn) {
		submitBtn.disabled = true;
		submitBtn.value = 'Uploading, please wait...';
	}
}
</script>

<?php endLayout(); ?>