<?php
include '../db.php';
include '../layout.php';
include '../users/auth.php';
?>

<?php startLayout('Blocks List'); ?>

<a href="#" onclick="openModal()">➕ Add New Block</a>

<table>
	<thead>
	<tr>
		<th><?= sortLink('Name', 'block_name', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th><?= sortLink('Region', 'show_in_region', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th><?= sortLink('Pages', 'show_on_pages', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th><?= sortLink('Module', 'module_file', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th>Created / Updated</th>
		<th><?= sortLink('Sort', 'sort', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th>Actions</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$sort = $_GET['sort'] ?? 'sort';
	$dir = $_GET['dir'] ?? 'asc';
	$allowedSorts = ['title', 'region', 'pages', 'sort', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) {
		$sort = 'entry_date_time';
	}
	if (!in_array($dir, $allowedDirs)) {
		$dir = 'desc';
	}
	$sql = "SELECT * FROM blocks ORDER BY $sort $dir";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$keyBlocks = $row['key_blocks'];
		$createdUpdated = $conn->query("SELECT b.key_blocks, u1.username AS creator, u2.username AS updater 
			FROM blocks b 
			LEFT JOIN users u1 ON b.created_by = u1.key_user
			LEFT JOIN users u2 ON b.updated_by = u2.key_user 
			WHERE key_blocks = $keyBlocks")->fetch_assoc();
		echo "<tr>
		<td>{$row['block_name']}</td>
		<td>{$row['title']}</td>
		<td>{$row['show_in_region']}</td>
		<td>{$row['show_on_pages']}</td>
		<td>{$row['module_file']}</td>
		<td>{$createdUpdated['creator']} / {$createdUpdated['updater']}</td>
		<td>{$row['sort']}</td>
		<td>{$row['status']}</td>
		<td class='record-action-links'>
			<a href='#' onclick='editItem({$row['key_blocks']}, \"get_block.php\", [\"block_name\",\"title\",\"block_content\",\"show_on_pages\",\"show_in_region\",\"visible_on\",\"sort\",\"module_file\",\"key_photo_gallery\",\"status\"])'>Edit</a> 
			<a href='delete.php?id={$row['key_blocks']}' onclick='return confirm(\"Delete this block?\")'>Delete</a>
		</td>
		</tr>";
	}
	?>
	</tbody>
</table>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Block</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_blocks" id="key_blocks">
		<input type="text" name="title" id="title" required maxlength="200"> <label>Title</label><br>
		<textarea name="block_content" id="block_content" placeholder="Content" title="Content" maxlength="10000"></textarea><br>
		<br>
		<input type="text" name="block_name" id="block_name" required maxlength="200"> <label>Block Name</label><br>
		<select name='show_in_region' id='show_in_region'>
			<option value="above_header">Above Header</option>
			<option value="header">Header</option>
			<option value="below_header">Below Header</option>
			<option value="sidebar_right">Sidebar Right</option>
			<option value="content">Content</option>
			<option value="sidebar_left">Sidebar Left</option>
			<option value="above_footer">Above Footer</option>
			<option value="footer">Footer</option>
			<option value="below_footer">Below Footer</option>
		</select> <label>Show in Region</label><br>
		<textarea name="show_on_pages" id="show_on_pages" placeholder="Show on Pages (comma separated)" title="Show on Pages (comma separated)" maxlength="1000"></textarea><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="openMediaModal()" style="display:none;">Select Banner Image</button>
		<select name='module_file' id='module_file'>
			<option value=''></option>
			<?php
			$module_files = glob('../../modules/*.php');
			$modules = array_map('basename', $module_files);
			foreach ($modules as $module) {
				$module_name = str_replace('.php', '', $module);
				echo "<option value='$module_name'>$module_name</option>";
			}
			?>
		</select> <label>Module File</label><br>
		
		<label>Visible On <span> — Leave unchecked for all devices</label><br>
		<?php
		// Visible on devices
		$deviceOptions = ['large-desktop', 'desktop', 'tablet', 'mobile', 'print'];
		foreach ($deviceOptions as $device) {
			echo "&nbsp; &nbsp; <label><input type='checkbox' name='visible_on[]' value='" . $device . "'> &nbsp;$device</label><br>";
		}
		?>

		<?php
		// Photo galleries available for blocks
		$galleryQuery = "SELECT key_photo_gallery, title FROM photo_gallery WHERE status = 'on' AND available_for_blocks = 'on' ORDER BY entry_date_time DESC";
		$galleryResult = mysqli_query($conn, $galleryQuery);
		?>
		<select name="key_photo_gallery" id="key_photo_gallery" class="form-control">
			<option value=""></option>
			<?php while ($gallery = mysqli_fetch_assoc($galleryResult)): ?>
			<option value="<?= $gallery['key_photo_gallery']; ?>"
				<?= ($block['key_photo_gallery'] ?? '') == $gallery['key_photo_gallery'] ? 'selected' : ''; ?>>
				<?= htmlspecialchars($gallery['title']); ?>
			</option>
			<?php endwhile; ?>
		</select> <label>Assign Photo Gallery</label><br>
		
		<input type="number" name="sort" id="sort" value="0" min="0" max="2000"> <label>Sort</label><br>
		<input type="checkbox" name="status" id="status" value="on" checked> <label>Active</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<div id="media-modal" class="modal">
	<a href="#" onclick="closeMediaModal();" class="close-icon">✖</a>
	<h3>Select Banner Image</h3>
	<div id="media-grid">
	<?php
	$mediaRes = $conn->query("SELECT key_media, file_url, alt_text FROM media_library WHERE file_type='images' ORDER BY entry_date_time DESC");
	while ($media = $mediaRes->fetch_assoc()) {
		echo "<div class='media-thumb' onclick='selectMedia({$media['key_media']}, \"{$media['file_url']}\")'>
				<img src='{$media['file_url']}' width='100'><br>
				<small>".htmlspecialchars($media['alt_text']).'</small>
			</div>';
	}
	?>
	</div>
</div>

<?php endLayout(); ?>