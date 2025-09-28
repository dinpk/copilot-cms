<?php include '../db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM youtube_gallery WHERE key_youtube_gallery=$id");
echo json_encode($result->fetch_assoc());
?>
