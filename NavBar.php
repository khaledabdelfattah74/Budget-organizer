<?php
if(isset($_GET['logout']))
{
  session_destroy();
  redirect("/index.php");
}
?>
<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarcontent" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo" href="index.php"><i class="fa fa-briefcase" aria-hidden="true"></i>
       Ma7faztk</a>
     </div>

     <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse navbar-right" id="navbarcontent">
      <ul class="nav navbar-nav">
        <li <?php if(htmlspecialchars($_SERVER["PHP_SELF"]) == '/News.php') echo 'class="active"';  ?> ><a href="News.php">
          <i class="fa fa-newspaper-o" aria-hidden="true"></i> News</a></li>
          <?php 
          if(isset($_SESSION['logged']))
          {
            echo "<li ";if(htmlspecialchars($_SERVER["PHP_SELF"]) == '/Budgets.php' || htmlspecialchars($_SERVER["PHP_SELF"]) == '/BudgetDuration.php') echo 'class="active"';  echo '><a href="Budgets.php">
            <i class="fa fa-envelope" aria-hidden="true"></i> budgets</a></li>
            <li><a href="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?logout">Logout</a></li><li ';if(htmlspecialchars($_SERVER["PHP_SELF"]) == '/EditProfile.php') echo 'class="active"';  echo '><a href="EditProfile.php">
             EditProfile</a></li>'; 
             /*
            if(isset($_SESSION['admin']))
            {
              echo '<li ';if(htmlspecialchars($_SERVER["PHP_SELF"]) == '/NewsInputForAdmins.php') echo 'class="active"';echo '><a href="/NewsInputForAdmins.php">Add News</a></li><li ';if(htmlspecialchars($_SERVER["PHP_SELF"]) == '/AddAdmins.php') echo 'class="active"';echo '><a href="/AddAdmins.php">Add Admins</a></li>'; 
            }*/

          }
          else
          {
            echo "<li  ";if(htmlspecialchars($_SERVER["PHP_SELF"]) == '/SignUp.php')echo 'class="active"';echo '><a href="SignUp.php">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Sign up</a></li>
            <li  ';if(htmlspecialchars($_SERVER["PHP_SELF"]) == '/SignIn.php') echo 'class="active"';echo' ><a href="SignIn.php">
              <i class="fa fa-sign-in" aria-hidden="true"></i> Sign in<span class="sr-only">(current)</span></a></li>';
            }
            ?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="ContactUs.php">Contact us</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/About.php">About</a></li>
              </ul>
            </li>
          </ul>
          <?php
          if(isset($_SESSION['admin']))
            {
         echo' <ul class="nav navbar-nav navbar-right adminDropList">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Control Panal<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/AddAdmins.php">set admins</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/NewsInputForAdmins.php">Add News</a></li>
              </ul>
            </li>
          </ul>';
        }
          ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
    