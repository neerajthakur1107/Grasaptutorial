<?php
include_once("database.php");
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    if($Email=='shreyadabbawar@gmail.com' && $Password=="123"){
        header('Location:aregister.html');
    }
       
}else{
    echo '<script>alert("check connection")</script>';
}

?>
