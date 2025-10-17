<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>

<?php startLayout("Products List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Product</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search products..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Type</th>
			<th><?= sortLink('Price', 'price', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Stock</th>
			<th>SKU</th>
			<th>Created / Updated</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$limit = 10;
	$page = max(1, intval($_GET['page'] ?? 1));
	$offset = ($page - 1) * $limit;
	$q = $conn->real_escape_string($_GET['q'] ?? '');
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'price', 'stock_quantity', 'sku', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM products";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(title, description, sku) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$keyProduct = $row["key_product"];
		$createdUpdated = $conn->query("SELECT p.key_product, u1.username AS creator, u2.username AS updater 
			FROM products p 
			LEFT JOIN users u1 ON p.created_by = u1.key_user
			LEFT JOIN users u2 ON p.updated_by = u2.key_user 
			WHERE key_product = $keyProduct")->fetch_assoc();		
	  echo "<tr>
		<td>{$row['title']}</td>
		<td>{$row['product_type']}</td>
		<td>{$row['price']}</td>
		<td>{$row['stock_quantity']}</td>
		<td>{$row['sku']}</td>
		<td>{$createdUpdated['creator']} / {$createdUpdated['updater']}</td>
		<td>{$row['status']}</td>
		<td class='record-action-links'>
		  <a href='#' onclick='editItem({$row['key_product']}, \"get_product.php\", [\"title\",\"description\",\"price\",\"stock_quantity\",\"sku\",\"product_type\",\"url\",\"status\"])'>Edit</a> 
		  <a href='delete.php?id={$row['key_product']}' onclick='return confirm(\"Delete this product?\")' style='display:none'>Delete</a> 
		  <a href='#' onclick='loadPriceHistory({$row['key_product']})'>Price History</a> 
			<a href='#' onclick='openImageModal({$row['key_product']})'>Assign Images</a>
		</td>
	  </tr>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM products";
	if ($q !== '') {
	  $countSql .= " WHERE MATCH(title, description, sku) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$total = $conn->query($countSql)->fetch_assoc()['total'];
	$totalPages = ceil($total / $limit);
	?>
	</tbody>
</table>

<div id="pager">
	<?php if ($page > 1): ?>
	<a href="?page=<?= $page - 1 ?>&q=<?= urlencode($q) ?>&sort=<?= urlencode($sort) ?>&dir=<?= urlencode($dir) ?>">⬅ Prev</a>
	<?php endif; ?>
	Page <?= $page ?> of <?= $totalPages ?>
	<?php if ($page < $totalPages): ?>
	<a href="?page=<?= $page + 1 ?>&q=<?= urlencode($q) ?>&sort=<?= urlencode($sort) ?>&dir=<?= urlencode($dir) ?>">Next ➡</a>
	<?php endif; ?>
</div>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Product</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_product" id="key_product">
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" required maxlength="200"> <label>Title</label><br>
		<input type="text" name="url" id="url" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, hyphens"> <label>Slug</label><br>
		<select name="product_type" id="product_type" required>
			<option value="">Select Type</option>
			<option value="book">Book</option>
			<option value="stationery">Stationery</option>
			<option value="digital">Digital</option>
			<option value="other">Other</option>
		</select> <label>Product Type</label><br>
		<textarea name="description" id="description" placeholder="Description" title="Description"></textarea><br>
		<input type="number" name="price" id="price" min="0" max="99999999.99" step="0.01"> <label>Price</label><br>
		<input type="number" name="stock_quantity" id="stock_quantity" min="0" max="99999999999"> <label>Stock Quantity</label><br>
		<input type="text" name="sku" id="sku" maxlength="50"> <label>SKU</label><br>
		<input type="checkbox" name="is_featured" id="is_featured" value="1"> <label>Featured</label><br>
		<input type="number" name="sort" id="sort" placeholder="Sort Order" value="0" min="0" max="2000"> <label>Sort</label><br>
		<input type="checkbox" name="status" id="status" value="on" checked> <label>Active</label><br>
		<fieldset id="select-categories">
			<legend>Categories</legend>
			<?php
			$catResult = $conn->query("SELECT key_categories, name, category_type FROM categories WHERE status='on' ORDER BY category_type, sort");
			$lastType = '';
			while ($cat = $catResult->fetch_assoc()) {
				if ($cat['category_type'] !== $lastType) {
					echo "<div style='color:Navy;padding:10px 0;'>" . ucfirst(str_replace('_', ' ', $cat['category_type'])) . "</div>";
					$lastType = $cat['category_type'];
				}
				echo "<label style='display:block;'>
						<input type='checkbox' name='categories[]' value='{$cat['key_categories']}'> {$cat['name']}
					</label>";
			}
			  ?>
		</fieldset>
		<input type="submit" value="Save">
	</form>
</div>

<div id="image-modal" class="modal">
	<h3>Assign Images to Product</h3>
	<form method="post" id="image-form">
		<input type="hidden" name="key_product" id="image_hidden_key">
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="openMediaModal()">Select Banner Image</button><br>
		<input type="number" name="sort_order" placeholder="Sort Order" value="0"><br>
		<input type="submit" value="Add Image">
	</form>
	<div id="image-list"></div>
	<button type="button" onclick="closeImageModal()">Close</button>
</div>

<div id="media-modal" class="modal">
	<a href="#" onclick="closeMediaModal();" class="close-icon">✖</a>
	<h3>Select Banner Image</h3>
	<div id="media-grid">
	<?php
	$mediaRes = $conn->query("SELECT key_media, file_url, alt_text FROM media_library WHERE file_type='image' ORDER BY entry_date_time DESC");
	while ($media = $mediaRes->fetch_assoc()) {
	  echo "<div class='media-thumb' onclick='selectMedia({$media['key_media']}, \"{$media['file_url']}\")'>
			  <img src='{$media['file_url']}' width='100'><br>
			  <small>" . htmlspecialchars($media['alt_text']) . "</small>
			</div>";
	}
	?>
	</div>
</div>

<?php endLayout(); ?>