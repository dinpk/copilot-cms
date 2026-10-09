<?php 
include(__DIR__ . '/../../dbconnection.php');
?>

<html>
<head>
	<title></title>
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
	print "<div class='hero-section' style=\"background-image: url('$image');\">
        <div class='hero-overlay'></div>
        <div class='hero-inner'>
            <h1>$title</h1>
            <p>$content</p>
            <a href='/about-us' class='home-btn'>Get Started</a>
        </div>
    </div>";
}

function renderArticles($section) {
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/720/480';

	print "
		<div id='articles' class='home-section light-section'>
			<div class='home-container'>
				<h2 class='home-title'>Latest Articles & Insights</h2>
				<p class='home-content'>Stay up to date with the latest industry trends, design paradigms, and optimization tips.</p>
				
				<div class='articles-layout'>
					<!-- Left Side: Featured Large Article -->
					<article class='article-featured'>
						<div class='article-feat-img'>
							<img src='$image' alt='Featured Article Image'>
						</div>
						<div class='article-feat-content'>
							<span class='article-meta'>October 2026 • Design</span>
							<h2>The Future of Responsive Web Design with Contemporary Layout Architectures</h2>
							<p>Discover how engineering principles are shifting towards micro-layouts and component-driven styles that dynamically adjust without heavy reliance on media queries.</p>
							<a href='#' class='home-btn'>Read Article</a>
						</div>
					</article>

					<!-- Right Side: Secondary Articles Column -->
					<div class='articles-list-side'>
						<!-- Side Item 1 -->
						<article class='article-side-item'>
							<span class='article-meta'>September 2026 • Tech</span>
							<h3><a href='#'>Optimizing Render Performance for Native Video Components</a></h3>
							<p>A deep dive into decoding cycles, asynchronous resource scheduling, and iframe optimization for smooth client interaction.</p>
						</article>

						<!-- Side Item 2 -->
						<article class='article-side-item'>
							<span class='article-meta'>September 2026 • Strategy</span>
							<h3><a href='#'>Building Accessible Color Palettes for Global Target Audiences</a></h3>
							<p>How to design high-contrast user experiences that respect regional preferences and satisfy contrast criteria gracefully.</p>
						</article>

						<!-- Side Item 3 -->
						<article class='article-side-item'>
							<span class='article-meta'>August 2026 • Business</span>
							<h3><a href='#'>Scaling Content Infrastructure on Modern Cloud Networks</a></h3>
							<p>A architectural summary outlining cloud caching techniques to distribute media files across server grids efficiently.</p>
						</article>
					</div>
				</div>
			</div>
		</div>
	";
}

function renderAuthors($section) {
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/650/330';
	print "
        <section class='home-section light-section'>
            <div class='home-container'>
                <img src='$image' alt='Author's Photo' class='author-photo'>
                <h2 class='home-title' style='margin-top: 20px;'>Meet the Author</h2>
                <p class='home-content'>Creating meaningful web experiences with clean code, semantic structures, and modern aesthetics.</p>
            </div>
        </section>
	
	";
}

function renderCategories($section) {
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/660/340';
	print "
        <div class='home-section dark-section'>
            <div class='home-container'>
                <h2 class='home-title'>Explore Categories</h2>
                <p class='home-content'>Filter through our widely popular subjects to find exactly what you are looking for.</p>
                <div class='categories-list'>
                    <a href='#' class='category-pill'>Design</a>
                    <a href='#' class='category-pill'>Development</a>
                    <a href='#' class='category-pill'>Marketing</a>
                    <a href='#' class='category-pill'>Business</a>
                </div>
            </div>
        </div>
	";
}

