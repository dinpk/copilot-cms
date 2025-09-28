<?php include '../db.php';
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM photo_gallery WHERE key_photo_gallery=$id");
echo json_encode($result->fetch_assoc());
?>
