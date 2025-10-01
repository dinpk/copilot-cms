<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Product Price History"); ?>

<?php
if (!isset($_GET['id'])) {
  echo "<p>Missing product ID.</p>";
  endLayout();
  exit;
}

$id = intval($_GET['id']);

// Fetch product title
$title = '';
$res = $conn->query("SELECT title FROM products WHERE key_product = $id LIMIT 1");
if ($row = $res->fetch_assoc()) {
  $title = $row['title'];
}

echo "<h3>Price History for: <span style='color:navy;'>$title</span></h3>";

$result = $conn->query("SELECT * FROM product_prices_history WHERE key_product = $id ORDER BY change_date DESC");

if ($result->num_rows === 0) {
  echo "<p>No price changes recorded.</p>";
} else {
  echo "<table>
    <thead>
      <tr>
        <th>Old Price</th>
        <th>New Price</th>
        <th>Change Date</th>
      </tr>
    </thead>
    <tbody>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['old_price']}</td>
      <td>{$row['new_price']}</td>
      <td>{$row['change_date']}</td>
    </tr>";
  }
  echo "</tbody></table>";
}
?>

<p style="margin-top:20px;"><a href="list.php">⬅ Back to Products</a></p>

<?php endLayout(); ?>
