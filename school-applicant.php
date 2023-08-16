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
    <title>School Applicant</title>
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
    <div id="main-content">
    <div class="bootstrap_cards2">
        <div class="container py-5">
            <!-- Second Row [Team]-->

            <?php
                $sql = "SELECT s.schoolID, st.*, COUNT(*) as pending_count
                FROM studenttbl s
                JOIN schooltbl st ON s.schoolID = st.schoolID
                WHERE s.status = 'pending'
                GROUP BY s.schoolID, st.schoolID;";

                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_execute($stmt);
                $result_schools = mysqli_stmt_get_result($stmt);

                $column_count = 0;

                while($rows=mysqli_fetch_array($result_schools)):

                    $_SESSION['schoolID'] = htmlspecialchars($rows['schoolID']);
                    $schoolName = htmlspecialchars($rows['schoolName']);
                    $address = htmlspecialchars($rows['address']);
                    $contact_info = htmlspecialchars($rows['contact_info']);
                    $schoolLogo = htmlspecialchars($rows['schoolLogo']);
                    $pending_count = htmlspecialchars($rows['pending_count']);

                    // If this is the first column, start a new row
                    if ($column_count % 4 == 0) {
                        echo '<div class="row pb-5 mb-4">';
                    }
                
                mysqli_close($con);
            ?> 
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <!-- Card-->
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body p-0">
                            <a href="school-transaction.php">
                                <img src="School-Logo/<?php echo $schoolLogo ?>" alt="" class="w-100 card-img-top">
                            </a>
                            <div class="p-4">
                                <h5 class="mb-0"><?php echo $schoolName ?></h5>
                                <a href="school-transaction.php">
                                    <p class="small text-muted"><?php echo $address  ?></p>
                                </a>
                                <?php 
                                    if ($rows['pending_count'] > 0) {
                                        $pending_student='<span class="pending-number">'. $pending_count . '</span> students pending';
                                    } else {
                                        $pending_student='';
                                    }
                                ?>
                                <a href="student-applicant.php?id=<?php echo $_SESSION['schoolID'] ?>" >                             
                                    <div class="pending">
                                        <p><?php echo $pending_student ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> 
            <?php
                    $column_count++;
                    // If this is the last column, end the row
                    if ($column_count % 4 == 0) {
                        echo '</div>';
                    }
                endwhile;
            ?>
        </div>
    </div>
</div>
     
        
</div>
</div></div>
    <script src="Hr-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="Hr-assets/js/bs-init.js"></script>
    <script src="Hr-assets/js/2-columns-media-image-video-carousel-map-2-columns-media.js"></script>
    <script src="Hr-assets/js/Bold-BS4-Animated-Back-To-Top-backtotop.js"></script>
    <script src="Hr-assets/js/theme.js"></script>
</body>
</html>