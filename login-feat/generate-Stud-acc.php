<?php
$user = "root";         //USERNAME
$pass = "";             //PASSWORD
$host = "localhost";    //SERVERNAME
$db_name = "wisdomdb";  //DATABASE NAME
$con = mysqli_connect ($host, $user, $pass);
$db = mysqli_select_db ($con, $db_name );

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

//************************ /
//STUDENT ACCOUNT CREATION
//************************ /

// query to get number of approved student accounts
$sql='SELECT COUNT(status) FROM studenttbl WHERE status="Approved"';
$result = mysqli_query($con, $sql);

// check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// get the number of approved student accounts
$row = mysqli_fetch_array($result);
$num_accounts = $row[0];

// loop through and generate the accounts
for ($i = 1; $i <= $num_accounts; $i++) {
    // generate the username
    $username = 'student-' . str_pad($i, 4, '0', STR_PAD_LEFT);

    // generate the password
    $password = '';
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $password .= $chars[rand(0, strlen($chars) - 1)];
    $password .= $chars[rand(0, strlen($chars) - 1)];
    $password .= $numbers[rand(0, strlen($numbers) - 1)];
    for ($j = 0; $j < 5; $j++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }

    // insert the account information into the database
    $sql = "INSERT INTO studenttbl (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($con, $sql);

    // check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    // output the account information
    echo "Username: " . $username . " Password: " . $password . "<br>";
}

// close the database connection
mysqli_close($con);
?>