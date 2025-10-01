<?php
include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT h.old_price, h.new_price, h.change_date, b.title 
        FROM book_prices_history h 
        JOIN books b ON h.key_books = b.key_books 
        WHERE h.key_books = $id 
        ORDER BY h.change_date DESC";
$result = $conn->query($sql);

// Get book title for modal header
$book_title = '';
if ($row = $result->fetch_assoc()) {
  $book_title = $row['title'];
  echo "<h4><em>{$book_title}</em></h4>";
  echo "<table><tr><th>Old</th><th>New</th><th>Date</th></tr>";
  echo "<tr>
    <td>Rs. {$row['old_price']}</td>
    <td>Rs. {$row['new_price']}</td>
    <td>{$row['change_date']}</td>
  </tr>";
  // Continue rendering remaining rows
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>Rs. {$row['old_price']}</td>
      <td>Rs. {$row['new_price']}</td>
      <td>{$row['change_date']}</td>
    </tr>";
  }
  echo "</table>";
} else {
  echo "<p>No price history found for this book.</p>";
}
?>
