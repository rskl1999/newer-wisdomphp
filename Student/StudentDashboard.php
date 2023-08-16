<?php

    require_once('../connection.php');
    session_start();

    include('../pageNavigation.php');

    include('../checkLogin.php');

    $accountID = $_SESSION['accountID'];

    // Query for duration + hours rendered
    $duration_query = $con->prepare("SELECT ap.duration, st.hoursRendered
                                    FROM internshipapplication ap
                                    JOIN student st ON ap.internshipapplicationID = st.applicationID
                                    WHERE st.accountID = ?
                                    ");
    $duration_query->bind_param("i", $accountID);
    $duration_query->execute();
    $duration_res = $duration_query->get_result();
    $duration_query->close();
    $total_duration = $duration_res->fetch_assoc();
    $total_duration['duration'] = $total_duration['duration'] ?? 0;
    $total_duration['hoursRendered'] = $total_duration['hoursRendered'] ?? 0;

    // Query for School and Facilitator Details
    $school_query = $con->prepare("SELECT st.schoolID, sc.schoolName, sc.address, sc.schoolLogo
                                    FROM student st
                                    JOIN school sc ON st.schoolID = sc.schoolID
                                    WHERE st.accountID = ?
                                    ");
    $school_query->bind_param("i", $accountID);
    $school_query->execute();
    $school_res = $school_query->get_result();
    $school_query->close();
    $school_details = $school_res->fetch_assoc();
    $school_details['schoolName'] = $school_details['schoolName'] ?? 'School\'s Name';
    $school_details['address'] = $school_details['address'] ?? 'School Address';
    $school_details['schoolLogo'] = $school_details['schoolLogo'] ?? 'default.png';

    // Query for tasks
    $task_query = $con->prepare("SELECT ts.taskID, ts.applicationID, ts.title, ts.description, ts.allotedHours, ts.dateStarted, ts.dateFinished, ts.status
                                FROM studenttask stk
                                JOIN task ts ON stk.taskID = ts.taskID
                                JOIN student st ON  stk.studentID = st.studentID
                                JOIN account ac ON st.accountID = ac.accountID
                                WHERE ac.accountID = ?
                                ");
    $task_query->bind_param("i", $accountID);
    $task_query->execute();
    $task_res = $task_query->get_result();
    $task_query->close();
    $tasks_detail = array();
    while($row = $task_res->fetch_assoc()) {
        $tasks_detail[] = $row;
    }


    // Table page setup
    $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
    $total_items = count($tasks_detail);
    $items_per_page = 10;
    $offset = ($page - 1) * $items_per_page;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="student-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="student-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="student-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="student-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="student-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="student-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="student-assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="student-assets/css/Profile-Edit-Form.css">
</head>

<body style="color: rgb(0,0,0);"><nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
    <div class="container-fluid"><a href="StudentDashboard.php"><img src="student-assets/img/logo_black.png" width="140" height="29" /></a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow mx-1"></li>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile" src="student-assets/img/avatars/avatar1.jpeg" /></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="StudentProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit Profile</a><a class="dropdown-item" href="StudentDashboard.php"><i class="fas fa-home fa-sm fa-fw me-2 text-gray-400"></i>Dashboard</a>
                        <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <div id="banner" style="height: 250px;background: url(&quot;student-assets/img/banner-bg.png&quot;) center / cover no-repeat, #d3edff;">
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
                <div style="height: 150px;width: 330px;background: #1b3996;color: rgb(255,255,255);font-family: Poppins, sans-serif;border-radius: 35px;box-shadow: 0px 4px 20px rgba(0,0,0,0.15)">
                    <div class="row d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="width: 100%;height: 100%;margin: 0px;font-size: 22px;padding: 0px 50px;">
                        <div class="col-md-6 d-flex d-sm-flex justify-content-center justify-content-sm-center">
                            <p style="margin: 0px;font-weight: bold;">Required Hours</p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center"><span style="font-size: 66px;font-weight: bold;margin-left:20px;"><?php echo $total_duration['duration']; ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center" id="enrolledStudent" style="margin-bottom: 12px;">
                <div style="height: 150px;width: 330px;background: #5cb8ff;color: rgb(255,255,255);font-family: Poppins, sans-serif;border-radius: 35px;box-shadow: 0px 4px 20px rgba(0,0,0,0.15)">
                    <div class="row d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="width: 100%;height: 100%;margin: 0px;font-size: 22px;padding: 0px 50px;">
                        <div class="col-md-6 d-flex justify-content-center">
                            <p style="margin: 0px;font-weight: bold;">Rendered Hours</p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center"><span style="font-size: 66px;font-weight: bold;margin-left:20px;"><?php echo $total_duration['hoursRendered']; ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex d-sm-flex justify-content-center justify-content-sm-center" id="pendingStudent" style="margin-bottom: 12px;">
                <div style="height: 150px;width: 330px;background: #95acb8;color: rgb(255,255,255);font-family: Poppins, sans-serif;border-radius: 35px;box-shadow: 0px 4px 20px rgba(0,0,0,0.15)">
                    <div class="row d-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="width: 100%;height: 100%;margin: 0px;font-size: 22px;padding: 0px 50px;">
                        <div class="col-md-6 d-flex justify-content-center">
                            <p style="margin: 0px;font-weight: bold;">Remaining Hours</p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center"><span style="font-size: 66px;font-weight: bold;margin-left:20px;"><?php echo ($total_duration['duration'] - $total_duration['hoursRendered']); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center" style="padding: 20px 12px;">
        <div class="row">
            <div class="col-md-6 mb-4">
            <h1 style="font-size: 30px;color: rgb(0,0,0);padding: 10px 5px;font-family: Poppins, sans-serif;"><strong>School</strong></h1>
                <div class="card" style="border-radius: 25px; border-style: none;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="border-radius: 25px; box-shadow: 0px 4px 20px rgba(0,0,0,0.15); border-style: none; height: 230px; width: 600px;">
                        <img src="../School-Logo/<?php echo $school_details['schoolLogo']; ?>" alt="School Image" style="position: absolute; top: 50%; left: 25%; transform: translate(-50%, -50%); width: 150px; height: 150; border-radius: 50%;">
                        <h5 class="card-title ml-2 text-center" style="font-weight: bold; font-family: Poppins, sans-serif;margin-left:40%; padding-right: 5%;"><?php echo $school_details['schoolName']; ?></h5>
                        <h6 class="card-title ml-3 text-center" style="font-family: Poppins, sans-serif;margin-left:40%; padding-right: 5%;"><?php echo $school_details['address']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
            <h1 style="font-size: 30px;color: rgb(0,0,0);padding: 10px 5px;font-family: Poppins, sans-serif;"><strong>Facilitator</strong></h1>
                <div class="card" style="border-radius: 25px; border-style: none;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="border-radius: 25px; box-shadow: 0px 4px 20px rgba(0,0,0,0.15); border-style: none; height: 230px; width: 600px;">
                        <img src="assets/img/avatars/avatar1.jpeg" alt="Facilitator Image" style="position: absolute; top: 50%; left: 25%; transform: translate(-50%, -50%); width: 150px; height: 150px; border-radius: 50%;">
                        <h5 class="card-title ml-2 text-center" style="font-weight: bold; font-family: Poppins, sans-serif;margin-left:40%; padding-right: 5%;">Facilitator's Name</h5>
                        <h6 class="card-title ml-3 text-center" style="font-family: Poppins, sans-serif;margin-left:40%; padding-right: 5%;">Facilitator's Position</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center" style="padding: 20px 12px;">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <a href="StudentLogs.php?side=logs" class="card text-white" style="border-radius: 25px; border-style: none; background-color: #1b3996; text-decoration: none;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="border-radius: 25px; box-shadow: 0px 4px 20px rgba(0,0,0,0.15); border-style: none; height: 230px; width: 600px;">
                        <h5 class="card-title text-center" style="font-size: 42px; font-weight: bold; font-family: Poppins, sans-serif;">Daily Logs</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="StudentLogs.php?side=docu" class="card text-white" style="border-radius: 25px; border-style: none; background-color: #5cb8ff; text-decoration: none;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="border-radius: 25px; box-shadow: 0px 4px 20px rgba(0,0,0,0.15); border-style: none; height: 230px; width: 600px;">
                        <h5 class="card-title text-center" style="font-size: 42px;font-weight: bold; font-family: Poppins, sans-serif;">Daily Tasks and Documentation</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container" id="StudentTable" style="padding: 0px 50px;padding-bottom: 30px;">
        <h1 style="font-size: 30px;color: rgb(0,0,0);padding: 10px 5px;font-family: Poppins, sans-serif;"><strong>Tasks</strong></h1>
        <div class="table-responsive" style="border: 1px solid rgb(227,230,240);font-family: Poppins, sans-serif;color: rgb(0,0,0);border-radius: 25px;padding: 0px;">
            <table class="table">
                <thead style="color: rgb(0,0,0);font-size: 13px;background: #f2f2f2;">
                    <tr style="margin: 5px;">
                        <th><input type="checkbox"></th>
                        <th>Task List</th>
                        <th>Status</th>
                        <th>Date Started</th>
                        <th>Date Finished</th>
                        <th>Alloted Hours</th>
                    </tr>
                </thead>
                <tbody style="color: rgb(0,0,0);font-size: 12px;">

                    <?php
                        for($i = $offset; $i < ($offset + $items_per_page) && $i < $total_items; $i++) {
                            $task = $tasks_detail[$i];
                            $task['status'] = $task['status'] ?? "Pending";
                            $task['dateStarted'] = $task['dateStarted'] ?? "No Date";
                            $task['dateFinished'] = $task['dateFinished'] ?? "No Date";
                            echo "
                                <tr>
                                    <td><input type=\"checkbox\"></td>
                                    <td style=\"max-width: 100px;\">
                                        <p style=\"margin: 0px;\"><strong>".$task['title']."</strong></p>
                                        <small>".$task['description']."</small>
                                    </td>
                                    <td>
                                        <span style=\"padding: 2px 14px;background: #d8ffdf;border-radius: 35px;color: #89c593;\">".$task['status']."</span>
                                    </td>
                                    <td>".$task['dateStarted']."</td>
                                    <td>".$task['dateFinished']."</td>
                                    <td>".$task['allotedHours']."</td>
                                </tr>
                            ";
                        }
                    ?>

                </tbody>
            </table>
        </div>
        <nav class="d-flex d-lg-flex justify-content-center justify-content-lg-center" style="padding: 20px 0px;">
            <ul class="pagination">

                <?php
                    $nav = new PageNavigation();
                    $nav->setTotalItems($total_items);
                    $nav->setItemsPerPage($items_per_page);
                    $nav->getNavigation("StudentDashboard.php", $page);
                ?>

            </ul>
        </nav>
    </div>
    <script src="student-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="student-assets/js/Profile-Edit-Form-profile.js"></script>
    <script src="student-assets/js/theme.js"></script>
    <script src="student-assets/js/untitled.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>
