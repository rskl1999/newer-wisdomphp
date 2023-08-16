<?php
// create-acct.php
session_start();
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user input
    $schoolName = filter_var($_POST['schoolName'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $province = filter_var($_POST['province'], FILTER_SANITIZE_STRING);
    $contactNo = filter_var($_POST['contact-no'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $conPass = $_POST['con-pass'];
    $department = $_POST['department']; // Retrieve the selected department

    // if email does not exist
    if (isset($_POST['next'])) {
        // Check if the email already exists in the database
        $email_check_query = "SELECT * FROM account WHERE email='$email' LIMIT 1";
        $result = mysqli_query($con, $email_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if email exists
            $_SESSION['error'] = "Email already exists.";
            header("Location: register.php");
            exit; // Stop further code execution after the redirection
        } else {
            if ($password != $conPass) {
                // If passwords don't match, don't save password and show error message
                $_SESSION['error'] = "Passwords do not match.";
                header("Location: register.php");
                exit; // Stop further code execution after the redirection
            } else {
                // Map the department to the corresponding role
                switch ($department) {
                    case 'Admin':
                        $_SESSION['role'] = 'admin';
                        break;
                    case 'Facilitator':
                        $_SESSION['role'] = 'facilitator';
                        break;
                    case 'HR':
                        $_SESSION['role'] = 'hr';
                        break;
                    case 'School':
                        $_SESSION['role'] = 'school';
                        break;
                    case 'Student':
                        $_SESSION['role'] = 'student';
                        break;
                    // Add additional cases for more roles, if needed
                }

                // Use prepared statement to insert user data into the database
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $con->prepare("INSERT INTO account (email, password, role) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $email, $hashed_password, $_SESSION['role']);
                $stmt->execute();
                $stmt->close();

                // Save other user input into session variables
                $_SESSION['schoolName'] = $schoolName;
                $_SESSION['email'] = $email;
                $_SESSION['address'] = $address . ", " . $city . ", " . $province;
                $_SESSION['contact-no'] = $contactNo;
                $_SESSION['password'] = $password;
                $_SESSION['department'] = $department;

                session_regenerate_id(true);

                header("Location: uploadprofile.php");
                exit; // Stop further code execution after the redirection
            }
        }
    }
}
?>
