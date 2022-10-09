<?php 
session_start();

    include("connection.php");
    include("function.php");

    $user_data = check_adminlogin($con);
    $user_id = $user_data['user_id'];
    $query = "SELECT * FROM orderdetails where user_id = '$user_id'";
    $result = mysqli_query($con,$query);

    echo $result->num_rows;
?>
