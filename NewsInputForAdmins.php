<?php
  include "Meta-PHP.php";
  include "myBudgetDataBase.php";
  if(!isset($_SESSION['admin']))
    redirect("/News.php");
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
if(isset($_POST['addNews'])) 
{
  addNew($_POST["title"], $_POST["tobic"], $_POST["imgUrl"],"Admin");
  redirect("/News.php");
}
?>
<div class="container"> 
        <div class="row">
          <div class=" Newsinput">
           <h1 class="text-center">
              Update 
            </h1>
            <form class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Enter the title</h2>
            <input type="text" name="title" class="form-control signform">
            <h2>Enter the news</h2>
                <textarea class="form-control signform" name="tobic"></textarea>
          
            <h2>Enter the link of image</h2>
                  <input type="text" name="imgUrl" class="form-control signform">
              <div class="submitbox center-block text-center">  
                <input type="submit" name="addNews" class="btn btn-default" value="Lets update">
              </div>
              </form>
           </div>
       </div>

 <script src="js/html5shiv.min.js"></script>
 <script src="js/respond.min.js"></script>
<script src="js/jquery-3.1.1.min.js"> </script>
 <script src="js/bootstrap.min.js"></script>
</section>
</body>
</html>