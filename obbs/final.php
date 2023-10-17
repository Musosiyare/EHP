<?php
// exit('hello');
include('includes/dbconnection.php');
include "pay.php";
// check if pay_ref is not empty
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    die("UNSUPPORTED REQUEST METHOD");
}
$pay_ref = $_GET['ref'];
$result = hdev_payment::get_pay($pay_ref);
if($result == null) {
    header('location: booking-history.php');
} else {
    $sql = "UPDATE `tblbooking` SET `payment_status`='" . $result->status . "' WHERE `transactionId` = '$pay_ref'";
    $update = $dbh->query($sql);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment Confirmation</title>
    <!-- Bootstrap 4 CDN -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <h1 class="mb-3">Your payment is
            <?php echo $result->status; ?>
        </h1>
        <?php
        if ($result->status == "pending"){ ?>
            <p class="mb-3">Please confirm your payment...</p>
            <p>Approve Payment on your phone, For MTN dial: *182*7*1#</p>
            <div class="spinner-border text-primary" role="status">
                <i class="fa fa-spinner fa-spin fa-5x"></i>
            </div>
            <?php
            }else {
                ?>
                <div class="spinner-border text-primary" role="status">
                <i class="fa fa-check fa-5x"></i>
            </div>
                <?php
            }
        ?>
        <div class="mt-3">
            <a href="index.php" class="btn btn-primary">Go back</a>
        </div>
    </div>

    <!-- Bootstrap 4 and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script>
        setTimeout(function () {
            location.reload();
        }, 5000);
    </script>
</body>

</html>