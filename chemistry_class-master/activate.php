<?php
session_start();
include_once("database.php");
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $updatequery = " update registers set status='active' where token='$token'";
    $query = mysqli_query($con,$updatequery);
    if($query){
            echo ("<script LANGUAGE='JavaScript'>
window. alert('Account updated successfully');
window. location. href='https://grasptutorials.com/login.html';
</script>");
       
    }else{
        echo ("<script LANGUAGE='JavaScript'>
        window. alert('Account not updated');
        window. location. href='https://grasptutorials.com/login.html';
        </script>");
    }
}
?>