<?php 
print_r($_POST);
$email=$_GET['email'];
$title=$_POST['title'];
$start=$_POST['start'];
$duration=$_POST['dur'];
$apply=$_POST['apply'];
$stipend=$_POST['stipend'];
$details=$_POST['description'];
$connection=new mysqli('localhost','root','',"InternDB");
//Making connection
if($connection->connect_error){
    
    die("Connection failed:". $connection->connect_error);
}else{
    echo "Connection Succesful";
}
$que="SELECT college_company from Userstable WHERE email='".$email."'";
$result=mysqli_query($connection,$que);
$org1=mysqli_fetch_assoc($result);
$org=$org1['college_company'];
echo "<br/>";

$que="INSERT INTO internshipstable(title,college_company,starton,applyby,dur,stipend,details) values('$title','$org','$start','$apply','$duration','$stipend','$details')";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "Succesfully posted the internship";
}else{
    echo $connection->error;
}

$que="INSERT INTO memberstable(user_id,internship_id) VALUES((SELECT uid FROM Userstable WHERE email='".$email."'),(SELECT inid FROM Internshipstable WHERE details='".$details."'))";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "Succesfully updated members table";
}else{
    echo $connection->error;
}

header('Location:' .$_SERVER['HTTP_REFERER'].'#post');
?>