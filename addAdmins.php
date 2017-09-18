<?php
include("Meta-PHP.php");
include("myBudgetDataBase.php");
if(!isset($_SESSION['admin']))
  redirect("/index.php" );
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
  <link rel="stylesheet" type="text/css" href="datatables.min.css">
  <link rel="stylesheet"  href="css/styles.css">
  <title>Add Admins</title>
</head>
<body>
  <?php
  include ('NavBar.php');
  
  if(isset($_POST['SetAdmin']))
  {
    setadmin($_POST['UserID']);  
    redirect("/AddAdmins.php");
  }
  if(isset($_POST['DeleteAdmin']))
  {
    removeadmin($_POST['UserID']);
    redirect("/AddAdmins.php");
  }
  if(isset($_POST['DeleteAccount']))
  {
    deleteUserByID($_POST['UserID']);
    redirect("/AddAdmins.php");
  }
  $userID = $_SESSION['userID'];
  ?>

  <div class="col-md center-block col-md-offset-1 budgetslist editForAdmins">
    <h1 class="text-center changeprofconfirm editForAdminsheader">Add Admins</h1>
    <table id="adminsTable" class="table tableincome">
      <thead>
        <tr>
          <th>User Name</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Age</th>
          <th>Data Joined</th>
          <th>Authorities</th>
          <th>Delete Account</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $users = getAllUsers();
        for ($i=0; $i < sizeof($users); $i++) { 
          $user = $users[$i];
          if($user['ID'] != $userID && $user["isAdmin"] != 2)
          {
            $userName = $user["Username"];
            $firstName = $user["Firstname"];
            $lastName = $user["Lastname"];
            $email = $user["Email"];
            $age = $user["Age"];
            $dataJoined = $user["Datejoined"];
            $isAdmin = $user["isAdmin"];
            echo "
            <tr>
              <td scope=\"row\">$userName</td>
              <td >$firstName</td>
              <td>$lastName</td>
              <td>$email</td>
              <td>$age</td>
              <td>$dataJoined</td>
              ";
              echo '<form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
              <td>
              <input type="hidden" name="UserID" value="'.$user['ID'].'">';
              if($isAdmin)
              {
                echo '<button type="submit" class="btn btn-default center-block submitbutton" name="DeleteAdmin">Delete Admin</button>';
              }
              else
              {
                echo '<button type="submit"  class="btn btn-default center-block setbutton submitbutton" name="SetAdmin">Set Admin</button>'; 
              }
              echo '</td><td><button type="submit"  class="btn btn-default center-block setbutton submitbutton" name="DeleteAccount">Delete</button>';
              echo "</form></td></tr>";
            }
            
          }
          ?>
        </tbody>
      </table>
    </div>
    <script src = "jquery.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<script src="js/jquery-3.1.1.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<script src = "jquery.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script>
  $(document).ready(function(){
    $('#adminsTable').DataTable();
          //alert("hii");
      });
 
  </script>

  </body>
  </html>