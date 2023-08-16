<?php
    require_once('../connection.php');

    // Query for Number of pending students
    $Numpending = $con->prepare("SELECT COUNT(st.studentID) AS pendingNum 
                             FROM student st 
                             JOIN school sc ON st.schoolID = sc.schoolID 
                             JOIN studentstatus sts ON sts.schoolID = sc.schoolID AND sts.studentID = st.studentID
                             WHERE sc.accountID = ? AND sts.status='pending'");
    $Numpending->bind_param("i", $accountid);
    $Numpending->execute();
    $result = $Numpending->get_result();
    $row = $result->fetch_assoc();
    $Numpending->close();
    $pendingNum = $row['pendingNum'];

    // Query for Number of accepted students
    $Numenrolled = $con->prepare("SELECT COUNT(st.studentID) AS enrolled 
                                FROM student st 
                                JOIN school sc ON st.schoolID = sc.schoolID 
                                JOIN studentstatus sts ON sts.schoolID = sc.schoolID AND sts.studentID = st.studentID
                                WHERE sc.accountID = ? AND sts.status='accepted'");
    $Numenrolled->bind_param("i", $accountid);
    $Numenrolled->execute();
    $result = $Numenrolled->get_result();
    $row = $result->fetch_assoc();
    $Numenrolled->close();
    $enrolled = $row['enrolled'];

    // Query for Total Number of students (finished or accepted)
    $total = $con->prepare("SELECT COUNT(st.studentID) AS studTotal 
                            FROM student st 
                            JOIN school sc ON st.schoolID = sc.schoolID 
                            JOIN studentstatus sts ON sts.schoolID = sc.schoolID AND sts.studentID = st.studentID
                            WHERE sc.accountID = ? AND (sts.status='finished' OR sts.status='accepted')");
    $total->bind_param("i", $accountid);
    $total->execute();
    $result = $total->get_result();
    $row = $result->fetch_assoc();
    $total->close();
    $studentTotal = $row['studTotal'];

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

?>