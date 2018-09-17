<?php
session_start();
$inid=$_GET['int'];
$connection=new mysqli('localhost','root','','InternDB');
$email=$_SESSION['email'];

$que="INSERT INTO memberstable(user_id,internship_id) values((SELECT uid from Userstable WHERE email='".$email."'),'".$inid."')";

if($connection->query($que)==TRUE){
    echo "updated memberstable";
}else{
    echo "error in updating memberstable";
}

header("Location:".$_SERVER['HTTP_REFERER']);

?>