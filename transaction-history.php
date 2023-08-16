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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Students</title>
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
                                    <li class="nav-item"><a class="nav-link active" data-bss-disabled-mobile="true" data-bss-hover-animate="pulse" href="school-applicant.php" style="font-family: Poppins, sans-serif;color: rgb(197,197,197);"><i class="fa fa-user" style="padding-right: 5px;"></i>Applicant</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bss-disabled-mobile="true" data-bss-hover-animate="pulse" href="school-transaction.php" style="font-family: Poppins, sans-serif;color: #0017eb;"><i class="fa fa-folder-open" style="padding-right: 5px;"></i>Transaction</a></li>
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
    <div id="main-content" style="padding-top: 24px;padding-bottom: 24px;">
        <div id="content">
<?php
    function sanitize($input) {
        $output = trim($input); 
        $output = stripslashes($output); 
        $output = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
        return $output;
        }
        
        $id = isset($_GET['id']) ? sanitize($_GET['id']) : null;

        $page = isset($_GET['page']) ? $_GET['page'] : 1;


        $sql = "SELECT schoolID FROM schooltbl WHERE schoolID = ?";
        
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($schoolID);
            $stmt->fetch();
            $stmt->close();
                
                if (!$id){
                    $id = 1;
                }
                elseif($id!=$schoolID){
                    $id = 1;
                }
                  
                $sql_school = "SELECT sc.schoolName, sc.schoolLogo, sc.address, a.email
                FROM schooltbl sc
                JOIN accounttbl a ON sc.accountID = a.accountID
                WHERE sc.schoolID = ?";
                    $stmt = $con->prepare($sql_school);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $stmt->bind_result($schoolName, $schoolLogo, $address, $email);
                    $stmt->fetch();
                    $stmt->close();

                $sql = "SELECT schoolID FROM schooltbl WHERE schoolID = ?";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $stmt->bind_result($schoolID);
                    $stmt->fetch();
                    $stmt->close();

                    $items_per_page = 10;
                            // Calculate the offset for the MySQL query
                    $offset = ($page - 1) * $items_per_page;

                            // Query to get the total number of students

                    $items_query = "SELECT st.studentName, st.course, a.dateSubmitted
                                FROM studenttbl st
                                JOIN applicanttbl a ON st.schoolID = a.schoolID AND st.batchID = a.batchID
                                WHERE st.schoolID = $id
                                LIMIT $offset, $items_per_page";

                            $result = mysqli_query($con, $items_query);

                    $sql = "SELECT COUNT(schoolID) FROM studenttbl WHERE schoolID = ? ";
                            $stmt = $con->prepare($sql);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $stmt->bind_result($total_items);
                            $stmt->fetch();
                            $stmt->close(); 
                        ?>   

            <div class="text-center" id="school-info" style="padding-right: 24px;padding-left: 24px;"><img style="width: 100px;" src="School-Logo/<?php echo $schoolLogo ?>">
                <h5 id="school-name" style="color: rgb(0,0,0);font-weight: bold;padding-top: 5px;margin-bottom: 0px;"><?php echo $schoolName ?> </h5>
                <p id="school-location" style="margin-bottom: 0px;"><?php echo $address ?></p>
                <p id="school-email"><?php echo $email ?></p>
            </div>
            <div id="body">
                <div class="container">
                    <div class="card shadow">
                        <div class="card-header py-3" style="background: #f8f9fc;padding-top: 0px;height: 60px;">
                            <div class="row" style="background: #f8f9fc;">
                                <div class="col-md-6 text-nowrap">
                                    <p class="text-primary m-0 fw-bold">Transaction History</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                        <p>Total Interns:<span id="intern-number" style="margin-left: 8px;"><?php echo $total_items ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Program</th>
                                            <th>Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                            while ($row = mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['studentName'] ?></td>
                                    <td><?php echo $row['course'] ?> </td>
                                    <td><?php echo $row['dateSubmitted']?></td>
                                </tr>
                            <?php 
                                }    
                                ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <nav class="d-flex justify-content-center">
                            <ul class="pagination">
                    <?php
                        $total_pages = ceil($total_items / $items_per_page);
                            if ($total_pages > 1) {
                            // Validate the current page number
                            $page = max($page, 1);
                            $page = min($page, $total_pages);

                                // Generate the "Previous" button link
                                $prev_page = $page - 1;
                                if ($prev_page >= 1) {echo '<li class="page-item"><a class="page-link" aria-label="Previous" href="transaction-history.php?page=' . $prev_page . '">«</a></li>';}
                            }
                                // Create the pagination links
                            for ($i = 1; $i <= $total_pages; $i++) {echo '<li class="page-item"><a class="page-link" href="transaction-history.php?page=' . $i . '">' . $i . '</a></li>';}
                            ?>
                            <?php
                            if ($total_pages > 1) {

                                // Generate the "Next" button link
                                $next_page = $page + 1;
                                if ($next_page <= $total_pages) {echo '<li class="page-item"><a class="page-link" aria-label="Next" href="transaction-history.php?page=' . $next_page . '">»</a></li>';}
                            }
                        ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Hr-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="Hr-assets/js/bs-init.js"></script>
    <script src="Hr-assets/js/2-columns-media-image-video-carousel-map-2-columns-media.js"></script>
    <script src="Hr-assets/js/Bold-BS4-Animated-Back-To-Top-backtotop.js"></script>
    <script src="Hr-assets/js/theme.js"></script>
</body>

</html>