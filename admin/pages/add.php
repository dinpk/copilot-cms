<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "pages")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

  $status = isset($_POST['status']) ? 'on' : 'off';	
  
  $stmt = $conn->prepare("INSERT INTO pages (
    title, page_content, url, banner_image_url, status
  ) VALUES (?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssss",
    $_POST['title'],
    $_POST['page_content'],
    $_POST['url'],
    $_POST['banner_image_url'],
    $status
  );

  $stmt->execute();
}

