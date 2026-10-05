<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? '';


startLayout("Contact Us");
?>
<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<article>
		<?php
		
		session_start();

		$message = '';
		$error = '';

		// $_SESSION['form_time'] = time();
		
		// Generate captcha on first load
		if (!isset($_SESSION['contact_captcha'])) {
			$a = rand(1, 9);
			$b = rand(1, 9);

			$_SESSION['contact_captcha'] = $a + $b;
			$_SESSION['contact_question'] = "$a + $b";
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			/*
			if (time() - $_SESSION['form_time'] < 3) { // bots fill out form too fast
				die('Too fast.');
			}
			*/
			
			if (!empty($_POST['website'])) { // bots fill out every form field
				http_response_code(403);
				exit;
			}

			$name = trim($_POST['name'] ?? '');
			$email = trim($_POST['email'] ?? '');
			$subject = trim($_POST['subject'] ?? '');
			$userMessage = trim($_POST['message'] ?? '');
			$captcha = trim($_POST['captcha'] ?? '');

			if ($name === '' || $email === '' || $subject === '' || $userMessage === '') {

				$error = "Please complete all fields.";

			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$error = "Please enter a valid email address.";

			} elseif ((int)$captcha !== (int)$_SESSION['contact_captcha']) {

				$error = "Incorrect captcha answer.";

			} else {

				$to = "info@copilotcms.org";

				$body =
					"Name: {$name}\n" .
					"Email: {$email}\n\n" .
					$userMessage;

				$headers =
					"From: {$email}\r\n" .
					"Reply-To: {$email}\r\n";

				if (mail($to, $subject, $body, $headers)) {

					$message = "Thank you! Your message has been sent.";

					unset($_SESSION['contact_captcha']);
					unset($_SESSION['contact_question']);

				} else {

					$error = "Unable to send message right now.";
				}
			}

			// Generate new captcha after every submission
			if (!isset($_SESSION['contact_captcha'])) {
				$a = rand(1, 9);
				$b = rand(1, 9);

				$_SESSION['contact_captcha'] = $a + $b;
				$_SESSION['contact_question'] = "$a + $b";
			}
		}

		echo "<h1>Contact Us</h1>";

		if (!empty($message)) {
			echo "<div class='success-message'>{$message}</div>";
		}

		if (!empty($error)) {
			echo "<div class='error-message'>{$error}</div>";
		}
		?>

		<form method="post" class="contact-form">

			<input type="text" name="website" autocomplete="off" style="display:none;">

			<p>
				<label>Name</label><br>
				<input type="text" name="name" required>
			</p>

			<p>
				<label>Email</label><br>
				<input type="email" name="email" required>
			</p>

			<p>
				<label>Subject</label><br>
				<input type="text" name="subject" required>
			</p>

			<p>
				<label>Message</label><br>
				<textarea name="message" rows="8" required></textarea>
			</p>

			<p>
				<label>
					What is <?= htmlspecialchars($_SESSION['contact_question']); ?> ?
				</label><br>
				<input type="text" name="captcha" required>
			</p>

			<p>
				<button type="submit">Send Message</button>
			</p>

		</form>



	
	</article>
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_pages"); ?>
</div>
<?php endLayout(); ?>