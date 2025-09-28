<?php include '../db.php';
$id = intval($_GET['id']);
$conn->query("DELETE FROM photo_gallery WHERE key_photo_gallery=$id");
header("Location: list.php");
exit;
