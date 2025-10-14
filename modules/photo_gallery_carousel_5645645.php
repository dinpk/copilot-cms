

<?php
// $key_photo_gallery fetched in renderBlocks() 
if (!$key_photo_gallery) return;


$gallery = $conn->query("SELECT * FROM photo_gallery WHERE key_photo_gallery = $key_photo_gallery AND status = 'on'")->fetch_assoc();
if (!$gallery || $gallery['available_for_blocks'] !== 'on') return;
$gallery_css = $gallery['css'];
$navigation_type = $gallery['navigation_type'] ?? 'slideshow';
$valid_types = ['slideshow', 'arrows'];
if (!in_array($navigation_type, $valid_types)) {
	$navigation_type = 'slideshow';
}



// Fetch images
$images = $conn->query("
  SELECT i.*, m.file_url, m.alt_text
  FROM photo_gallery_images i
  LEFT JOIN media_library m ON i.key_media_banner = m.key_media
  WHERE i.key_photo_gallery = $key_photo_gallery AND i.status = 'on'
    AND (i.visibility_start IS NULL OR i.visibility_start <= NOW())
    AND (i.visibility_end IS NULL OR i.visibility_end >= NOW())
  ORDER BY i.sort_order ASC
");




// Render carousel
echo "<div class='carousel-wrapper' style='$gallery_css'>";
if ($navigation_type === 'arrows') {
  echo '<div class="carousel-arrow left">&#10094;</div>';
  echo '<div class="carousel-arrow right">&#10095;</div>';
}
while ($img = $images->fetch_assoc()) {
  $img_url = htmlspecialchars($img['file_url']);
  $alt_text = htmlspecialchars($img['alt_text'] ?? $img['title'] ?? '');

  echo '<div class="carousel-slide" 
        style="opacity:' . floatval($img['opacity']) . '"
        data-animation="' . htmlspecialchars($img['animation_type']) . '">';

  echo '<img src="' . $img_url . '" alt="' . $alt_text . '">';
  
  // Optional overlay text
  if (!empty($img['title']) || !empty($img['description'])) {
    echo '<div class="carousel-text" style="color:' . htmlspecialchars($img['text_color']) . '; text-align:' . htmlspecialchars($img['text_position']) . '">';
    echo '<h3>' . htmlspecialchars($img['title']) . '</h3>';
    echo '<p>' . htmlspecialchars($img['description']) . '</p>';
    if ($img['action_button']) {
      echo '<a href="' . htmlspecialchars($img['action_button_link_url']) . '" class="carousel-btn ' . htmlspecialchars($img['button_style']) . '">' . htmlspecialchars($img['action_button_text']) . '</a>';
    }
    echo '</div>';
  }

  echo '</div>';
}
echo '</div>';
?>







<?php
// Only include assets once per page load
if (!defined('CAROUSEL_INLINE_ASSETS')) {
  define('CAROUSEL_INLINE_ASSETS', true);
  echo '<style>
    .carousel-wrapper { position: relative; overflow: hidden;}
	.carousel-wrapper img {object-fit:cover;object-position:50% 100%;width:100%;height:100%;}
    .carousel-slide { display: none; transition: opacity 1s ease-in-out; }
    .carousel-slide.active { display: block; }
    .carousel-text { position: absolute; bottom: 20px; width: 100%; text-align: center; }
    .carousel-btn { padding: 10px 20px; background: #000; color: #fff; text-decoration: none; }

	.carousel-slide[data-animation="fade"] { animation: fadeIn 1s ease-in-out; }
	.carousel-slide[data-animation="slide"] { animation: slideIn 1s ease-in-out; }
	.carousel-slide[data-animation="zoom"] { animation: zoomIn 1s ease-in-out; }

	@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
	@keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }
	@keyframes zoomIn { from { transform: scale(0.8); } to { transform: scale(1); } }	



	.carousel-arrow {
	  position: absolute;
	  top: 50%;
	  transform: translateY(-50%);
	  font-size: 2rem;
	  color: #fff;
	  cursor: pointer;
	  z-index: 10;
	  padding: 10px;
	  background: rgba(0,0,0,0.5);
	}
	.carousel-arrow.left { left: 10px; }
	.carousel-arrow.right { right: 10px; }

  </style>';

	echo '<script>
	document.addEventListener("DOMContentLoaded", function() {
	  let slides = document.querySelectorAll(".carousel-slide");
	  let current = 0;

	  function showSlide(index) {
		slides.forEach((s, i) => s.classList.toggle("active", i === index));
	  }

	  showSlide(current);
	';
	if ($navigation_type === 'slideshow') {
	  echo '
	  setInterval(() => {
		current = (current + 1) % slides.length;
		showSlide(current);
	  }, 5000);
	  ';
	}

	if ($navigation_type === 'arrows') {
	  echo '
	  document.querySelector(".carousel-arrow.left").addEventListener("click", () => {
		current = (current - 1 + slides.length) % slides.length;
		showSlide(current);
	  });

	  document.querySelector(".carousel-arrow.right").addEventListener("click", () => {
		current = (current + 1) % slides.length;
		showSlide(current);
	  });
	  ';
	}

	echo '});
	</script>';

}
?>