<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['odmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {


    $eid = $_GET['editid'];
    $bookingid = $_GET['bookingid'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];


    $sql = "update tblbooking set Status=:status,Remark=:remark where ID=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':remark', $remark, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);

    $query->execute();

    echo '<script>alert("Remark has been updated")</script>';
    echo "<script>window.location.href ='all-booking.php'</script>";
  }

  ?>
  <!doctype html>
  <html lang="en" class="no-focus"> <!--<![endif]-->

  <head>
    <title>Event Handler Platform - View Booking</title>
    <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

  </head>

  <body>
    <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">


      <?php include_once('includes/sidebar.php'); ?>

      <?php include_once('includes/header.php'); ?>

      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        <div class="content">

          <!-- Register Forms -->
          <h2 class="content-heading"><strong>View Booking</strong> </h2>
          <div class="row">
            <div class="col-md-12">
              <!-- Bootstrap Register -->
              <div class="block block-themed">
                <div class="block-header bg-gd-emerald">
                  <h3 class="block-title"><strong>View Booking</strong></h3>
                  <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle"
                      data-action-mode="demo">
                      <i class="si si-refresh"></i>
                    </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                      data-action="content_toggle"></button>
                  </div>
                </div>
                <div class="block-content">

                  <?php
                  $eid = $_GET['editid'];

                  $sql = "SELECT tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tblbooking.BookingID,tblbooking.BookingDate,tblbooking.PricePerEvent,tblbooking.TotalPrice,tblbooking.EventType,tblbooking.Numberofguest,tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblbooking.PhonePayedOn,tblevents.ServiceName,tblevents.SerDes,tblevents.ServicePrice,tblevents.Location,tblevents.ServiceDate,tblevents.ServiceTime from tblbooking join tblevents on tblbooking.ServiceID=tblevents.ID join tbluser on tbluser.ID=tblbooking.UserID  where tblbooking.ID=:eid";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);

                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                    foreach ($results as $row) { ?>
                      <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <tr>
                          <th colspan="5" style="text-align: center;font-size: 20px;color: blue;">Booking Code:
                            <?php echo $row->BookingID; ?>

                          </th>
                        </tr>
                        <tr>
                          <th>Customer Name</th>
                          <td style="color:orange;font-weight:bold;font-size:15px;">
                            <?php echo $row->FullName; ?>
                          </td>
                          <th>Mobile Number</th>
                          <td style="color:orange;font-weight:bold;font-size:15px;">(+250)
                            <?php echo $row->MobileNumber; ?>
                          </td>
                        </tr>


                        <tr>

                          <th>Email</th>
                          <td style="color:blue;font-weight:bold;font-size:15px;">
                            <?php echo $row->Email; ?>
                          </td>
                          <th>Number of Seats</th>
                          <td style="color:orange;font-weight:bold;font-size:15px;">
                            <?php echo $row->Numberofguest; ?> Seat(s)
                          </td>
                        </tr>
                        <tr>

                          <th>Event Date</th>
                          <td>
                            <?php echo $row->ServiceDate; ?>
                          </td>
                          <th>Event Time</th>
                          <td>
                            <?php echo $row->ServiceTime; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Event Location</th>
                          <td>
                            <?php echo $row->Location; ?>
                          </td>
                          <th>Apply Date</th>
                          <td>
                            <?php echo $row->BookingDate; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Event Price</th>
                          <td><span class="text-danger">Frw</span>
                            <?php echo $row->ServicePrice; ?>
                          </td>
                          <th>Total price</th>
                          <td><span class="text-danger">Frw</span>
                            <?php echo $row->TotalPrice; ?>
                          </td>
                        </tr>

                        <tr>

                          <th>Event Name</th>
                          <td>
                            <?php echo $row->ServiceName; ?>
                          </td>
                          <th>Phone Used In Payment</th>
                          <td>+250 
                            <?php echo $row->PhonePayedOn; ?>
                          </td>
                        </tr>

                        <tr>

                          <th>Order Final Status</th>

                          <td style="color:orange;font-weight:bold;font-size:15px;">
                            <?php $status = $row->Status;

                            if ($row->Status == "Approved") {
                              echo "Approved";
                            }

                            if ($row->Status == "Cancelled") {
                              echo "Cancelled";
                            }


                            if ($row->Status == "") {
                              echo "Not Response Yet";
                            }


                            ; ?>
                          </td>
                          <th>Admin Remark</th>
                          <?php if ($row->Status == "") { ?>

                            <td style="color:orange;font-weight:bold;font-size:15px;">
                              <?php echo "Not Updated Yet"; ?>
                            </td>
                          <?php } else { ?>
                            <td style="color:orange;font-weight:bold;font-size:15px;">
                              <?php echo htmlentities($row->Remark); ?>
                            </td>
                          <?php } ?>
                        </tr>


                        <?php $cnt = $cnt + 1;
                    }
                  } ?>

                  </table>
                  <?php

                  if ($status == "") {
                    ?>
                    <p align="center" style="padding-top: 20px">
                      <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal"
                        data-target="#myModal">
                        <i class="fa fa-plus"></i> Take Action
                      </button>
                    </p>

                  <?php } ?>
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:red;">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table class="table table-bordered table-hover data-tables">

                            <form method="post" name="submit">



                              <tr>
                                <th>Remark :</th>
                                <td>
                                  <textarea name="remark" placeholder="Remark" rows="12" cols="14"
                                    class="form-control wd-450" required="true"></textarea>
                                </td>
                              </tr>


                              <tr>
                                <th>Status :</th>
                                <td>

                                  <select name="status" class="form-control wd-450" required="true">
                                    <option value="Approved" selected="true">Approved</option>
                                    <option value="Cancelled">Cancelled</option>
                                  </select>
                                </td>
                              </tr>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-close" style="color:red;"></i> Close
                          </button>
                          <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save
                          </button>

                          </form>



                        </div>
                      </div>
                      <!-- END Bootstrap Register -->
                    </div>

                  </div>
                </div>
                <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <?php include_once('includes/footer.php'); ?>
    </div>
    <!-- END Page Container -->

    <!-- Codebase Core JS -->
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="assets/js/core/jquery.appear.min.js"></script>
    <script src="assets/js/core/jquery.countTo.min.js"></script>
    <script src="assets/js/core/js.cookie.min.js"></script>
    <script src="assets/js/codebase.js"></script>
  </body>

  </html>
<?php } ?>