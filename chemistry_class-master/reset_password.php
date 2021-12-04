<?php
//  header('Location:login.html');
    session_start();
    ob_start();
    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","25");
    include_once("database.php");
     $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)) {
        if(isset($_GET['token'])){
            $token=$_GET['token'];
        $newPassword = $_POST['Password'];
        $cPassword = $_POST['cPassword'];
        $pass = password_hash($newPassword,PASSWORD_BCRYPT);
        $cpass = password_hash($cPassword,PASSWORD_BCRYPT);
        if($newPassword==$cPassword){
        $updatequery = "update registers set Password='$pass' where token='$token'";
        $iquery=mysqli_query($con,$updatequery);
        if($iquery){
          $_SESSION['msg']="Your password has been updated";
          header('location:login.php');
        }else{
            $_SESSION['passmsg']="Your password is not updated";
        }
        
           
        }
        else{
            // echo '<script>alert("")</script>';
            echo ("<script LANGUAGE='JavaScript'>
            window. alert('password are not matching');
            window. location. href='http://localhost/chemistry_class-master/chemistry_class-master/reset_password.html';
            </script>");
        }
   
    }
    }
        else{
            echo('waha error hai');
        }
?> 