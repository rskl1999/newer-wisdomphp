<?php
    require_once('../../connection.php');
    session_start();

    $accountid = $_SESSION['accountID'];

    // Query for school logo
    $schoolLogo = $con->prepare("SELECT schoolLogo, schoolID 
                                FROM school 
                                WHERE accountID = ?");
    $schoolLogo->bind_param("i", $accountid);        
    $schoolLogo->execute();
    $result = $schoolLogo->get_result();
    $row = $result->fetch_assoc();
    $schoolLogo->close();
    $_SESSION['schoolLogo'] = $row['schoolLogo'];
    $_SESSION['schoolID'] = $row['schoolID'];

    echo $_SESSION['schoolLogo'];

?>