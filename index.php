<?php
  include "Meta-PHP.php";
  if(isset($_SESSION['logged']))
  {
    $htmlData["leftTitle"] = "Change your profile";
    $htmlData["leftButton"] = "EditProfile";
    $htmlData["leftHerf"] = "/EditProfile.php";
    $htmlData["midTitle"] = "Hello";
    $htmlData["midButton"] = "My Budgets";
    $htmlData["midHerf"] = "/Budgets.php";
  }
  else
  {
    $htmlData["leftTitle"] = "A new commer?";
    $htmlData["leftButton"] = "Sign Up";
    $htmlData["leftHerf"] = "/SignUp.php";
    $htmlData["midTitle"] = "Old here?";
    $htmlData["midButton"] = "Sign In";
    $htmlData["midHerf"] = "/SignIn.php";
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href=fonts/DroidSans-Bold.ttf" rel="stylesheet">
  <link href=fonts/DroidSans.ttf" rel="stylesheet">
  <link href="fonts/Lobster-Regular.ttf" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet"  href="css/styles.css">
  <title>Budget Organizer</title>
  </head>
<body>
<?php
  if(isset($_GET['logout']))
  {
    session_destroy();
    redirect("/index.php");
  }
  //include 'NavBar.php';
?>
<section class="welcome">
    <div class="container"> 
        <div class="row">
          <div class=" welcomeheader">
           <h1 class="text-center">
              Welcome to Your finances manager <br><span>Ma7fztak</span>  
            </h1>
          </div>
       </div>
        <div class="row">
          <div class="col-md-3 text-center welcomebuttons center-block">
            <h2><?php echo $htmlData['leftTitle']; ?></h2>
            <a href="<?php echo $htmlData['leftHerf']; ?>"><button class="btn btn-default form-control" href=""><?php echo $htmlData['leftButton']; ?></button></a>
          </div>
          <div class="col-md-1 visible-lg visible-md">
            </div>
          <div class="col-md-4 text-center center-block welcomebuttons">
            <h2><?php echo $htmlData['midTitle']; ?></h2>
            <a href="<?php echo $htmlData['midHerf']; ?>"><button class="btn btn-default form-control" href=""><?php echo $htmlData['midButton']; ?></button></a>
          </div>
          <div class="col-md-1 visible-lg visible-md">
            </div>
          <div class="col-md-3 text-center  center-block welcomebuttons">
            <h2>What's new?</h2>
            <a href="News.php"><button class="btn btn-default form-control" href="">News</button></a>
          </div>

        </div>
    </div>
</section>




 <script src="js/html5shiv.min.js"></script>
 <script src="js/respond.min.js"></script>
<script src="js/jquery-3.1.1.min.js"> </script>
 <script src="js/bootstrap.min.js"></script>

</body>

</html>
