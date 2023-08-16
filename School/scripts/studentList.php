<?php
    require_once('../connection.php');
    // session_start();

    $items_per_page = $_SESSION['items_per_page'];
    $page = $_SESSION['page'];
    $schoolid = $_SESSION['schoolID'];

    // Counts students from current school 
    $total_stud_query = "SELECT COUNT(studentID) FROM student WHERE schoolID = ?"; 
    // Selects student details of those who applied in the internship
    $students = $con->prepare("SELECT st.studentName, b.batchID, b.batchNo, sts.status, st.course, st.hoursRendered, a.duration, ac.email
                            FROM student st
                                JOIN internshipapplication a ON st.schoolID = a.schoolID
                                JOIN school sc ON st.schoolID = sc.schoolID 
                                JOIN batch b ON b.batchID = a.batchID AND a.internshipApplicationID = st.applicationID
                                JOIN studentstatus sts ON sts.schoolID = sc.schoolID AND sts.studentID = st.studentID
                                JOIN account ac ON st.accountID = ac.accountID
                            WHERE st.schoolID = ?
                            LIMIT ?, ?");
    // Execution of getting srudent count
    $total_stud_stmt = $con->prepare($total_stud_query);
    $total_stud_stmt->bind_param("i", $schoolid);
    $total_stud_stmt->execute();
    $total_stud_result = $total_stud_stmt->get_result();
    $total_items = $total_stud_result->fetch_row()[0];
    $total_stud_stmt->close();

    // Execution of getting students' details
    $offset = ($page -1) * $items_per_page;
    $students->bind_param("iii", $schoolid, $offset, $items_per_page);
    $students->execute();
    $result = $students->get_result();
    $students->close();  

    // Store student details in array then POST
    $student_details = array();
    while($row = $result->fetch_assoc()) {
        if(empty($row['hoursRendered'])) {
            $row['hoursRendered'] = 0;
        }
        $student_details[] = $row;
    }
    $_POST['data'] = $student_details;

    // FOR DEBUGGING 
    // foreach($_POST['data'] as $data) {
    //     print_r($data);

    //     echo "<br/>";
    // }
    // var_dump($_POST['data']);

    // header("Location: SchoolDashboard.php");

?>