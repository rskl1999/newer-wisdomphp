<?php
    // TODO:
    // Check if student id exists
    // Check if status is valid: ['pending', 'accepted', 'declined']


    require_once('connection.php');
    session_start();

    require_once('checkLogin.php');

    if(isset($_GET['stid']) && isset($_GET['status']) && isset($_GET['appli'])) {
        $studentid = $_GET['stid'];
        $status = $_GET['status'];
        $applicationid = $_GET['appli'];
    }
    else {
        header("Location: ".$_SESSION['prevLocation']);
    }

    // Insert into database student status
    $query = $con->prepare("UPDATE studentstatus 
                            SET status = ? 
                            WHERE studentID = ?");
    $query->bind_param("si", $status, $studentid);
    $query->execute();

    // Update Internshipapplication tabl
    $query = $con->prepare("UPDATE internshipapplication 
                            SET noStudents = IF(noStudents > 0 OR NOT noStudents = NULL, (noStudents - 1), 0) 
                            WHERE internshipApplicationID = ?");
    $query->bind_param("i", $applicationid);
    $query->execute();

    $query->close();

    header('Location: '.$_SESSION['prevLocation']);
?>