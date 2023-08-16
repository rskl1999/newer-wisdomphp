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

    // Query for applicant details
    $applicant_query = $con->prepare("SELECT schoolName FROM school WHERE schoolID = ?");
    $applicant_query->bind_param("i", $schoolID);
    $applicant_query->execute();
    $applicant_query_res = $applicant_query->get_result();
    $school_details = $applicant_query_res->fetch_assoc();

    // Page Variables
    $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
    $items_per_page = 5;
    $offset = ($page - 1) * $items_per_page;


    // Query for students 
    $stud_batch_query = $con->prepare("SELECT st.studentName, ac.email, sts.status, st.submittedRequirements, ap.duration
                                        FROM student st
                                        JOIN account ac ON st.accountID = ac.accountID
                                        JOIN studentstatus sts ON sts.studentID = st.studentID
                                        JOIN internshipapplication ap ON ap.internshipapplicationID = st.applicationID
                                        WHERE st.schoolID = ?
                                        "); 
    $stud_batch_query->bind_param("i", $schoolID);
    $stud_batch_query->execute();
    $stud_batch_query_res = $stud_batch_query->get_result();
    $students_detail = array();
    while($row = $stud_batch_query_res->fetch_assoc()) {
        $row['submittedRequirements'] = empty($row['submittedRequirements']) ? '' : $row['submittedRequirements'];
        $students_detail[] = $row;
    }

    $school_name = $students_detail['schoolName'] ?? "School_Name";

    $total_items = count($students_detail);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>wisdom-1</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="hr-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
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
    <div id="banner" style="height: 250px;background: url(assets/img/banner.jpg) center / cover no-repeat, #d3edff;"></div>
            <div class="container" style="padding: 0px 8px;">
                <h1 style="text-align: left;font-weight: bold;margin-bottom: 15px;margin-top: 30px;">Student Applicants</h1>
                <div></div>
                <h1 style="font-size: 30px;"><?php echo $school_name; ?></h1>
                <p>BS Information Technology |&nbsp;Batch 1</p>
                <div class="table-responsive" style="border-radius: 1.5rem;padding-top: 5px;border: 2px solid rgb(227,230,240);">
                    <table class="table">
                        <thead style="--bs-body-bg: #55565a;">
                            <tr style="--bs-body-bg: #55565a;height: 56.5px;">
                                <th style="padding-left: 30px;padding-right: 0px;padding-bottom: 15px;"><input type="checkbox" style="padding-bottom: 15px;"></th>
                                <th style="padding-bottom: 15px;width: 320px;">Student Name</th>
                                <th style="width: 155px;padding-bottom: 15px;">Status</th>
                                <th style="padding-bottom: 15px;width: 248px;">Submitted</th>
                                <th style="padding-bottom: 15px;">Incomplete</th>
                                <th style="padding-bottom: 15px;">Duration</th>
                                <th style="padding-bottom: 15px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // TODO: Make webpage recognize student's submitted requirements

                                function checkListSubmitted($submitted_req) {
    
                                    $student_requirements = ['resume', 'recommendation letter', '30-to60-second video', 'personal information form', 'consent form', 'school registration form', 'vaccination certificate'];

                                    $output = "";
                                    foreach($submitted_req as $req) {
                                        if(in_array(strtolower($req), $student_requirements)) {
                                            $output .= "\n<p style=\"margin-bottom: 5px;\"><i class=\"far fa-check-square\" style=\"font-size: 16px;margin-right: 14px;\"></i>".$req."</p>";
                                        }
                                    }
                                    if(strlen($output) <=0 ) {
                                        $output = 'None';
                                    }
                                    return $output;
                                }

                                function checkListIncomplete($submitted_req) {

                                    $student_requirements = ['resume', 'recommendation letter', '30-to60-second video', 'personal information form', 'consent form', 'school registration form', 'vaccination certificate'];

                                    $output = "";
                                    $incomplete = array_diff($student_requirements, array_map('strtolower', $submitted_req));
                                    foreach($incomplete as $req) {
                                        $output .= "<p style=\"margin-bottom: 5px;\"><i class=\"far fa-file\" style=\"font-size: 17px;margin-right: 14px;\"></i>".$req."</p>";
                                    }
                                    if(strlen($output) <= 0) {
                                        $output = 'None';
                                    }
                                    return $output;
                                }

                                for($i = $offset; $i < $offset + $items_per_page && $i < $total_items; $i++) {
                                    $student = $students_detail[$i];
                                    $submitted_requirements = array();

                                    if(!empty($student['submittedRequirements'])) {
                                        $submitted_requirements = explode(',', $student['submittedRequirements']);
                                        foreach($submitted_requirements as $subreq) {
                                            if(str_contains($subreq, '.')) {
                                                print("<br/>");
                                                print('before:'.$subreq);
                                                $subreq = explode('.', $subreq)[0];
                                                print("<br/>");
                                                print('after:'.$subreq);
                                            }
                                        }
                                    }

                                    echo "
                                        <tr>
                                            <td style=\"padding-left: 30px;padding-right: 0px;\"><input type=\"checkbox\"></td>
                                            <td>
                                                <h1 style=\"font-size: 16px;\"><strong>".$student['studentName']."</strong></h1>
                                                <p>".$student['email']."</p>
                                            </td>
                                            <td><button class=\"btn btn-primary\" type=\"button\" style=\"color: #f0800c;background: #FFEDD5;width: 90%;border-radius: 35px;border-style: none;\">".$student['status']."</button></td>
                                            <td>
                                                ".checkListSubmitted($submitted_requirements)."
                                                <div></div>
                                            </td>
                                            <td>
                                                ".checkListIncomplete($submitted_requirements)."
                                            </td>
                                            <td>".$student['duration']."</td>
                                            <td style=\"width: 205.844px;\"><button class=\"btn btn-primary\" type=\"button\" style=\"border-style: solid;border-radius: .75rem;width: 120px;padding: 10px;margin-right: 15px;\"><i class=\"far fa-check-square\" style=\"margin-right: 5px;\"></i>Approve</button></td>
                                        </tr>
                                    ";
                                }

                            ?>
                            <!--
                            <tr>
                                <td style="padding-left: 30px;padding-right: 0px;"><input type="checkbox"></td>
                                <td>
                                    <h1 style="font-size: 16px;"><strong>Student Name</strong></h1>
                                    <p>studentemail@gmail.com</p>
                                </td>
                                <td><button class="btn btn-primary" type="button" style="color: #f0800c;background: #FFEDD5;width: 90%;border-radius: 35px;border-style: none;">Pending</button></td>
                                <td>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>Resume</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55, 65, 81);">Recommendation Letter</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55, 65, 81);">30- to 60-second video</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55 65 81 / var(--tw-text-opacity));">Personal Information Form</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>Consent Form</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>School Registration Form</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>Vaccination Certificate</p>
                                    <div></div>
                                </td>
                                <td>None</td>
                                <td>200</td>
                                <td style="width: 205.844px;"><button class="btn btn-primary" type="button" style="border-style: solid;border-radius: .75rem;width: 120px;padding: 10px;margin-right: 15px;"><i class="far fa-check-square" style="margin-right: 5px;"></i>Approve</button></td>
                            </tr>

                            <tr>
                                <td style="padding-left: 30px;padding-right: 0px;"><input type="checkbox"></td>
                                <td>
                                    <h1 style="font-size: 16px;"><strong>Student Name</strong></h1>
                                    <p>studentemail@gmail.com</p>
                                </td>
                                <td><button class="btn btn-primary" type="button" style="color: var(--bs-table-color);background: rgb(229,231,235);width: 90%;border-radius: 35px;border-style: none;">Incomplete</button></td>
                                <td>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>Resume</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55, 65, 81);">Recommendation Letter</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55, 65, 81);">30- to 60-second video</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55 65 81 / var(--tw-text-opacity));">Personal Information Form</span></p>
                                </td>
                                <td>
                                    <p style="margin-bottom: 5px;"><i class="far fa-file" style="font-size: 17px;margin-right: 14px;"></i>Resume</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-file" style="font-size: 17px;margin-right: 14px;"></i><span style="color: rgb(55, 65, 81);">Recommendation Letter</span></p>
                                </td>
                                <td>200</td>
                                <td><button class="btn btn-primary" type="button" style="border-radius: .75rem;width: 120px;padding: 10px;margin-right: 15px;background: var(--bs-table-border-color);color: var(--bs-table-striped-color);border-style: solid;border-color: var(--bs-btn-color);"><i class="far fa-check-square" style="margin-right: 5px;"></i>Approve</button></td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px;padding-right: 0px;"><input type="checkbox"></td>
                                <td>
                                    <h1 style="font-size: 16px;"><strong>Student Name</strong></h1>
                                    <p>studentemail@gmail.com</p>
                                </td>
                                <td><button class="btn btn-primary" type="button" style="color: #CA8A04;background: rgb(254,249,195);width: 90%;border-radius: 35px;border-style: none;">Approved</button></td>
                                <td>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>Resume</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55, 65, 81);">Recommendation Letter</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55, 65, 81);">30- to 60-second video</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i><span style="color: rgb(55 65 81 / var(--tw-text-opacity));">Personal Information Form</span></p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>Consent Form</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>School Registration Form</p>
                                    <p style="margin-bottom: 5px;"><i class="far fa-check-square" style="font-size: 16px;margin-right: 14px;"></i>Vaccination Certificate</p>
                                </td>
                                <td>None</td>
                                <td>200</td>
                                <td><button class="btn btn-primary" type="button" style="border-radius: .75rem;width: 120px;padding: 10px;margin-right: 15px;background: var(--bs-table-border-color);border-style: solid;border-color: var(--bs-table-border-color);color: rgb(0,0,0);"><i class="far fa-check-square" style="margin-right: 5px;"></i>Approved</button></td>
                            </tr>
-->
                        </tbody>
                    </table>
                </div>
                <nav class="text-center" style="margin-left: 40%;margin-top: 3%;margin-right: 40%;">
                    <ul class="pagination">
                        <?php
                            $nav = new PageNavigation();
                            $nav->setTotalItems($total_items);
                            $nav->setItemsPerPage($items_per_page);
                            $nav->getNavigation("HRStudentApplicantsv2.php?sch=".$schoolID, $page);
                        ?>
                    </ul>
                </nav>
            </div>
        </section>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="assets/js/Profile-Edit-Form-profile.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/untitled.js"></script>
    <script src="../logout.js"></script>
</body>

</html>
