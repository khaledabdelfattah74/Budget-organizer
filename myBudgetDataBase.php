<?php
//include_once ("Database.php");
/* "Every" Duration :
Year   : Y
Month  : M
//Week   : W
Day    : D
Hour   : H
Minute : m
*/
/* "Gender"
Male
Female
Unkown
*/
function setadmin($id)
{
	$sql = "UPDATE userstable SET isAdmin = 1 WHERE ID = $id";
	db_query($sql);
}
function removeadmin($id)
{
	$sql = "UPDATE userstable SET isAdmin = 0 WHERE ID = $id";
	db_query($sql);
}
function getAllUsers()
{
	$usersdb = db_query("SELECT * FROM userstable");
	while($x = db_fetch_assoc($usersdb))
	{
		$users[] = $x;
	}
	return $users;
}
function getBudgetSpentsByID($budgetID)
{
	$spentsdb = db_query("SELECT * FROM spentstable WHERE BudgetID = $budgetID ORDER BY Datepuhrcased DESC");
	while($x = db_fetch_assoc($spentsdb))
	{
		$spents[] = $x;
	}
	return $spents;
}
function getBudgetIncomesScheduleByID($budgetID)
{
	$incomesScheduledb = db_query("SELECT * FROM incomesscheduletable WHERE BudgetID = $budgetID ORDER BY DateCreated DESC");
	while($x = db_fetch_assoc($incomesScheduledb))
	{
		$incomesSchedule[] = $x;
	}
	return $incomesSchedule;	
}
function getBudgetSpentsScheduleByID($budgetID)
{
	$spentsScheduledb = db_query("SELECT * FROM spentsscheduletable WHERE BudgetID = $budgetID ORDER BY DateCreated DESC");
	while($x = db_fetch_assoc($spentsScheduledb))
	{
		$spentsSchedule[] = $x;
	}
	return $spentsSchedule;	
}
function getBudgetIncomesByID($budgetID)
{
	$incomesdb = db_query("SELECT * FROM incomestable WHERE BudgetID = $budgetID ORDER BY DateCreated DESC");
	while($x = db_fetch_assoc($incomesdb))
	{
		$incomes[] = $x;
	}
	return $incomes;
}
function setDefBudgetOf_To($userID, $budgetID)
{
	$sql = "UPDATE userstable SET DefaultBudgetID = $budgetID WHERE ID = $userID";
	db_query($sql);
}
function getUserByBudgetID($budgetID)
{
	$budget = getBudgetByID($budgetID);
	$user = getUserByID($budget['UserID']);
	return $user;
}
function getUserByID($id)
{
	$sql = "SELECT * FROM userstable WHERE ID = $id";
	$userdb = db_query($sql);
	$user = db_fetch_assoc($userdb);
	return $user;
}
function getBudgetByID($id)
{
	$sql = "SELECT * FROM budgetstable WHERE ID = $id";
	$budgetdb = db_query($sql);
	$budget = db_fetch_assoc($budgetdb);
	return $budget;
}
function getBudgetsByUserID($id)
{
	$sql = "SELECT * FROM budgetstable WHERE UserID = $id";
	$budgetsdb = db_query($sql);
	while($x = db_fetch_assoc($budgetsdb))
	{
		$budgets[] = $x;
	}
	return $budgets;
}
function deleteAllBudgetsByUserID($id)
{
	db_query("DELETE FROM budgetstable WHERE UserID = $id");
	$sql = "UPDATE userstable SET DefaultBudgetID = 0 WHERE ID = $id";
	db_query($sql);
}
function deleteBudgetsByID($id)
{
	$user = getUserByBudgetID($id);
	db_query("DELETE FROM budgetstable WHERE ID = $id");
	if($id == $user['DefaultBudgetID'])
	{
		$userBugdets = getBudgetsByUserID($user['ID']);
		if(isset($userBugdets[0]['ID']))
		{
			$userFirstBudget = $userBugdets[0]['ID'];
		}
		else
		{
			$userFirstBudget = 0;
		}
		$sql = "UPDATE userstable SET DefaultBudgetID = $userFirstBudget WHERE ID = ".$user['ID'];
		db_query($sql);
	}
}
function addBudget($BudgetName, $startedMoney, $userID)
{
	$budgetsdb =  db_query("SELECT * FROM budgetstable WHERE UserID = $userID AND BudgetName = '$BudgetName'");
	if(db_num_rows($budgetsdb) < 1 && $startedMoney >= 0)
	{
		$sql = "INSERT INTO budgetstable (BudgetName, UserID, Money, StartedMoney) VALUES ('$BudgetName', '$userID', '$startedMoney', '$startedMoney')";
		db_query($sql);
		$sql = "SELECT * FROM budgetstable WHERE UserID = $userID AND BudgetName = '$BudgetName'";
		$budgetdb = db_query($sql);
		$budget = db_fetch_assoc($budgetdb);
		$sql = "UPDATE userstable SET DefaultBudgetID = ".$budget['ID']." WHERE ID = $userID";
		db_query($sql);
		return true;
	}
	else
	{
		return false;
	}
}
function addIncome($source,$amount,$budgetID, $date = "")
{
	$budget = getBudgetByID($budgetID);
	$budgetMoney = $amount + $budget['Money'];
	$incomeMoney = $amount + $budget['Income'];
	$sql = "UPDATE budgetstable SET Money = $budgetMoney WHERE ID = $budgetID";
	db_query($sql);
	$sql = "UPDATE budgetstable SET Income = $incomeMoney WHERE ID = $budgetID";
	db_query($sql);
	if($date == "")
	{
		$sql = "INSERT INTO incomestable (Source, Amount, BudgetID) VALUES ('$source', '$amount', '$budgetID')";
		db_query($sql);
	}
	else
	{
		$sql = "INSERT INTO incomestable (Source, Amount, BudgetID, DateCreated) VALUES ('$source', '$amount', '$budgetID', '$date')";
		db_query($sql);
	}
}
function getCatByName_Of($catName, $userID)
{
	$catdb = db_query("SELECT * FROM categoriestable WHERE UserID = $userID AND Name = '$catName'");
	if(db_num_rows($catdb) < 1)
	{
		$sql = "INSERT INTO categoriestable (Name, UserID) VALUES ('$catName', '$userID')";
		db_query($sql);
		$catdb = db_query("SELECT * FROM categoriestable WHERE UserID = $userID AND Name = '$catName'");
	}
	$cat = db_fetch_assoc($catdb);
	return $cat;
}
function getSubCatByName_Of($subCatName, $catID)
{
	$subCatdb = db_query("SELECT * FROM subcategoriestable WHERE CatID = $catID AND Name = '$subCatName'");
	if(db_num_rows($subCatdb) < 1)
	{
		$sql = "INSERT INTO subcategoriestable (Name, CatID) VALUES ('$subCatName', '$catID')";
		db_query($sql);
		$subCatdb = db_query("SELECT * FROM subcategoriestable WHERE CatID = $catID AND Name = '$subCatName'");
	}
	$subCat = db_fetch_assoc($subCatdb);
	return $subCat;
}
function getProductByName_Of($productName, $subCatID, $price)
{
	$productdb = db_query("SELECT * FROM productstable WHERE SubCatID = $subCatID AND Name = '$productName'");
	if(db_num_rows($productdb) < 1)
	{
		$sql = "INSERT INTO productstable (Name, SubCatID) VALUES ('$productName', '$subCatID')";
		db_query($sql);
		$productdb = db_query("SELECT * FROM productstable WHERE SubCatID = $subCatID AND Name = '$productName'");
	}
	$product = db_fetch_assoc($productdb);
	return $product;
}
function addSpent($catName, $subCatName, $productName, $price, $quantitiy, $budgetID, $date = "")
{
	$user = getUserByBudgetID($budgetID);
	$budget = getBudgetByID($budgetID);
	$budgetMoney = $budget['Money'] - $price*$quantitiy;
	$spentMoney = $price*$quantitiy + $budget['Spent'];

	$sql = "UPDATE budgetstable SET Money = '$budgetMoney' WHERE ID = $budgetID";
	db_query($sql);
	$sql = "UPDATE budgetstable SET Spent = '$spentMoney' WHERE ID = $budgetID"; 
	db_query($sql);

	$cat = getCatByName_Of($catName, $user['ID']);
	$subCat = getSubCatByName_Of($subCatName, $cat['ID']);
	$product = getProductByName_Of($productName, $subCat['ID'],$price);

	$productWasBought = $product['wasBought'];
	$productWasBought++;
	$sql = "UPDATE productstable SET wasBought = $productWasBought WHERE ID = ".$product['ID'];
	db_query($sql);
	if($date === "")
	{
		$sql = "INSERT INTO spentstable (ProductID, Price, Quantitiy, BudgetID) VALUES ('".$product['ID']."', '$price', '$quantitiy', '$budgetID')";
	}
	else
	{
		$sql = "INSERT INTO spentstable (ProductID, Price, Quantitiy, BudgetID, Datepuhrcased) VALUES ('".$product['ID']."', '$price','$quantitiy', '$budgetID', '$date')";	
	}
	db_query($sql);
}
function getCatByID($id)
{
	$catdb = db_query("SELECT * FROM categoriestable WHERE ID = $id");
	$cat = db_fetch_assoc($catdb);
	return $cat;
}
function getSubCatByID($id)
{
	$subCatdb = db_query("SELECT * FROM subcategoriestable WHERE ID = $id");
	$subCat = db_fetch_assoc($subCatdb);
	return $subCat;
}
function getProductByID($id)
{
	$productdb = db_query("SELECT * FROM productstable WHERE ID = $id"); 
	$product = db_fetch_assoc($productdb);
	return $product;
}
function updateProfileByID($userID, $firstName, $lastName, $email, $age, $password, $repassword, $currentPassword)
{
	$user = db_query("SELECT * FROM userstable WHERE ID = '$userID' AND Password = Password('$password')");
	if(isset($user['ID']))
	{
		if($firstName != "")
		{
			db_query("UPDATE userstable SET Firstname = '$firstName' WHERE ID = $userID");
		}
		if($lastName != "")
		{
			db_query("UPDATE userstable SET Lastname = '$lastName' WHERE ID = $userID");
		}
		if($email != "")
		{
			db_query("UPDATE userstable SET Email = '$email' WHERE ID = $userID");
		}
		if($age != "")
		{
			db_query("UPDATE userstable SET Age = $age WHERE ID = $userID");
		}
		if($password != "" && $password == $repassword)
		{
			db_query("UPDATE userstable SET Password = PASSWORD('$password') WHERE ID = $userID");
		}
		return true;
	}
	else
	{
		return false;
	}
}
function getAllNews()
{
	$dbnews = db_query("SELECT * FROM newstable ORDER BY DateCreated DESC");
	while($x = db_fetch_assoc($dbnews))
	{
		$news[] = $x;
	}
	return $news;
}
function addNew($title, $tobic, $imgUrl, $author = "Admin")
{
	$sql = "INSERT INTO newstable (Title, Tobic, ImgUrl, Author) VALUES ('$title', '$tobic', '$imgUrl', '$author')";
	db_query($sql);
}
function getUserByUserName($userName)
{
	$sql = "SELECT * FROM userstable WHERE Username = '$userName'";
	$userdb = db_query($sql);
	$user = db_fetch_assoc($userdb);
	return $user;
}
function getUserByEmail($email)
{
	$sql = "SELECT * FROM userstable WHERE Email = '$email'";
	$userdb = db_query($sql);
	$user = db_fetch_assoc($userdb);
	return $user;
}
function addUser($firstName, $lastName, $userName, $email, $birthDate, $gender, $password, $repassword)
{
	if(!($password == $repassword))
	{
		return 'wrongPassword';
	}
	$nameCheck = getUserByUserName($userName);
	if (isset($nameCheck['ID']))
	{
		return 'wrongUserName';
	}
	$emailCheck = getUserByEmail($email);
	if (isset($emailCheck['ID']))
	{
		return 'wrongEmail';
	}
	$sql = "INSERT INTO userstable (Username, Firstname, Lastname, Email, BirthDay, Gender, Password) VALUES ('$userName', '$firstName', '$lastName', '$email', '$birthDate', '$gender', PASSWORD('$password'))";
	db_query($sql);
	$user = getUserByUserName($userName);
	return $user;
}
function checkUser($userName, $password)
{
	$user = getUserByUserName($userName);
	if (!isset($user['ID']))
	{
		return 'wrongUserName';
	}
	$user = db_query("SELECT * FROM userstable WHERE Username = '$userName' AND Password = PASSWORD('$password')");
	$user = db_fetch_assoc($user);
	if(!isset($user['ID']))
	{
		return 'wrongPassword';
	}
	else 
	{	
		return $user;
	}
}
function getSpentByID($id)
{
	$spentdb = db_query("SELECT * FROM spentstable WHERE ID = $id");
	$spent = db_fetch_assoc($spentdb);
	return $spent;
}
function getIncomeByID($id)
{
	$incomedb = db_query("SELECT * FROM incomestable WHERE ID = $id");
	$income = db_fetch_assoc($incomedb);
	return $income;
}
function deleteSpentByID($id)
{
	$spent = getSpentByID($id);
	if(isset($spent['ID']))
	{
		$budget = getBudgetByID($spent['BudgetID']);
		$budgetMoney = $budget['Money'] + $spent['Price'];
		$spentMoney = $budget['Spent'] - $spent['Price'];
		$sql = "UPDATE budgetstable SET Money = '$budgetMoney' WHERE ID = ".$budget['ID'];
		db_query($sql);
		$sql = "UPDATE budgetstable SET Spent = '$spentMoney' WHERE ID = ".$budget['ID']; 
		db_query($sql);

		$product = getProductByID($spent['ProductID']);
		$productWasBought = $product['wasBought'];
		$productWasBought--;
		$sql = "UPDATE productstable SET wasBought = $productWasBought WHERE ID = ".$product['ID'];
		db_query($sql);

		db_query("DELETE FROM spentstable WHERE ID = $id");
	}
}
function deleteIncomeByID($id)
{
	$income = getIncomeByID($id);
	if(isset($income['ID']))
	{
		$budget = getBudgetByID($income['BudgetID']);
		$budgetMoney = $budget['Money'] - $income['Amount'];
		$incomeMoney = $budget['Income'] - $income['Amount'];
		$sql = "UPDATE budgetstable SET Money = $budgetMoney WHERE ID = ".$budget['ID'];
		db_query($sql);
		$sql = "UPDATE budgetstable SET Income = $incomeMoney WHERE ID = ".$budget['ID'];
		db_query($sql);
		
		db_query("DELETE FROM incomestable WHERE ID = $id");
	}
}
function durationformat($diff)
{
	$duration['Y'] = date_interval_format($diff,"%y");
	$duration['M'] = date_interval_format($diff,"%m") + $duration['Y'] * 12;
	$duration['D'] = date_interval_format($diff,"%a");
	$duration['H'] = date_interval_format($diff,"%h") + $duration['D'] * 24;
	$duration['m'] = date_interval_format($diff,"%i") + $duration['H'] * 60;
	return $duration;
}
function updateUser($userID)
{
	$durationName  = array('m' => "minutes",'H' => "hours", 'D' => "days", 'M' => 'mounths', 'Y' => "years");
	$dateToday = date_create_from_format("Y-m-d H:i:s",date("Y-m-d H:i:s"));
	$budgets =  getBudgetsByUserID($userID);
	for ($i=0; $i < sizeof($budgets); $i++) { 
		$budget = $budgets[$i];
		$budgetID = $budget['ID'];
		$incomesSchedule = getBudgetIncomesScheduleByID($budgetID);
		for ($j=0; $j < sizeof($incomesSchedule); $j++) { 
			$incomeShd = $incomesSchedule[$j];
			$dateStarted = date_create($incomeShd['StartDate']);
			$incomeShdID = $incomeShd['ID'];
			$every = $incomeShd['Every'];
			$times = $incomeShd['Times'];
			$source = $incomeShd['Source'];
			$amount = $incomeShd['Amount'];
			$diff = date_diff($dateStarted,$dateToday);
	 			//echo "</br>"."Started Date : ".date_format($dateStarted,"Y/m/d H:i:s")."</br>";
	 			//echo date_interval_format($diff,"%R %Y/%m/%d %H:%i:%s");
			$duration = durationformat($diff);
			while($duration["$every"] >= $times)
			{
				date_add($dateStarted,date_interval_create_from_date_string("$times ".$durationName["$every"]));
	 				//echo "</br>"."Started Date : ".date_format($dateStarted,"Y/m/d H:i:s")."</br>";
				$diff=date_diff($dateStarted,$dateToday);
				$duration = durationformat($diff);
				$dateStartedFormated = date_format($dateStarted,"Y/m/d H:i:s");
				addIncome($source,$amount,$budgetID,$dateStartedFormated);
				db_query("UPDATE incomesscheduletable SET StartDate = '$dateStartedFormated' WHERE ID = $incomeShdID");
			}
		}
		$spentsSchedule = getBudgetSpentsScheduleByID($budgetID);
		for ($j=0; $j < sizeof($spentsSchedule); $j++) { 
			$spentShd = $spentsSchedule[$j];
			$dateStarted = date_create($spentShd['StartDate']);
			$spentShdID = $spentShd['ID'];
			$every = $spentShd['Every'];
			$times = $spentShd['Times'];
			$price = $spentShd['Price'];
			$product = getProductByID($spentShd['ProductID']);
			$subCat = getSubCatByID($product['SubCatID']);
			$cat = getCatByID($subCat['CatID']);
			$productName = $product['Name'];
			$subCatName = $subCat['Name'];
			$catName = $cat['Name'];
			$diff = date_diff($dateStarted,$dateToday);
			//echo "</br>"."Started Date : ".date_format($dateStarted,"Y/m/d H:i:s")."</br>";
			//echo date_interval_format($diff,"%R %Y/%m/%d %H:%i:%s");
			$duration = durationformat($diff);
			while($duration["$every"] >= $times)
			{
				date_add($dateStarted,date_interval_create_from_date_string("$times ".$durationName["$every"]));
				//echo "</br>"."Started Date : ".date_format($dateStarted,"Y/m/d H:i:s")."</br>";
				$diff=date_diff($dateStarted,$dateToday);
				$duration = durationformat($diff);
				$dateStartedFormated = date_format($dateStarted,"Y-m-d H:i:s");
				addSpent($catName, $subCatName, $productName, $price,1, $budgetID, $dateStartedFormated);
				db_query("UPDATE spentsscheduletable SET StartDate = '$dateStartedFormated' WHERE ID = $spentShdID");
			}
		}
	}
}
function deleteIncomeScheduleByID($id)
{
	db_query("DELETE FROM incomesscheduletable WHERE ID = $id");
}
function deleteSpentScheduleByID($id)
{
	db_query("DELETE FROM spentsscheduletable WHERE ID = $id");	
}
function addIncomeSchedule($source, $amount, $budgetID, $every, $times, $startDate)
{
	$sql = "INSERT INTO incomesscheduletable (Source, Amount, BudgetID, Every, Times, StartDate) VALUES ('$source', '$amount', '$budgetID', '$every', '$times', '$startDate')";
	db_query($sql);
}
function addSpentSchedule($catName, $subCatName, $productName, $price, $budgetID, $every, $times, $startDate)
{
	$user = getUserByBudgetID($budgetID);
	// Put the Category if it doesn't exist
	$cat = getCatByName_Of($catName, $user['ID']);
	$subCat = getSubCatByName_Of($subCatName, $cat['ID']);
	$product = getProductByName_Of($productName, $subCat['ID'],$price);
	$sql = "INSERT INTO spentsscheduletable (ProductID, Price, BudgetID, Every, Times, StartDate) VALUES ('".$product['ID']."', '$price', '$budgetID', '$every', '$times', '$startDate')";
	db_query($sql);
}
function getAcceptedOpinions()
{
	$sql = "SELECT * FROM opinionstable WHERE State = 1";
	$opinionsdb = db_query($sql);
	while ($x = db_fetch_assoc($opinionsdb)) {
		$opinions[] = $x;
	}
	return $opinions;
}
function deleteUserByID($id)
{
	$sql = "DELETE FROM userstable WHERE ID = $id";
	db_query($sql);
}
function addOpinion($name, $gender, $opinion)
{
	$imagesCount = 2;
	$imgNumber = rand(0,$imagesCount-1);
	$sql = "INSERT INTO opinionstable (Name, Gender, ImgNumber, Opinion) VALUES ('$name', '$gender', '$imgNumber', '$opinion')";
	db_query($sql);
}
?>