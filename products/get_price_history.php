<?php include '../db.php';

$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM product_prices_history WHERE key_product = $id ORDER BY change_date DESC");

if ($res->num_rows === 0) {
  echo "<p>No price changes recorded.</p>";
} else {
  echo "<table><thead><tr><th>Old Price</th><th>New Price</th><th>Change Date</th></tr></thead><tbody>";
  while ($row = $res->fetch_assoc()) {
    echo "<tr>
      <td>{$row['old_price']}</td>
      <td>{$row['new_price']}</td>
      <td>{$row['change_date']}</td>
    </tr>";
  }
  echo "</tbody></table>";
}
