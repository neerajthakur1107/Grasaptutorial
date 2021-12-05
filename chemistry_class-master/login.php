<?php
session_start();
include_once("database.php");
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $check=$_POST['check'];
    $sql = "SELECT * FROM registers where Email='$Email' and status='active'";
    $query = mysqli_query($con,$sql);
    $email_count=mysqli_num_rows($query);
    if($email_count){
       $email_pass = mysqli_fetch_assoc($query);
       $db_pass = $email_pass['Password'];
       $pass_decode = password_verify($Password,$db_pass);
    
    if($pass_decode){
        echo ("<script LANGUAGE='JavaScript'>
        window. alert('login successful');
        window. location. href='https://grasptutorials.com/index.html';
        </script>");
       
    }else{
        echo ("<script LANGUAGE='JavaScript'>
        window. alert('Password incorrect');
        window. location. href='https://grasptutorials.com/login.html';
        </script>");
    }
}else{
    echo ("<script LANGUAGE='JavaScript'>
window. alert('Invalid email or account not activated please check your email..');
window. location. href='https://grasptutorials.com/login.html';
</script>");
    // echo '<script>alert("Invalid email or account not activated please check your email..")</script>';
}
    // if($result = mysqli_query($con,$sql))
    // {
    //     $rows = array();
    //     while($row = mysqli_fetch_assoc($result))
    //     {
    //         $rows[] = $row;
    //     }
    //     echo "login sucessfull...";
    // }
    // else{
    //     http_response_code(401);
        
    // }
}
?>
