<?php
include "Meta-PHP.php";
include "myBudgetDataBase.php";
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
  include("NavBar.php");
  function printANew($new)
  {
    echo '<div class="col-md-7 col-xs-12 newsheader">
            <p class="lead modifier"><strong>Last modified</strong> , '.$new["DateCreated"].'.</p>
            <div class="center-block newsimagecontainer">
              <img src="'.$new["ImgUrl"].'" class="center-block newsimage"/>
            </div>
            <h1 class="text-center">'.$new["Title"].'</h1>
            <p class="lead text-center">'.$new["Tobic"].'</p>
          </div>';
  }
  ?>
  <section class="headers">
    <div class="container">
      <h1 class="text-center">What's new?</h1>
      <div class="row">
        <?php
        $news = getAllNews();
        printANew($news[0]);
        ?>
        <div class="col-md-4 col-xs-12 sidenews">
          <div class="center-block newsimagecontainer">
            <img src="images/broke.jpg" class="newsimage">
          </div>
          <h3 class="text-center">Borke?</h3>	
          <p class="lead text-center newstext ">Don't ever let that happen to you .The first feature you want to have is here now you can create your own budgets and watch your finances</p>
        </div>
        <div class="col-md-4 col-xs-12 sidenews">
         <div class="center-block newsimagecontainer">
          <img src="images/alarm.jpg" class="newsimage">
        </div>
        <h3 class="text-center">Time is money</h3>	
        <p class="lead text-center newstext ">A newly included feature is that you can make temprary budgets. Temprary budgets allows you to manage others money too. More to come, stay tuned.</p>		
      </div>
      <?php

      for($i = 1;$i < sizeof($news);$i++)
      {
        printANew($news[$i]);
      }

      ?>
    </div>
  </div>

  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/jquery-3.1.1.min.js">	</script>
  <script src="js/bootstrap.min.js"></script>
</section>
</body>
</html>