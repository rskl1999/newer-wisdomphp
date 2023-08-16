<?php
function email_moa($HR_email, $schoolName, $schoolEmail, $accountID){

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'martinezlloydangelo21@gmail.com';
    $mail->Password = 'trzrqbqoqozofjrc';
    $mail->SMTPSecure = 'tls'; // or 'ssl'
    $mail->Port = 465; // or 587
    
    define('EMAIL', 'wisdom.projectsph@gmail.com');
    
    $mail->setFrom(EMAIL, 'Wisdom');
    $mail->addAddress($HR_email);
    $mail->addReplyTo($schoolEmail);
    
    if (isset($_FILES['file']) && $_FILES['file']['type'][0] == 'application/pdf') {
        $target_path = 'moa/' . basename($_FILES['file']['name'][0]) . $_FILES['file']['type'][0];
    
        if (move_uploaded_file($_FILES['file']['tmp_name'][0], $target_path)) {
            $mail->addAttachment($target_path, $_FILES['file']['name'][0]);
            $moa = $_FILES['file']['name'][0];
    
            // Send email notification
            $mail->isHTML(true);
            $mail->Subject = 'Internship Application';
            $mail->Body = '<div style="border:2px solid red;">
                                <h2>Internship Application</h2> <br> 
                                <p>Good Day from Wisdom,</p>
                                <p>' . $schoolName . ' has submitted their Memorandum of Agreement and is looking forward to your approval of their internship application. For any changes to the File format, you may email them at ' . $schoolEmail . '.</p>
                            </div>';
            $mail->AltBody = $schoolName . ' has submitted their Memorandum of Agreement and is looking forward to your approval of their internship application. For any changes to the File format, you may email them at ' . $schoolEmail . '.';
            $mail->send();

            // Update database using prepared statements
            $update_moa = "UPDATE schooltbl SET moa = ? WHERE accountID = ? LIMIT 1";
            $stmt = $con->prepare($update_moa);
            $stmt->bind_param("si", $moa, $accountID);
            $stmt->execute();
            $stmt->close();
    
            // Redirect to success page
            header('Location: internship-application.php');
        } else {
            echo 'Error: Failed to save the file.';
        }
    } else {
        echo 'Error: Only PDF files are allowed.';
    }   
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
} 