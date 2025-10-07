<?php include '../db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM youtube_gallery WHERE key_youtube_gallery=$id");
header("Location: list.php");
?>
