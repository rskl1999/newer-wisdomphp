<?php
require_once('connection.php');
session_start();

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
        $mail->Subject    = 'Internship Application';
        $email_template   = "
            <h2>Hello!</h2>
            <h3>You have received an email password reset request for your account.</h3>
            <br>
            <a href='$get_link?token=$token'>Click Me!</a>
        ";
        $mail->Body = $email_template;
        if (!$mail->send()) {
            error_log('Mailer Error: ' . $mail->ErrorInfo);
            echo '<script>alert("Failed to send password reset email.")</script>';

        } else {
            echo '<script>alert("Password Reset Link email Sent")</script>';
        }
    }
        //when user press submit
                $schoolLogo = $_SESSION['schoolLogo'];
                $accountid = $_SESSION['accountID'];

                $advFname = $_POST['advFname'];
                $advLname = $_POST['advLname'];
                
                $adName = $advFname ." ". $advLname;
    
                $advEmail = $_POST['advEmail'];
                $course   = $_POST['course'];
                $duration = $_POST['duration'];
    
                $student_fnmae = $_POST['student-fname'];
                $student_lname = $_POST['student-lname'];
                $student_email = $_POST['student-email'];
            
                    $scID ="SELECT schoolID FROM schooltbl WHERE accountID = ?";
                        $stmt = $con->prepare($scID);
                        $stmt->bind_param("i", $accountid);
                        $stmt->execute();
                        $stmt->bind_result($schoolid);
                        $stmt->fetch();
                        $stmt->close();
    
                    $btID ="SELECT MAX(batchID) FROM applicanttbl WHERE schoolID = ?";
                        $stmt = $con->prepare($btID );
                        $stmt->bind_param("i", $schoolid);
                        $stmt->execute();
                        $stmt->bind_result($batchID);
                        $stmt->fetch();
                        $stmt->close();
    

                // Check if the email exists in the account table
                $check_email_query = "SELECT email FROM accounttbl WHERE email=? LIMIT 1";
                $stmt = $con->prepare($check_email_query);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) 
                    $row = $result->fetch_assoc();
                    $email = $row['email'];
                    $get_link= 'http://localhost/wisdom/password-reset.php';


        ?>