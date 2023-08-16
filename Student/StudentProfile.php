<?php

        require_once('../connection.php');
        session_start();

        include('../checkLogin.php');

    // Store Account ID
    $accountid = $_SESSION['accountID'];

    $f_name = '';
    $l_name = '';
    
    $sql = "SELECT *
                FROM student st
                JOIN account a ON a.accountID = st.accountID
                WHERE a.accountID = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $accountid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $name = $row['studentName'];
        // Extract First Name from Account Name
        $arr_off =  count(explode(" ",$name))-1; 
        $arr_len = 1;
        $l_name = join(" ", array_slice(explode(" ", $name), $arr_off, $arr_len));
        // Extract Last Name from Account Name
        $arr_off = 0;
        $arr_len = count(explode(" ",$name))-$arr_off-1;
        $f_name = join(" ", array_slice(explode(" ", $name), $arr_off, $arr_len));

        $email = $row['email'];
        $password = $row['password'];
        $course = $row['course'];
        $profileImage = $row['profileImage'];
    } else {
        $name = 'Student Name';
        $email = '';
        $password = '';
        $course = '';
        $profileImage = '';
    }

    // If form is submitted, update the user's profile in the database
    if (isset($_POST['submit'])) {
        $n_fname = $_POST['studentFName'];
        $n_lname = $_POST['studentLName'];
        
        $n_studentName = !empty($n_fname) && !empty($n_lname) ? $n_fname." ".$n_lname : $name;
        $n_email = $_POST['email'] ?? $email;
        // If user uploaded a logo, load logo; if not, use saved image
        $n_profileImage = $_POST['avatar-file'] ?? $profileImage;

        $image_name = $_FILES["avatar-file"]["name"];
        $image_tmp_name = $_FILES["avatar-file"]["tmp_name"];
        $image_type = $_FILES["avatar-file"]["type"];
        $image_size = $_FILES["avatar-file"]["size"];

        // Check if the user uploaded a new logo
        if($_FILES['avatar-file']['error'] !== 4 || ($_FILES['avatar-file']['size'] !== 0 && $_FILES['avatar-file']['error'] !== 0)){
            $unique_id = uniqid(); // Generate unique identifier
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION); // Get the file extension
            $new_image_name = $unique_id . '.png'; // Create new file name with extension
            move_uploaded_file($image_tmp_name, "../Student-Logo/" . $new_image_name);
        }        

        // Update the Student email
        $stmt = $con->prepare("UPDATE account SET email=? WHERE email=?");
        $stmt->bind_param("ss", $n_email, $email);
        $stmt->execute();
        
        // Update the student information
        $stmt = $con->prepare("UPDATE student SET studentName=?, profileImage=? WHERE accountID=?");
        $stmt->bind_param("ssi", $n_studentName, $n_profileImage, $accountid);
        $stmt->execute();
        
        $stmt->close();
        $con->close();
        
        // Update the session variables
        $_SESSION['success'] = "Account Updated Successfully";


        header("Location:StudentDashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Student Profile</title>
    <link rel="stylesheet" href="student-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="student-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="student-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="student-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="student-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="student-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="student-assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="student-assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="editProfile-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="editProfile-assets/css/styles.min.css">
</head>

<body style="color: rgb(0,0,0);"><nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
    <div class="container-fluid"><a href="StudentDashboard.php"><img src="student-assets/img/logo_black.png" width="140" height="29" /></a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow mx-1"></li>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile" src="student-assets/img/avatars/avatar1.jpeg" /></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="StudentProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit Profile</a><a class="dropdown-item" href="StudentDashboard.php"><i class="fas fa-home fa-sm fa-fw me-2 text-gray-400"></i>Dashboard</a>
                        <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <div>
    <div id="banner" style="height: 150px;background: url(&quot;student-assets/img/banner-bg.png&quot;) center / cover no-repeat, #d3edff;"></div>
        <div class="container profile profile-view" id="profile" style="padding: 0px 20px;">
        <form method="POST" enctype="multipart/form-data">
            <div class="row profile-row">
                <div class="col-md-4 relative">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div>
                    <input type="file" class="form-control" name="avatar-file" style="border-radius: 0px;border-width: 0px;border-color: rgba(85,85,85,0);" accept="image/*">
                </div>
                <div class="col-md-8 mb-2" style="font-family: Poppins, sans-serif; font-weight:bold;color:#1C1C1C;">
                    <h3 style="font-weight:bold; margin-bottom: 20px;">Student Profile</h3>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">First Name</label>
                                <input class="form-control" name="studentFName" type="text" value="<?php echo $f_name?>" placeholder="First Name" style="height: 45px;border-radius: 35px;" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Last Name</label>
                                <input class="form-control" name="studentLName" type="text" value="<?php echo $l_name?>" placeholder="Last Name" style="height: 45px;border-radius: 35px;" required="">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Email</label>
                                <input class="form-control" name="email" type="text" value="<?php echo $email?>" placeholder="student@email.com" style="height: 45px;border-radius: 35px;" required="" inputmode="email">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Course/Strand</label>
                                <input class="form-control" name="course" type="text" value="<?php echo $course?>" placeholder="Course/Strand" style="height: 45px;border-radius: 35px;" required="">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Password</label>
                                <input class="form-control" name="password" type="password" id="studentPassword" style="height: 45px;border-radius: 35px;" required="" minlength="8" maxlength="16" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="StudentDashboard.php"><button class="btn btn-default" type="button" name="cancel" style="font-family: Poppins, sans-serif;width: 120px;background: rgba(0,23,235,0);color: #0017eb;height: 45px;border-radius: 35px;margin: 0px;margin-right: 20px;margin-top:20px;font-weight: bold;border-width: 2px;border-color: #0017eb;">Cancel</button></a>
                            <button class="btn btn-default" type="submit" name="submit" style="font-family: Poppins, sans-serif;width: 120px;background: #0017eb;color: rgb(255,255,255);height: 45px;border-radius: 35px;margin: 0px;margin-right: 20px;margin-top: 20px;border-width: 0px;">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <script src="student-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="student-assets/js/Profile-Edit-Form-profile.js"></script>
    <script src="student-assets/js/theme.js"></script>
    <script src="student-assets/js/untitled.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>
