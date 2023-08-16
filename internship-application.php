<?php
// Connect ot database and start session.
require_once('connection.php');
session_start();

// Remember session account ID
$accountid = $_SESSION['accountID'];

$moa = $con->prepare("SELECT moa FROM schooltbl WHERE accountID = ?");
$moa->bind_param("i", $accountid);
$moa->execute();
$result = $moa->get_result();
$row = $result->fetch_assoc();
$schoolmoa = $row['moa'];

// Check if school has no MOA 
if (empty($schoolmoa)) {
    // Redirect to MOA upload page
    echo "<script>alert('Please upload school MOA');</script>";
    header("Location:school-moa.php");
}
// Proceed to intern application
else {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Internship Application Form</title>
    <link rel="stylesheet" href="school-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="school-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="school-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="school-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="school-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="school-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="school-assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="school-assets/css/Profile-Edit-Form.css">
</head>

<body style="color: rgb(0,0,0);">
    <nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
        <div class="container-fluid"><a href="SchoolDashboard.html"><img src="school-assets/img/logo_black.png"
                    width="140" height="29" /></a>
            <ul class="navbar-nav flex-nowrap ms-auto">
                <li class="nav-item dropdown no-arrow mx-1"></li>
                <li class="nav-item dropdown no-arrow">
                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false"
                            data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile"
                                src="School-Logo/<?php echo $_SESSION['schoolLogo'] ?>" /></a>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item"
                                href="edit-profile.html"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit
                                Profile</a><a class="dropdown-item" href="school-dashboard.php"><i
                                    class="fas fa-home fa-sm fa-fw me-2 text-gray-400"
                                    href="school-dashboard.php"></i>Dashboard</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                    class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div id="banner"
        style="height: 150px;background: url(&quot;school-assets/img/banner-bg.png&quot;) center / cover no-repeat, #d3edff;">
    </div>
    <div id="body">
        <div class="container">
            <form style="padding: 31px;" method="POST" action="register-students.php">
                <div id="ProgramAdviserInfo" style="padding: 40px 0px;">
                    <h3><strong>Program Adviser Information</strong></h3>
                    <div class="row d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="name">
                        <div class="col" id="fname"><label class="form-label"><strong>First Name</strong></label>
                            <input class="form-control" name="advFname" type="text" style="height: 45px;border-radius: 35px;" placeholder="First Name" required="" onkeypress="return isVarchar(event)">
                        </div>
                        <div class="col" id="lname"><label class="form-label"><strong>Last Name</strong></label>
                            <input class="form-control" name="advLname" type="text" style="height: 45px;border-radius: 35px;" placeholder="Last Name" required="" onkeypress="return isVarchar(event)">
                        </div>
                        <div class="col" id="blank"></div>
                    </div>
                    <div class="row" id="email">
                        <div class="col"><label class="form-label"><strong>Email</strong></label>
                            <input class="form-control" name="advEmail" type="email" style="height: 45px;border-radius: 35px;" placeholder="Email" required="" onkeypress="return validateEmail(event)">
                        </div>

                        <div class="col"></div>
                    </div>
                </div>
                <div id="InternshipInfo" style="padding: 40px 0px;">
                    <h3><strong>Internship Information</strong></h3>
                    <div class="row">
                        <div class="col" id="program"><label class="form-label"><strong>Program</strong></label>
                            <input class="form-control" name="course" type="text" style="height: 45px;border-radius: 35px;" placeholder="Program" required="" onkeypress="return isVarchar(event)">
                        </div>
                        <div class="col" id="duration"><label class="form-label"><strong>Duration</strong></label>
                            <input class="form-control" name="duration" type="number" style="height: 45px;border-radius: 35px;" required="" min="100" max="500" onkeypress="return isNum(event)">
                        </div>
                        <div class="col" id="blank-1"></div>
                    </div>
                </div>
                <div id="addStudent" style="padding: 40px 0px;">
                    <div id="addStudent-1" style="padding: 40px 0px;">
                        <h3><strong>Student Information</strong></h3>
                        <button class="btn btn-primary" type="button" style="background: #0017eb;height: 45px;border-radius: 35px;border-width: 2px;border-color: #0017eb;color: #ffffff;margin: 0px 12px;width: 122px;">
                            <strong>Add</strong>
                        </button>
                    </div>
                    <div class="row">



                    </div>
                </div>
        </div>
        <div id="buttons" style="padding: 40px 0px;">
            <a class="btn btn-primary" name="discard" role="button" id="discard" style="background: rgba(0,23,235,0);width: 150px;height: 45px;border-radius: 35px;margin-right: 25px;color: #0017eb;border-width: 2px;" href="school-dashboard.php?page=1">
                <strong>Discard</strong>
            </a>
            <input class="btn btn-primary" name="apply" type="submit" role="button" style="background: #0017eb;width: 150px;height: 45px;border-radius: 35px;margin-right: 25px;">
        </div>
        </form>
    </div>
    </div>

    <script src="school-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="school-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="school-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="school-assets/js/Profile-Edit-Form-profile.js"></script>
    <script src="school-assets/js/theme.js"></script>
    <script src="school-assets/js/untitled.js"></script>
</body>
<script>

    function validateEmail(event) {
        const keyCode = event.keyCode;
        const allowedKeys = [46, 64, 95]; // 46 is for ".", 64 is for "@", and 95 is for "_"

        if ((keyCode >= 48 && keyCode <= 57) // 0-9
            || (keyCode >= 65 && keyCode <= 90) // A-Z
            || (keyCode >= 97 && keyCode <= 122) // a-z
            || allowedKeys.includes(keyCode)) { // allowed special characters
            return true;
        }
        event.preventDefault();
        return false;
    }

    function isVarchar(event) {
        const charCode = event.which ? event.which : event.keyCode;
        if ((charCode < 65 || charCode > 90)
            && (charCode < 97 || charCode > 122)
            && charCode !== 44 // allow comma
            && charCode !== 32) { // allow space
            event.preventDefault();
            return false;
        }
        return true;
    }

    function isNum(event) {
        const charCode = event.which ? event.which : event.keyCode;
        if (!(charCode < 65 || charCode > 90)
            || !(charCode < 97 || charCode > 122)
            || charCode === 44 // allow comma
            || charCode === 32) { // allow space
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>

</html>