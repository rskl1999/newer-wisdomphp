<?php 

session_start();
require_once('connection.php');

if(isset($_GET['deleteid'])){
    $account_id=$_GET['deleteid'];

    $sql="DELETE FROM account WHERE accountID = $account_id";
    $result = mysqli_query($con, $sql);

    if($result){
        echo "Deleted successfully";
        // header('Location: Admin/AdminDashboard.php');
    }
    else{
        die(mysqli_error($con));
    }
}

?>
