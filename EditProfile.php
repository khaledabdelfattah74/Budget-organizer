<?php
include "Meta-PHP.php";
include "myBudgetDataBase.php";
if(!isset($_SESSION['logged']))
  redirect("/Budgets.php");
$userID = $_SESSION['userID'];
if(isset($_POST['ChangeProfile']))
{
  if(updateProfileByID($userID, $_POST['FirstName'], $_POST['LastName'], $_POST['Email'], $_POST["Age"], $_POST["Password"], $_POST["RePassword"], $_POST['CurrentPassword']))
  {
    redirect("/EditProfile.php");
  }
  else
  {
    echo "Error updating the profile";
  }
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
  include("NavBar.php");
  $user = getUserByID($userID);
  ?>
  <div class="container"> 
    <div class="row">
      <div class=" Newsinput">
       <div class="row">
        <h1 class="center-block text-center changeprofileheader">Change profile</h1>
        <form class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         <div class = "col-md-6 changeprofile">
           <label for="changefirstname">First name :</label>
           <input type="text" class="signform form-control" id="changefirstname" name="FirstName" value="<?php echo $user['Firstname'];?>">
         </div>
         <div class = "col-md-6 changeprofile">
           <label for="changelastname">Last name :</label>
           <input type="text" class="signform form-control" id="changelastname" name="LastName" value="<?php echo $user['Lastname']; ?>">
         </div>
         <div class = "col-md-6 changeprofile">
           <label for="changepassword">The New Password :</label>
           <input type="text" class="signform form-control" id="changepassword" name="Password">
         </div>
         <div class = "col-md-6 changeprofile">
           <label for="changepassconf">Confirm The New Password :</label>
           <input type="text" class="signform form-control" id="changepassconf" name="RePassword">
         </div>
         <div class = "col-md-6 changeprofile">
           <label for="changeage">Age :</label>
           <input type="text" class="signform form-control" id ="changeage" name="Age" value="<?php echo $user['Age']; ?>">
         </div>
         <div class = "col-md-6 changeprofile">
           <label for="changemail">Email :</label>
           <input type="Email" class="signform form-control" id="changemail" name="Email" value="<?php echo $user['Email']; ?>">
         </div>
         <div class = "col-md-6 changeprofile changeprofconfirm">
           <label for="currentpass">Current Password to confirm :</label>
           <input type="password" class="signform form-control" id="currentpass" name="CurrentPassword">
         </div>
         <div class = "col-md-6 changeprofile">
           <input type="submit" name="ChangeProfile" class="btn btn-default changebutton center-block" value="Save Changes">
         </div>
       </form>
     </div>
   </div>
 </div>
</div>

<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<script src="js/jquery-3.1.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
</section>
</body>
</html>