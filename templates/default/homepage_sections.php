<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
?>

<!DOCTYPE html>
<html>
<head>
	<?php
	echo "
	<title>Home</title>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' href='/templates/settings.css?version=" . getSetting("css_version") . "'>
	";
	?>
</head>
<body>

<?php

$result = $conn->query("
	SELECT *
	FROM home_page_sections
	WHERE is_active = 1
	ORDER BY sort
");

while ($section = $result->fetch_assoc()) {

    switch ($section['section_type']) {
        case 'hero':
            renderHero($section);
            break;
        case 'articles':
            renderArticles($section);
            break;
        case 'authors':
            renderAuthors($section);
            break;
        case 'categories':
            renderCategories($section);
            break;
        case 'galleries':
            renderGalleries($section);
            break;
        case 'videos':
            renderVideos($section);
            break;
        case 'contact':
            renderContact($section);
            break;
        case 'footer':
            renderFooter($section);
            break;
        case 'custom':
            renderCustom($section);
            break;
    }
}

?>

</body>
</html>



<?php

function renderCustom($section) {
	print $section['content'];
}

function renderHero($section) {
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/1920/1080';
	$target_url = htmlspecialchars($section['target_url']);
	print "<div class='hero-section' style=\"background-image: url('$image');\">
        <div class='hero-overlay'></div>
        <div class='hero-inner'>
            <h1>$title</h1>
            <h2>$content</h2>
            <a href='$target_url' class='home-btn'>Get Started</a>
        </div>
    </div>";
}

function renderArticles($section) {
	global $conn;
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/720/480';

	$result = $conn->query("SELECT a.*, m.file_url AS banner
            FROM articles a 
            LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
            WHERE a.is_active = 1 AND a.is_featured = 1 
			ORDER BY entry_date_time DESC 
            LIMIT 1");
	if ($featured = $result->fetch_assoc()) {
		$featured_title = $featured['title'];
		$featured_snippet = $featured['article_snippet'];
		$featured_url = $featured['url'];
		$featured_entry_date = date_format(date_create($featured['entry_date_time']),"d F Y");
		$featured_banner_url = empty($featured['banner_image_url']) ? $featured['banner'] : $featured['banner_image_url'];
		if (empty($featured_banner_url)) $featured_banner_url = 'https://picsum.photos/720/480';
	} else {
		[$featured_title, $featured_snippet, $featured_url, $featured_entry_date, $featured_banner_url] = ["Featured Article", "Snippet", "", "Date", "https://picsum.photos/720/480"];
	}
	print "
		<div id='articles' class='home-section light-section'>
			<div class='home-container'>
				<h2 class='home-title'>$title</h2>
				<p class='home-content'>$content</p>
				
				<div class='articles-layout'>
					<!-- Left Side: Featured Large Article -->
					<article class='article-featured'>
						<div class='article-feat-img'>
							<img src='$featured_banner_url' alt='Featured Article Image'>
						</div>
						<div class='article-feat-content'>
							<span class='article-meta'>$featured_entry_date</span>
							<h2>$featured_title</h2>
							<p>$featured_snippet</p>
							<a href='/article/$featured_url' class='home-btn'>Read Article</a>
						</div>
					</article>
					<!-- Right Side: Secondary Articles Column -->
					<div class='articles-list-side'>
	";
						$result = $conn->query("SELECT title, article_snippet, url, entry_date_time FROM articles WHERE is_active = 1 ORDER BY entry_date_time DESC LIMIT 3");
						while ($featured_more = $result->fetch_assoc()) {
							$featured_entry_date = date_format(date_create($featured_more['entry_date_time']),"d F Y");
							print "
							<article class='article-side-item'>
								<span class='article-meta'>$featured_entry_date</span>
								<h3><a href='/article/" . $featured_more['url'] . "'>" . $featured_more['title'] . "</a></h3>
								<p>" . $featured_more['article_snippet'] . "</p>
							</article>";
						}
	print "
					</div>
				</div>
			</div>
		</div>
	";
}

function renderAuthors($section) {
	global $conn;
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/650/330';
	print "
		<div class='home-section light-section'>
			<div class='home-container'>
				
				<!-- Main Section Title -->
				<h2 class='home-title'>$title</h2>
				<p class='home-content'>$content</p>
				<!-- Reusing your home-grid for multiple authors -->
				<div class='home-grid'>
	";
	
					$result = $conn->query("SELECT authors.*, media_library.file_url_thumbnail AS banner FROM authors 
												LEFT JOIN media_library ON authors.key_media_banner = media_library.key_media  
												WHERE is_active = 1 ORDER BY entry_date_time DESC LIMIT 3");
					$count = 300;
					while ($row = $result->fetch_assoc()) {
						$image_url = empty($row['banner_image_url']) ? $row['banner'] : $row['banner_image_url'];
						if (empty($image_url)) $image_url = "https://picsum.photos/" . $count++ . "/" . $count++;
						print "
						<div class='author-card'>
						<img src='$image_url' alt='' class='author-photo'>
						<h3 class='author-name'>" . $row['name'] . "</h3>
						<p class='author-bio'>" . $row['description'] . " … <a href='/author/" . $row['url'] . "'>More</a></p>
						</div>
						";
					}

	print "
				
				</div>
			</div>
		</div>
	";
}

function renderCategories($section) {
	global $conn;
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/660/340';
	print "
        <div class='home-section dark-section'>
            <div class='home-container'>
                <h2 class='home-title'>Explore Categories</h2>
                <p class='home-content'>Filter through our widely popular subjects to find exactly what you are looking for.</p>
                <div class='categories-list'>
	";
					$result = $conn->query("
						SELECT *
						FROM categories 
						WHERE is_active = 1
						ORDER BY sort LIMIT 4;
					");	
					while ($row = $result->fetch_assoc()) {
						print "<a href='category/" . $row['url'] . "' class='category-pill'>" . $row['name'] . "</a>";
					}
	print "
                </div>
            </div>
        </div>
	";
}

function renderGalleries($section) {
	global $conn;
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/660/340';
	print "
		<div id='gallery' class='home-section light-section'>
			<div class='home-container'>
				<h2 class='home-title'>$title</h2>
				<p class='home-content'>$content</p>
				
				<div class='gallery-grid'>
	";
					$result = $conn->query("
						SELECT a.*, m.file_url AS banner_url FROM photo_gallery a
							LEFT JOIN media_library m ON a.key_media_banner = m.key_media
								WHERE a.is_active = 1;
					");	
					while ($row = $result->fetch_assoc()) {
						if ($row['image_url']) { // full link url
							echo "<div class='gallery-item'><a href='/photo-gallery/" . $row['url'] . "'><img src='" . $row['image_url'] . "'></a></div>";
						} else if ($row['banner_url']) { // media library file
							echo "<div class='gallery-item'><a href='/photo-gallery/" . $row['url'] . "'><img src='" . $row['banner_url'] . "'></a></div>";
						}
					}	
	print "				
				</div>
			</div>
		</div>	
	";
	
}
function renderVideos($section) {
	
	global $conn;
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/660/340';
	
	print "
		<div id='videos' class='home-section dark-section'>
			<div class='home-container'>
				<h2 class='home-title'>$title</h2>
				<p class='home-content'>$content</p>
				<div class='video-grid'>
				
	";
				$result = $conn->query("SELECT * FROM youtube_gallery WHERE is_active = 1 ORDER BY entry_date_time DESC LIMIT 2");
				while ($row = $result->fetch_assoc()) {
				
					print "
					<div class='video-card'>
						<div class='video-wrapper'>
							<iframe src='https://www.youtube.com/embed/" . $row['youtube_id'] . "' title='" . $row['title'] . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
						</div>
						<div class='video-body'>
							<h3>" . $row['title'] . "</h3>
							<p>" . firstWords($row['description'], 40) . "</p>
						</div>
					</div>
					";
				}
					
	print "				
				</div>
			</div>
		</div>	
	";
	
}
function renderContact($section) {
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/640/320';
	$target_url = htmlspecialchars($section['target_url']);
	print "
        <div class='home-section light-section'>
            <div class='home-container'>
                <div class='contact-box'>
                    <h2 class='home-title'>Get In Touch</h2>
                    <p class='home-content'>Have any questions or want to work together? Drop us a line and we will get back to you as soon as possible.</p>
                    <a href='$target_url' class='home-btn'>Contact Us</a>
                </div>
            </div>
        </div>
	";	
}

function renderFooter($section) {
	global $conn;
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/640/320';
	$target_url = htmlspecialchars($section['target_url']);
	print "
		<div class='footer-home'>
			<div class='footer-grid'>
	";		
				$result = $conn->query("SELECT title, block_content FROM blocks WHERE show_in_region = 'above_footer' AND is_active = 1 ORDER BY sort;");	
				while ($row = $result->fetch_assoc()) {
					print "
					<div>
					<h2>" . $row['title'] . "</h2>
					<div>" . $row['block_content'] . "</div>
					</div>";
				}
				
				
	print "			
			</div>
		</div>
	";
	$result = $conn->query("SELECT title, block_content FROM blocks WHERE show_in_region = 'footer' AND is_active = 1 ORDER BY sort;");	
	if ($row = $result->fetch_assoc()) {
		print "<div id='footer'>" . $row['block_content'] . "</div>";
	}
}


?>


<style>
body {
	margin:0;
}

a {
	text-decoration:none;
	color:var(--brand-link-color);
}

.home-section {
	padding:80px 20px;
}

.home-container {
	max-width:1400px;
	margin:auto;
}

.home-title {
	font-size:2.2rem;
	margin-bottom:15px;
	text-align:center;
}

.home-content {
	max-width:800px;
	margin:auto;
	text-align:center;
	line-height:1.7;
}

.home-grid {
	display:grid;
	grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
	gap:25px;
	margin-top:40px;
}

.home-card {
	background:#fff;
	border-radius:12px;
	overflow:hidden;
	box-shadow:0 3px 12px rgba(0,0,0,.08);
	transition:.3s;
}

.home-card:hover {
	transform:translateY(-5px);
}

.home-card img {
	width:100%;
	height:220px;
	object-fit:cover;
	display:block;
}

.home-card-body {
	padding:20px;
}

.home-btn {
	display:inline-block;
	padding:12px 24px;
	background:var(--brand-background-color);
	color:#fff;
	text-decoration:none;
	border-radius:30px;
	margin-top:15px;
}

.home-btn:hover {
	opacity:.9;
}

.hero-section {
	min-height:85vh;
	display:flex;
	align-items:center;
	justify-content:center;
	text-align:center;
	background-size:cover;
	background-position:center;
	position:relative;
	color:#fff;
}

.hero-overlay {
	position:absolute;
	inset:0;
	background:rgba(0,0,0,.55);
}

.hero-inner {
	position:relative;
	z-index:2;
	max-width:900px;
	padding:40px;
}

.hero-inner h1 {
	font-size:4rem;
	margin-bottom:20px;
}

/* ==========================================
   Articles & Insights Styles
   ========================================== */
.articles-layout {
	display: grid;
	grid-template-columns: 1.6fr 1fr;
	gap: 40px;
	margin-top: 40px;
}

@media (max-width: 992px) {
	.articles-layout {
		grid-template-columns: 1fr; /* Stack columns on tablets and mobile screens */
	}
}

/* Featured Article (Left Side) */
.article-featured {
	background: #fff;
	border-radius: 16px;
	overflow: hidden;
	box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.article-feat-img img {
	width: 100%;
	height: 340px;
	object-fit: cover;
	display: block;
}

.article-feat-content {
	padding: 35px;
}

.article-meta {
	display: inline-block;
	font-size: 0.85rem;
	color: var(--brand-text-color);
	font-weight: bold;
	text-transform: uppercase;
	letter-spacing: 1px;
	margin-bottom: 12px;
}

.article-feat-content h2 {
	font-size: 1.8rem;
	margin-bottom: 15px;
	line-height: 1.4;
	color: #111;
}

.article-feat-content p {
	color: #555;
	line-height: 1.6;
	margin-bottom: 20px;
}

/* Secondary Articles List (Right Side) */
.articles-list-side {
	display: flex;
	flex-direction: column;
	gap: 25px;
}

.article-side-item {
	padding-bottom: 25px;
	border-bottom: 1px solid #e5e5e5;
}

.article-side-item:last-child {
	border-bottom: none;
	padding-bottom: 0;
}

.article-side-item h3 {
	font-size: 1.25rem;
	margin: 8px 0 10px 0;
	line-height: 1.4;
}

.article-side-item h3 a {
	color: #111;
	text-decoration: none;
	transition: color 0.2s;
}

.article-side-item h3 a:hover {
	color: var(--brand-link-color);
}

.article-side-item p {
	font-size: 0.95rem;
	color: #666;
	line-height: 1.6;
}







.dark-section {
	background:var(--brand-background-color);
	color:#fff;
}

.light-section {
	background:#f8f8f8;
}

.categories-list {
	display:flex;
	flex-wrap:wrap;
	justify-content:center;
	gap:15px;
	margin-top:30px;
}

.category-pill {
	padding:10px 20px;
	border-radius:50px;
	text-decoration:none;
	color:var(--brand-text-color);
	background:#fff;
	font-weight:bold;
}

.author-photo {
	width:120px;
	height:120px;
	border-radius:50%;
	object-fit:cover;
	margin:auto;
	display:block;
}


/* ==========================================
   Photo Gallery Styles
   ========================================== */
.gallery-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap: 20px;
	margin-top: 40px;
}

.gallery-item {
	overflow: hidden;
	border-radius: 12px;
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.gallery-item img {
	width: 100%;
	height: 260px;
	object-fit: cover;
	display: block;
	transition: transform 0.4s ease;
}

.gallery-item:hover img {
	transform: scale(1.05);
}

/* ==========================================
   Video Showcase Styles
   ========================================== */
.video-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
	gap: 30px;
	margin-top: 40px;
}

@media (max-width: 500px) {
	.video-grid {
		grid-template-columns: 1fr; /* Fallback for very small phone screens */
	}
}

.video-card {
	background: #fff;
	border-radius: 16px;
	overflow: hidden;
	box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

/* Fluid Aspect-Ratio Trick for Responsive YouTube Iframes (16:9) */
.video-wrapper {
	position: relative;
	padding-bottom: 56.25%; 
	height: 0;
	overflow: hidden;
}

.video-wrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border: 0;
}

.video-body {
	padding: 25px;
}

.video-body h3 {
	font-size: 1.4rem;
	margin-bottom: 10px;
	color: var(--brand-text-color);
}

.video-body p {
	font-size: 0.95rem;
	color: #222;
	line-height: 1.6;
}

.contact-box {
	max-width:800px;
	margin:auto;
	text-align:center;
	padding:50px;
	border-radius:20px;
	background:#fff;
	box-shadow:0 0 20px rgba(0,0,0,.1);
}

#footer, #below-footer {
    font-family: var(--footer-font);
    text-align: center;
    color: #666;
	padding:20px;
}

.footer-home {
	background:var(--brand-background-color);
	color:#fff;
	padding:60px 20px;
}

.footer-grid {
	display:grid;
	grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
	gap:30px;
	max-width:1400px;
	margin:auto;
}

.footer-home a {
	color:#fff;
	text-decoration:none;
	display:block;
	margin-bottom:8px;
}

@media(max-width:768px){

	.hero-inner h1{
		font-size:2.4rem;
	}

	.home-section{
		padding:50px 15px;
	}
}
</style>