function renderGalleries($section) {
	
	print "
		<div id='gallery' class='home-section light-section'>
			<div class='home-container'>
				<h2 class='home-title'>Photo Gallery</h2>
				<p class='home-content'>Take a visual tour through our recent projects and favorite captures from around the world.</p>
				
				<div class='gallery-grid'>
					<div class='gallery-item'>
						<img src='https://picsum.photos/640/320' alt='Sample Landscape 1'>
					</div>
					<div class='gallery-item'>
						<img src='https://picsum.photos/639/319' alt='Sample Landscape 2'>
					</div>
					<div class='gallery-item'>
						<img src='https://picsum.photos/638/318' alt='Sample Forest'>
					</div>
					<div class='gallery-item'>
						<img src='https://picsum.photos/637/317' alt='Sample Mountain Trek'>
					</div>
				</div>
			</div>
		</div>	
	";
	
}
function renderVideos($section) {
	print "
		<div id='videos' class='home-section dark-section'>
			<div class='home-container'>
				<h2 class='home-title'>Video Showcase</h2>
				<p class='home-content'>Watch our custom cinematic edits and in-depth video tutorials directly from YouTube.</p>
				
				<div class='video-grid'>
					<!-- Video 1 -->
					<div class='video-card'>
						<div class='video-wrapper'>
							<iframe src='https://www.youtube.com/embed/ymTwVM9Tiac?si=d5yYWETyDHMRvXpe' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
						</div>
						<div class='video-body'>
							<h3>Featured Presentation</h3>
							<p>An introduction to our creative workflows and community development projects.</p>
						</div>
					</div>

					<!-- Video 2 -->
					<div class='video-card'>
						<div class='video-wrapper'>
							<iframe src='https://www.youtube.com/embed/W6aOdLlEz1w?si=uTynEcl7NVbqvUCb' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
						</div>
						<div class='video-body'>
							<h3>Behind the Scenes</h3>
							<p>A closer, raw perspective look into our team dynamic and weekly review processes.</p>
						</div>
					</div>
				</div>
			</div>
		</div>	
	";
	
}
function renderContact($section) {
	$title = htmlspecialchars($section['title']);
	$content = nl2br(htmlspecialchars($section['content']));
	$image = !empty($section['image_url']) ? htmlspecialchars($section['image_url']) : 'https://picsum.photos/640/320';
	print "
        <div class='home-section light-section'>
            <div class='home-container'>
                <div class='contact-box'>
                    <h2 class='home-title'>Get In Touch</h2>
                    <p class='home-content'>Have any questions or want to work together? Drop us a line and we will get back to you as soon as possible.</p>
                    <a href='mailto:info@example.com' class='home-btn'>Contact Us</a>
                </div>
            </div>
        </div>
	";	
}

function renderFooter($section) {
	print "
		<div class='footer-home'>
			<div class='footer-grid'>
				<!-- Column 1 -->
				<div>
					<h3>About Us</h3>
					<p style='opacity: 0.8; line-height: 1.6; margin-top: 15px;'>Building responsive, accessible, and fast layout solutions for the web environment.</p>
				</div>
				<!-- Column 2 -->
				<div>
					<h3>Quick Links</h3>
					<div style='margin-top: 15px;'>
						<a href='#'>Home</a>
						<a href='#'>Services</a>
						<a href='#'>Portfolio</a>
						<a href='#'>Blog</a>
					</div>
				</div>
				<!-- Column 3 -->
				<div>
					<h3>Resources</h3>
					<div style='margin-top: 15px;'>
						<a href='#'>Documentation</a>
						<a href='#'>Support Center</a>
						<a href='#'>Privacy Policy</a>
						<a href='#'>Terms of Use</a>
					</div>
				</div>
			</div>
		</div>
	";
}


?>


<style>
body {
	margin:0;
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
	background:#049b5c;
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
	color: #049b5c;
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
	color: #049b5c;
}

.article-side-item p {
	font-size: 0.95rem;
	color: #666;
	line-height: 1.6;
}







.dark-section {
	background:#111;
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
	border:2px solid #049b5c;
	border-radius:50px;
	text-decoration:none;
	color:#049b5c;
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
	background: #1e1e1e; /* Darker tile contrasting the dark-section */
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
	color: #fff;
}

.video-body p {
	font-size: 0.95rem;
	color: #ccc;
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

.footer-home {
	background:#222;
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
