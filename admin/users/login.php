<?php 
include_once('../../dbconnection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND status = 'on' LIMIT 1");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($user = $result->fetch_assoc()) {
		if (password_verify($password, $user['password_hash'])) {
			$_SESSION['key_user'] = $user['key_user'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['role'] = $user['role'];
			header("Location: ../index.php");
			exit;
		}
	}
	$error = "Invalid login.";
}
?>
<form method="post">
	<input type="text" name="username" placeholder="Username" required><br>
	<input type="password" name="password" placeholder="Password" required><br>
	<input type="submit" value="Login">
	<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</form>
