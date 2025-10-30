<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM media_library WHERE key_media = $id");
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>