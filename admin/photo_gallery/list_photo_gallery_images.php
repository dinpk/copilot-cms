<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 

$key_photo_gallery = intval($_GET['gallery_id'] ?? 0);
if (!$key_photo_gallery) die("Invalid gallery ID");

$gallery = $conn->query("SELECT title FROM photo_gallery WHERE key_photo_gallery = $key_photo_gallery")->fetch_assoc();
startLayout("Images for: " . htmlspecialchars($gallery['title']));
?>

<p><a href="#" onclick="galleryImage_openModal()">➕ Add Image</a></p>

<table>
	<thead>
		<tr>
			<th>Preview</th>
			<th>Title</th>
			<th>Sort</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$result = $conn->query("SELECT * FROM photo_gallery_images WHERE key_photo_gallery = $key_photo_gallery ORDER BY sort_order ASC");
	while ($row = $result->fetch_assoc()):
	  $media = $row['key_media_banner'] ? $conn->query("SELECT file_url FROM media_library WHERE key_media = {$row['key_media_banner']}")->fetch_assoc() : null;
	?>
		<tr>
			<td>
				<?php if ($media): ?>
				<img src="<?= $media['file_url'] ?>" width="100">
				<?php else: ?>
				<em>No image</em>
				<?php endif; ?>
			</td>
			<td><?= htmlspecialchars($row['title']) ?></td>
			<td><?= $row['sort_order'] ?></td>
			<td><?= $row['status'] ?></td>
			<td class='record-action-links'>
				<a href="#" onclick="galleryImage_editItem(<?= $row['key_image'] ?>)">Edit</a> 
				<a href="#" onclick="galleryImage_openMediaModal(<?= $row['key_image'] ?>)">Assign Image</a> 
				<a href="delete_photo_gallery_image.php?image_id=<?= $row['key_image'] ?>" onclick="return confirm('Delete this image?')">Delete</a>
			</td>
		</tr>
		<?php endwhile; ?>
	</tbody>
</table>

<div id="galleryImageModal" class="modal">
	<a href="#" onclick="galleryImage_closeModal();" class="close-icon">✖</a>
	<h3 id="galleryImageModalTitle">Add Image</h3>
	<form id="galleryImageForm" method="post" action="save_photo_gallery_image.php">
		<input type="hidden" name="key_image" id="galleryImage_key_image">
		<input type="hidden" name="key_photo_gallery" id="galleryImage_key_photo_gallery" value="<?= $key_photo_gallery ?>">
		<input type="text" name="title" id="galleryImage_title"> <label>Title</label><br>
		<textarea name="description" id="galleryImage_description" placeholder="Description" title="Description"></textarea><br>
		<select name="text_position" id="galleryImage_text_position">
			<option value="center">Center</option>
			<option value="left">Left</option>
			<option value="right">Right</option>
			<option value="bottom">Bottom</option>
		</select> <label>Text Position</label><br>
		<input type="color" name="text_color" id="galleryImage_text_color" value="#ffffff"> <label>Text Color</label><br>
		<input type="number" step="0.1" min="0.1" max="1" name="opacity" id="galleryImage_opacity" value="1"> <label>Image Opacity</label><br>
		<select name="animation_type" id="galleryImage_animation_type">
			<option value="fade">Fade</option>
			<option value="zoom">Zoom</option>
			<option value="slide">Slide</option>
			<option value="none">None</option>
		</select> <label>Animation Type</label><br>
		<input type="checkbox" name="action_button" id="galleryImage_action_button" value="1"> <label>Show Action Button</label><br>
		<input type="text" name="action_button_text" id="galleryImage_action_button_text"> <label>Button Text</label><br>
		<input type="text" name="action_button_link_url" id="galleryImage_action_button_link_url"> <label>Button Link URL</label><br>
		<input type="text" name="image_wrapper_class" id="galleryImage_image_wrapper_class" title="Image Wrapper CSS Class"> <label>Wrapper CSS Class</label><br>
		<select name="status" id="galleryImage_status">
			<option value="on">Active</option>
			<option value="off">Inactive</option>
		</select> <label>Status</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<div id="mediaPickerModal" class="modal" style="display:none;"></div>
<script>
	function galleryImage_openModal() {
		document.getElementById('galleryImageModalTitle').innerText = 'Add Image';
		document.getElementById('galleryImageForm').reset();
		document.getElementById('galleryImage_key_image').value = '';
		document.getElementById('galleryImageModal').style.display = 'block';
	}
	function galleryImage_closeModal() {
		document.getElementById('galleryImageModal').style.display = 'none';
	}
	function galleryImage_editItem(id) {
		fetch('get_photo_gallery_image.php?image_id=' + id)
			.then(res => res.json())
			.then(data => {
				document.getElementById('galleryImageModalTitle').innerText = 'Edit Image';
				document.getElementById('galleryImage_key_image').value = id;
				[
					'title', 'description', 'opacity', 'action_button',
					'action_button_text', 'action_button_link_url', 'animation_type',
					'text_position', 'text_color', 'image_wrapper_class', 'status'
				].forEach(field => {
					const el = document.getElementById('galleryImage_' + field);
					if (el.type === 'checkbox') {
						el.checked = data[field] == '1';
					} else {
						el.value = data[field] || '';
					}
				});
				document.getElementById('galleryImageModal').style.display = 'block';
			});
	}
	function galleryImage_openMediaModal(imageId) {
		fetch('assign_photo_gallery_image.php?image_id=' + imageId)
			.then(res => res.text())
			.then(html => {
				document.getElementById('mediaPickerModal').innerHTML = html;
				document.getElementById('mediaPickerModal').style.display = 'block';
			});
	}
	function galleryImage_assignMedia(imageId, mediaId) {
		fetch('assign_photo_gallery_image_save.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			body: 'image_id=' + imageId + '&media_id=' + mediaId
		}).then(() => {
			document.getElementById('mediaPickerModal').style.display = 'none';
			location.reload();
		});
	}

	document.addEventListener('click', function(e) {
		if (e.target.closest('.media-modal-link')) {
			e.preventDefault();
			const link = e.target.closest('.media-modal-link');
			fetch(link.href)
				.then(res => res.text())
				.then(html => {
					console.log(html);
					document.getElementById('mediaPickerModal').innerHTML = html;
				});
		}
	});
	document.addEventListener('submit', function(e) {
		if (e.target.id === 'media-search-form') {
			e.preventDefault();
			const form = e.target;
			const params = new URLSearchParams(new FormData(form)).toString();
			fetch('assign_photo_gallery_image.php?' + params)
				.then(res => res.text())
				.then(html => {
					document.getElementById('mediaPickerModal').innerHTML = html;
				});
		}
	});
</script>

<?php endLayout(); ?>