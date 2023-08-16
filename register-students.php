<?php
    session_start();
    require_once('connection.php');

    // If school acc is not logged in, return to login page.
    if(!isset($_SESSION['accountID'])) {
        header("Location:login.php");
    }

    // counter for student inputs
    $students_count = 0;

    // If inputs for students' details was created ... 
    if(isset($_POST["fname"]) & isset($_POST["lname"]) & isset($_POST["email"])) {
        // Get inputted students name and print them out
        $student_names_f = $_POST["fname"]; // get input first names
        $student_names_l = $_POST["lname"]; // get input last names
        $student_emails = $_POST["email"]; // get input emails
        foreach($student_names_f as $key=>$value){ // loop thru and print each input 
            echo "<br/> Student: ".$value." ".$student_names_l[$key].", ".$student_emails[$key]; // DEBUG: print out students
            $students_count++;
        }
    }
    // no student details was inputted.
    else {
        echo "<br/> Student list empty.";
    }
    echo "<br/>";

    // Applicant table req'd params
    $schoolID = $_SESSION['schoolID'];
    $batchID = -1; // TODO: Replace arbitrary value (1) with an inputted value
    $programAdviser = $_POST['advFname']." ".$_POST['advLname'];    // Type: str
    $adviserEmail = $_POST['advEmail'];                             // Type: str
    $dateSubmitted = date("Y-m-d");                                 // Type: str
    $duration = $_POST["duration"]; // Program duration in hours;   // Type: int

    // DEBUG: print out adviser details
    echo "<br/><hr/>Application table entry: <br/><br/>" 
        ."School ID: ".$schoolID."<br/>"
        ."Batch ID: ".$batchID."<br/>"
        ."Advisor: ".$programAdviser."<br/>"
        ."Advisor Email: ".$adviserEmail."<br/>"
        ."Date Submitted: ".$dateSubmitted."<br/>"
        ."Duration: ".$duration;

    // Student table req'd params
    $accountIDs;        // Type: int
    $schoolIDs;         // Type: int
    $studentNames;      // Type: str
    $course;            // Type: str
    $hoursRendered;     // Type: str
    $status;            // Type: str
    $noStudent;          // type: int

    $accountID = $_SESSION['accountID'];
    $schoolID = $_SESSION['schoolID'];
    $student_names = array();
    foreach($_POST["fname"] as $key=>$value) {
        array_push($student_names, $value." ".$_POST['lname'][$key]);
    }
    $student_emails = array();
    foreach($_POST["email"] as $key=>$value) {
        array_push($student_emails, $value);
    }
    $course = $_POST['course'];
    $hoursRendered = "0";
    $status = "pending";
    $noStudent = max(count($student_names), count($student_emails));

    // DEBUG: print out student details -- content -- 
    echo "<br/>Account ID: ".$accountID
        ."<br/>Batch ID: ".$batchID
        ."<br/>School ID: ".$schoolID
        ."<br/>Student Names: ".join("\n  ", $student_names)
        ."<br/>Student Emails: ".join("\n  ", $student_emails)
        ."<br/>Course: ".$course
        ."<br/>Hrs Rendered : ".$hoursRendered
        ."<br/>Status: ".$status
        ."<br/>No of Students: ".$noStudent;

    /// CHECKING FOR DUPLICATE EMAILS
    // Query for existing emails
    $email_check_query = $con->prepare("SELECT email FROM account");
    $email_check_query->execute();
    $email_check_result = $email_check_query->get_result();
    // Loop through each email found in query
    $index = 0;
    while($email_out = $email_check_result->fetch_assoc()['email']) {
        // If a student's email is already in database...
        if(in_array($email_out, $student_emails)) {
            // Redirect to SchoolAddStudent page
            $_SESSION['error'] = "Student's email <strong>".$email_out."</strong> already registered.";
            header("Location: School/SchoolAddStudent.php");
            exit();
        }
    }
    
    // Count total number of batches
    $batch_count_query = $con->prepare("SELECT COUNT(BatchID) AS count from batch");
    $batch_count_query->execute();
    $batch_count_result = $batch_count_query->get_result();
    $batchNo = $batch_count_result->fetch_assoc()['count'];

    // Upload new batch into database
    $batchName = 'Batch '.$_POST['advFname'];
    $batchDesc = ''.$programAdviser.'\'s '.$students_count.' students from schoolID: '.$schoolID;
    $insert_batch_query = $con->prepare("INSERT INTO batch (schoolID, batchName, batchNo, batchDescription, startDate) VALUES (?, ?, ?, ?, ?)");
    $insert_batch_query->bind_param("isiss", $schoolID, $batchName, $batchNo, $batchDesc, $dateSubmitted);
    $insert_batch_query->execute();
    $insert_batch_query->close();
    /// Querying for batchID
    $insert_batch_query = $con->prepare("SELECT batchID FROM batch 
                                        WHERE schoolID = ? 
                                            AND batchName = ?
                                            AND batchDescription = ?
                                            AND startDate = ?");
    $insert_batch_query->bind_param("isss", $schoolID, $batchName, $batchDesc, $dateSubmitted);
    $insert_batch_query->execute();
    $insert_batch_result = $insert_batch_query->get_result();
    $batchID = $insert_batch_result->fetch_assoc()['batchID'];
    $insert_batch_query->close();

    // Upload application data into database
    $insert_applicant_query = $con->prepare("INSERT INTO internshipapplication (schoolID, batchID, programAdviser, adviserEmail, dateSubmitted, duration, noStudents) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insert_applicant_query->bind_param("iissssi", $schoolID, $batchID, $programAdviser, $adviserEmail, $dateSubmitted, $duration, $noStudent);
    $insert_applicant_query->execute();
    /// Querying for applicationID
    $insert_applicant_query = $con->prepare("SELECT internshipapplicationID FROM internshipapplication 
                                            WHERE schoolID = ? 
                                                AND batchID = ? 
                                                AND programAdviser = ? 
                                                AND adviserEmail = ? 
                                                AND dateSubmitted = ? 
                                                AND duration = ?
                                                AND noStudents = ?");
    $insert_applicant_query->bind_param("iissssi", $schoolID, $batchID, $programAdviser, $adviserEmail, $dateSubmitted, $duration, $noStudent);
    $insert_applicant_query->execute();
    $insert_applicant_result = $insert_applicant_query->get_result();
    $applicationID = $insert_applicant_result->fetch_assoc()['internshipapplicationID'];
    $insert_applicant_query->close();

    echo "<br/>";
    echo "Application ID: ".$applicationID;
    echo "<br/>";


    // For each student...
    for($i = 0; $i < $students_count; $i++) {
        // Upload student data into account table
        $student_role = 'student';
        $insert_stud_acc_sqry = $con->prepare("INSERT INTO account (email, role) VALUES (?, ?)");
        $insert_stud_acc_sqry->bind_param("ss", $student_emails[$i], $student_role);
        $insert_stud_acc_sqry->execute();
        /// Query for student accountID
        $insert_stud_acc_query = $con->prepare("SELECT accountID FROM account WHERE email = ?");
        $insert_stud_acc_query->bind_param("s", $student_emails[$i]);
        $insert_stud_acc_query->execute();
        $insert_stud_acc_result = $insert_stud_acc_query->get_result();
        $studentAccID = $insert_stud_acc_result->fetch_assoc()['accountID'];

        $insert_stud_acc_sqry->close();

        // DEBUG:
        echo "<br/>" ."$i -> $accountID, $studentAccID, $batchID, $schoolID, $student_names[$i], $course, $hoursRendered, $status";

        // Upload student data into student table
        $insert_student_query = $con->prepare("INSERT INTO student (accountID, applicationID, schoolID, studentName, course, hoursRendered) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_student_query->bind_param("iiisss", $studentAccID, $applicationID, $schoolID, $student_names[$i], $course, $hoursRendered);
        $insert_student_query->execute();
        /// Query for studentID
        $insert_student_query = $con->prepare("SELECT studentID FROM student
                                            WHERE accountID = ?
                                                AND applicationID = ?
                                                AND schoolId = ?
                                                AND studentName = ?
                                                AND course = ?");
        $insert_student_query->bind_param("iiiss", $studentAccID, $applicationID, $schoolID, $student_names[$i], $course);
        $insert_student_query->execute();
        $insert_student_result = $insert_student_query->get_result();
        $studentID = $insert_student_result->fetch_assoc()['studentID'];

        // Skip studentstatus upload of null schoolID or studentID
        if(empty($schoolID) | empty($studentID)) {
            continue;
        }
        // Check for duplicate status in studentstatus table
        $insert_stud_status_sqry = $con->prepare("SELECT 1 FROM studentstatus
                                                WHERE schoolID = ? AND studentID = ?");
        $insert_stud_status_sqry->bind_param("ii", $schoolID, $studentID);
        $insert_stud_status_sqry->execute();
        $insert_stud_status_res = $insert_stud_status_sqry->get_result();
        $does_status_entry_exists = $insert_stud_status_res->fetch_assoc();
        // Id status entry does not exist ...
        if(empty($does_status_entry_exists)) {
            // Upload student status into studentstatus table
            $student_status = 'pending'; // Student Initial Status
            $insert_stud_status_sqry = $con->prepare("INSERT INTO studentstatus (schoolID, studentID, status) VALUES (?, ?, ?)");
            $insert_stud_status_sqry->bind_param("iis", $schoolID, $studentID, $student_status);
            $insert_stud_status_sqry->execute();
        }
        $insert_stud_status_sqry->close();
    }

    $insert_student_query->close();
    $con->close();

    // Redirect to school dashboard after application
    header("Location:School/SchoolDashboard.php");
?>