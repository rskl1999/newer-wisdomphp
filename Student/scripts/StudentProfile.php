<?php
    require_once('../../connection.php');
    session_start();

    $accountid = $_SESSION['accountID'];

    // Query for school logo
    $schoolLogo = $con->prepare("SELECT profileImage, studentID 
                                FROM student 
                                WHERE accountID = ?");
    $schoolLogo->bind_param("i", $accountid);        
    $schoolLogo->execute();
    $result = $schoolLogo->get_result();
    $row = $result->fetch_assoc();
    $schoolLogo->close();
    $_SESSION['userLogo'] = $row['profileImage'];
    $_SESSION['userID'] = $row['studentID'];

    echo $_SESSION['userLogo'];

?>