<!DOCTYPE html>
<html>
<head>
	<title>Try</title>
</head>
<body>

	<?php
		if(isset($_POST['btn']))
		{
			echo $_POST['date'];
			echo $_POST['dur'];
		}
		$imgNumber = rand(0,1);
		echo $imgNumber;
	?>
	<form role= "form" class="form-group" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		<label for="Choice">Service or product :</label>
		<input class="form-control signform" id="Choice" type="text"  name="">
		<label for = "Value">value  :</label>
		<input type="text" id="Value" class="form-control signform" name="">
		<label for="sel1">Select list:</label>
		<select class="form-control durationlist selectpicker" name="dur">
			<option class="durationlistelement">Annual</option>
			<option class="durationlistelement">Monthly</option>
			<option class="durationlistelement">Daily</option>
			<option class="durationlistelement">Each hour</option>
		</select>
		<label for = "date">Date Started :</label>
		<input type="datetime-local" value="now" id="date" class="form-control signform" name="date">
		<button type="submit" name="btn">Go</button>
	</form>
</body>
</html>