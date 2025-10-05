<?php include '../db.php';

if (!isset($_GET['id'])) {
  echo json_encode(['error' => 'Missing user ID']);
  exit;
}

$id = intval($_GET['id']);
$data = [];

$result = $conn->query("SELECT * FROM users WHERE key_user = $id LIMIT 1");
if ($row = $result->fetch_assoc()) {
  $data = $row;
}

echo json_encode($data);

?>