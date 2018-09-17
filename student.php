<?php
$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$email=$_GET['email'];
$signedin=$_GET['signedin'];

session_start();    

if($_SERVER['HTTP_REFERER']=="http://108.55.6.113/Internshala/Login.html"){
$_SESSION['signedin']="YES";


}else{
    
    
    $_SESSION['signedin']="NO";
}


$connection=new mysqli('localhost','root','','InternDB');

$que="SELECT internship_id from memberstable WHERE user_id=(SELECT uid from Userstable WHERE email='".$email."') ";


$result=mysqli_query($connection,$que);


$datar1[]=array();
    while($row=mysqli_fetch_assoc($result)){
    $datar1[]=$row; 
    }
$count=count($datar1);


$applied=array();
for($a=1;$a<$count;$a++){
    
$que="SELECT title,college_company FROM Internshipstable WHERE inid=".$datar1[$a]['internship_id'];
$result=mysqli_query($connection,$que);
    while($row=mysqli_fetch_assoc($result)){
        $applied[]=$row; 
        }
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interns!</title>
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
    <!-- My javascript files-->

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

                    <a class="navbar-brand " href="Login.html">INTERNS!</a>
                </div>
                <div id="list" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="hvr-grow" id="intbtn" ><a href="signout.php"><span class="fa fa-user-circle"></span><?php echo $signedin=="YES"?"Signout":"Login/Signup"; ?></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="jumbotron row">
        <p>Your are signed in As <?php echo $firstname;   ?></p>
        <h1 class="col-xs-12">Welcome Back! <?php echo $firstname ?></h1>
        <p class="col-xs-12">How are you today?</p>
        <a href="internships.php"><button class="btn btn-success col-xs-12 col-sm-3">Apply for an Internship</button></a>
        
        <a href="#track"><button class="btn btn-success col-xs-12 col-sm-4 col-sm-push-2">Look at Applied Internships</button></a>    

        </div>
        <div class="row" id="track" >
            
            <div class="col-xs-12" >
                  <h1 center >Applied Internships</h1>
            </div>
            <div class="col-xs-1" style="border:1px ridge">
                <p><strong>Number</strong></p>
            </div>
            
            <div class="col-xs-6" style="border:1px ridge">
                  <p><strong>Title</strong></p>
            </div>
            <div class="col-xs-5" style="border:1px ridge">
                  <p><strong>Company</strong></p>
            </div>
            <?php for($b=0;$b<count($applied);$b++){      ?>
            <div class="col-xs-1" style="border:1px ridge">
                  <p><?php echo $b + 1 ; ?></p>
            </div>
            
            <div class="col-xs-6" style="border:1px ridge">
                  <p><?php echo $applied[$b]['title'];   ?></p>
            </div>
            <div class="col-xs-5" style="border:1px ridge">
                  <p><?php echo $applied[$b]['college_company']   ?></p>
            </div>
            <?php } ?>
        </div>
        </div>
</body>
</html>