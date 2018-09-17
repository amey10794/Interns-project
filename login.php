<?php

$eemail=$_POST['eemail'];
$epassword=$_POST['epassword'];
$con=mysqli_connect('localhost','root','','InternDB') or die("Error".mysqli_error($con));
    $sql="SELECT * FROM Userstable WHERE email= '".$eemail."'";
    echo $sql;
    if($con->query($sql)==TRUE){
        echo "succesfully done";
    }
    else{
        echo "Error in selection".$con->error;
    }
    
    $result=mysqli_query($con,$sql);
    echo '<br/>';
    print_r($result);
    $datar[]=array();
    while($row=mysqli_fetch_assoc($result)){
        $datar[]=$row;
    }
    echo '<br/>';
        
    print_r($datar);
    echo $firstname=$datar[1]['firstname'];
    echo $lastname=$datar[1]['lastname'];
    echo $email=$datar[1]['email'];
    echo $password=$datar[1]['password'];
    echo $org=$datar[1]['college_company'];
    echo $mem=$datar[1]['membership_id'];
    
$con->close();
if($epassword===$password){
    
    echo "passwords match!";
    echo gettype($mem);
    $link=$mem=='1'?"student.php?firstname=".$firstname."&lastname=".$lastname."&email=".$email."&org=".$org."&signedin=YES":"employee.php?firstname=".$firstname."&lastname=".$lastname."&email=".$email."&org=".$org."&signedin=YES";
    echo '<br/>';
    echo $link;
    session_start();
    $_SESSION["firstname"]=$firstname;
    $_SESSION["lastname"]=$lastname;
    $_SESSION["email"]=$email;
    $_SESSION["mem"]=$mem;
    $_SESSION["signedin"]="YES";
    header("Location:http://108.55.6.113/Internshala/".$link);
}
else{
    echo "wrong password";
    header("Location:http://108.55.6.113/Internshala/login.html");
    
}


?>