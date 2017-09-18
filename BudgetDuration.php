<?php
include "Meta-PHP.php";
include "myBudgetDataBase.php";
if(!isset($_SESSION['logged']))
	redirect("/SignIn.php");
$userID = $_SESSION['userID'];
updateUser($userID);
function charToDuration($times)
{
	if($times == 'm')
	{
		return "Minutes";
	}
	else if($times == 'H')
	{
		return "Hours";
	}
	else if($times == 'D')
	{
		return "Days";
	}
	else if($times == 'W')
	{
		return "Weeks";
	}
	else if($times == 'M')
	{
		return "Mounths";
	}
	else if($times == 'Y')
	{
		return "Year";
	}
	else
	{
		return "Error";
	}
}
function durationTochar($duration)
{
	if($duration == 'Year')
	{
		return 'Y';
	}
	else if($duration == 'Month')
	{
		return 'M';
	}
	else if($duration == 'Day')
	{
		return 'D';
	}
	else if($duration == 'Hour')
	{
		return 'H';
	}
}
if(isset($_GET['BudgetID']))
{
	setDefBudgetOf_To($userID, $_GET['BudgetID']);	
}
if(isset($_POST['Clearall']))
{
	deleteAllBudgetsByUserID($userID);
	redirect("/Budgets.php");
}
if(isset($_POST['RemoveBudget']))
{
	deleteBudgetsByID($_POST['BudgetID']);
	redirect("/Budgets.php");
}
if(isset($_POST['AddBudget']))
{
	if(addBudget($_POST['BudgetName'], $_POST['StartedMoney'], $userID))
	{
		redirect("/Budgets.php");
	}
	else
	{
		echo "Error adding the budget";
	}
}
if(isset($_POST['AddIncomeSchedule']))
{
	$startDate = date_create($_POST['StartDate']);
	$startDateformated = date_format($startDate,"Y-m-d H:i:s");
	addIncomeSchedule($_POST['Source'], $_POST['Amount'], $_POST['BudgetID'], durationTochar($_POST['Every']), $_POST['Times'], $startDateformated);
	redirect("/BudgetDuration.php");
}
if(isset($_POST['DeleteIncomeSchedule']))
{
	deleteIncomeScheduleByID($_POST['IncomeScheduleID']);
	redirect("/BudgetDuration.php");
}
if(isset($_POST['DeleteSpentSchedule']))
{
	deleteSpentScheduleByID($_POST['SpentScheduleID']);
	redirect("/BudgetDuration.php");
}
if(isset($_POST['AddSpentSchedule']))
{
	$startDate = date_create($_POST['StartDate']);
	$startDateformated = date_format($startDate,"Y-m-d H:i:s");
	addSpentSchedule($_POST['Cat'], $_POST['SubCat'], $_POST['Product'], $_POST['Price'], $_POST['BudgetID'], durationTochar($_POST['Every']), $_POST['Times'], $startDateformated);
	redirect("/BudgetDuration.php");
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
	include ('NavBar.php');
	$user = getUserByID($userID);
	$defBudgetID = $user["DefaultBudgetID"];
	?>
	<div class="container">

		<div class="row">
			<div class="col-md-3 budgetslist">
				<h1>Budgets</h1>
				<div class="row">
					<?php
					$budgets =  getBudgetsByUserID($userID);
					for ($i=0; $i < sizeof($budgets); $i++) { 
						$budget = $budgets[$i];
						echo '<div class="col-md-12 budgetitem ';
						if($defBudgetID == $budget['ID'])
						{
							$defBudget = $budget;
							echo "budgetitemactive";
						}
						echo' text-center"><a href="?BudgetID='.$budget['ID'].'"><h3>'.$budget['BudgetName'].'</h3></a></div>';
					}
					?>
					<div class="row" style="padding-top: 10px">
						<button type="button" class="btn btn-default center-block submitbutton" data-toggle="modal" data-target="#modalbox">Create new</button>
						<!-- Button trigger modal -->


						<!-- Modal -->
						<div class="modal fade" id="modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h2 class="modal-title" id="exampleModalLabel">Create a budget</h2>
									</div>
									<div class="modal-body">
										<form role= "form" class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
											<label for="budgetname">Budget name :</label>
											<input class="form-control signform" id="budgetname" type="text"  name="BudgetName">
											<label for = "category">Start Balance  :</label>
											<input type="number" min="0" value="0" id="category" class="form-control signform" name="StartedMoney" step="0.01">
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-default" name="AddBudget">Create Budget</button>
											</div>
										</form>
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="row" style="padding-top: 10px">
						<form role= "form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<button type="submit" class="btn btn-default center-block submitbutton" name="Clearall">Clear all</button>
						</form>
					</div>
				</div>

			</div>
			<?php
			if (isset($defBudget)) 
			{
				echo'
				<div class="col-md-8 col-md-offset-1 budgetsinfo">
					<h1 class="text-center">'.$defBudget['BudgetName'].'</h1>
					';
					$spentsSchedule = getBudgetSpentsScheduleByID($defBudgetID);
					if(sizeof($spentsSchedule) > 0)
					{
						echo '
						<div class="row">		
							<div class="col-md-12 text-center budgetsinfoheaders">

								<h2>Your spendings</h2>
							</div>
						</div>
						<table class=" table tablespendings originaltable">
							<thead>
								<tr>
									<th>Category</th>
									<th>Sub-Cat</th>
									<th>Product</th>
									<th>Last Purchased</th>
									<th>Every</th> 
									<th>Price</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>';
								for ($i=0; $i < sizeof($spentsSchedule); $i++) { 
									$spent = $spentsSchedule[$i];
									$product = getProductByID($spent['ProductID']);
									$subCat = getSubCatByID($product['SubCatID']);
									$cat = getCatByID($subCat['CatID']);
									$productName = $product['Name'];
									$subCatName = $subCat['Name'];
									$catName = $cat['Name'];
									$times = $spent['Times'];
									$every = charToDuration($spent['Every']);
									echo '
									<tr>
										<td scope="row">'.$catName.'</td>
										<td>'.$subCatName.'</td>
										<td>'.$productName.'</td>
										<td>'.$spent['StartDate'].'</td>
										<td>'."$times $every".'</td>
										<td>$'.$spent['Price'].'</td>
										<td><form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
											<input type="hidden" name="SpentScheduleID" value="'.$spent['ID'].'">
											<button type="submit" class="btn btn-danger center-block submitbutton" name="DeleteSpentSchedule">Delete</button></form></td>
										</tr>';
									}
									echo '
								</tbody>
							</table>
							<table class="table tablespendings visibletable">
								<thead>
									<tr class= "text-center">
										<th class= "text-center">Product</th>
									</tr>
								</thead>
								<tbody>
									';
									for ($i=0; $i < sizeof($spentsSchedule); $i++) { 
										$spent = $spentsSchedule[$i];
										$product = getProductByID($spent['ProductID']);
										$subCat = getSubCatByID($product['SubCatID']);
										$cat = getCatByID($subCat['CatID']);
										$productName = $product['Name'];
										$subCatName = $subCat['Name'];
										$catName = $cat['Name'];
										$times = $spent['Times'];
										$every = charToDuration($spent['Every']);
										echo '
										<tr class= "text-center">
											<td><strong>Category :</strong> '.$catName.'
												<br><strong> Sub-Cat  :</strong> '.$subCatName.'
												<br><strong> Product  :</strong> '.$productName.'
												<br><strong> Last Purchased  :</strong> '.$spent['StartDate'].'
												<br><strong> Every  :</strong> '."$times $every".'
												<br><strong> Price  :</strong> $'.$spent['Price'].'
												<br><form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
												<input type="hidden" name="SpentScheduleID" value="'.$spent['ID'].'">
												<button type="submit" class="btn btn-danger center-block submitbutton" name="DeleteSpentSchedule">Delete</button></form></td>
												';
											}
											echo'</tbody>
										</table>';
									}
									$incomeSchedule = getBudgetIncomesScheduleByID($defBudgetID);
									if(sizeof($incomeSchedule) > 0)
									{
										echo '
										<div class="row">		
											<div class="col-md-12 text-center budgetsinfoheaders">

												<h2>Your income</h2>
											</div>
										</div>
										<table class="table tableincome originaltable">
											<thead>
												<tr>
													<th>Source</th>
													<th>Amount</th>
													<th>Every</th>
													<th>Last Income</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>';
												for ($i=0; $i < sizeof($incomeSchedule); $i++) { 
													$incomeShd = $incomeSchedule[$i];
													$times = $incomeShd['Times'];
													$every = charToDuration($incomeShd['Every']);
													echo '
													<tr>
														<td scope="row">'.$incomeShd['Source'].'</td>
														<td>$'.$incomeShd['Amount'].'</td>
														<td>'."$times $every".'</td>
														<td>'.$incomeShd['StartDate'].'</td>
														<td>
															<form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
																<input type="hidden" name="IncomeScheduleID" value="'.$incomeShd['ID'].'">
																<button type="submit" class="btn btn-default center-block submitbutton" name="DeleteIncomeSchedule">Delete</button>
															</form>
														</td>
													</tr>';
												}
												echo '
											</tbody>
										</table>
										<table class="table tableincome visibletable">
											<thead>
												<tr class= "text-center"> 
													<th class= "text-center">Sources</th>
												</tr>
											</thead>
											<tbody>';
												for ($i=0; $i < sizeof($incomeSchedule); $i++) { 
													$incomeShd = $incomeSchedule[$i];
													$times = $incomeShd['Times'];
													$every = charToDuration($incomeShd['Every']);
													echo '
													<tr class= "text-center">
														<td scope="row"><strong>'.$incomeShd['Source'].'</strong>
															<br><strong>Amount:</strong>$'.$incomeShd['Amount'].'
															<br><strong>Every :</strong>'."$times $every".'
															<br><strong>Last Income:</strong>'.$incomeShd['StartDate'].'
															<br><form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
															<input type="hidden" name="IncomeScheduleID" value="'.$incomeShd['ID'].'">
															<button type="submit" class="btn btn-default center-block submitbutton" name="DeleteIncomeSchedule">Delete</button></form></td>
														</tr>';
													}
													echo '</tbody>
												</table>
												';
											}
											echo '
											<div class="row">		
												<div class="col-md-12 text-center budgetsinfoheaders">

													<h2>Options</h2>
												</div>
											</div>
											<div class="row">		
												<div class="col-md-4 budgetbuttons">
													<button class="btn btn-success incomebutton center-block" data-toggle="modal" data-target="#Addincome">Add income</button>
													<div class="modal fade" id="Addincome" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h2 class="modal-title" id="exampleModalLabel">Add income</h2>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<form role= "form" class="form-group" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
																		<label for="source">Income source :</label>
																		<input class="form-control signform" id="source" type="text"  name="Source">
																		<label for = "Value">Amount  :</label>
																		<input type="number" min="0" value="0" step="0.01" id="Value" class="form-control signform" name="Amount" >
																		<label for="sel1">Every :</label>
																		<input type="number" id="Value" class="form-control signform" name="Times" value="1" min="1">
																		<select class="form-control durationlist selectpicker" name="Every">
																			<option class="durationlistelement">Year</option>
																			<option class="durationlistelement">Month</option>
																			<option class="durationlistelement">Day</option>
																			<option class="durationlistelement">Hour</option>
																		</select>
																		<label for = "date">Date Started :</label>
																		<input type="date" id="date" class="form-control signform" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'" name="StartDate">
																		<input type="hidden" name="BudgetID" value="'.$defBudget['ID'].'">
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			<button type="submit" name="AddIncomeSchedule" class="btn btn-default">Add</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4 budgetbuttons">

													<button class="btn btn-primary center-block" data-toggle="modal" data-target="#buy">Add periodic spendings</button>
													<div class="modal fade" id="buy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h2 class="modal-title" id="exampleModalLabel">Buy an item</h2>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<form role= "form" class="form-group" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
																		<label for="Cat">Category :</label>
																		<input class="form-control signform" id="Cat" type="text"  name="Cat">
																		<label for="SubCat">Sub-Cat :</label>
																		<input class="form-control signform" id="SubCat" type="text"  name="SubCat">
																		<label for="Choice">Product :</label>
																		<input class="form-control signform" id="Choice" type="text"  name="Product">
																		<label for = "Value">Price  :</label>
																		<input type="number" min="0" value="0" step="0.01" id="Value" class="form-control signform" name="Price">
																		<label for="sel1">Every :</label>
																		<input type="number" id="Value" class="form-control signform" name="Times" value="1" min="1">
																		<select class="form-control durationlist selectpicker" name="Every">
																			<option class="durationlistelement">Year</option>
																			<option class="durationlistelement">Month</option>
																			<option class="durationlistelement">Day</option>
																			<option class="durationlistelement">Hour</option>
																		</select>
																		<label for = "date">Date Started :</label>
																		<input type="date" id="date" class="form-control signform" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'" name="StartDate">
																		<input type="hidden" name="BudgetID" value="'.$defBudget['ID'].'">
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			<button type="submit" name="AddSpentSchedule" class="btn btn-default">Add Spending</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4  budgetbuttons">

													<button class="btn btn-danger center-block" data-toggle="modal" data-target="#remove">Remove</button>
													<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h2 class="modal-title" id="exampleModalLabel">Remove</h2>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body">
																	<form role= "form" class="form-group">
																		<label for="Choice">Service or product :</label>
																		<input class="form-control signform" id="Choice" type="text"  name="">
																		<label for="sel1">Income or spending:</label>
																		<select class="form-control durationlist selectpicker">
																			<option class="durationlistelement">Income</option>
																			<option class="durationlistelement">Spending</option>

																		</select>
																	</form>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	<button type="button" class="btn btn-default">Remove Budget</button>
																</div>
															</div>
														</div>
													</div>			
												</div>
												<div class="col-md-12  budgetbuttons">
													<a href="Budgets.php"><button class="btn btn-primary form-control">Return to budgets</button></a>
												</div>
											</div>
										</div>
										';
									}
									?>
								</div>


							</div>
							<script src="js/html5shiv.min.js"></script>
							<script src="js/respond.min.js"></script>
							<script src="js/jquery-3.1.1.min.js">	</script>
							<script src="js/bootstrap.min.js"></script>
						</body>

						</html>