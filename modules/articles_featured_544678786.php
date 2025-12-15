<div class="articles-featured" style="display:flex;overflow:hidden;white-space:nowrap;height:400px;<?= $css ?>">

    <?php
    $sql = "SELECT a.*, m.file_url AS banner
            FROM articles a 
            LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
            WHERE a.is_active = 1 AND a.key_media_banner != 0 AND a.is_featured = 1 
			ORDER BY RAND() 
            LIMIT $number_of_records";
    $articles = $conn->query($sql);
    while ($record = $articles->fetch_assoc()) {
        $banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
        echo "<div style='flex:0 0 auto;margin-right:10px;'>
                <a href='/article/{$record['url']}'>
                    <div style='position:relative;height:100%;width:100%;'>
                        <img src='$banner_url' style='object-fit:cover;object-position:center;height:100%;'>
                        <div style='direction:var(--site-direction);font-size:1.3em;background:#000;padding:10px;text-align:center;opacity:.7;position:absolute;bottom:0;width:100%;color:#fff;white-space:normal;word-wrap:break-word;'>{$record['title']}</div>
                    </div>
                </a>
              </div>";
    }
    ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const container = document.querySelector(".articles-featured");
  let scrollAmount = 1.5; 
  let direction = 1;      // start moving right

  // make sure we start at the very left edge
  container.scrollLeft = container.scrollWidth;

  function autoScroll() {
    container.scrollLeft += scrollAmount * direction;

    if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
      direction = -1; // reached right end → go left
    } else if (container.scrollLeft <= 0) {
      direction = 1; // reached left end → go right
    }

    requestAnimationFrame(autoScroll);
  }

  autoScroll();
});


</script>
