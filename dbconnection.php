<?php

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
	http_response_code(403);
	exit('Direct access denied.');
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'simplesite';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

?>
