<?php
include "Meta-PHP.php";
include "myBudgetDataBase.php";
if(isset($_SESSION['logged']))
	redirect("/Budgets.php");
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
	<script type="text/javascript">
		function isNumeric(value) {
			return /^\d+$/.test(value);
		}
		function validateForm() {
			var pass = form.password.value;
			var repass = form.repassword.value;
			var email = form.email.value;
			var fname = form.firstName.value;
			var lname = form.lastName.value;
			var age = form.age.value;
			var uname = form.username.value;
			if (pass != repass) {
				document.getElementById("password", "repassword").innerHTML = " Confirmation for password mismatched ";
				// alert("Confirmation for password mismatched ");
				return false;
			} else if (pass.length == 0 || repass.length == 0) {
				document.getElementById("password", "repassword").innerHTML = " please enter password";
				// alert("mismatch! \n please enter password");
				return false;
			} else if (pass.length < 8) {
				document.getElementById("password").innerHTML = "  password should contain at least 8 characters  ";
				// alert("mismatch! \n password should contain at least 8 characters ");
				return false;
			} else if (email.length == 0) {
				document.getElementById("email").innerHTML = " please enter your Email ";
				// alert("please enter your Email ");
				return false;
			} else if (fname.length == 0) {
				document.getElementById("firstname").innerHTML = " please enter your first name ";
				// alert("please enter your first name ");
				return false;
			} else if (uname.length == 0) {
				document.getElementById("username").innerHTML = " please enter your User name ";
				// alert("please enter your User name ");
				return false;
			} else if (lname.length == 0) {
				document.getElementById("lastname").innerHTML = " please enter your last name ";
				// alert("please enter your last name ");
				return false;
			} else {
				//alert("thank you :D ");
				return true;
			}
		}
	</script>
	
</head>
<body>
	<?php 
	include("NavBar.php");
	if(isset($_POST['Register'])) 
	{
		$birthDate = date_create($_POST['BirthDate']);
		$birthDateformated = date_format($birthDate,"Y-m-d");
		$user = addUser($_POST["firstName"], $_POST["lastName"], $_POST["username"], $_POST["email"], $birthDateformated, $_POST['Gender'], $_POST["password"], $_POST["repassword"]);
		if($user === 'wrongPassword')
		{
			$wrongPassword = true;
		}
		else if ($user === 'wrongUserName')
		{
			$wrongUserName = true;
		}
		else if ($user === 'wrongEmail')
		{
			$wrongEmail = true;
		}
		else
		{	
			$_SESSION['logged'] = true;
			$_SESSION['userID'] = $user['ID'];
			redirect("/Budgets.php");
		}
	}
	?>
	<div class="container">
		<div class="row">
			<div class = "col-md-7  col-sm-12 signupbox">
				<h1 class="text-center signupfont">Sign up</h1> 
				<form name="form" role= "form" class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<label for ="email">Email     : <span class="labelwarn" id = "email"><?php if(isset($wrongEmail) && $wrongEmail){ echo"There exists a user with this Email!!"; $wrongEmail = false; } ?></span></label>
					<input id ="email" type="email" class="form-control signform" name="email">
					<label for ="firstname">First name: <span class="labelwarn" id="firstname"><h6></h6></span></label>
					<input type="text" id ="firstname" class="form-control signform" name="firstName">
					<label for ="lastname">Last  name: <span class="labelwarn" id="lastname"><h6></h6></span></label>
					<input type="text" id ="lastname" class="form-control signform" name="lastName">
					<div class="row">
						<div class ="col-md-6">
							<label for ="age">Date of birth   :</label>
							<input type="date" id ="age" class="form-control signform" max='<?php echo date("Y-m-d"); ?>' name="BirthDate">
						</div>
						<div class ="col-md-6">
							<label for ="gender">Gender   :</label>
							<select value ="choose gender " id="gender" style = "height: 130%" class = "signform center-block form-control " name = "Gender">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Unkown">Not nessecary</option>
							</select>
						</div>
					</div>
					<label for ="user">User  name: <span class="labelwarn" id="username"><?php if(isset($wrongUserName) && $wrongUserName == true){ echo"There exists a user with this Username!!"; $wrongUserName = false; } ?></span></label>
					<input type="text" id ="user" class="form-control signform" name="username">
					<label for ="pass">Password  :<span class="labelwarn" id="password"><h6></h6></span> <span class="labelwarn"><?php if(isset($wrongPassword) && $wrongPassword){ echo"The Passwords aren't identical"; $wrongPassword = false; } ?></span></label>
					<input type="password"  id ="pass" class="form-control signform" name="password">
					<label for ="Conpass">Confirm password:<span class="labelwarn" id="repassword"><h6></h6></span></label>
					<input type="password" id ="Conpass" class="form-control signform" name="repassword">
					<br class="visible-md" />
					<div class="center-block text-center"><input type="submit" onclick="return validateForm()" class="btn btn-default center-block submitbutton" name="Register" value="Get started"><a href="" class = "forgotpassword">Forgot password?</a></div>
					<br class="visible-sm visible-xs" />
				</form>	
			</div>
			<div class = "col-md-4  col-sm-12 features text-center">
				<span class="glyphicon glyphicon-euro"></span>
				<h3>Finances</h3>
				<p class="featurestext">
					Our website aims to handle your finance properly, without exposing any of your data. The application is totally free for any user of any age.
				</p>
				<br class="hidden-md hidden-lg" />
			</div>
			<div class = "col-md-4  col-sm-12 features text-center">
				<span class="glyphicon glyphicon-globe"></span>
				<h3>It's global</h3>
				<p class="featurestext">
					Our website is available for all our users all over the globe. You needen't worry about your finances will abroad .We can handle it.
				</p>
				<br class="hidden-md hidden-lg" />
			</div>
			<div class = "col-md-4 col-lg-4 col-sm-12 features text-center">
				<span class="glyphicon glyphicon-thumbs-up"></span>
				<h3>Very responsive</h3>
				<p class="featurestext">
					Our website is very reponsive and can work on every single possible device. The website has a relaxing interface .
				</p>
				<br class="hidden-md hidden-lg" />
			</div>
		</div>
	</div>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery-3.1.1.min.js">	</script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>