<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Products List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Product</a></p>

<form method="get" style="margin-bottom:20px;">
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
	  <th>Created</th>
	  <th>Updated</th>
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
		
		// Show created by updated by
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
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_product']}, \"get_product.php\", [\"title\",\"description\",\"price\",\"stock_quantity\",\"sku\",\"product_type\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_product']}' onclick='return confirm(\"Delete this product?\")'>Delete</a> |
          <a href='#' onclick='loadPriceHistory({$row['key_product']})'>Price History</a> | 
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

<div style="margin-top:20px;">
  <?php if ($page > 1): ?>
    <a href="?page=<?= $page - 1 ?>&q=<?= urlencode($q) ?>&sort=<?= urlencode($sort) ?>&dir=<?= urlencode($dir) ?>">⬅ Prev</a>
  <?php endif; ?>
  Page <?= $page ?> of <?= $totalPages ?>
  <?php if ($page < $totalPages): ?>
    <a href="?page=<?= $page + 1 ?>&q=<?= urlencode($q) ?>&sort=<?= urlencode($sort) ?>&dir=<?= urlencode($dir) ?>">Next ➡</a>
  <?php endif; ?>
</div>

<!-- Modal Form — Add/Edit -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; height:80vh; z-index:1000;">
  <h3 id="modal-title">Add Product</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_product" id="key_product">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <textarea name="description" id="description" placeholder="Description"></textarea><br>
    <input type="text" name="sku" id="sku" placeholder="SKU"><br>
    <input type="number" name="price" id="price" placeholder="Price"><br>
    <input type="number" name="stock_quantity" id="stock_quantity" placeholder="Stock Quantity"><br>
    <select name="product_type" id="product_type">
      <option value="book">Book</option>
      <option value="stationery">Stationery</option>
      <option value="digital">Digital</option>
      <option value="other">Other</option>
    </select><br>
    <label>
      <input type="checkbox" name="status" id="status" value="on" checked> Active
    </label><br>

    <div style="margin:10px 0;border:1px solid #777;padding:20px;">
      <h3>Categories</h3>
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
    </div>

    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>




<!-- Modal: Assign Images -->
<div id="image-modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; height:80vh; z-index:1000;">
  <h3>Assign Images to Product</h3>
	<form method="post" id="image-form">
	  <input type="hidden" name="key_product" id="image_key_product">
	  <input type="text" name="image_url" placeholder="Image URL" required><br>
	  <input type="number" name="sort_order" placeholder="Sort Order"><br>
	  <input type="submit" value="Add Image">
	</form>

  <div id="image-list" style="margin-top:20px;"></div>
  
  <button type="button" onclick="closeImageModal()">Close</button>

  
</div>


<?php endLayout(); ?>
