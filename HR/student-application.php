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
    <title>student-application</title>
    <link rel="stylesheet" href="hr-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600&amp;display=swap">
    <link rel="stylesheet" href="hr-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="hr-assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="hr-assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="hr-assets/css/animate.min.css">
    <link rel="stylesheet" href="hr-assets/css/2-columns-media-image-video-carousel-map-2-columns-media1.css">
    <link rel="stylesheet" href="hr-assets/css/Bold-BS4-Animated-Back-To-Top.css">
    <link rel="stylesheet" href="hr-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="hr-assets/css/Documents-App-Browser.css">
    <link rel="stylesheet" href="hr-assets/css/iframe.css">
    <link rel="stylesheet" href="hr-assets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="hr-assets/css/untitled.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand bg-white topbar static-top">
        <div class="container-fluid"><img src="hr-assets/img/logo.png" width="150" height="31" style="width: 129px;height: 27px;">
            <ul class="navbar-nav flex-nowrap ms-auto">
                <li class="nav-item dropdown no-arrow">
                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile" src="hr-assets/img/avatars/side%20logo.png"></a>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="banner" style="height: 250px;background: url(assets/img/banner.jpg) center / cover no-repeat, #d3edff;">
        <div class="container d-flex align-items-center" style="height: 250px;">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-family: Poppins, sans-serif;font-size: 39px;color: rgb(0,0,0);font-weight: bold;">Find the internship<br>of your&nbsp;<span style="color: #041aeb;font-weight: bold;">Dreams</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="nav2">
        <div class="row d-flex d-xl-flex align-items-center align-items-xl-center" style="height: 73px;">
            <div class="col" style="margin: 0px 20px;"><a data-bss-hover-animate="pulse" href="applicant.php" style="padding: 0px 10px;color: rgb(0,23,235);font-family: Poppins, sans-serif;"><i class="fa fa-user" style="color: rgb(0,23,235);"></i>&nbsp;Applicant</a><a href="school-transaction.php" style="padding: 0px 10px;color: rgb(197,197,197);font-family: Poppins, sans-serif;"><i class="fa fa-folder-open" style="color: rgb(197,197,197);"></i><strong>&nbsp;</strong>Transaction</a></div>
        </div>
        <hr style="margin: 0px;color: rgb(197,197,197);">
    </div>
    <div id="content" style="padding-top: 25px;height: 600px;">
        <div class="text-center" id="school-info" style="padding-right: 24px;padding-left: 24px;"><img style="width: 100px;" src="../School-Logo/<?php echo $school_details['schoolLogo']; ?>">
            <h5 id="school-name" style="color: rgb(0,0,0);font-weight: bold;padding-top: 5px;margin-bottom: 0px;"><?php echo $school_details['schoolName']; ?></h5>
            <p id="school-location-1" style="margin-bottom: 0px;"><?php echo $school_details['address']; ?></p>
            <p id="school-email"><?php echo $school_details['email']; ?></p>
        </div>
        <div id="body">
            <div class="container">
                <div id="main-content">
                    <?php
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

                        $_SESSION['prevLocation'] = 'Admin/student-application.php?sch='.$schoolID.'&page='.$page;

                        foreach($students_list as $student) {
                            echo "
                            <div class=\"container\" style=\"padding-bottom: 10px;\">
                                <div class=\"row\" id=\"internship-body\" style=\"background: #f2f2f2;color: rgb(0,0,0);\">
                                    <div class=\"col-md-6\">
                                        <div id=\"school-name-1\" style=\"margin-top: 7px;\"><a id=\"program-name\" href=\"#\" style=\"font-size: 18px;color: rgb(0,0,0);\">".$student['studentName']."</a></div>
                                        <p style=\"font-size: 13px;color: rgb(85,85,85);margin-bottom: 7px;\">".$student['course']."</p>
                                    </div>
                                    <div class=\"col d-flex justify-content-center align-items-center justify-content-xxl-end\" id=\"colb-2\"><a href=\"student-requirements.php?std=".$student['studentID']."\"><button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(13,110,253);border-width: 0px;height: 44px;border-radius: 10px;\"><i class=\"fa fa-file-text\"></i>&nbsp; View File</button></a></div>
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
                        $nav->getNavigation("student-application.php?sch=".$schoolID, $page);
                    ?>

                </ul>
            </nav>

        </div>
    </div>
    <script src="hr-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="hr-assets/js/bs-init.js"></script>
    <script src="hr-assets/js/2-columns-media-image-video-carousel-map-2-columns-media.js"></script>
    <script src="hr-assets/js/Bold-BS4-Animated-Back-To-Top-backtotop.js"></script>
    <script src="hr-assets/js/theme.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>
