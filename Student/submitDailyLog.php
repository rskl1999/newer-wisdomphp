<?php
    session_start();
    require_once("../connection.php");

    $time_in = $_POST['timein'];
    $time_out = $_POST['timeout'];
    $time_rendered = $_POST['renderedHours'];

    $date_submitted = date("m/d/Y");

    $studentiD_query = $con->prepare("SELECT studentID, hoursRendered FROM student WHERE accountID = ?");
    $studentiD_query->bind_param("i", $_SESSION['accountID']);
    $studentiD_query->execute();
    $studentiD_res = $studentiD_query->get_result()->fetch_assoc();
    $studentID = $studentiD_res['studentID'];
    $student_hours = $studentiD_res['hoursRendered'];
    $studentiD_query->close();

    if(!empty($studentID)) {
        // Insert post details into database
        $insert_log_query = $con->prepare("INSERT 
                                        INTO dailylog (studentID, hoursRendered, date, dateTimeIn, dateTimeOut)
                                        VALUES (?, ?, ?, ?, ?)
                                        ");
        $insert_log_query->bind_param("iisss", $studentID, $time_rendered, $date_submitted, $time_in, $time_out);
        $insert_log_query->execute();
        $insert_log_query->close();

        // Update student's total hours
        $total_hours = $student_hours + $time_rendered;
        $update_hours_query = $con->prepare("UPDATE student SET hoursRendered = ? WHERE studentID = ?");
        $update_hours_query->bind_param("ii", $total_hours, $studentID);
        $update_hours_query->execute();
        $update_hours_query->close();

        echo 1;
    }
?>