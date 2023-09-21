<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

$fname = "";
$mobno = "";
$email = "";

if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $mobno = $_POST['mobno'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $ret = "select Email from tbluser where Email=:email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Validate empty values
    if (empty($fname) || empty($mobno) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required. Please fill in all the fields.');</script>";
    }
    // Validate Full Name (only characters and spaces with a minimum length of 3)
    elseif (!preg_match("/^[a-zA-Z\s]{3,}$/", $fname)) {
        echo "<script>alert('Full Name should only contain characters and spaces (minimum 3 characters).');</script>";
    }
    // Validate Mobile Number (only numbers and exactly 10 digits)
    elseif (!preg_match("/^[0-9]{10}$/", $mobno)) {
        echo "<script>alert('Mobile Number should be a valid 10-digit number.');</script>";
    } elseif ($query->rowCount() == 0) {
        $sql = "Insert Into tbluser(FullName,MobileNumber,Email,Password) Values(:fname,:mobno,:email,:password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('You have signed up successfully.');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Email-id already exists. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Event Handler Platform | Signup</title>

    <script type="application/x-javascript">
        addEventListener("load", function() {
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
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
            });
        });
    </script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <script type="text/javascript">
        function checkpass() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert('New Password and Confirm Password field does not match');
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }

    </script>
</head>

<body>
    <!-- banner -->
    <div class="banner jarallax">
        <div class="agileinfo-dot">
            <?php include_once('includes/header.php'); ?>
            <div class="wthree-heading">
                <h2>Register</h2>
            </div>
        </div>
    </div>
    <!-- //banner -->
    <!-- contact -->
    <div class="contact">
        <div class="container">
            <div class="agile-contact-form">
                <div class="col-md-6 contact-form-left">

                    <div class="agileits-contact-address">
                        <img src="images/5.jpg" alt="" height="500" width="500">
                    </div>
                </div>
                <div class="col-md-6 contact-form-right">
                    <div class="contact-form-top">
                        <h3>Register Yourself </h3>
                    </div>
                    <div class="agileinfo-contact-form-grid">
                        <form method="post" name="signup" onsubmit="return checkpass();">
                            <input type="text" name="fname" placeholder="Full Name" value="<?php echo $fname; ?>">
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>">
                            <input type="text" name="mobno" placeholder="Mobile Number" maxlength="10"
                                pattern="[0-9]+" value="<?php echo $mobno; ?>">
                            <input type="password" name="password" placeholder="Password" id="password1">
                            <br>
                            <input type="password" name="confirmpassword" placeholder="Confirm Password" id="password2">
                            <br>
                            <div class="tp">
                                <button class="btn1" name="signup">Register NOW</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="col-md-6 contact-form-right">
                    <div class="forgot">
                        <a href="login.php">Already have an account!!!</a>
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
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
    <!-- //here ends scrolling icon -->
    <script src="js/modernizr.custom.js"></script>
</body>

</html>
