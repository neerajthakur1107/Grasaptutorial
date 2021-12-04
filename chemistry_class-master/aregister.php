<?php
//  header('Location:login.html');
    session_start();
    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","25");
    include_once("database.php");
     $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)) {
        $full_name = $_POST['full_name'];
        $Email = $_POST['Email'];
        $loginID = $_POST['loginID'];
        $Password = $_POST['Password'];
        $cPassword = $_POST['cPassword'];
        $comp=$_POST['comp'];
        $pass = password_hash($Password,PASSWORD_BCRYPT);
        $cpass = password_hash($cPassword,PASSWORD_BCRYPT);
        $emailquery="select * from slogin where email_id='$Email'";
        $query=mysqli_query($con,$emailquery);
        $emailcount = mysqli_num_rows($query);
        if($emailcount>0){
            // echo '<script>alert("email already exist")</script>';
            // header('Location:aregister.html');
            echo ("<script LANGUAGE='JavaScript'>
            window. alert('email already exist');
            window. location. href='http://localhost/chemistry_class-master/chemistry_class-master/aregister.html';
            </script>");  
        }else{
        if($Password==$cPassword){
            $sql = "INSERT INTO slogin(full_name,email_id,password,loginID) VALUES ('$full_name','$Email','$pass','$loginID')";

            if ($con->query($sql) === TRUE) {
                $authdata = [ 
                    'email_id' => $Email,
                    
                    ];

                
            } else {
                
                echo('yaha error hai');
            }
            $subject="Email activation";
            $body="Hi,your loginID is $loginID. and Password is $Password.";
            $headers="From: navin55545@gmail.com";
            if(mail($Email,$subject,$body,$headers)){
                echo '<script>alert("Email sent")</script>';
            }else{
                echo '<script>alert("Email sending failed")</script>';
            }
           
        }
        else{
            // echo '<script>alert("Password are not matching")</script>';
            // header('Location:aregister.html');
            echo ("<script LANGUAGE='JavaScript'>
            window. alert('Password are not matching');
            window. location. href='http://localhost/chemistry_class-master/chemistry_class-master/aregister.html';
            </script>");
        }
    }
   
    }
        else{
            echo('waha error hai');
        }
?>