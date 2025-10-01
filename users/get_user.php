<?php include '../db.php';

if (!isset($_GET['id'])) {
  echo json_encode(['error' => 'Missing user ID']);
  exit;
}

$id = intval($_GET['id']);
$data = [];

$result = $conn->query("SELECT key_user, username, email, role, status,
phone, address, city, state, country, description FROM users WHERE key_user = $id LIMIT 1");
if ($row = $result->fetch_assoc()) {
  $data = $row;
}

echo json_encode($data);

?>