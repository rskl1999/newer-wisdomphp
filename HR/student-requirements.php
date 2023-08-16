<?php
    require_once('../connection.php');
    session_start();

    include('../pageNavigation.php');
    include('../checkLogin.php');

    $accountid = $_SESSION['accountID'];

    if(isset($_GET['std'])) {
        $studentID = $_GET['std'];
    }
    else {

    }

    /// LOAD STUDENT DETAILS

    $student_query = $con->prepare("SELECT st.studentID, st.schoolID, st.profileImage, st.studentName, ac.email, st.submittedRequirements, st.applicationID
                                    FROM student st 
                                    JOIN account ac ON st.accountID = ac.accountID 
                                    WHERE st.studentID = ?");
    $student_query->bind_param("i", $studentID);
    $student_query->execute();
    $student_query_res = $student_query->get_result();
    $student_details = $student_query_res->fetch_assoc();

    $student_requirements = explode(",",$student_details['submittedRequirements']); // WARNING: Diplaying of files assumes files are uploaded properly

    /// RECEIVE SUBMITION
    unset($_SESSION['prevLocation']);

    if(isset($_POST['accept'])) {
        $_SESSION['prevLocation'] = 'HR/student-application.php?sch='.$student_details['schoolID'];
        header("Location: ../studentChangeStatus.php?stid=".$student_details['studentID']."&status=accepted&appli=".$student_details['applicationID']);
    }
    else if(isset($_POST['decline'])) {
        $_SESSION['prevLocation'] = 'HR/student-application.php?sch='.$student_details['schoolID'];
        header("Location: ../studentChangeStatus.php?stid=".$student_details['studentID']."&status=declined&appli=".$student_details['applicationID']);
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>student-requirements</title>
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

<body style="color: rgb(0,0,0);">
    <nav class="navbar navbar-light navbar-expand bg-white topbar static-top">
        <div class="container-fluid"><img src="hr-assets/img/logo.png" width="150" height="31" style="width: 129px;height: 27px;">
            <ul class="navbar-nav flex-nowrap ms-auto">
                <li class="nav-item dropdown no-arrow">
                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile"></a>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="banner" style="height: 250px;background: url(assets/img/banner.jpg) center / cover no-repeat, #d3edff;"></div>
    <div class="container" id="nav2">
        <div class="row d-flex d-xl-flex align-items-center align-items-xl-center" style="height: 73px;">
            <div class="col" style="margin: 0px 20px;"><a data-bss-hover-animate="pulse" href="applicant.php" style="padding: 0px 10px;color: rgb(0,23,235);font-family: Poppins, sans-serif;"><i class="fa fa-user" style="color: rgb(0,23,235);"></i>&nbsp;Applicant</a><a href="school-transaction.php" style="padding: 0px 10px;color: rgb(197,197,197);font-family: Poppins, sans-serif;"><i class="fa fa-folder-open" style="color: rgb(197,197,197);"></i><strong>&nbsp;</strong>Transaction</a></div>
        </div>
        <hr style="margin: 0px;color: rgb(197,197,197);">
    </div>
    <div class="container">
        <form method="POST">
            <div class="row">
                <div class="col-md-4 text-center" style="margin: 20px 0px;"><img id="student-profile" style="width: 200px;height: 200px;border-radius: 50%;margin: 10px 0px;">
                    <h4 id="student-name" style="margin: 0px;"><strong></strong></h4>
                    <small id="student-email"><span style="color: rgb(147, 147, 147);"></span></small>
                </div>
                <div class="col-md-8" style="margin: 20px 0px;">
                    <h4><strong>Requirements:</strong></h4>
                    <div class="row">
                        <div class="col"><link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

                <div id="main-content" class="file_manager">
                        <div class="container">            
                            <div class="row clearfix">

                                <?php 

                                    for($i = 0; $i < count($student_requirements); $i++) {
                                        echo "
                                            <div class=\"col-lg-3 col-md-4 col-sm-12\">
                                                <div class=\"card\">
                                                    <div class=\"file\">
                                                        <a href=\"javascript:void(0);\">

                                                            <div class=\"icon\">
                                                                <i class=\"fa fa-file text-info\"></i>
                                                            </div>
                                                            <div class=\"file-name\">
                                                                <p class=\"m-b-5 text-muted\">".$student_requirements[$i]."</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>                
                                        ";
                                    }

                                ?>
                            </div>
                        </div>
                    </div></div>
                    </div>
                    
                    <div class="row">
                        <div class="col d-flex d-xxl-flex justify-content-end justify-content-xxl-end" style="margin: 50px 0px;">
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary" name="accept" id="accept" type="submit" style="margin: 0px 10px;background: rgba(78,115,223,0);border-radius: 0px;border-width: 0px;border-color: rgba(255,255,255,0);color: rgb(0,160,45);">
                                    <i class="fas fa-check-circle" style="margin: 0px 6px;"></i> Accept
                                </button>
                                <button class="btn btn-primary" name="decline" id="decline" type="submit" style="margin: 0px 10px;background: rgba(78,115,223,0);border-radius: 0px;border-width: 0px;border-color: rgba(255,255,255,0);color: red;">
                                    <i class="fas fa-times-circle" style="margin: 0px 6px;"></i> Decline
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="hr-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="hr-assets/js/bs-init.js"></script>
    <script src="hr-assets/js/2-columns-media-image-video-carousel-map-2-columns-media.js"></script>
    <script src="hr-assets/js/Bold-BS4-Animated-Back-To-Top-backtotop.js"></script>
    <script src="hr-assets/js/theme.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
    <script src="scripts/studentRequirement.js"></script>
</body>

</html>
