<?php
session_start();
include_once("database.php");
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $updatequery = " update registers set status='active' where token='$token'";
    $query = mysqli_query($con,$updatequery);
    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg']="Account updated successfully";
            header('location"login.html');
        }else{
            $_SESSION['msg']="you are logged out.";
            header('location"login.html');
        }
    }else{
        $_SESSION['msg']="Account not updated";
        header('location"login.html');
    }
}
?>