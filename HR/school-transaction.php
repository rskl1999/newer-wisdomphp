<?php

    require_once('../connection.php');
    session_start();

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
            header("Location: ../login.php");
            exit(); // Added exit() to stop further execution
        }
    }
    // Else return to index.php
    else{
        header("Location: ../login.php");
        exit(); // Added exit() to stop further execution
    }

    $accountid = $_SESSION['accountID'];


    // Query For Schools and the no. of student applicants
    $school_query = $con->prepare("SELECT DISTINCT sc.schoolID, sc.schoolName, sc.address, sc.schoolLogo, ap.noStudents
                                FROM school sc
                                JOIN internshipapplication ap ON ap.schoolID = sc.schoolID
                                WHERE sc.schoolID > 0
                                ");
    $school_query->execute();
    $school_query_res = $school_query->get_result();
    // Store list of schools and their details
    $school_list = array();
    while($row = $school_query_res->fetch_assoc()) {
        // Clean
        if(empty($row['noStudents'])) {
            $row['noStudents'] = 0;
        }
        $school_list[] = $row;
    }
    // Trim duplicate schools and their total no of students together
    for($i = 0; $i < count($school_list); $i++) {
        for($j = $i+1; $j < count($school_list)-1; $j++) {
            if($school_list[$i]['schoolName'] == $school_list[$j]['schoolName']) {
                $school_list[$i]['noStudents'] += $school_list[$j]['noStudents'];
                array_splice($school_list, $j, 1);
                $j -= 1;
            }
        }
    }

    $school_query->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>school-transaction</title>
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
            <div class="col" style="margin: 0px 20px;"><a data-bss-hover-animate="pulse" href="applicant.php" style="padding: 0px 10px;color: rgb(197,197,197);font-family: Poppins, sans-serif;"><i class="fa fa-user" style="color: rgb(197,197,197);"></i>&nbsp;Applicant</a><a href="school-transaction.php" style="padding: 0px 10px;color: rgb(0,23,235);font-family: Poppins, sans-serif;"><i class="fa fa-folder-open" style="color: rgb(0,23,235);"></i><strong>&nbsp;</strong>Transaction</a></div>
        </div>
        <hr style="margin: 0px;color: rgb(197,197,197);">
    </div>
    <div id="main-content"><div class="bootstrap_cards2">
<div class="container py-5">
            <?php
                // TODO: redo this in javascript
                $col_per_row = 3;
                $row_count = count($school_list) / $col_per_row;

                for($i = 0; $i < $row_count; $i++) {
                    echo " <div class=\"row pb-5 mb-4\"> ";
                    for($j = 0; $j < $col_per_row; $j++){
                        $index = ($i * $col_per_row) + $j;
                        if($index >= count($school_list)) break;
                        echo "
                            <div class=\"col-lg-3 col-md-6 mb-4 mb-lg-0\">
                                <div class=\"card shadow-sm border-0 rounded\">
                                    <div class=\"card-body p-0\">
                                        <a href=\"transaction-history.php?sch=".$school_list[$index]['schoolID']."\">
                                            <img src=\"../School-Logo/".$school_list[$index]['schoolLogo']."\" alt=\"".$school_list[$index]['schoolLogo']."\" class=\"w-100 card-img-top\">
                                        </a>
                                        <div class=\"p-4\">
                                            <a href=\"transaction-history.php?sch=".$school_list[$index]['schoolID']."\"><h5 class=\"mb-0\">".$school_list[$index]['schoolName']."</h5> </a>
                                            <p class=\"small text-muted\">".$school_list[$index]['address']."</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                    echo "</div>";
                }
            ?>

            </div>
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
