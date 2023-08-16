<?php
    require_once('../connection.php');
    session_start();

    include('../checkLogin.php');

    if(isset($_GET['i'])) {
        $current_account_id = $_GET['i'];

        // Query for Account Details
        $account_details_query = "SELECT ac.email, ac.password, ac.role, IF(ac.role='student',st.studentName,sc.schoolName) AS Name
                                FROM account ac
                                LEFT JOIN student st ON st.accountID = ac.accountID
                                LEFT JOIN school sc ON sc.accountID = ac.accountID
                                WHERE ac.accountID = ?";
        $account_query_stmt = $con->prepare($account_details_query);
        $account_query_stmt->bind_param("i", $current_account_id);
        $account_query_stmt->execute();
        $account_query_result = $account_query_stmt->get_result();
        $account_details = $account_query_result->fetch_assoc();
        $account_query_stmt->close();

        // Store Account Name
        $acc_name = $account_details['Name'];
        // Extract First Name from Account Name
        $arr_off =  count(explode(" ",$acc_name))-1; 
        $arr_len = 1;
        $l_name = join(" ", array_slice(explode(" ", $acc_name), $arr_off, $arr_len));
        // Extract Last Name from Account Name
        $arr_off = 0;
        $arr_len = count(explode(" ",$account_details['Name']))-$arr_off-1;
        $f_name = join(" ", array_slice(explode(" ", $acc_name), $arr_off, $arr_len));

        // If 'Save' button is pressed
        if(isset($_POST['submit'])) {
            $acc_fname = $_POST['fname'];
            $acc_lname = $_POST['lname'];
            $acc_email = $_POST['email'];

            // TODO: configure updates for other roles
            // Upload new details: Name
            $accName = $acc_fname." ".$acc_lname;
            switch($account_details['role']) {
                case 'student':
                    $name_stmt = "UPDATE student SET studentName = ? WHERE accountID = ?";
                    break;
                case 'school':
                    $name_stmt = "UPDATE school SET schoolName = ? WHERE accountID = ?";
                    break;
                default:
                    $name_stmt = "SELECT ac.role FROM account ac JOIN school sc ON sc.accountID = ac.accountID WHERE sc.schoolName = ? AND ac.accountID = ?";
                    break;
            }

            $name_query = $con->prepare($name_stmt);
            $name_query->bind_param("si", $accName, $current_account_id);
            $name_query->execute();
            $name_query->close();
            //
            // Upload new details: Email
            $email_stmt = "UPDATE account SET email = ? WHERE accountID = ?";
            $email_query = $con->prepare($email_stmt);
            $email_query->bind_param("si", $acc_email, $current_account_id);
            $email_query->execute();
            $email_query->close();
            //
            // Upload new details: Role
            //
            // Upload new details: Password
            //

            header("Location: AdminDashboard.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>wisdom-1</title>
    <link rel="stylesheet" href="admin-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="admin-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="admin-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="admin-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="admin-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="admin-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="admin-assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="admin-assets/css/Profile-Edit-Form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="color: rgb(0,0,0);">
    <nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
    <div class="container-fluid"><a href="AdminDashboard.php"><img src="assets/img/logo.png" width="140" height="29" /></a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow mx-1"></li>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile" src="admin-assets/img/avatars/avatar1.jpeg" /></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="AdminProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit Profile</a><a class="dropdown-item" href="StudentDashboard.php"><i class="fas fa-home fa-sm fa-fw me-2 text-gray-400"></i>Dashboard</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
        </div>
        </nav>
        <div id="banner" style="height: 250px;background: url(&quot;assets/img/banner.jpg&quot;) center / cover no-repeat, #d3edff;">
        </div>
        <section id="admin-edit-acc">
            <?php
            ?>
            <form style="margin: 50px;" method="POST">
                <div>
                    <div class="row" style="height: 110px;">
                        <div class="col" style="margin: 23px;margin-top: 5px;">
                            <div><label class="form-label" style="font-size: 16px;"><strong>First Name</strong></label></div>
                            <div><input class="form-control" type="text" name="fname" style="border-radius: 25px;width: 100%;height: 50px;font-size: 16px;border: 1px solid #d1d3e2;" value="<?php echo $f_name; ?>"></div>
                        </div>
                        <div class="col" style="margin: 23px;margin-top: 5px;">
                            <div><label class="form-label" style="font-size: 16px;"><strong>Last Name</strong></label></div>
                            <div><input class="form-control" type="text" name="lname" style="border-radius: 25px;width: 100%;height: 50px;border: 1px solid #d1d3e2;" value="<?php echo $l_name; ?>"></div>
                        </div>
                    </div>
                    <div class="row" style="height: 110px;">
                        <div class="col" style="margin: 23px;margin-top: 5px;">
                            <div><label class="form-label" style="font-size: 16px;"><strong>Email</strong></label></div>
                            <div><input class="form-control" type="text" name="email" style="border-radius: 25px;width: 100%;height: 50px;border: 1px solid #d1d3e2;" value="<?php echo $account_details['email']?>"></div>
                        </div>
                    </div>
                    
                    <body>
                        <div class="row" style="height: 110px;">
                            <div class="col" style="margin: 23px;margin-top: 5px;">
                                <div><label class="form-label" style="font-size: 16px;"><strong>Account Role</strong></label></div>
                                <div class="dropdown" style="border-radius: 25px;width: 100%;height: 50px;color: #C7BABA;border: 1px solid #d1d3e2;">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: var(--bs-black);background: rgb(255,255,255);border-style: none;margin: 5px;">
                                        --Select--
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="selectRole('Student')">Student</a>
                                        <a class="dropdown-item" onclick="selectRole('School')">School</a>
                                        <a class="dropdown-item" onclick="selectRole('Facilitator')">Facilitator</a>
                                        <a class="dropdown-item" onclick="selectRole('Human Resource')">Human Resource</a>
                                        <a class="dropdown-item" onclick="selectRole('Admin')">Admin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                        <div class="col" style="margin: 23px;margin-top: 5px;">
                            <div><label class="form-label" style="font-size: 16px;"><strong>Password</strong></label></div>
                            <div><input class="form-control" type="password" style="border-radius: 25px;width: 100%;height: 50px;border: 1px solid #d1d3e2;" placeholder="*************"></div>
                        </div>

                    <div class="row" style="height: 110px;">
                        <div class="col">
                            <button class="btn btn-primary" type="button" style="margin: 25px;border-radius: 25px;width: 160px;height: 50px;margin-right: 0px;color: var(--bs-btn-bg);background: var(--bs-btn-disabled-color);border: 1px solid var(--bs-btn-bg);" onclick="location.href='AdminDashboard.php';"><strong>Cancel</strong></button>
                            <input class="btn btn-primary" type="submit" name="submit" value="Save" style="margin: 25px;border-radius: 25px;width: 160px;height: 50px;margin-right: 0px; font-weight: bold;"></input>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('dropdownMenuButton').innerText = role;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>

    
</body>
</html>
