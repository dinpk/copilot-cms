<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php');

$regionOptions = [
	"above_header"   => "Above Header",
	"header"         => "Header",
	"below_header"   => "Below Header",
	"sidebar_right"  => "Sidebar Right",
	"above_content"  => "Above Content",
	"below_content"  => "Below Content",
	"sidebar_left"   => "Sidebar Left",
	"above_footer"   => "Above Footer",
	"footer"         => "Footer",
	"below_footer"   => "Below Footer"
];

?>

<?php startLayout('Blocks List'); ?>

<a href="#" onclick="openModal()">➕ Add New Block</a><br><br>

<form method="get">
    <select name="region_filter" id="region_filter" onchange="this.form.submit()">
        <option value="">All Regions</option>
        <?php foreach ($regionOptions as $value => $label): ?>
            <option value="<?= $value ?>" <?= ($_GET['region_filter'] ?? '') === $value ? 'selected' : '' ?>>
                <?= $label ?>
            </option>
        <?php endforeach; ?>
    </select> Filter
</form>

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
		<th><?= sortLink('# of Records', 'number_of_records', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th><?= sortLink('Active', 'is_active', $_GET['sort'] ?? '', $_GET['dir'] ?? ''); ?></th>
		<th>Actions</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$sort = $_GET['sort'] ?? 'sort';
	$dir = $_GET['dir'] ?? 'asc';
	$allowedSorts = ['title', 'region', 'pages', 'sort', 'number_of_records', 'is_active'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) {
		$sort = 'entry_date_time';
	}
	if (!in_array($dir, $allowedDirs)) {
		$dir = 'desc';
	}
	$regionFilter = $_GET['region_filter'] ?? '';
	$sql = "SELECT * FROM blocks";
	if ($regionFilter !== '') {
		$sql .= " WHERE show_in_region = '" . $conn->real_escape_string($regionFilter) . "'";
	}
	$sql .= " ORDER BY $sort $dir";	
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
		<td>{$row['number_of_records']}</td>
		<td>{$row['is_active']}</td>
		<td class='record-action-links'>
			<a href='#' onclick='editItem({$row['key_blocks']}, \"get_block.php\", [\"block_name\",\"title\",\"block_content\",\"show_on_pages\",\"show_in_region\",\"visible_on\",\"css\",\"sort\",\"module_file\",\"number_of_records\",\"key_photo_gallery\",\"key_content_types\",\"key_categories\",\"key_tags\",\"is_dynamic\",\"is_active\"])'>Edit</a> 
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
		<input type="text" name="title" id="title" maxlength="200"> <label>Title</label><br>
		<textarea name="block_content" id="block_content" placeholder="Content" title="Content" maxlength="10000"></textarea><br>
		<br>
		<input type="text" name="block_name" id="block_name" required maxlength="200"> <label>Block Name</label><br>
		<select name="show_in_region" id="show_in_region">
			<?php foreach ($regionOptions as $value => $label): ?>
				<option value="<?= $value ?>"><?= strtolower($label) ?></option>
			<?php endforeach; ?>
		</select> <label>Show in Region</label><br>
		<textarea name="show_on_pages" id="show_on_pages" placeholder="Show on Pages (comma separated)" title="Show on Pages (comma separated)" maxlength="1000"></textarea><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="openMediaModal()" style="display:none;">Select Banner Image</button>
		<input type="text" name="css" id="css"> <label>CSS</label><br>
		<input type="number" name="sort" id="sort" value="0" min="-200" max="2000"> <label>Sort</label><br>
		<div style="display:none;"><label> <input type="checkbox" name="is_dynamic" id="is_dynamic"> Dynamic</label><br></div>
		<label> <input type="checkbox" name="is_active" id="is_active" checked> Active</label><br>
		
		<details>
		<summary>Visibility</summary>
		<?php
		// Visible on devices
		$deviceOptions = ['large-desktop', 'desktop', 'tablet', 'mobile', 'print'];
		foreach ($deviceOptions as $device) {
			$checked = ($device == 'print') ? '' : 'checked';
			echo "&nbsp; &nbsp; <label><input type='checkbox' name='visible_on[]' value='" . $device . "' $checked> &nbsp;$device</label><br>";
		}
		?>
		</details>

		<details>
		<summary>Attachments</summary>

			<?php
				$block = $block ?? [];
			?>
			
			<select name='module_file' id='module_file'>
				<option value=''></option>
				<?php
				$module_files = glob('../../modules/*.php');
				$modules = array_map('basename', $module_files);
				foreach ($modules as $module) {
					$module_value = str_replace('.php', '', $module);
					$module_name = removeDigits($module_value);
					$module_name = str_replace('_', ' ', $module_name);
					$module_name = strtolower($module_name);
					echo "<option value='$module_value'>$module_name</option>";
				}
				?>
			</select> <label>Module File</label><br>

			<input type="number" name="number_of_records" id="number_of_records" value="5" min="0" max="1000"> <label>Number of Records</label><br>

			<?php
			// Photo galleries available for blocks
			$galleryQuery = "SELECT key_photo_gallery, title FROM photo_gallery WHERE is_active = 1 AND available_for_blocks = 1 ORDER BY entry_date_time DESC";
			$galleryResult = mysqli_query($conn, $galleryQuery);
			?>
			<select name="key_photo_gallery" id="key_photo_gallery" class="form-control">
				<option value="0"></option>
				<?php while ($gallery = mysqli_fetch_assoc($galleryResult)): ?>
				<option value="<?= $gallery['key_photo_gallery']; ?>"
					<?= ($block['key_photo_gallery'] ?? '') == $gallery['key_photo_gallery'] ? 'selected' : ''; ?>>
					<?= htmlspecialchars($gallery['title']); ?>
				</option>
				<?php endwhile; ?>
			</select> <label>Photo Gallery</label><br>

			<?php
			$attachQuery = "SELECT key_content_types, name FROM content_types WHERE is_active = 1 ORDER BY name";
			$attachResult = mysqli_query($conn, $attachQuery);
			?>
			<select name="key_content_types" id="key_content_types" class="form-control">
				<option value="0"></option>
				<?php while ($record = mysqli_fetch_assoc($attachResult)): ?>
				<option value="<?= $record['key_content_types']; ?>"
					<?= ($block['key_content_types'] ?? '') == $record['key_content_types'] ? 'selected' : ''; ?>>
					<?= htmlspecialchars($record['name']); ?>
				</option>
				<?php endwhile; ?>
			</select> <label>Content Type</label><br>

			<?php
			$attachQuery = "SELECT key_categories, name FROM categories WHERE is_active = 1 ORDER BY name";
			$attachResult = mysqli_query($conn, $attachQuery);
			?>
			<select name="key_categories" id="key_categories" class="form-control">
				<option value="0"></option>
				<?php while ($record = mysqli_fetch_assoc($attachResult)): ?>
				<option value="<?= $record['key_categories']; ?>"
					<?= ($block['key_categories'] ?? '') == $record['key_categories'] ? 'selected' : ''; ?>>
					<?= htmlspecialchars($record['name']); ?>
				</option>
				<?php endwhile; ?>
			</select> <label>Category</label><br>

			<?php
			$attachQuery = "SELECT key_tags, name FROM tags WHERE is_active = 1 ORDER BY name";
			$attachResult = mysqli_query($conn, $attachQuery);
			?>
			<select name="key_tags" id="key_tags" class="form-control">
				<option value="0"></option>
				<?php while ($record = mysqli_fetch_assoc($attachResult)): ?>
				<option value="<?= $record['key_tags']; ?>"
					<?= ($block['key_tags'] ?? '') == $record['key_tags'] ? 'selected' : ''; ?>>
					<?= htmlspecialchars($record['name']); ?>
				</option>
				<?php endwhile; ?>
			</select> <label>Tag</label><br>


		</details>
		



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