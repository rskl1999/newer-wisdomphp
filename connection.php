<?php
$user = "root";         //USERNAME
$pass = "";             //PASSWORD
$host = "localhost";    //SERVERNAME
$db_name = "wisdomdb";  //DATABASE NAME
$con = mysqli_connect ($host, $user, $pass);
$db = mysqli_select_db ($con, $db_name );
?>