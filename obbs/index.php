<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Event Handler Platform || Home Page</title>
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);
		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
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
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
			});
		});
	</script>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<![endif]-->
	<style>
		/* Style for the notification icon and text */
		.notification {
			position: fixed;
			top: 50px;
			right: 170px;
			background-color: red;
			border-radius: 50%;
			/* Make it a circle */
			width: 40px;
			height: 40px;
			text-align: center;
			line-height: 40px;
			color: white;
			cursor: pointer;
			z-index: 999;
		}

		.notification-text {
			margin-left: 5px;
			font-weight: bold;
		}

		/* Style for the badge count */
		.badge {
			font-size: 15px;
			position: absolute;
			top: 100%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		/* Style for the "Lorem ipsum" content */
		.lorem-content {
			background-color: white;
			border-radius: 5px;
			padding: 50px;
			/* Adjust the margin as needed */
		}

		p {
			margin-left: 100px;
			margin-right: 50px;
		}

		/* You can add more styles to customize the appearance of the content */
	</style>
</head>

<body>
	<!-- header -->
	<div class="container">
		<!-- Add the notification icon and text below -->
		<div class="notification">
			<a class="block text-center" href="services.php" style="color:white;">
				<span class="glyphicon glyphicon-bell"></span>
				<span class="badge badge-danger">

					<?php
					$currentDateTime = date('Y-m-d H:i:s'); // Get the current date and time in 'Y-m-d H:i:s' format
					$sql = "SELECT * FROM tblservice WHERE CONCAT(ServiceDate, ' ', ServiceTime) > :currentDateTime";
					$query = $dbh->prepare($sql);
					$query->bindParam(':currentDateTime', $currentDateTime, PDO::PARAM_STR);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);
					$totalreadquery = $query->rowCount();
					?>
					<div class="ribbon-box">
						<?php echo htmlentities($totalreadquery); ?>
					</div>

				</span> <!-- You can update the badge count as needed -->
			</a>
		</div>
		<!-- End of notification icon and text -->
	</div>
	<!-- //header -->
	<!-- banner -->
			<?php include_once('includes/header.php'); ?>
			
			<div class="wthree-heading">
				<h2 style="color:black;">Home</h2> <hr>
			</div>
			<!-- Main Content -->
			<div class="main-content" style="margin-top:-20px;">
				<!-- "Lorem ipsum" content goes here -->
				<div class="lorem-content">
					<h3 style="margin-left:100px;font-weight:bold;">Welcome! To Event Handler Platform Ltd</h3>
					<p>
						<strong>At Event Handler Platform Ltd</strong> , <br>
						we're more than just an event management system; we're a community of
						passionate event organizers, attendees, and partners who are dedicated to creating memorable
						experiences. We invite you to become a part of our growing family and join us on this exciting
						journey.
					</p>
					<h3 style="margin-left:100px;font-weight:bold;">Join Us Today!!!</h3>
					<p>
						An Event Handler Platform is a software or application that helps individuals or organizations
						plan, organize, and manage various types of events more efficiently. These systems provide a
						range of tools and features to streamline the entire event lifecycle, from initial planning and
						registration to execution and post-event analysis. Here are some key components and features
						typically found in event management systems:
					</p>

					<button class="btn btn-danger" style="padding:15px; margin-left:100px;"><a href="services.php"
							style="color:white;text-decoration:none; font-weight:bold;">GET STARTED NOW!</a></button>
					<!-- Add more content as needed -->
				</div>
			</div>
			<div class="w3ls-banner-info-bottom">
				<div class="container">
					<div class="banner-address">
						<?php
						$sql = "SELECT * from tblpage where PageType='contactus'";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);

						$cnt = 1;
						if ($query->rowCount() > 0) {
							foreach ($results as $row) { ?>
								<div class="col-md-4 banner-address-left">
									<p><i class="fa fa-map-marker" aria-hidden="true"></i>
										<?php echo htmlentities($row->PageDescription); ?>
										.
									</p>
								</div>
								<div class="col-md-4 banner-address-left">
									<p><i class="fa fa-envelope" aria-hidden="true"></i>
										<?php echo htmlentities($row->Email); ?>
									</p>
								</div>
								<div class="col-md-4 banner-address-left">
									<p><i class="fa fa-phone" aria-hidden="true"></i> +
										<?php echo htmlentities($row->MobileNumber); ?>
									</p>
								</div>
								<div class="clearfix"></div>
								<?php $cnt = $cnt + 1;
							}
						} ?>
					</div>
				</div>
			</div>
	<!-- //banner -->
	<!-- //banner-bottom -->

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