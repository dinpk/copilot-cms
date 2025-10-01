<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Books — Sell Settings"); ?>


<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search books..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Price', 'price', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Stock', 'stock_quantity', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Discount', 'discount_percent', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Format', 'format', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Language', 'language', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $limit;

    $q = $_GET['q'] ?? '';
    $q = $conn->real_escape_string($q);
	
	
	// sort
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'price', 'stock_quantity', 'discount_percent', 'format', 'language'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	
	
    $sql = "SELECT * FROM books";
    if ($q !== '') {
      $sql .= " WHERE MATCH(title,subtitle,author_name,publisher,description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
    }
    $sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
	
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['title']}</td>
        <td>Rs. {$row['price']}</td>
        <td>{$row['stock_quantity']}</td>
        <td>{$row['discount_percent']}%</td>
        <td>{$row['format']}</td>
        <td>{$row['language']}</td>
        <td>
          <a href='#' onclick='editSellItem({$row['key_books']}, \"get_book.php\", [\"price\",\"stock_quantity\",\"discount_percent\",\"format\",\"language\"])'>Edit</a> |
		  <a href='#' onclick='loadPriceHistory(" . $row['key_books'] . ")'>View History</a>
        </td>
      </tr>";
    }

    $countSql = "SELECT COUNT(*) AS total FROM books";
    if ($q !== '') {
      $countSql .= " WHERE MATCH(title,subtitle,author_name,publisher,description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
    }
    $countResult = $conn->query($countSql);
    $totalBooks = $countResult->fetch_assoc()['total'];
    $totalPages = ceil($totalBooks / $limit);
    ?>
  </tbody>
</table>

<!-- Pager -->
<div style="margin-top:20px;">
	<?php if ($page > 1): ?>
	  <a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">⬅ Prev</a>
	<?php endif; ?>

	Page <?php echo $page; ?> of <?php echo $totalPages; ?>

	<?php if ($page < $totalPages): ?>
	  <a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">Next ➡</a>
	<?php endif; ?>
</div>

<!-- Modal Form — Sell Settings -->
<div id="sell-modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="sell-modal-title">Edit Sell Info</h3>
  <form id="sell-form" method="post" action="update_sell.php">
    <input type="hidden" name="key_books" id="key_books">
    <input type="text" name="price" id="price" placeholder="Price (Rs.)"><br>
    <input type="number" name="stock_quantity" id="stock_quantity" placeholder="Stock Quantity"><br>
    <input type="number" name="discount_percent" id="discount_percent" placeholder="Discount (%)"><br>
    <input type="text" name="format" id="format" placeholder="Format"><br>
    <input type="text" name="language" id="language" placeholder="Language"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeSellModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
