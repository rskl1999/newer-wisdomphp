<?php
    session_start();
    require_once('../connection.php');

    require_once('../PageNavigation.php');

    $school_index = isset($_GET['school_index']) ? $_GET['school_index'] : 1;

    // Query for List of Students
    $students_query = "SELECT st.studentID, st.studentName, st.course, st.hoursRendered, sts.status, b.batchNo, ap.duration
                    FROM student st
                    JOIN internshipapplication ap ON st.applicationID = ap.internshipapplicationID
                    JOIN studentstatus sts ON st.schoolID = sts.schoolID AND st.studentID = sts.studentID
                    JOIN batch b ON b.batchID = ap.batchID AND ap.internshipApplicationID = st.applicationID
                    WHERE st.schoolID = ?";
    $students_stmt = $con->prepare($students_query);
    $students_stmt->bind_param("i", $school_index);
    $students_stmt->execute();
    $students_result = $students_stmt->get_result();
    // Store List of Students
    $students_list = array();
    while($row = $students_result->fetch_assoc()) {
        $students_list[] = $row;
    }
    // Close query
    $students_stmt->close();
    // Temp FIx: If no students were found in query, set null value for variable
    //           Do this so that the webpage will display an empty list instead of an error.
    if(empty($students_list)) {
        $students_list[] = array("studentID" => -1, "studentName" => "", "course" => "", "hoursRendered" => 0, "status" => "", "batchNo" => 0, "duration" => 0);
    }

    // Query for School Details
    $school_query = "SELECT schoolName, schoolLogo FROm school where schoolID = ?";
    $school_stmt = $con->prepare($school_query);
    $school_stmt->bind_param("i", $school_index);
    $school_stmt->execute();
    $school_result = $school_stmt->get_result();
    // Store School detail
    $school_detail = $school_result->fetch_assoc();
    // Close query 
    $school_stmt->close();

    // Varibales for table-page setup
    $total_items = count($students_list);
    $items_per_page = 10;
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Facilitator Student List</title>
    <link rel="stylesheet" href="facilitator-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="facilitator-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="facilitator-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="facilitator-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="facilitator-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="facilitator-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="facilitator-assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="facilitator-assets/css/Profile-Edit-Form.css">
</head>

