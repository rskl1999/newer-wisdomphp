<?php
    require_once('../connection.php');
    session_start();

    require_once('../pageNavigation.php');
    
    // Check if a registered account is logged in ...    
    if(isset($_SESSION['accountID'])){
        $accID = $_SESSION['accountID'];

        $sql = "SELECT accountID FROM account WHERE accountID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $accID);
        $stmt->execute();
        $stmt->bind_result($accountID);
        $stmt->fetch();
        $stmt->close();

        // If account ID is not located in database ... return to index.php
        if(!$accountID){
            header("Location: ../index.php");
            exit(); // Added exit() to stop further execution
        }
    }
    // Else return to index.php
    else{
        header("Location: ../index.php");
        exit(); // Added exit() to stop further execution
    }

    $accountid = $_SESSION['accountID'];

    if(isset($_GET['sch'])) {
        $schoolID = $_GET['sch'];
    }

    // Query For School Details
    $school_query = $con->prepare("SELECT DISTINCT sc.schoolID, sc.schoolName, sc.address, sc.schoolLogo, a.email
                                FROM school sc
                                JOIN account a ON a.accountID = sc.accountID
                                WHERE sc.schoolID =?;
                                ");
    $school_query->bind_param("s", $schoolID);
    $school_query->execute();
    $school_query_res = $school_query->get_result();
    // Store list of schools and their details
    $school_details = $school_query_res->fetch_assoc();
    $school_query->close();

    // Query for total number of students
    $total_students = $con->prepare("SELECT COUNT(st.studentID) AS totalStudents 
                                    FROM student st
                                        JOIN studentstatus sts ON st.studentID = sts.studentID
                                    WHERE st.schoolID = ? 
                                        AND sts.status = 'pending' 
                                    ");
    $total_students->bind_param("i", $schoolID);
    $total_students->execute();
    $total_students_res = $total_students->get_result();
    $total_items = $total_students_res->fetch_assoc()['totalStudents'];
    $total_students->close();

    $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
    $items_per_page = 10;
    $offset = ($page - 1) * $items_per_page;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Page Not Found - Brand</title>
    <link rel="stylesheet" href="admin-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="admin-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="admin-assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="admin-assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="admin-assets/css/2-columns-media-image-video-carousel-map-2-columns-media1.css">
    <link rel="stylesheet" href="admin-assets/css/Bold-BS4-Animated-Back-To-Top.css">
    <link rel="stylesheet" href="admin-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="admin-assets/css/Documents-App-Browser.css">
    <link rel="stylesheet" href="admin-assets/css/iframe.css">
    <link rel="stylesheet" href="admin-assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: #69c9ff;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="school-applicant.php">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span><img src="admin-assets/img/New%20Project%20(1).png" width="106" height="27"></span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="school-applicant.php"><i class="fa fa-briefcase"></i><span>School Applicant</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="daily-log.php"><i class="fa fa-pencil-square-o"></i><span>Intern Daily Log</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="calendar.php"><i class="fa fa-calendar-plus-o"></i><span>Intern Calendar</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="documentation.php"><i class="fa fa-folder-open"></i><span>Intern Documentation</span></a></li>
                </ul>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Company Name</span><img class="border rounded-circle img-profile" src="admin-assets/img/avatars/side%20logo.png" width="32" height="32"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="text-center" id="school-info" style="padding-right: 24px;padding-left: 24px;"><img style="width: 100px;" src="../School-Logo/<?php echo $school_details['schoolLogo']; ?>">
                    <h5 id="school-name" style="color: rgb(0,0,0);font-weight: bold;padding-top: 5px;margin-bottom: 0px;"><?php echo $school_details['schoolName']; ?></h5>
                    <p id="school-location-1" style="margin-bottom: 0px;"><?php echo $school_details['address']; ?></p>
                    <p id="school-email"><?php echo $school_details['email']; ?></p>
                    <div>
                        <div class="container text-center" style="width: 814px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <p id="school-location" style="margin-bottom: 0px;"><?php echo $school_details['address']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p id="school-email-1"><?php echo $school_details['email']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="body">
                    <div class="container">
                        <div id="main-content">
                            <?php

                                // Required:
                                // student name -- OK
                                // year/course -- OK
                                // address -- TODO: address column in student table DOES NOT EXIST
                                // Query for students of current school
                                $student_query = $con->prepare("SELECT st.studentID, st.studentName, st.course, sts.status, st.applicationID
                                                                FROM student st 
                                                                    JOIN studentstatus sts ON st.studentID = sts.studentID
                                                                WHERE st.schoolID = ? 
                                                                    AND sts.status = 'pending' 
                                                                LIMIT ?, ?");
                                $student_query->bind_param("iii", $schoolID, $offset, $items_per_page);
                                $student_query->execute();
                                $student_query_res = $student_query->get_result();
                                $students_list = array();
                                while($row = $student_query_res->fetch_assoc()) {
                                    $students_list[] = $row;
                                }
                                $student_query->close();

                                $action_base_url = '../studentChangeStatus.php';

                                $_SESSION['prevLocation'] = 'Admin/student-application.php?sch='.$schoolID.'&page='.$page;

                                foreach($students_list as $student) {
                                    echo "
                                    <div class=\"container\" style=\"padding-bottom: 10px;\">
                                        <div class=\"row\" id=\"internship-body\" style=\"background: #f2f2f2;color: rgb(0,0,0);\">
                                            <div class=\"col-md-6\">
                                                <div id=\"school-name-1\" style=\"margin-top: 7px;\"><a id=\"program-name\" href=\"#\" style=\"font-size: 18px;color: rgb(0,0,0);\">".$student['studentName']."</a></div>
                                                <p style=\"font-size: 13px;color: rgb(85,85,85);margin-bottom: 7px;\">".$student['course']."</p>
                                            </div>
                                            <div class=\"col\" id=\"colb\">
                                                <div id=\"divb\"><a href=\"".$action_base_url."?stid=".$student['studentID']."&status=accepted&appli=".$student['applicationID']."\"><button class=\"btn btn-primary\" id=\"accept\" type=\"button\"><i class=\"fa fa-check-circle\" style=\"padding-right: 5px;\"></i>Proceed</button></a>
                                                    <div id=\"divider\"></div><a href=\"".$action_base_url."?stid=".$student['studentID']."&status=declined&appli=".$student['applicationID']."\"><button class=\"btn btn-primary\" id=\"reject\" type=\"button\"><i class=\"fa fa-times-circle\" style=\"padding-right: 5px;\"></i>Decline</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                }
                            ?>
                        </div>
                    </div>

                    <nav class="d-flex d-lg-flex justify-content-center justify-content-lg-center" style="padding: 20px 0px;">
                        <ul class="pagination">

                            <?php 
                                $nav = new PageNavigation();
                                $nav->setTotalItems($total_items);
                                $nav->setItemsPerPage($items_per_page);
                                $nav->getNavigation("student-application.php?sch=1", $page);
                            ?>

                        </ul>
                    </nav>

                </div>
            </div>
            <div id="back-to-top"><a class="cd-top js-cd-top cd-top--fade-out cd-top--show" style="background-image: url(&quot;admin-assets/img/cd-top-arrow.svg&quot;);border-radius: 50px;" href="#0">Top</a></div>
        </div>
    </div>
    <script src="admin-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin-assets/js/2-columns-media-image-video-carousel-map-2-columns-media.js"></script>
    <script src="admin-assets/js/Bold-BS4-Animated-Back-To-Top-backtotop.js"></script>
    <script src="admin-assets/js/theme.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>