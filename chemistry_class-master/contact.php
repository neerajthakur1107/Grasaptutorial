<?php
    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","25");
    include_once("database.php");
    $postdata = file_get_contents("php://input");
    if(isset($postdata) && !empty($postdata)) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $Email = $_POST['Email'];
        $message = $_POST['message'];
        $additional = $_POST['additional'];
        $to = "navin55545@live.com";
        $subject = "Contact request";
        $txt = "contact details: ".$fname." ".$lname." ".$Email." /n
         ".$message." /n 
         ".$additional." ";
         $txt = wordwrap($txt,70);
        $headers = "From: navin55545@gmail.com";
        mail($to,$subject,$txt,$headers);
        echo ("<script LANGUAGE='JavaScript'>
            window. alert('successfully submitted');
            window. location. href='https://grasptutorials.com/index.html';
            </script>");
    }
?>
 