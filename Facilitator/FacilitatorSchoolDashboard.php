<?php
    require_once('../connection.php');
    session_start();

    include('../checkLogin.php');

    include('../pageNavigation.php');

    $accountid = $_SESSION['accountID'];
    $schools_list = array();

    // Initializing variables
    $card_count_per_page = 8;
    $card_count_per_row = 4;

    include('scripts/schoolCount.php');

    // // Count Total Number of Schools Registered in the Database
    // $SchoolNum = $con->prepare("SELECT COUNT(schoolID) AS schoolCount FROM school");
    // $SchoolNum->execute();
    // $SchoolNum_result = $SchoolNum->get_result();
    // $SchoolNum_row = $SchoolNum_result->fetch_assoc();
    // $SchoolNum->close();
    // $schoolCount = $SchoolNum_row['schoolCount'];

    // $card_details = array();
    // // Get School Names with their IDs and Addresses
    // $SchoolQuery = $con->prepare("SELECT schoolName, schoolID, address, schoolLogo FROM school");
    // $SchoolQuery->execute();
    // $SchoolQuery_result = $SchoolQuery->get_result();

    // while($SchoolQuery_row = $SchoolQuery_result->fetch_assoc()) {
    //     $card_details[] = $SchoolQuery_row;
    // }

    // $SchoolQuery->close();


    $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
    // Page offset for displaying card in specific pages
    $page_offset = ($page - 1) * $card_count_per_page;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Facilitator Dashboard</title>
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
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img id="user-logo" class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg" /></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="FacilitatorSchoolDashboard.php"><i class="fas fa-school fa-sm fa-fw me-2 text-gray-400"></i> Schools</a><a class="dropdown-item" href="FacilitatorStudentList.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>Student List</a><a class="dropdown-item" href="FacilitatorStudentLogs.php"><i class="fas fa-file fa-sm fa-fw me-2 text-gray-400"></i>Student Logs</a><a class="dropdown-item" href="FacilitatorTasks.php"><i class="fas fa-folder-open fa-sm fa-fw me-2 text-gray-400"></i>Task Documentation</a>
                        <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <div id="banner" style="height: 250px;background: url(&quot;assets/img/banner-bg.png&quot;) center / cover no-repeat, #d3edff;"></div>
    <div style="margin-top: 80px;">
        <section id="acc-form">
            <div class="container">
    <h1 style="text-align: center;font-weight: bold;margin-bottom: 39px;">School Partners</h1>
    <div id="schoolCards" class="row">
        <?php
            // Loop through the card details and create the cards in a grid layout
            for ($i = $page_offset; $i < min($page_offset + $card_count_per_page, count($card_details)); $i++) {
                $card = $card_details[$i];
                if(empty($card['schoolLogo'])) {
                    $card['schoolLogo'] = 'default.png';
                }
                echo "
                    <div class=\"col-md-3 mb-4\">
                        <a href=\"FacilitatorStudentList.php?school_index=".$card['schoolID']."\" style=\"text-decoration: none; color:black;\">
                            <div class=\"card\" style=\"border-radius: 25px;border-style: none;\">
                                <div class=\"card-body\" style=\"border-radius: 25px;box-shadow: 0px 4px 20px rgba(0,0,0,0.15);border-style: none;\">
                                    <img src=\"../School-Logo/".$card['schoolLogo']."\" width=\"100\" height=\"80\" style=\"height: 20%;width: 100%;\">
                                    <h4 class=\"card-title\" style=\"margin-top: 5%;text-align: center;font-weight: bold;margin-bottom: 25px;\">".$card['schoolName']."</h4>
                                    <h6 class=\"text-muted card-subtitle mb-2\" style=\"text-align: center;font-size: 14px;margin-top: 25px;margin-bottom: 30px;\">".$card['address']."</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                ";
            }
        ?>
    </div>

    <div class="col" style="padding:50px 30px;">
        <nav class="d-flex d-lg-flex justify-content-center justify-content-lg-center" style="text-align: center;">
            <ul class="pagination">

                <?php
                    $nav = new PageNavigation();
                    $nav->setTotalItems($schoolCount);
                    $nav->setItemsPerPage($card_count_per_page);
                    $nav->getNavigation("SchoolDashboard.php", $page);
                ?>

            </ul>
        </nav>
    </div>
</div>


            </div>
        </section>
    </div>
    <script src="facilitator-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>
