 
 <?php
//  header('Location:login.html');
    session_start();
    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","25");
    include_once("database.php");
     $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)) {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $cPassword = $_POST['cPassword'];
        $comp=$_POST['comp'];
        $pass = password_hash($Password,PASSWORD_BCRYPT);
        $cpass = password_hash($cPassword,PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(15));
        $emailquery="select * from registers where Email='$Email'";
        $query=mysqli_query($con,$emailquery);
        $emailcount = mysqli_num_rows($query);
        if($emailcount>0){
            echo '<script>alert("email already exist")</script>';
        }else{
        if($Password==$cPassword){
            $sql = "INSERT INTO registers(Name,Email,Password,cPassword,token,status) VALUES ('$Name','$Email','$pass','$cpass','$token','inactive')";

            if ($con->query($sql) === TRUE) {
                $authdata = [ 
                    'Name' => $Name,
                    'Email' => $Email,
                    'id' => mysqli_insert_id($con)
                    
                    ];

                
            } else {
                
                echo('yaha error hai');
            }
            $subject="Email activation";
            $body="Hi,$Name. Click here too activate your account
            https://grasptutorials.com/activate.php?token=$token";
            $headers="From: navin55545@gmail.com";
            if(mail($Email,$subject,$body,$headers)){
                $_SESSION['msg']="check your mail to activate your account $Email";
                header('Location:login.html');
            }else{
                echo '<script>alert("email sending failed")</script>';
            }
           
        }
        else{
            echo '<script>alert("password are not matching")</script>';
        }
    }
   
    }
        else{
            echo('waha error hai');
        }
?>