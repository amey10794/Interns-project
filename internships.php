<?php 

@preg_match('/(student.php)/',$_SERVER['HTTP_REFERER'] , $matchstudent, PREG_OFFSET_CAPTURE);
session_start();
if($_SERVER['HTTP_REFERER']=="http://108.55.6.113/Internshala/Login.html"||$matchstudent[0][0]=="student.php"||$_SERVER['HTTP_REFERER']=="http://108.55.6.113/Internshala/internships.php"){
$_SESSION['signedin']="YES";
$email=$_SESSION['email'];

}else{
    
    
    $_SESSION['signedin']="NO";
    
}


$connection=new mysqli('localhost','root','','InternDB');

$today= date("Y-m-d");
$que = "SELECT * FROM internshipstable WHERE applyby >'".$today."'";

$result=mysqli_query($connection,$que);


$datar[]=array();
$datar1[]=array();
while($row=mysqli_fetch_assoc($result)){
    $datar[]=$row;
}

if($_SESSION['signedin']=="YES"){
     $que="SELECT internship_id from memberstable WHERE user_id=(SELECT uid from Userstable WHERE email='".$email."') ";


    $result=mysqli_query($connection,$que);
    

    
        while($row=mysqli_fetch_assoc($result)){
        $datar1[]=$row; 
        }
    
}

$applied=array();
for($a=1;$a<count($datar1);$a++){
    
    $applied[]=$datar1[$a]['internship_id'];
}

@$profile="http://108.55.6.113/Internshala/student.php?firstname=".$_SESSION['firstname']."&lastname=".$_SESSION['lastname']."&email=".$_SESSION['email']."&org=".$_SESSION['college_company']."&signedin=YES";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interning!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="https://goo.gl/UHdDoA">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-social.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
    <link href="css/hover-min.css" rel="stylesheet">
    <link href="css/hover.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#list" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand " href="Home.html">INTERNS!</a>
                </div>
                <div id="list" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="hvr-grow" id="intbtn" ><a href="<?php echo $_SESSION['signedin']=="YES"?$profile:""; ?>"><span class="fa fa-user-circle"></span><?php echo $_SESSION['signedin']=="YES"?"Profile":""; ?></a></li>
                        <li class="hvr-grow" id="intbtn" ><a href="Login.html"><span class="fa fa-user-circle"></span><?php echo $_SESSION['signedin']=="YES"?"Signout":"Login/Signup"; ?></a></li>

                    </ul>
                </div>

            </nav>

        </div>
        
        <div class="row">
            <h3 class="col-xs-12 alert-success">We have found <?php echo count($datar)-1 ?> internships for you</h3>
        </div>
        <?php for($i=1;$i<count($datar);$i++){ ?>
        <div class="row" >
            <div style="border-bottom:1px ridge">
                <h3 class="col-xs-12"><?php echo $datar[$i]['title']." at "; echo $datar[$i]['college_company']; ?></h3>
                
                <a href= <?php echo $_SESSION['signedin']==='YES'?'apply.php?int='.$datar[$i]['inid']:'login.html';  ?> ><button <?php echo in_array($datar[$i]['inid'],$applied)?"disabled":""   ?>  class="col-xs-4 col-xs-push-6 btn btn-primary"> <?php echo in_array($datar[$i]['inid'],$applied)?"APPLIED!":"APPLY!"   ?> </button></a>
                
            </div>
            <div class="col-xs-12">
                <p class="col-xs-6"><strong>START DATE:</strong> <?php echo $datar[$i]['starton']; ?></p>
                
                <p class="col-xs-6"><strong>APPLY BY:</strong> <?php echo $datar[$i]['applyby']; ?></p>
                
                
                <p class="col-xs-6"><strong>DURATION(months):</strong> <?php echo $datar[$i]['dur']; ?></p>
                
                <p class="col-xs-6"><strong>COMPENSATION(Rs.):</strong> <?php echo $datar[$i]['stipend']; ?></p>
                
                <p class="col-xs-12"><strong>DETAILS:</strong></p>
                <p class="col-xs-12" ><?php echo $datar[$i]['details']; ?></p>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>