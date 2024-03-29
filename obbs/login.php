<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

$email = ""; // Initialize the email variable
$password = ""; // Initialize the password variable
$emailError = ""; // Initialize the email error message variable
$passwordError = ""; // Initialize the password error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT ID FROM tbluser WHERE Email=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['obbsuid'] = $result->ID;
        }
        $_SESSION['login'] = $_POST['email'];
        echo "<script type='text/javascript'> document.location ='index.php'; </script>";
    } else {
        // Check if the email is invalid
        $sql = "SELECT ID FROM tbluser WHERE Email=:email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $passwordError = "Invalid Password";
            $emailError = ""; // Clear email error message
        } else {
            $emailError = "Invalid Email";
            $passwordError = ""; // Clear password error message
        }
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Clear error messages when the page is reloaded
        $emailError = "";
        $passwordError = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Event Handler Platform | Login</title>

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
</head>

<style>
    .agileinfo-contact-form-grid {
        background-color: #383636;
        /* Grayish white background color */
        padding: 30px;
        border-radius: 5px;
    }

    .agileinfo-contact-form-grid input[type="password"],
    .agileinfo-contact-form-grid input[type="email"] {
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

<body>
    <!-- banner -->
    <?php include_once('includes/header.php'); ?>
    <div class="wthree-heading">
        <h2 style="color:black;">Login <a href="login.php"><i class="fa fa-sign-in"></i></a></h2>
        <hr>
    </div>
    <!-- //banner -->
    <!-- contact -->
    <div class="contact">
        <div class="container">
            <div class="agile-contact-form" style="margin-top:-50px;">
                <div class="col-md-6 contact-form-left">

                    <div class="agileits-contact-address" style="margin-top:0px;">
                        <img src="images/lg11.png" alt="" height="400" width="500">
                    </div>
                </div>
                <div class="col-md-6 contact-form-right">
                    <div class="contact-form-top">
                        <h3>Login to User Panel <a href="login.php"><i class="fa fa-user"
                                    style="color:skyblue;"></i></a></h3>
                    </div>
                    <div class="agileinfo-contact-form-grid">
                        <form action="#" method="post" name="login">
                            <input type="email" name="email" placeholder="E-mail Required" required
                                value="<?php echo $email; ?>">
                            <span style="color: red;">
                                <?php echo $emailError; ?>
                            </span>
                            <input type="password" name="password" placeholder="Password Required" required>
                            <span style="color: red;">
                                <?php echo $passwordError; ?>
                            </span>
                            <br>
                            <div class="forgot">
                                <a href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <br>
                            <button class="btn1" name="login">
                                <i class="fa fa-sign-in mr-5"></i> Go
                            </button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="col-md-6 contact-form-right">
                    <div class="forgot">
                        <a href="signup.php">Register Yourself</a>
                        <hr>
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