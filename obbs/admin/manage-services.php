<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['odmsaid'] == 0)) {
    header('location:logout.php');
} else {

    // Code for deleting product from cart
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "delete from tblevents where ID=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href = 'manage-services.php'</script>";
    }

    ?>
    <!DOCTYPE html>
    <html lang="en" class="no-focus">

    <head>
        <title>Event Handler Platform - Manage Services</title>
        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
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
                    <h2 class="content-heading"><strong>Manage Events</strong></h2>
                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title"><strong>Manage Events</strong></h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Event Name</th>
                                        <th class="d-none d-sm-table-cell">Event Price</th>
                                        <th class="d-none d-sm-table-cell">Event Date</th>
                                        <th class="d-none d-sm-table-cell">Event Time</th>
                                        <th class="d-none d-sm-table-cell">Location</th>
                                        <th class="d-none d-sm-table-cell">Seats</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $currentDateTime = date("Y-m-d H:i:s"); // Get the current date and time
                                    $sql = "SELECT * from tblevents";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                            $eventDateTime = $row->ServiceDate . ' ' . $row->ServiceTime;
                                            $expired = strtotime($eventDateTime) < strtotime($currentDateTime); // Check if event has expired
                                            ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo htmlentities($cnt); ?>
                                                </td>
                                                <td class="font-w600 <?php echo $expired ? 'text-danger' : ''; ?>">
                                                    <?php echo htmlentities($row->ServiceName); ?>
                                                    <?php if ($expired)
                                                        echo ' (Expired)'; ?>
                                                </td>
                                                <td class="d-none d-sm-table-cell <?php echo $expired ? 'text-danger' : ''; ?>">
                                                    <span class="text-danger">Frw</span>
                                                    <?php echo htmlentities($row->ServicePrice); ?>
                                                </td>
                                                <td class="d-none d-sm-table-cell <?php echo $expired ? 'text-danger' : ''; ?>">
                                                    <?php echo htmlentities($row->ServiceDate); ?>
                                                </td>
                                                <td class="d-none d-sm-table-cell <?php echo $expired ? 'text-danger' : ''; ?>">
                                                    <?php echo htmlentities($row->ServiceTime); ?>
                                                </td>
                                                <td class="d-none d-sm-table-cell <?php echo $expired ? 'text-danger' : ''; ?>">
                                                    <?php echo htmlentities($row->Location); ?>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <?php
                                                    $seats = htmlentities($row->Seats);
                                                    if ($seats == 0) {
                                                        echo '<span class="badge badge-danger">No seats available</span>';
                                                    } else {
                                                        echo '<span class="badge badge-primary">' . $seats . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="d-none d-sm-table-cell"><a
                                                        href="manage-services.php?delid=<?php echo ($row->ID); ?>"
                                                        onclick="return confirm('Do you really want to Delete ?');"><i
                                                            class="fa fa-trash fa-delete text-danger" aria-hidden="true"></i></a>
                                                    <span class="mx-20">
                                                        <a href="manage-service-update.php?upid=<?php echo ($row->ID); ?>"><i
                                                                class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full Pagination -->
                    <!-- END Dynamic Table Simple -->
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
        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Page JS Code -->
        <script src="assets/js/pages/be_tables_datatables.js"></script>
    </body>

    </html>
<?php } ?>