<?php
session_start();
	require_once('../connection.php');

	include('../checkLogin.php');

	// Store Account and School IDs //add adminID -> admintb
	$accountid = $_SESSION['accountID'];
	$userid = $_SESSION['adminID'];
	
    //add accountID -> admintb
	$sql = "SELECT *
				FROM admintb ad
				JOIN account a ON a.accountID = ad.accountID
				WHERE adminID = ?";
	
	$stmt = $con->prepare($sql);
	$stmt->bind_param("i", $userid);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$name = $row['adminName']; //add adminName
		$email = $row['email']; //add email
		//
		$complete_address = $row['address'];
		$arr_address = explode(",", $complete_address);
		$province = $arr_address[count($arr_address)-1];
		$city = $arr_address[count($arr_address)-2];
		$address = join(",", array_slice($arr_address, 0, count($arr_address)-2));
		//
		$contact_info = $row['contactInfo'];
		$password = $row['password'];
		$adminLogo = $row['adminLogo'];
	} else {
		$name = '';
		$email = '';
		$address = '';
		$contact_info = '';
		$password = '';
		$adminLogo = '';
	}

	// If form is submitted, update the user's profile in the database
	if (isset($_POST['submit'])) {
		$n_adminName = $_POST['adminName'];
		$n_email = $_POST['email'];
		if(isset($_POST['addressCity']) && isset($_POST['addressProvince'])) {
			$n_address = $_POST['address'].",".$_POST['addressCity'].",".$_POST['addressProvince'];
		}
		else {
			$n_address = $address;
		}
		$n_contact_info = $_POST['contactInfo'];
		// If user uploaded a logo, load logo; if not, use saved image
		if(!empty($_POST['avatar-file'])) {
			$n_adminLogo = $_POST['avatar-file'] ? $_POST['avatar-file'] : $adminLogo;

			$image_name = $_FILES["avatar-file"]["name"];
			$image_tmp_name = $_FILES["avatar-file"]["tmp_name"];
			$image_type = $_FILES["avatar-file"]["type"];
			$image_size = $_FILES["avatar-file"]["size"];
		}
		else {
			$n_adminLogo = $adminLogo;

			$image_name = $_FILES["avatar-file"]["name"];
			$image_tmp_name = $_FILES["avatar-file"]["tmp_name"];
			$image_type = $_FILES["avatar-file"]["type"];
			$image_size = $_FILES["avatar-file"]["size"];
		}
		// Check if the user uploaded a new logo
		if($_FILES['avatar-file']['error'] !== 4 || ($_FILES['avatar-file']['size'] !== 0 && $_FILES['avatar-file']['error'] !== 0)){
			$unique_id = uniqid(); // Generate unique identifier
			$image_extension = pathinfo($image_name, PATHINFO_EXTENSION); // Get the file extension
			$new_logo_name = $unique_id . '.png'; // Create new file name with extension
			move_uploaded_file($image_tmp_name, "../School-Logo/" . $new_logo_name);
			$n_adminLogo = $new_logo_name;
			$_SESSION['adminLogo'] = $new_logo_name; // Set new logo as Session Logo 
		} else {
			$displayedLogo = $_SESSION['adminLogo'];
		}
		
		// Update the School Role
		$stmt = $con->prepare("UPDATE account SET email=? WHERE email=?");
		$stmt->bind_param("ss", $n_email, $email);
		$stmt->execute();
		
		// Update the School information
		$stmt = $con->prepare("UPDATE school SET adminName=?, address=?, contactInfo=?, adminLogo=? WHERE accountID=?");
		$stmt->bind_param("ssssi", $n_adminName, $n_address, $n_contact_info, $n_adminLogo, $accountid);
		$stmt->execute();

		// Update password
		$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $con->prepare("UPDATE account 
								SET password=? 
								WHERE accountID=?");
		$stmt->bind_param("si", $hashed_pass, $accountid);
		$stmt->execute();
		
		$stmt->close();
		$con->close();
		
		// Update the session variables
		$_SESSION['success'] = "Account Updated Successfully";


		header("Location:AdminDashboard.php");
	}
	$displayedLogo = $_SESSION['adminLogo'];
	?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Student Profile</title>
    <link rel="stylesheet" href="../student/student-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="../student/student-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../student/student-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="../student/student-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="../student/student-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="../student/student-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="../student/student-assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="../student/student-assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="../student/editProfile-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="../student/editProfile-assets/css/styles.min.css">
</head>

<body style="color: rgb(0,0,0);"><nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
    <div class="container-fluid"><a href="AdminDashboard.php"><img src="assets/img/logo.png" width="140" height="29" /></a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow mx-1"></li>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile" src="admin-assets/img/avatars/avatar1.jpeg" /></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="AdminProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit Profile</a><a class="dropdown-item" href="AdminDashboard.php"><i class="fas fa-home fa-sm fa-fw me-2 text-gray-400"></i>Dashboard</a>
                        <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <div>
    <div id="banner" style="height: 150px;background: url(&quot;../student/student-assets/img/banner-bg.png&quot;) center / cover no-repeat, #d3edff;"></div>
        <div class="container profile profile-view" id="profile" style="padding: 0px 20px;">
        <form>
            <div class="row profile-row">
                <div class="col-md-4 relative">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div>
                    <input type="file" class="form-control" name="avatar-file" style="border-radius: 0px;border-width: 0px;border-color: rgba(85,85,85,0);" accept="image/*">
                </div>
                <div class="col-md-8 mb-2" style="font-family: Poppins, sans-serif; font-weight:bold;color:#1C1C1C;">
                    <h3><strong>Admin Edit Profile</strong></h3><br>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">First Name</label>
                                <input class="form-control" type="text" placeholder="First Name" style="height: 45px;border-radius: 35px;" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Last Name</label>
                                <input class="form-control" type="text" placeholder="Last Name" style="height: 45px;border-radius: 35px;" required="">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Email</label>
                                <input class="form-control" type="text" placeholder="email@gmail.com" style="height: 45px;border-radius: 35px;" required="" inputmode="email">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Position</label>
                                <input class="form-control" type="text" placeholder="position" style="height: 45px; border-radius: 35px;" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="control-label" style="font-family: Poppins, sans-serif;">Password</label>
                                <input class="form-control" type="password" id="studentPassword" style="height: 45px;border-radius: 35px;" required="" minlength="8" maxlength="16" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="AdminDashboard.php"><button class="btn btn-default" type="button" style="font-family: Poppins, sans-serif;width: 120px;background: rgba(0,23,235,0);color: #0017eb;height: 45px;border-radius: 35px;margin: 0px;margin-right: 20px;margin-top:20px;font-weight: bold;border-width: 2px;border-color: #0017eb;">Cancel</button></a>
                            <button class="btn btn-default" type="button" style="font-family: Poppins, sans-serif;width: 120px;background: #0017eb;color: rgb(255,255,255);height: 45px;border-radius: 35px;margin: 0px;margin-right: 20px;margin-top: 20px;border-width: 0px;">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <script src="..student/student-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="..student/student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="..student/student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="..student/student-assets/js/Profile-Edit-Form-profile.js"></script>
    <script src="..student/student-assets/js/theme.js"></script>
    <script src="..student/student-assets/js/untitled.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>
</html>
