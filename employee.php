<?php
$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$email=$_GET['email'];
$signedin=$_GET['signedin'];
session_start();    

if($_SERVER['HTTP_REFERER']=="http://108.55.6.113/Internshala/Login.html"){
$_SESSION['signedin']="YES";


}else{
    
    $_SESSION['firstname']="";
    $_SESSION['signedin']="NO";
}


$connection=new mysqli('localhost','root','','InternDB');

$que="SELECT internship_id from memberstable WHERE user_id=(SELECT uid from Userstable where email='".$email."')";
$result=mysqli_query($connection,$que);


$datar1[]=array();
    while($row=mysqli_fetch_assoc($result)){
    $datar1[]=$row; 
    }

foreach($datar1 as $row1){

@$que = "SELECT Userstable.firstname, Userstable.lastname,Userstable.email,Userstable.college_company,Internshipstable.title,memberstable.internship_id,memberstable.user_id from Userstable join Internshipstable join memberstable on memberstable.user_id=userstable.uid AND memberstable.internship_id=internshipstable.inid WHERE memberstable.internship_id=".$row1['internship_id']." ORDER BY internshipstable.title";
$result=mysqli_query($connection,$que);
    while($row=mysqli_fetch_assoc($result)){
        if($row['email']!=$email){
        $posted1[]=$row; 
        }
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

                    <a class="navbar-brand " href="Home.html">INTERNS!</a>
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
        <a href="#post"><button class="btn btn-success col-xs-12 col-sm-3">Post a New Internship</button></a>
        
        <a href="#track"><button class="btn btn-success col-xs-12 col-sm-4 col-sm-push-2">Track applicant's for an existing internship</button></a>    

        </div>
        <div class="row" id="post">
            
            <div class="col-xs-6 col-xs-push-3" style="border:1px ridge">
                  <h1 >Post a New Internship!</h1>
                  <form class="form-horizontal" action="<?php echo "postintern.php?email=".$email  ?>" role="form" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <div class="col-xs-12">
                              <input type="text" id="title" name="title" class="form-control" placeholder="Title or Position">
                          </div>
                          
                      </div>
                      <div class="form-group">
                        
                        <div class="col-xs-6">
                            <label for="sd">Start Date:</label>
                            <input type="date" id="sd" class="form-control " name="start">
                            
                        </div>
                        <div class="col-xs-6">
                            <label for="ab">Apply By:</label>
                            <input type="date" id="ab" class="form-control " name="apply" >
                            
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-6">
                            <input type="number" placeholder="Duration in months" id="dur" class="form-control" name="dur">
                        </div>
                        <div class="col-xs-6">
                            <input type="number" placeholder="Stipend in Rupees" id="stipend" class="form-control" name="stipend">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-12">
                            <textarea class="form-control" id="description" style="height:100px" placeholder="Description about the position" name="description"></textarea>
                        </div>
                      
                      </div>
                      <div class="col-xs-12 col-xs-push-4">
                        <input type="submit" class="btn btn-success" name="Submit" value="POST!!">
                      </div>
                  </form>
                </div>
            
        
        </div>
        <p>  </p>
        <div class="row">
            <div class="col-xs-9 col-xs-push-2" style="border:1px ridge">
                <h1 id="track">Applications Received</h1>
                <div class="col-xs-1" style="border:1px ridge">
                <p><strong>No.</strong></p>
                </div>
            
                <div class="col-xs-3" style="border:1px ridge">
                      <p><strong>Title</strong></p>
                </div>
                <div class="col-xs-3" style="border:1px ridge">
                      <p><strong>Name</strong></p>
                </div>
                <div class="col-xs-5" style="border:1px ridge">
                      <p><strong>E-mail</strong></p>
                </div>
                

                <?php for($c=0;$c<count($posted1);$c++){   ?>
                
                <div class="col-xs-1" style="border:1px ridge">
                      <p><?php echo $c+1 ; ?></p>
                </div>
                <div class="col-xs-3" style="border:1px ridge">
                      <p><?php echo $posted1[$c]['title'];      ?></p>
                </div>
                <div class="col-xs-3" style="border:1px ridge">
                      <p><?php echo $posted1[$c]['firstname']." ". $posted1[$c]['lastname']; ?></p>
                </div>
                <div class="col-xs-5" style="border:1px ridge">
                      <p><?php echo $posted1[$c]['email']   ?></p>
                </div>
                
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>