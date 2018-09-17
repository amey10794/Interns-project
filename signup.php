<?php
session_start();
print_r($_POST);
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$password=$_POST['password'];
$mem=$_POST['mem'];
$org=$_POST['org'];
$servername="localhost";
$username="root";
$passworddb="";
$_SESSION["firstname"]=$firstname;
$_SESSION["lastname"]=$lastname;
$_SESSION["email"]=$email;
$_SESSION["mem"]=$mem;
$_SESSION["signedin"]="YES";
$connection=new mysqli($servername,$username,$passworddb,"InternDB");
//Making connection
if($connection->connect_error){
    
    die("Connection failed:". $connection->connect_error);
}else{
    echo "Connection Succesful";
}
//Creating Database
$que= "CREATE DATABASE IF NOT EXISTS InternDB";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "InternDB created succesfully";
}
//Membership Table
$que="CREATE TABLE IF NOT EXISTS memtable(
id INT PRIMARY KEY UNIQUE,
type VARCHAR(50)
)";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "Memtable created succesfully";
}else{
    echo $connection->error;
}
$que="INSERT INTO memtable(id,type) values(1,'Student'),(2,'Employer')";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "Memtable populated succesfully";
}else{
    echo $connection->error;
}


//Userstable
$que="CREATE TABLE IF NOT EXISTS Userstable(
uid int UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
firstname varchar(50) NOT NULL,
lastname varchar(50) NOT NULL,
password varchar(50) NOT NULL,
email varchar(50) NOT NULL,
college_company varchar(50),
membership_id INT,
reg_date TIMESTAMP,
FOREIGN KEY(membership_id) REFERENCES memtable(id)
)";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "Userstable created succesfully";
}else{
    echo $connection->error;
}
//entries

$que = "INSERT INTO Userstable (firstname, lastname, email,password,college_company,membership_id)
VALUES ('$firstname', '$lastname', '$email', '$password','$org','$mem')";

echo "<br/>";
if($connection->query($que)===TRUE){
    echo "Inserted data succesfully";
}else{
    echo $connection->error;
}

//Internships table
$que="CREATE TABLE IF NOT EXISTS Internshipstable(
inid int UNSIGNED PRIMARY KEY AUTO_INCREMENT UNIQUE,
title varchar(50) NOT NULL,
college_company varchar(50) NOT NULL,
starton varchar(50) NOT NULL,
applyby varchar(50) NOT NULL,
dur varchar(50) NOT NULL,
stipend varchar(50) NOT NULL,
details varchar(500) NOT NULL
)";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "Internships Table created succesfully";
}else{
    echo $connection->error;
}
//Junction Table
$que="CREATE TABLE IF NOT EXISTS memberstable(
id int UNSIGNED PRIMARY KEY AUTO_INCREMENT UNIQUE,
user_id int ,
internship_id int
)";
echo "<br/>";
if($connection->query($que)===TRUE){
    echo "junction table created succesfully";
}else{ 
    echo $connection->error;
}


if($mem==1){
header("Location:http://108.55.6.113/Internshala/student.php?firstname=".$firstname."&lastname=".$lastname."&email=".$email."&org=".$org."&signedin=YES");    
}elseif($mem==2){
header("Location:http://108.55.6.113/Internshala/employee.php?firstname=".$firstname."&lastname=".$lastname."&email=".$email."&org=".$org."&signedin=YES");
}

?>