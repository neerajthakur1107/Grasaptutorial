<?php
//  header('Location:login.html');
    session_start();
    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","25");
    include_once("database.php");
     $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)) {
        $Email = $_POST['Email'];
        $emailquery="select * from registers where Email='$Email'";
        $query=mysqli_query($con,$emailquery);
        $emailcount = mysqli_num_rows($query);
        if($emailcount){
           $userdata = mysqli_fetch_array($query);
           $Name=$userdata['Name'];
           $token = $userdata['token'];
           $subject="Email activation";
           $body="Hi,$Name. Click here too reset your password
           http://localhost/chemistry_class-master/chemistry_class-master/reset_password.html?token=$token";
           $headers="From: navin55545@gmail.com";
           if(mail($Email,$subject,$body,$headers)){
               $_SESSION['msg']="check your mail to reset your password $Email";
               header('Location:login.html');
           }else{
            echo '<script>alert("email sending failed")</script>';
           }
        }
   
    }
        else{
            echo('waha error hai');
        }
?>