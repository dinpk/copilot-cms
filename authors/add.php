<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO authors (
    name, email, phone, website, url,
    social_url_media1, social_url_media2, social_url_media3,
    city, state, country, image_url, description, status
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssssssssss",
    $_POST['name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['website'],
    $_POST['url'],
    $_POST['social_url_media1'],
    $_POST['social_url_media2'],
    $_POST['social_url_media3'],
    $_POST['city'],
    $_POST['state'],
    $_POST['country'],
    $_POST['image_url'],
    $_POST['description'],
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
