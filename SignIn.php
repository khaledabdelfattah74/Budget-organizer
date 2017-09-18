<?php
include "Meta-PHP.php";
include "myBudgetDataBase.php";

if(isset($_SESSION['logged']))
	redirect("/Budgets.php");
?>
<!DOCTYPE html>
<html>
<head>
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
		//include "UpdateBudget.php";
		if(isset($_POST['signIn'])) 
		{
			$user = checkUser($_POST["username"], $_POST["password"]);
			if($user === 'wrongPassword')
			{
				$wrongPassword = true;
			}
			else if ($user === 'wrongUserName')
			{
				$wrongUserName = true;
			}
			else 
			{	
				if($user['isAdmin'])
					$_SESSION['admin'] = true;
				$_SESSION['logged'] = true;
				$_SESSION['userID'] = $user['ID'];
				updateUser($user['ID']);
				redirect("/Budgets.php");
			}
		}
		?>

		<section>
			<div class="container">
				<div class="row">
					<div class=" loginformheader">
						<h1 class="text-center">
							<i class="fa fa-user" aria-hidden="true"></i> Welcome To our site 
						</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-7  loginform " >
						<h1 class="text-center">Sign in</h1>
						<form role= "form" class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<label for="loginuser">Username  : <span class="labelwarn"><?php if(isset($wrongUserName) && $wrongUserName){ echo"There isnt any user with this username!!"; $wrongUserName = false; } ?></span></label>
							<input class="form-control signform" id="loginuser" type="text"  name="username">
							<label for = "loginpass">Password  : <span class="labelwarn"><?php if(isset($wrongPassword) && $wrongPassword){ echo"Wrong Password"; $wrongPassword = false; } ?></label>
							<input type="password" id="loginpass" class="form-control signform" name="password">
							<input type="submit" value="Login" name="signIn" class=" btn btn-success form-control submitbutton loginelement" >
						</form>
					</div>
					<div class="col-md-1 visible-md visible-lg" >
					</div>
					<div class="col-md-4 forgotform " >
						<h1 class="text-center">Forgot password?</h1>
						<p class="lead text-center">We can send your password to your mail just enter it.</p>
						<form role= "form" class="form-group">
							<label for="forgot">E-mail  :</label>
							<input class="form-control signform" id="forgot" type="text"  name="">
							<input type="submit" value="Send" name="" class=" btn btn-success form-control submitbutton loginelement" >
						</form>
					</div>
				</div>
			</div>
		</section>





		<script src="js/html5shiv.min.js"></script>
		<script src="js/respond.min.js"></script>
		<script src="js/jquery-3.1.1.min.js">	</script>
		<script src="js/bootstrap.min.js"></script>
	</body>
	</html>