<?php
    /********************** */
    //Forgot password page
    /********************** */
include_once('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_email, $get_link, $token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'martinezlloydangelo21@gmail.com'; //Email account that will be used to send an email
    $mail->Password   = 'trzrqbqoqozofjrc';                 //Enter temporary password for email, Create one in gmail account
    $mail->Port       = 465;

    $mail->addAddress($get_email);
    $mail->isHTML(true);
    $mail->Subject    = 'Reset Password Notification';
    $email_template   = "
        <h2>Hello!</h2>
        <h3>You have received an email password reset request for your account.</h3>
        <br>
        <a href='$get_link?token=$token'>Click Me!</a>";
    
    $mail->Body = $email_template;
    if (!$mail->send()) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        echo '<script>alert("Failed to send password reset email.")</script>';

    } else {
        echo '<script>alert("Password Reset Link email Sent")</script>';
    }
}

if (isset($_POST['pass_reset'])) {
    $email = $_POST['email'];

    // Check if the email exists in the account table
    $check_email_query = "SELECT email FROM accounttbl WHERE email = ? LIMIT 1";
    $stmt = $con->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $get_link= 'http://localhost/wisdom/password-reset.php';

        // Generate a new token and update the account table
        $token = bin2hex(random_bytes(20));
        $update_token_query ="UPDATE accounttbl SET token=? WHERE email=? LIMIT 1";
        $stmt = $con->prepare($update_token_query);
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        //calls the function that send an email
        send_password_reset($email, $get_link, $token);

    } else {
        // Email not found in the account table
        echo '<script>alert("Email does not Exist!")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Forgotten Password</title>
    <link rel="stylesheet" href="login-reg-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="login-reg-assets/css/untitled.css">
</head>

<body class="bg-gradient-primary" style="background: url(&quot;login-reg-assets/img/image.jpg&quot;) center / cover no-repeat;">
    <div class="container" id="cont">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-password-image" style="background: url(&quot;login-reg-assets/img/dogs/login-logo.jpg&quot;) center;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-2" style="font-family: Poppins, sans-serif;">Forgot Your Password?</h4>
                                        <p class="mb-4" style="font-family: Poppins, sans-serif;font-size: 14px;">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="mb-3"><input class="form-control form-control-user" name="email" type="email" id="forgot-email" aria-describedby="emailHelp" placeholder="Enter Email Address..." style="font-family: Poppins, sans-serif;" required=""></div>
                                        <button class="btn btn-primary d-block btn-user w-100" name="pass_reset" type="submit" style="background: rgb(0,23,235);border-width: 0px;font-family: Poppins, sans-serif;">Reset Password</button>
                                    </form>
                                    <div class="text-center" style="font-family: Poppins, sans-serif;font-size: 14px;">
                                        <hr><a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center"><a class="small" href="login.php" style="font-family: Poppins, sans-serif;font-size: 12px;">Already have an account? Login!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="login-reg-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="login-reg-assets/js/theme.js"></script>
</body>
</html>