<?php 
include 'connection.php';
if(isset($_GET['deleteid'])){
    $account_id=$_GET['deleteid'];

    $sql="DELETE FROM student WHERE accountID=$account_id";
    $result=mysqli_query($con,$sql);

    if($result){
        //echo "Deleted successfully";
        header('location:display.php');
    }
    else{
        die(mysqli_error($con));
    }
}

?>