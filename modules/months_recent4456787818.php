
<div class="block" style="<?= $css ?>">

<?php
	$sql = "SELECT DISTINCT DATE_FORMAT(entry_date_time, '%Y-%m') AS ym,
				  DATE_FORMAT(entry_date_time, '%M %Y') AS month_label
		  FROM articles
		  WHERE is_active = 1
		  ORDER BY ym DESC 
		  LIMIT $number_of_records";
	$result = $conn->query($sql);

	echo "<div dir='ltr'>";
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
		  echo "<p><small><a href='/monthly-articles/{$row['ym']}'>" . htmlspecialchars($row['month_label']) . "</a></small></p>";
		}
	} else {
		echo "<p>No articles found.</p>";
	}
	echo "</div>";
  
  echo "<p><a href='/monthly'>" . getSetting('module_more_label') . "</a></p>";
?>
</div>