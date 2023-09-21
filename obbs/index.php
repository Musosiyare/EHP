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
			top: 130px;
			right: 70px;
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

		.header {
			background-color: #333;
			/* Replace with your desired background color */
			padding: 10px 0;
			margin: 0;
			/* Add padding as needed */
		}

		/* Style for the navigation links in the header */
		.header .navbar-nav>li>a {
			color: white;
			/* Text color for the links */
		}

		/* Style for the navigation links on hover */
		.header .navbar-nav>li>a:hover {
			background-color: #555;
			/* Background color on hover */
			color: #fff;
			/* Text color on hover */
		}

		/* Style for the dropdown menu items */
		.header .dropdown-menu li a {
			color: #333;
			/* Text color for the dropdown menu items */
		}

		/* Style for the dropdown menu items on hover */
		.header .dropdown-menu li a:hover {
			background-color: #555;
			/* Background color on hover */
			color: #fff;
			/* Text color on hover */
		}
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
					$currentDate = date('y:m:d');
					$sql = "SELECT * from tblservice where ServiceDate > '$currentDate'";
					$query = $dbh->prepare($sql);
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
		<!-- navigation -->
		<div class="top-nav">
			<nav class="navbar navbar-default">
				<!-- ... (your existing navigation menu) ... -->
			</nav>
		</div>
	</div>
	<!-- //header -->
	<!-- banner -->
	<div class="banner jarallax">
		<div class="agileinfo-dot">
			<?php include_once('includes/header.php'); ?>
			<div class="w3layouts-banner">
				<div class="container">
					<div class="w3-banner-info">
						<div class="w3l-banner-text">
							<h2>Wedding Venue</h2>
							<p>We create your special day</p>
						</div>
					</div>
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
		</div>
	</div>
	<!-- //banner -->
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="wthree-bottom-grids">
				<div class="col-md-6 wthree-bottom-grid">
					<div class="w3-agileits-bottom-left">
						<div class="w3-agileits-bottom-left-text">
							<h3>Planning from start to finish</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id lacus vel purus sagittis
								convallis ut ac risus.</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 wthree-bottom-grid">
					<div class="w3-agileits-bottom-left w3-agileits-bottom-right">
						<div class="w3-agileits-bottom-left-text">
							<h3>LET THE EXPERTS RUN YOUR WEDDING</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id lacus vel purus sagittis
								convallis ut ac risus.</p>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
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