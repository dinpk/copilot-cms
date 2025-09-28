<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Book Price History"); ?>

<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search by title..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Old Price</th>
      <th>New Price</th>
      <th>Changed On</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $q = $_GET['q'] ?? '';
    $q = $conn->real_escape_string($q);

    $sql = "SELECT h.old_price, h.new_price, h.change_date, b.title 
            FROM book_prices_history h 
            JOIN books b ON h.key_books = b.key_books";
    if ($q !== '') {
      $sql .= " WHERE b.title LIKE '%$q%'";
    }
    $sql .= " ORDER BY h.change_date DESC";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['title']}</td>
        <td>Rs. {$row['old_price']}</td>
        <td>Rs. {$row['new_price']}</td>
        <td>{$row['change_date']}</td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<?php endLayout(); ?>
