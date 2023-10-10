<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	// Server-side validation
	if (validateForm($name, $email, $message)) {
		$sql = "insert into tblcontact(Name,Email,Message)values(:name,:email,:message)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':name', $name, PDO::PARAM_STR);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':message', $message, PDO::PARAM_STR);
		$query->execute();
		$LastInsertId = $dbh->lastInsertId();

		if ($LastInsertId > 0) {
			echo "<script>alert('Your message was sent successfully!.');</script>";
			echo "<script>window.location.href ='mail.php'</script>";
		} else {
			echo '<script>alert("Something Went Wrong. Please try again")</script>';
		}
	}
}

function validateForm($name, $email, $message)
{
	$isValid = true;

	// Check for empty values
	if (empty($name) || empty($email) || empty($message)) {
		echo '<script>alert("All fields are required.");</script>';
		$isValid = false;
	}

	// Full Name Validation (At least 3 characters, only letters and spaces)
	if (strlen($name) < 3 || !preg_match('/^[a-zA-Z\s]+$/', $name)) {
		echo '<script>alert("Full Name must be at least 3 characters and contain only letters and spaces.");</script>';
		$isValid = false;
	}

	// Email Validation (Valid email format)
	$emailRegex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
	if (!preg_match($emailRegex, $email)) {
		echo '<script>alert("Enter a valid email address.");</script>';
		$isValid = false;
	}

	// Message Validation (At least 3 characters)
	if (strlen($message) < 3) {
		echo '<script>alert("Message must be at least 3 characters.");</script>';
		$isValid = false;
	}

	return $isValid;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Event Handler Platform | Mail</title>

	<script
		type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- bootstrap-css -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--// bootstrap-css -->
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!--// css -->
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- font -->
	<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i"
		rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300'
		rel='stylesheet' type='text/css'>
	<!-- //font -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$("form").submit(function (event) {
				var name = $("input[name='name']").val();
				var email = $("input[name='email']").val();
				var message = $("textarea[name='message']").val();

				// Check if at least one field is empty
				if (name === "" && email === "" && message === "") {
					alert("At least one field is required.");
					event.preventDefault(); // Prevent form submission
				}
			});
		});
	</script>

	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->

	<style>
		.agileinfo-contact-form-grid {
			background-color: #f0f0f0;
			/* Grayish white background color */
			padding: 30px;
			border-radius: 5px;
		}

		.agileinfo-contact-form-grid input[type="text"],
		.agileinfo-contact-form-grid input[type="email"],
		.agileinfo-contact-form-grid textarea {
			background-color: white;
			/* White background for input fields and textareas */
			border: 1px solid #ccc;
			padding: 10px;
			width: 100%;
			margin-bottom: 20px;
			border-radius: 3px;
			font-size: 15px;
		}
	</style>
</head>

<body>
	<!-- banner -->
	<?php include_once('includes/header.php'); ?>
	<div class="wthree-heading">
		<h2 style="color:black;">Contact</h2>
		<hr>
	</div>
	<!-- //banner -->
	<!-- contact -->
	<div class="contact">
		<div class="container">
			<div class="agile-contact-form" style="margin-top:-50px;">
				<div class="col-md-6 contact-form-left">
					<div class="w3layouts-contact-form-top">
						<h3>Get in touch</h3>
						<p>Pellentesque eget mi nec est tincidunt accumsan. Proin fermentum dignissim justo, vel euismod
							justo sodales vel. In non condimentum mauris. Maecenas condimentum interdum lacus, ac varius
							nisl dignissim ac. Vestibulum euismod est risus, quis convallis nisi tincidunt eget. Sed
							ultricies congue lacus at fringilla.</p>
					</div>
					<div class="agileits-contact-address">
						<ul>
							<?php
							$sql = "SELECT * from tblpage where PageType='contactus'";
							$query = $dbh->prepare($sql);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);

							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $row) { ?>
									<li><i class="fa fa-phone" aria-hidden="true"></i> <span>+
											<?php echo htmlentities($row->MobileNumber); ?>
										</span></li>
									<li><i class="fa fa-phone fa-envelope" aria-hidden="true"></i> <span>
											<?php echo htmlentities($row->Email); ?>
										</span></li>
									<li><i class="fa fa-map-marker" aria-hidden="true"></i> <span>
											<?php echo htmlentities($row->PageDescription); ?>.
										</span></li>
									<?php $cnt = $cnt + 1;
								}
							} ?>
						</ul>
					</div>
				</div>
				<div class="col-md-6 contact-form-right">
					<div class="contact-form-top">
						<h3>Send us a message</h3>
					</div>
					<div class="agileinfo-contact-form-grid">
						<form action="#" method="post">
							<input placeholder="Full Name Required " name="name" type="text">
							<input placeholder="Email Required" name="email" type="email">
							<textarea name="message" placeholder="Message Required"></textarea>
							<button class="btn1" name="submit" style="">
								<i class="fa fa-send" style="font-size:20px;"></i>
								<strong>Send</strong>
							</button>
						</form>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>


		</div>
	</div>
	<!-- //contact -->
	<?php include_once('includes/footer.php'); ?>
	<!-- jarallax -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<!-- //jarallax -->
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
	<!-- //here ends scrolling icon -->
	<script src="js/modernizr.custom.js"></script>

</body>

</html>