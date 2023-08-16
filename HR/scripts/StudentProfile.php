<?php
    require_once('../../connection.php');

    if(isset($_GET['std'])) {
        $studentid = $_GET['std'];
    }

    // Query for school logo
    $image = $con->prepare("SELECT student.profileImage, student.studentName, account.email
                                FROM student 
                                JOIN account ON student.accountID = account.accountID
                                WHERE student.studentID = ?");
    $image->bind_param("i", $studentid);        
    $image->execute();
    $result = $image->get_result();
    $row = $result->fetch_assoc();
    $image->close();
    echo $row['profileImage'].",".$row['studentName'].",".$row['email'];
?>