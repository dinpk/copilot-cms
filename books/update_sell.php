<?php
include '../db.php';

$key_books = intval($_POST['key_books']);
$new_price = floatval($_POST['price']);
$stock_quantity = intval($_POST['stock_quantity']);
$discount_percent = intval($_POST['discount_percent']);
$format = $conn->real_escape_string($_POST['format']);
$language = $conn->real_escape_string($_POST['language']);

// Fetch old price for comparison
$old_price = 0;
$check = $conn->query("SELECT price FROM books WHERE key_books = $key_books LIMIT 1");
if ($row = $check->fetch_assoc()) {
  $old_price = floatval($row['price']);
}

// Update books table
$sql = "UPDATE books SET 
          price = '$new_price',
          stock_quantity = '$stock_quantity',
          discount_percent = '$discount_percent',
          format = '$format',
          language = '$language'
        WHERE key_books = $key_books";
$conn->query($sql);

// Log price change if different
if ($old_price != $new_price) {
  $conn->query("INSERT INTO book_prices_history 
    (key_books, old_price, new_price) VALUES 
    ($key_books, $old_price, $new_price)");
}

// Redirect back to sell page
header("Location: books_sell.php");
exit;
?>
