<?php

session_start();
is_login();

function is_login ()
{
    if(!isset($_SESSION["is_login"]) == 1) {
        header("location:../admin/login.php");
        exit();
    }
}

include_once "../DB/db_connect.php";

$sqlquery         = "SELECT * FROM attandence ORDER BY `created_at` DESC";
$attendance_lists = $conn->query($sqlquery);

$sqlquery    = "SELECT * FROM stall ORDER BY `created_at` DESC";
$stall_lists = $conn->query($sqlquery);

$sqlquery    = "SELECT * FROM member_list ORDER BY `created_at` DESC";
$member_list = $conn->query($sqlquery);

if(isset($_POST["download_csv"])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="attendance.csv"');
    $output = fopen("php://output", "w");
    fputcsv($output, array( 'SL', 'Date', 'First Name', 'Surname', 'Business Name', 'Business Address', 'Email Address', 'Contact Number' ));

    $sqlquery       = "SELECT row_number() OVER(ORDER BY ID) AS `SL`, DATE_FORMAT(`created_at`,'%Y-%m-%d') AS `Date`, `first_name`,`surname`,`business_name`,`business_address`,`email`,`contact` FROM attandence";
    $attendance_csv = $conn->query($sqlquery);


    if($attendance_csv->num_rows > 0) {
        while($attendance = $attendance_csv->fetch_assoc()) {
            fputcsv($output, $attendance);
        }
    }
    fclose($output);
    exit();
}

