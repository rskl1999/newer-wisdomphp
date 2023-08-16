<?php
    require_once('../connection.php');

    // Count Total Number of Schools Registered in the Database
    $SchoolNum = $con->prepare("SELECT COUNT(schoolID) AS schoolCount FROM school");
    $SchoolNum->execute();
    $SchoolNum_result = $SchoolNum->get_result();
    $SchoolNum_row = $SchoolNum_result->fetch_assoc();
    $SchoolNum->close();
    $schoolCount = $SchoolNum_row['schoolCount'];

    $card_details = array();
    // Get School Names with their IDs and Addresses
    $SchoolQuery = $con->prepare("SELECT schoolName, schoolID, address, schoolLogo FROM school");
    $SchoolQuery->execute();
    $SchoolQuery_result = $SchoolQuery->get_result();

    while($SchoolQuery_row = $SchoolQuery_result->fetch_assoc()) {
        $card_details[] = $SchoolQuery_row;
    }

    $SchoolQuery->close();

?>