<body style="color: rgb(0,0,0);"><nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
    <div class="container-fluid"><a href="FacilitatorSchoolDashboard.php"><img src="assets/img/logo_black.png" width="140" height="29" /></a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow mx-1"></li>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" /></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="FacilitatorSchoolDashboard.php"><i class="fas fa-school fa-sm fa-fw me-2 text-gray-400"></i> Schools</a><a class="dropdown-item" href="FacilitatorStudentList.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>Student List</a><a class="dropdown-item" href="FacilitatorStudentLogs.php"><i class="fas fa-file fa-sm fa-fw me-2 text-gray-400"></i>Student Logs</a><a class="dropdown-item" href="FacilitatorTasks.php"><i class="fas fa-folder-open fa-sm fa-fw me-2 text-gray-400"></i>Task Documentation</a>
                    <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <div id="banner" style="height: 250px;background: url(&quot;assets/img/banner-bg.png&quot;) center / cover no-repeat, #d3edff;">
    </div>
        <section id="table" style="font-family: Poppins, sans-serif;">
            <div class="container" style="width: 100%;padding: 0px 8px;">
                <h1 style="text-align: left;font-weight: bold;margin-bottom: 15px;margin-top: 30px;">Student List</h1>
                <h1 style="text-align: left;font-weight: bold;margin-bottom: 15px;font-size: 30px;"><span style="font-weight: normal !important;"><?php echo $school_detail['schoolName']; ?></span></h1>
                <p><?php echo $students_list[0]['course']; ?> |&nbsp;Batch <?php echo $students_list[0]['batchNo']; ?></p>
                <div class="table-responsive" style="border:none;width: 100%;">
                    <table class="table">
                        <thead style="--bs-body-bg: #55565a;">
                            <tr style="--bs-body-bg: #55565a;height: 56.5px; color:#121212;border-top: 1px solid #DEDEDE;">
                                <th style="padding-left: 30px;padding-right: 0px;padding-bottom: 15px;"><input type="checkbox" style="padding-bottom: 15px;"></th>
                                <th style="padding-bottom: 15px;">Student Name</th>
                                <th style="padding-bottom: 15px;">Batch</th>
                                <th style="padding-bottom: 15px;">Status</th>
                                <th style="padding-bottom: 15px;">Course/Strand</th>
                                <th style="padding-bottom: 15px;">Duration</th>
                                <th style="padding-bottom: 15px;">Hours</th>
                                <th style="padding-bottom: 15px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
                            $offset = ($page - 1) * $items_per_page;

                            // If students list is not empty...
                            if (!empty($students_list[0]['studentName']) && !empty($students_list[0]['course']) && !empty($students_list[0]['status'])) {
                                // Display all students
                                for ($i = $offset; ($i < $offset + $items_per_page) && ($i < count($students_list)); $i++) {
                                    $status = $students_list[$i]['status'];

                                    // Determine the appropriate styles based on status
                                    $buttonStyles = '';
                                    if ($status == 'accepted') {
                                        $buttonStyles = 'background-color: rgb(200, 235, 190); color: #009900;';  // Lighter green
                                    } elseif ($status == 'pending') {
                                        $buttonStyles = 'background-color: rgb(255, 255, 180); color: #CC9900;';  // Lighter yellow
                                    } elseif ($status == 'declined') {
                                        $buttonStyles = 'background-color: rgb(255, 200, 200); color: #CC0000;';  // Lighter red
                                    }

                                    echo "
                                        <tr>
                                            <td style=\"padding-left: 30px;padding-right: 0px;padding-top:17px;\"><input type=\"checkbox\"></td>
                                            <td>
                                                <h1 style=\"font-size: 16px;color:#121212;margin-top:10px;\"><strong>".$students_list[$i]['studentName']."</strong></h1>
                                                <p>studentemail@gmail.com</p>
                                            </td>
                                            <td><p style=\"margin-top: 20px;\">Batch ".$students_list[$i]['batchNo']."</p></td>
                                            <td><button class=\"btn btn-primary\" type=\"button\" style=\"".$buttonStyles."width: 90%;margin-top:15px;border-radius: 35px;border-style: none;font-size:14px;\">".$status."</button></td>
                                            <td><p style=\"margin-top: 20px;\">".$students_list[$i]['course']."</p></td>
                                            <td><p style=\"margin-top: 20px;\">".$students_list[$i]['duration']."</p></td>
                                            <td><p style=\"margin-top: 20px;\">".$students_list[$i]['hoursRendered']."</p></td>
                                            <td>
                                                <a style=\"text-decoration: none;margin-top:10px;\" href=\"FacilitatorTasks.php?stid=".$students_list[$i]['studentID']."\">
                                                    <button class=\"btn btn-primary\" type=\"button\" style=\"margin-top:15px;border-style: solid;border-radius: .75rem;width: 100px;padding: 10px;margin-right: 15px;font-size:14px;\"><i class=\"far fa-eye\" style=\"margin-right: 5px;\"></i>View</button>
                                                </a>
                                                <button class=\"btn btn-primary\" type=\"button\" style=\"margin-top:15px;background: rgb(22,163,74);border-color: rgb(22,163, 74);border-top-color: rgb(22,163,;border-right-color: 74);border-bottom-color: rgb(22,163,;border-left-color: 74);border-radius: .75rem;width: 100px;padding: 10px;font-size:14px;\"><i class=\"far fa-check-circle\" style=\"margin-right: 5px;\"></i>Done</button>
                                            </td>
                                        </tr>
                                    ";
                                }
                            } else {
                                // Display a message if no students are available
                                echo '<tr><td colspan="8">No students found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <nav class="text-center" style="margin-left: 40%;margin-top: 3%;margin-right: 40%;">
                    <ul class="pagination">

                        <?php
                            $nav = new PageNavigation();
                            $nav->setTotalItems($total_items);
                            $nav->setItemsPerPage($items_per_page);
                            $nav->getNavigation("FacilitatorStudentList.php?school_index=".$school_index, $page);
                        ?>

                    </ul>
                </nav>
            </div>
        </section>
    <script src="facilitator-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>
