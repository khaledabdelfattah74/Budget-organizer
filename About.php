<?php
include("Meta-PHP.php");
include "myBudgetDataBase.php";
if(isset($_POST["AddOpinion"]))
{
  $userID = $_SESSION['userID'];
  $user = getUserByID($userID);
  addOpinion($user['Firstname']." ".$user['Lastname'], $user['Gender'], $_POST['Opinion']);
}
if(isset($_POST["AddAnonymouseOpinion"]))
{
  addOpinion("Annymous", "Unkown", $_POST['Opinion']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="fonts/DroidSans-Bold.ttf" rel="stylesheet">
  <link href="fonts/DroidSans.ttf" rel="stylesheet">
  <link href="fonts/Lobster-Regular.ttf" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet"  href="css/styles.css">
  <title>Budget Organizer</title>
</head>
<body>
  <?php
  include ('NavBar.php');
  ?>    
  <div class="container">
   <div id="userOpinions" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <?php
      $opinions = getAcceptedOpinions();
      for ($i = 0;$i < sizeof($opinions);$i++) {
        $opinion = $opinions[$i];
        echo '<div class="item opinionitem ';
        if($i == 0)
          echo "active";
        echo ' text-center">
        <h2>Users\' opinions</h2>';
        echo '<p class="lead">'.$opinion['Opinion'].'</p>
        <h3>'.$opinion['Name'].'</h3></div>';
      }
      echo '<ol class="carousel-indicators" />';
      for ($i = 0;$i < sizeof($opinions);$i++) {
        $opinion = $opinions[$i];
        echo '
        <li data-target="#userOpinions" data-slide-to="'.$i.'" ';
        if($i == 0)
          echo 'class="active"';
        echo '>
        <img src="images/'.$opinion['Gender'].$opinion['ImgNumber'].'.jpg" />
      </li>';
    }
    echo '</ol>';
    ?>

  </div>
</div>
<div class="row">
  <div class = "col-md-8 col-md-offset-2  col-xs-12 Aboutbox text-center">
    <h1>About</h1>
    <p class = "lead">We are very happy to present to you this web-based application. The main aim of the application is to provide users with information about their finances ,and keep an eye on their payements and saving plans. You can create any number of budgets you want for varies catigories and don't worry we will handle it all. you can view some of other users' opinions above.</p>
  </div>
</div>
<?php if (isset($_SESSION['logged']) && !isset($_SESSION['admin'])): ?>
<div class="row">
  <div class = "col-md-8 col-md-offset-2  col-xs-12 Aboutbox">
    <h1 class="text-center signupfont">Your opinion <i class="fa fa-comments"></i></h1>
    <div class="center-block text-center">
    <form  class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <textarea class="form-control Aboutbox text-center" rows="10" name="Opinion"></textarea>
    <div class="row">
      <input type="submit" class="btn btn-default submitbutton" name="AddOpinion" value="Submit">
      <input type="submit" class="btn btn-default submitbutton" name="AddAnonymouseOpinion" value="Submit Anonymously">
    </div>
    </form> 
  </div>
</div>
<?php endif; ?>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<script src="js/jquery-3.1.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>
