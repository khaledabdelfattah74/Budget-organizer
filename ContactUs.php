<?php
include "Meta-PHP.php";
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
<body class = "contactUs">
<?php
include("NavBar.php");
?>    
 <div class="container">
 <div id="userOpinions" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active text-center">
      <p class="lead">This is Khaled <br>Email : </p></p>
        <h3>Khaled</h3>
      </div>
    <div class="item text-center">
     <p class="lead">This is Abdelrahman Ibrahim Soliman <br>Email :a_ibrahim_7@yahoo.com</p>
        <h3>Abdelrahman</h3>
    </div>
    <div class="item text-center">
        <p class="lead">This is Ayman <br>Email : </p>
        <h3>Ayman</h3>
          </div>
    <ol class="carousel-indicators" />
    <li data-target="#userOpinions" data-slide-to="0" class="active">
      <img src="images/avatar3.jpg" />
    </li>
    <li data-target="#userOpinions" data-slide-to="1">
      <img src="images/avatar1.jpg" />
    </li>
    <li data-target="#userOpinions" data-slide-to="2">
      <img src="images/avatar2.jpg" />
    </li>
  </ol>
  </div>
</div>
  <div class="row">
    <div class = "col-md-8 col-md-offset-2  col-xs-12 Aboutbox text-center">
      <h1>Contact Us</h1>
      <p class = "lead">We are very happy to present to you this web-based application. If you need any help feel confortable to contact us . Emails are int the section above . We will try to respond as soon as possible.</p>
      </div>
    </div>
 <script src="js/html5shiv.min.js"></script>
 <script src="js/respond.min.js"></script>
<script src="js/jquery-3.1.1.min.js"> </script>
 <script src="js/bootstrap.min.js"></script>
</body>

</html>
