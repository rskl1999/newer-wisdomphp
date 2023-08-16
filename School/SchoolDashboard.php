<?php
    require_once('../connection.php');
    session_start();

    include('../PageNavigation.php');
    include('../checkLogin.php');

    $accountid = $_SESSION['accountID'];

    include('scripts/studentCount.php');

    $schoolid = $_SESSION['schoolID'];

    $_SESSION['items_per_page'] = 10;
    $_SESSION['page'] = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;

    include('scripts/studentList.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SchoolPage</title>
    <link rel="stylesheet" href="school-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="school-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="school-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="school-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="school-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="school-assets/css/Navbar-With-Button-icons.css">
</head>

<body style="color: rgb(0,0,0);"><nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
    <div class="container-fluid"><a href="SchoolDashboard.php"><img src="school-assets/img/logo_black.png" width="140" height="29" /></a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item d-flex justify-content-center align-items-center dropdown no-arrow mx-1"><a href="SchoolAddStudent.php"><button class="btn btn-primary" type="button" style="background: #0017eb;border-radius: 35px;width: 130px;">Add Student</button></a></li>
            <li class="nav-item dropdown no-arrow mx-1"></li>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img id="school-logo" class="border rounded-circle img-profile"/></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="SchoolEditProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit Profile</a><a class="dropdown-item" href="SchoolDashboard.php"><i class="fas fa-home fa-sm fa-fw me-2 text-gray-400"></i>Dashboard</a>
                        <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <div id="banner" style="height: 250px;background: url(&quot;school-assets/img/banner-bg.png&quot;) center / cover no-repeat, #d3edff;">
        <div class="container" style="height: 250px;">
            <div class="row d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="height: 100%;">
                <div class="col-md-12 text-center" style="width: 754px;">
                    <p class="d-flex d-xxl-flex justify-content-center justify-content-xxl-center" style="font-family: Poppins, sans-serif;font-size: 45px;margin-bottom: 0px;color: rgb(0,0,0);font-weight: bold;">Empower students for&nbsp;</p><span class="d-flex d-xxl-flex justify-content-center justify-content-xxl-center" style="font-size: 45px;font-family: Poppins, sans-serif;color: rgb(0,23,235);font-weight: bold;">success</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" id="numbers" style="padding: 60px 12px;">
        <div class="row">
            <div class="col-md-4 d-flex d-sm-flex justify-content-center justify-content-sm-center" id="totalStudent" style="margin-bottom: 12px;">
                <div style="height: 150px;width: 330px;background: #1b3996;color: rgb(255,255,255);font-family: Poppins, sans-serif;border-radius: 35px;">
                    <div class="row d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="width: 100%;height: 100%;margin: 0px;font-size: 22px;padding: 0px 50px;">
                        <div class="col-md-6 d-flex d-sm-flex justify-content-center justify-content-sm-center">
                            <p style="margin: 0px;font-weight: bold;">Total Student</p>
                        </div>

                        <!-- Number of All Students -->
                        <div class="col-md-6 d-flex justify-content-center"><span style="font-size: 66px;font-weight: bold;"><?php echo $studentTotal; ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center" id="enrolledStudent" style="margin-bottom: 12px;">
                <div style="height: 150px;width: 330px;background: #5cb8ff;color: rgb(255,255,255);font-family: Poppins, sans-serif;border-radius: 35px;">
                    <div class="row d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="width: 100%;height: 100%;margin: 0px;font-size: 22px;padding: 0px 50px;">
                        <div class="col-md-6 d-flex justify-content-center">
                            <p style="margin: 0px;font-weight: bold;">Enrolled Student</p>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center"><span style="font-size: 66px;font-weight: bold;"><?php echo $enrolled ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex d-sm-flex justify-content-center justify-content-sm-center" id="pendingStudent" style="margin-bottom: 12px;">
                <div style="height: 150px;width: 330px;background: #95acb8;color: rgb(255,255,255);font-family: Poppins, sans-serif;border-radius: 35px;">
                    <div class="row d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="width: 100%;height: 100%;margin: 0px;font-size: 22px;padding: 0px 50px;">
                        <div class="col-md-6 d-flex justify-content-center">
                            <p style="margin: 0px;font-weight: bold;">Pending Student</p>
                        </div>

                        <!-- Number of Pending Students -->
                        <div class="col-md-6 d-flex justify-content-center"><span style="font-size: 66px;font-weight: bold;"><?php echo $pendingNum ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="StudentTable" style="padding: 0px 50px;padding-bottom: 30px;">
        <h1 style="font-size: 30px;color: rgb(0,0,0);padding: 10px 5px;"><strong>Student</strong></h1>
        <div class="table-responsive" style="border: 1px solid rgb(227,230,240);font-family: Poppins, sans-serif;color: rgb(0,0,0);border-radius: 25px;padding: 0px;">
            <table class="table">
                <thead style="color: rgb(0,0,0);font-size: 13px;background: #f2f2f2;">
                    <tr style="margin: 5px;">
                        <th><input type="checkbox"></th>
                        <th>Student Name</th>
                        <th>Batch</th>
                        <th>Status</th>
                        <th>Course/Strand</th>
                        <th>Duration</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody style="color: rgb(0,0,0);font-size: 12px;">
                <?php

                    if(isset($_POST['data'])) {
                        foreach($_POST['data'] as $student) {
                            echo "
                                <tr>
                                    <td><input type=\"checkbox\"></td>
                                    <td>
                                        <p style=\"margin: 0px;\"><strong>".$student['studentName']."</strong></p><small>".$student['email']."</small>
                                    </td>
                                    <td>".$student['batchNo']."</td>
                                    <td><span style=\"padding: 2px 14px;background: #d8ffdf;border-radius: 35px;color: #89c593;\">".$student['status']."</span></td>
                                    <td>".$student['course']."</td>
                                    <td>".$student['hoursRendered']."&nbsp;</td>
                                    <td>".$student['duration']."</td>
                                </tr>
                            ";
                        }
                    }
                ?>
                </tbody>
            </table>

            <nav class="d-flex d-lg-flex justify-content-center justify-content-lg-center" style="padding: 20px 0px;">
                <ul class="pagination">

                    <?php
                        $nav = new PageNavigation();
                        $nav->setTotalItems($total_items);
                        $nav->setItemsPerPage($items_per_page);
                        $nav->getNavigation("SchoolDashboard.php", $page);
                    ?>

                </ul>
            </nav>
        </div>
    </div>
    <script src="school-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="school-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="school-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="school-assets/js/Profile-Edit-Form-profile.js"></script>
    <script src="school-assets/js/theme.js"></script>
    <script src="school-assets/js/untitled.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
    <script src="studentList.js"></script>
</body>

</html>
