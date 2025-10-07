<?php include '../db.php';

if (!isset($_GET['id'])) {
  echo "Missing product ID.";
  exit;
}

$id = intval($_GET['id']);
$assigned = [];
$res = $conn->query("SELECT key_categories FROM product_categories WHERE key_product = $id");
while ($row = $res->fetch_assoc()) {
  $assigned[] = intval($row['key_categories']);
}

$catResult = $conn->query("SELECT key_categories, name, category_type FROM categories WHERE status='on' ORDER BY category_type, sort");

$lastType = '';
while ($cat = $catResult->fetch_assoc()) {
  if ($cat['category_type'] !== $lastType) {
    echo "<div style='color:Navy;padding:10px 0;'>" . ucfirst(str_replace('_', ' ', $cat['category_type'])) . "</div>";
    $lastType = $cat['category_type'];
  }

  $checked = in_array($cat['key_categories'], $assigned) ? 'checked' : '';
  echo "<label style='display:block;'>
          <input type='checkbox' name='categories[]' value='{$cat['key_categories']}' $checked> {$cat['name']}
        </label>";
}
