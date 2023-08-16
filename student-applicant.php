<?php
    require_once('connection.php');
    session_start();
        if(isset($_SESSION['accountID'])){
            $accID = $_SESSION['accountID'];

            $sql ="SELECT accountID FROM accounttbl WHERE accountID = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $accID);
                $stmt->execute();
                $stmt->bind_result($accountID);
                $stmt->fetch();
                $stmt->close();
                
            if(!$accountID){
                header("Location:index.php");
            }
        }
        else{
            header("Location:index.php");
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Student</title>
    <link rel="stylesheet" href="Hr-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="Hr-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="Hr-assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="Hr-assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="Hr-assets/css/animate.min.css">
    <link rel="stylesheet" href="Hr-assets/css/2-columns-media-image-video-carousel-map-2-columns-media1.css">
    <link rel="stylesheet" href="Hr-assets/css/Bold-BS4-Animated-Back-To-Top.css">
    <link rel="stylesheet" href="Hr-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="Hr-assets/css/Documents-App-Browser.css">
    <link rel="stylesheet" href="Hr-assets/css/iframe.css">
    <link rel="stylesheet" href="Hr-assets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="Hr-assets/css/untitled.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
        <div class="container-fluid"><img src="Hr-assets/img/logo.png" width="150" height="31" style="width: 129px;height: 27px;">
            <ul class="navbar-nav flex-nowrap ms-auto">
                <div class="d-none d-sm-block topbar-divider"></div>
                <li class="nav-item dropdown no-arrow">
                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small" style="font-family: Poppins, sans-serif;font-size: 12px;">Employer Admin</span><img class="border rounded-circle img-profile" src="Hr-assets/img/avatars/side%20logo.png"></a>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="banner" style="height: 250px; background: url('Hr-assets/img/New Project (2).jpg'), #d3edff;">
        <div class="container d-flex align-items-center" style="height: 250px;">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-family: Poppins, sans-serif;font-size: 39px;color: rgb(0,0,0);font-weight: bold;">Find the internship<br>of your&nbsp;<span style="color: #041aeb;font-weight: bold;">Dreams</span></p>
                </div>
            </div>
        </div>
    </div>
    <div id="nav2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-light navbar-expand-md py-3">
                        <div class="container">
                            <div class="collapse navbar-collapse" id="navcol-1">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item"><a class="nav-link active" data-bss-hover-animate="pulse" href="school-applicant.php" style="font-family: Poppins, sans-serif;color: #0017eb;"><i class="fa fa-user" style="padding-right: 5px;"></i>Applicant</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bss-disabled-mobile="true" data-bss-hover-animate="pulse" href="school-transaction.php" style="font-family: Poppins, sans-serif;color: rgb(197,197,197);"><i class="fa fa-folder-open" style="padding-right: 5px;"></i>Transaction</a></li>
                                    <li class="nav-item"></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <hr style="margin: 0px;">
                </div>
            </div>
        </div>
    </div>
    <div id="content" style="padding-top: 25px;height: 600px;">
    <?php

        function sanitize($input) {
            $output = trim($input); 
            $output = stripslashes($output); 
            $output = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
            return $output;
        }

        $schoolid = isset($_GET['id']) ? sanitize($_GET['id']) : null;

        $sql = "SELECT schoolID FROM schooltbl WHERE schoolID = ?";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $schoolid);
            $stmt->execute();
            $stmt->bind_result($schoolID);
            $stmt->fetch();
            $stmt->close();
        
        if (!$schoolid){
            $schoolid = 1;
        }
        elseif($schoolid!=$schoolID){
            $schoolid = 1;
        }  
        $sql_school = "SELECT sc.schoolID, sc.schoolName, sc.schoolLogo, sc.address, a.email
        FROM schooltbl sc
        JOIN accounttbl a ON sc.accountID = a.accountID
        WHERE sc.schoolID = ?";

            $stmt = $con->prepare($sql_school);
            $stmt->bind_param("i", $schoolid);
            $stmt->execute();
            $stmt->bind_result($schoolID, $schoolName, $schoolLogo, $address, $email);
            $stmt->fetch();
            $stmt->close();
            
        
        ?>

     <!-- school Logo -->
     <div class="text-center" id="school-info" style="padding-right: 24px;padding-left: 24px;"><img style="width: 100px;" src="School-Logo/<?php echo $schoolLogo ?>">
            <h5 id="school-name" style="color: rgb(0,0,0);font-weight: bold;padding-top: 5px;margin-bottom: 0px;"><?php echo $schoolName ?> </h5>
            <p id="school-location-1" style="margin-bottom: 0px;"><?php echo $address ?></p>
            <p id="school-email"><?php echo $email ?></p>
        </div>
    <div id="body">
        <div class="container">

        <?php
            function updateStatus($rowId, $status) {
                require_once('connection.php');
                    $sql = "UPDATE studenttbl SET status='$status' WHERE studentID='$rowId'";
                    
                    if (mysqli_query($con, $sql)) {
                    echo "Status updated successfully";
                    } else {
                    echo "Error updating status: " . mysqli_error($con);
                    }
                    // close the database connection
                    mysqli_close($con);
                    // redirect to the student-applicant.php page
                    header("Location: student-applicant.php");
                    exit();
                }
            $students = "SELECT * FROM studenttbl WHERE schoolID = $schoolid AND status='pending'";
            $result = mysqli_query($con, $students);
            
            if (!$result) {
                die('Error executing query: ' . mysqli_error($con));
            }
            $row_count = mysqli_num_rows($result); // get the number of rows
            $i = 1; // initialize a counter variable
            while ($row = mysqli_fetch_array($result)) {
        ?>
        <div id="main-content">
            <div class="container" style="padding-bottom: 10px;">
                <div class="row" id="internship-body" style="background: #f2f2f2;color: rgb(0,0,0);">
                    <div class="col-md-6">
                    
                        <div id="school-name-1" style="margin-top: 7px;"><a id="program-name" href="view-file.php?id=<?php echo $row['studentID']?>" style="font-size: 18px;color: rgb(0,0,0);"><?php echo $row['studentName']?> </a></div>
                        <p style="font-size: 13px;color: rgb(85,85,85);margin-bottom: 7px;">Strand/Course: <?php echo $row['course'] ?></p>
                    </div>
                    <div class="col" id="colb">
                    <div id="divb">
                        <button class="btn btn-primary" id="accept" onclick="updateStatus(<?php echo $row['studentID']?>, 'Accepted')">
                        <i class="fa fa-check-circle" style="padding-right: 5px;"></i>Accept</button>

                    <div id="divider"></div>

                    <button class="btn btn-primary" id="reject" onclick="updateStatus(<?php echo $row['studentID']?>, 'Declined')">
                        <i class="fa fa-times-circle" style="padding-right: 5px;"></i>Decline</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        $i++;
    }
    mysqli_close($con);
    ?>

    <script src="Hr-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="Hr-assets/js/bs-init.js"></script>
    <script src="Hr-assets/js/2-columns-media-image-video-carousel-map-2-columns-media.js"></script>
    <script src="Hr-assets/js/Bold-BS4-Animated-Back-To-Top-backtotop.js"></script>
    <script src="Hr-assets/js/theme.js"></script>
</body>

</html>