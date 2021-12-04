<?php
include_once("database.php");
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
    $loginID = $_POST['loginID'];
    $Password = $_POST['Password'];
    $sql = "SELECT * FROM slogin where loginID='$loginID' ";
    $query = mysqli_query($con,$sql);
    $email_count=mysqli_num_rows($query);
    if($email_count){
       $email_pass = mysqli_fetch_assoc($query);
       $db_pass = $email_pass['password'];
       $pass_decode = password_verify($Password,$db_pass);
    
    if($pass_decode){
    //     echo '<script>alert("login successful")</script>';
    //    header('Location: https://youtube.com/channel/UC_t3Kng-YF6yLRdCGDfZhCQ');
    echo ("<script LANGUAGE='JavaScript'>
    window. alert('login successful');
    window. location. href='https://youtube.com/channel/UC_t3Kng-YF6yLRdCGDfZhCQ';
    </script>");
    }else{
        // echo '<script>alert("password incorrect")</script>';
        // header('Location:slogin.html');
        echo ("<script LANGUAGE='JavaScript'>
        window. alert('password incorrect');
        window. location. href='http://localhost/chemistry_class-master/chemistry_class-master/slogin.html';
        </script>");
    }
}else{
    header('Location:index.html');
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
