<?php
require_once('connection.php');
session_start();

// Check if the required session variables are set
$schoolName = $_SESSION['schoolName'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];
$contactno = $_SESSION['contact-no'];
$password = $_SESSION['password'];

if (!$schoolName || !$email || !$address || !$contactno || !$password) {
    header("Location: register.php");
}

if (isset($_POST['create'])) {
    $image_name = $_FILES["logo"]["name"];
    $image_tmp_name = $_FILES["logo"]["tmp_name"];
    $image_type = $_FILES["logo"]["type"];
    $image_size = $_FILES["logo"]["size"];

    $unique_id = uniqid(); // Generate unique identifier
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION); // Get the file extension
    $new_logo_name = $unique_id . '.' . $image_extension; // Create new file name with extension
    
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    // Get the role from the previous insertion
    $sql = "SELECT accountID, role FROM account WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $userID = $user['accountID'];
    $role = $user['role'];
    $stmt->close();

    // Determine the folder to save the image based on the role
    $folder = "";
    switch ($role) {
        case 'admin':
            $folder = "Admin-Logo/";
            break;
        case 'facilitator':
            $folder = "Facilitator-Logo/";
            break;
        case 'hr':
            $folder = "HR-Logo/";
            break;
        case 'school':
            $folder = "School-Logo/";
            break;
        case 'student':
            $folder = "Student-Logo/";
            break;
        // Add additional cases for more roles, if needed
        default:
            $folder = "Other-Logo/";
    }

    move_uploaded_file($image_tmp_name, $folder . $new_logo_name);

    // Upload user data to individual tables
    echo $role;
    echo "\nschool: ".strcmp($role, 'school');
    echo "\nstudent: ".strcmp($role, 'student');
    echo "\nfaci: ".strcmp($role, 'facilitator');
    echo "\nhr: ".strcmp($role, 'hr');
    if(strcmp($role, 'school') == 0) { // SCHOOL
        $stmt = $con->prepare("INSERT INTO school (accountID, schoolName, address, contactInfo, schoolLogo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $userID, $schoolName, $address, $contactno, $new_logo_name);
        $stmt->execute();

        $stmt->close();
    }
    else if (strcmp($role, 'student') == 0) { // STUDENT
        $stmt = $con->prepare("INSERT INTO student (accountID, studentName, profileImage) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userID, $schoolName, $new_logo_name);
        $stmt->execute();

        $stmt->close();
    }
    else if (strcmp($role, 'facilitator') == 0) { // FACILITATOR
        echo "pota faci";
        $stmt = $con->prepare("INSERT INTO facilitator (accountID, facilitatorName, profileImage) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userID, $schoolName, $new_logo_name);
        $stmt->execute();

        $stmt->close();
    }
    else if (strcmp($role, 'hr') == 0) { // HR
        echo "pota";
        $stmt = $con->prepare("INSERT INTO hr (accountID, hrName, profileImage) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userID, $schoolName, $new_logo_name);
        $stmt->execute();

        $stmt->close();
    }
    else if (strcmp($role, 'admin') == 0) { // ADMIN
    }
    $con->close();

    // Clear out SESSION variables
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['schoolName']);
    unset($_SESSION['address']);
    unset($_SESSION['contact-no']);

    $_SESSION['success'] = "Account Created Successfully";
    header("Location: login.php");
    exit; // Stop further code execution after the redirection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile</title>
    <link rel="stylesheet" href="login-reg-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="login-reg-assets/css/untitled.css">
</head>

<body class="d-flex d-xxl-flex justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center" style="height: 100vh;background: url(&quot;login-reg-assets/img/image.jpg&quot;) center / cover round;">
    <div class="card" style="width: 350px;box-shadow: 0px 0px 19px 0px rgba(133,135,150,0.29);border-radius: 15px;">
        <form method="POST" enctype="multipart/form-data">
            <h4 class="d-flex d-xxl-flex justify-content-center justify-content-xxl-center" style="margin-top: 30px;margin-right: 25px;margin-bottom: 8px;margin-left: 25px;font-family: Poppins, sans-serif;color: rgb(0,0,0);">Profile Picture</h4>
            <div class="row" id="profImage" style="margin: 40px;">
                <div class="col d-flex d-xxl-flex justify-content-center justify-content-xxl-center"><img></div>
            </div>
            <div class="row" id="inputBox" style="padding-bottom: 30px;padding-right: 20px;padding-left: 20px;">
                <div class="col d-flex justify-content-center">
                    <input class="form-control form-control-sm" type="file" name="logo" required="" accept="image/*"></div>
            </div>
            <div class="row" id="profButton" style="padding-bottom: 30px;padding-right: 20px;padding-left: 20px;">
                <div class="col d-flex justify-content-between">
                <button class="btn btn-primary"  name="discard" style="background: rgba(0,23,235,0);height: 40px;width: 100px;border-radius: 35px;border-width: 2px;border-color: #0017eb;color: #0017eb;font-weight: bold;" href="register.html">Discard</a>
                <button class="btn btn-primary"  name="create" style="background: #0017eb;height: 40px;width: 100px;border-radius: 35px;">Create</a></div>
            </div>
        </form>
    </div>
    <script src="login-reg-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="login-reg-assets/js/Input-Image-With-Preview-input_image_preview.js"></script>
    <script src="login-reg-assets/js/profImage.js"></script>
    <script src="login-reg-assets/js/theme.js"></script>
</body>

</html>