if(isset($_POST["download_stall_csv"])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="stall.csv"');
    $output = fopen("php://output", "w");
    fputcsv($output, array( 'SL', 'First Name', 'Surname', 'Business Name', 'Business Address', 'Email Address', 'Contact Number', 'Created at' ));

    $sqlquery  = "SELECT row_number() OVER(ORDER BY ID) AS `SL`, DATE_FORMAT(`created_at`,'%Y-%m-%d') AS `Date`, `first_name`,`surname`,`business_name`,`business_address`,`business_email`,`business_contact` FROM stall";
    $stall_csv = $conn->query($sqlquery);

    if($stall_csv->num_rows > 0) {
        while($stall = $stall_csv->fetch_assoc()) {
            fputcsv($output, $stall);
        }
    }
    fclose($output);
    exit();
}
if(isset($_POST["download_member_csv"])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Registered Members List.csv"');
    $output = fopen("php://output", "w");
    fputcsv($output, array( 'SL', 'Date', 'Name', 'Company Name', 'Type of Business', 'Business Address', 'Establish Year', ' Number of Employee', 'Membership Type', 'Membership Fees', 'Business Contact Number', 'Mobile', 'Email Address', 'Website Url', 'Never Provide Details Via' ));

    $sqlquery   = "SELECT row_number() OVER(ORDER BY ID) AS `SL`, DATE_FORMAT(`created_at`,'%Y-%m-%d') AS `Date`,  CONCAT(`first_name`,' ', `last_name`) AS Name,`company_name`,`business_type`,`business_address`,`establish_year`,`employee_number`,`membership_type`,`selected_membership_amount`,`telephone`,`mobile`,`email`,`website`,`shared_way` FROM member_list";
    $member_csv = $conn->query($sqlquery);

    if($member_csv->num_rows > 0) {
        while($member = $member_csv->fetch_assoc()) {
            fputcsv($output, $member);
        }
    }
    fclose($output);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UKBCCI Registered List</title>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <style>
            .csv-btn {
                margin-bottom: 5px;
            }

            .btn-primary {
                background-color: #469fc6 !important;
                border-color: #4076af !important;
            }

            .table thead tr th {
                text-align: center;
                vertical-align: middle;
            }

            .nav-btns {
                text-align: right !important;
            }

            #stall-list-btn {
                color: white !important;
                background: skyblue !important;
                border: skyblue !important;
            }

            .tab-title {
                font-size: 17px !important;
            }
        </style>
    </head>

    <body>
        <?php
        include_once('../admin_headerview/header.php');
        ?>
        <div id="main-content" class="container allContent-section py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col mt-1 ">

                        <button id="attandence-list-btn" class="btn btn-success btn-sm btn-block">Attendance</button>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col mt-1">

                        <button id="stall-list-btn" class="btn btn-sm btn-block">Stall</button>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col mt-1">

                        <button id="member-list-btn" class="btn btn-info btn-sm btn-block">Members</button>

                    </div>
                </div>
                <div id="attendance-list-div">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-9 mt-1">
                            <h5 class="tab-title">Registered Attendance</h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 text-right mt-1">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <button type="submit" name="download_csv" class="btn btn-sm btn-primary">CSV <i
                                            class="fa fa-download" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th rowspan="2">SL</th>
                                            <th rowspan="2" width="100px">Date </th>
                                            <th rowspan="2">First Name</th>
                                            <th rowspan="2">Sur-Name</th>
                                            <th colspan="2">Business</th>
                                            <th rowspan="2">Email Address</th>
                                            <th rowspan="2">Contact Number</th>

                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if($attendance_lists->num_rows > 0) {
                                            while($attendance = $attendance_lists->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <th><?php echo $count++; ?></th>
                                                    <td><?php echo date("Y-m-d", strtotime($attendance['created_at'])); ?>
                                                    </td>
                                                    <td><?php echo $attendance['first_name']; ?></td>
                                                    <td><?php echo $attendance['surname']; ?></td>
                                                    <td><?php echo $attendance['business_name']; ?></td>
                                                    <td><?php echo $attendance['business_address']; ?></td>
                                                    <td><?php echo $attendance['email']; ?></td>
                                                    <td><?php echo $attendance['contact']; ?></td>

                                                </tr>
                                            <?php }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="stall-list-div">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-9 mt-1">
                            <h5 class="tab-title">Registered Stall</h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 text-right mt-1">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <button type="submit" name="download_stall_csv" class="btn btn-sm btn-primary">CSV
                                        <i class="fa fa-download" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table table-striped table-bordered table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th rowspan="2">SL</th>
                                            <th rowspan="2" width="100px">Date</th>
                                            <th rowspan="2">First Name</th>
                                            <th rowspan="2">Sur-Name</th>
                                            <th colspan="4">Business</th>

                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if($stall_lists->num_rows > 0) {
                                            while($stall = $stall_lists->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <th><?php echo $count++; ?></th>
                                                    <td><?php echo date("Y-m-d", strtotime($stall['created_at'])); ?>
                                                    </td>
                                                    <td><?php echo $stall['first_name']; ?></td>
                                                    <td><?php echo $stall['surname']; ?></td>
                                                    <td><?php echo $stall['business_name']; ?></td>
                                                    <td><?php echo $stall['business_address']; ?></td>
                                                    <td><?php echo $stall['business_email']; ?></td>
                                                    <td><?php echo $stall['business_contact']; ?></td>

                                                </tr>
                                            <?php }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="member-list-div">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-9 mt-1">
                            <h5 class="tab-title">Registered Member</h5>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 text-right mt-1">
                            <form method="post" enctype="multipart/form-data">

                                <button type="submit" name="download_member_csv" class="btn btn-sm btn-primary">CSV
                                    <i class="fa fa-download" aria-hidden="true"></i></button>

                            </form>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-sm table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th rowspan="2">SL</th>
                                            <th rowspan="2" width="100px">Date </th>
                                            <th rowspan="2">First Name</th>
                                            <th rowspan="2">Last Name</th>
                                            <th rowspan="2">Company Name</th>
                                            <th rowspan="2">Type of Business</th>
                                            <th rowspan="2">Business Address</th>
                                            <th>Email Address</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if($member_list->num_rows > 0) {

                                            while($member = $member_list->fetch_assoc()) {

                                                ?>
                                                <tr>
                                                    <th><?php echo $count++; ?></th>
                                                    <td><?php echo date("Y-m-d", strtotime($member['created_at'])); ?>
                                                    </td>
                                                    <td><?php echo $member['first_name']; ?></td>
                                                    <td><?php echo $member['last_name']; ?></td>
                                                    <td><?php echo $member['company_name']; ?></td>
                                                    <td><?php echo $member['business_type']; ?></td>
                                                    <td><?php echo $member['business_address']; ?></td>
                                                    <td><?php echo $member['email']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary member_info"
                                                            data-toggle="modal" data-placement="bottom" data-target="#myModal"
                                                            data-id="<?= $member['id'] ?>"
                                                            data-action="member_details_modal.php?id=<?= $member['id'] ?>">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog  modal-dialog-centered modal-lg">
                                        <div class="modal-content" style="border: 3px solid #0891b2;">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Member Details</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body member-details-show">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="../assets/js/jquery-3.1.1.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#attendance-list-div').show();
                $('#stall-list-div').hide();
                $('#member-list-div').hide();
            });

            $(document).on('click', '#attandence-list-btn', function () {
                $('#attendance-list-div').show();
                $('#stall-list-div').hide();
                $('#member-list-div').hide();
            });
            $(document).on('click', '#stall-list-btn', function () {
                $('#attendance-list-div').hide();
                $('#member-list-div').hide();
                $('#stall-list-div').show();
            });
            $(document).on('click', '#member-list-btn', function () {
                $('#attendance-list-div').hide();
                $('#stall-list-div').hide();
                $('#member-list-div').show();
            });

            $(document).on('click', '.member_info', function (event) {
                event.preventDefault();
                var dataAction = $(this).attr('data-action');
                var id = $(this).attr('data-id');
                //console.log('dataAction: ', dataAction);
                $.ajax({
                    type: "POST",
                    url: dataAction,
                    data: { id: id },
                    success: function (data) {
                        console.log('data: ', data);
                        $('.member-details-show').html(data);
                        $('#myModal').modal('show');
                    },
                    error: function () {
                        console.log("Error");
                    }
                });
            });

        </script>
    </body>

</html>