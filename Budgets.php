<?php
include "Meta-PHP.php";
include "myBudgetDataBase.php";
if(!isset($_SESSION['logged']))
	redirect("/SignIn.php");
$userID = $_SESSION['userID'];
$user = getUserByID($userID);
$defBudgetID = $user["DefaultBudgetID"];
updateUser($userID);
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
if(isset($_POST['DeleteSpent']))
{
	deleteSpentByID($_POST['SpentID']);
	redirect("/Budgets.php");
}
if(isset($_POST['DeleteIncome']))
{
	deleteIncomeByID($_POST['IncomeID']);
	redirect("/Budgets.php");
}
if(isset($_POST['AddIncome']))
{
	addIncome($_POST['Source'],$_POST['Amount'],$defBudgetID);
	redirect("/Budgets.php");
}
if(isset($_POST['Phurcase']))
{
	addSpent($_POST['Cat'], $_POST['SubCat'], $_POST['Product'], $_POST['Price'],$_POST['Quantity'], $defBudgetID);
	redirect("/Budgets.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="datatables.min.css"/> 

	<link href="fonts/DroidSans-Bold.ttf" rel="stylesheet">
	<link href="fonts/DroidSans.ttf" rel="stylesheet">
	<link href="fonts/Lobster-Regular.ttf" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet"  href="css/styles.css">
	<title>Budget Organizer</title>
	<script type="text/javascript">
		function isNumeric(value) {

			//return /^\d+$/.test(value);
			return !isNaN(parseFloat(n)) && isFinite(n);
		}
		function validateBudgetForm() {
			var budgetName = budgetForm.BudgetName.value;
			var StartedMoney = budgetForm.StartedMoney.value;
			if (budgetName.length == 0 || !isNumeric(StartedMoney)) {
				alert("please enter your budget correctly");
				return false;
			}  else {
				//alert("thank you :D ");
				return true;
			}
		}
		function validateIncomeForm()
		{
			var source = incomeForm.Source.value;
			var amount = incomeForm.Amount.value;
			if (source.length == 0 || !isNumeric(amount)) {
				alert("please enter your income correctly");
				return false;
			} else {
				//alert("thank you :D ");
				return true;
			}
		}
		function validateCatForm()
		{
			var cat = catForm.Cat.value;
			var subCat = catForm.SubCat.value;
			var product = catForm.Product.value;
			var price = catForm.Price.value;
			if (cat.length == 0 || subCat.length == 0 || product.length == 0 || !isNumeric(price)) {
				alert("please enter your income correctly");
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
	include ('NavBar.php');
	?>
	<div class="container">

		<div class="row">
			<div class="col-md-3 budgetslist">
				<h1 class="center-block text-center">Budgets</h1>
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
										<form role= "form" class="form-group" method="POST" onsubmit="return validateBudgetForm()" name="budgetForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
											<label for="budgetname">Budget name :</label>
											<input class="form-control signform" id="budgetname" type="text"  name="BudgetName">
											<label for = "category">Start Balance  :</label>
											<input type="number" value="0" min="0" id="category" class="form-control signform" name="StartedMoney" step="0.01">
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
			if (isset($defBudget)) {
				echo'
				<div class="col-md-8 col-md-offset-1 budgetsinfo">
					<h1 class="text-center">'.$defBudget['BudgetName'].'</h1>
					<div class="row">		
						<div class="col-md-12 text-center budgetsinfoheaders">
							<h2 class="text-center ">Your stats</h2>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-5 budgetstats text-center">

							<p>Starting balance :</p><h3>$'.$defBudget['StartedMoney'].'</h3>

						</div>
						<div class="budgetstats col-md-6 col-md-offset-1 text-center">

							<p>Current :</p><h3>$'.$defBudget['Money'].'</h3>

						</div>
					</div>
					<div class="row">
						<div class="col-md-5 budgetstats budgetstatsdecrease text-center">

							<h3> - $'.$defBudget['Spent'].'</h3>

						</div>
						<div class="col-md-6 budgetstats col-md-offset-1 budgetstatsincrease text-center">

							<h3> + $'.$defBudget['Income'].'</h3>

						</div>
					</div>';
					$spents = getBudgetSpentsByID($defBudgetID);
					if(sizeof($spents) > 0)
					{
						echo'<div class="row">		
						<div class="col-md-12 text-center budgetsinfoheaders">

							<h2>Your spendings</h2>
						</div>
					</div>
					<div class="originaltable">
						<table class="table tablespendings" id="myTable">
							<thead>
								<tr>
									<th>Category</th>
									<th>Sub-Category</th>
									<th>Product</th>
									<th>Date Purchased</th>
									<th>Price</th>
									<th>Remove</th>
								</tr>
							</thead>
							<tbody>';

								for ($i=0; $i < sizeof($spents); $i++) { 
									$spent = $spents[$i];
									$product = getProductByID($spent['ProductID']);
									$subCat = getSubCatByID($product['SubCatID']);
									$cat = getCatByID($subCat['CatID']);
									$productName = $product['Name'];
									$subCatName = $subCat['Name'];
									$catName = $cat['Name'];
									$price = $spent['Price'];
									$datePuhrcased = $spent['Datepuhrcased'];
									echo '<tr>
									<td scope="row">'.$catName.'</td>
									<td>'.$subCatName.'</td>
									<td>'.$productName.'</td>
									<td>'.$datePuhrcased.'</td>
									<td>'.$spent['Quantitiy']." x $".$price.'</td>
									<td>
										<form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
											<input type="hidden" name="SpentID" value="'.$spent['ID'].'">
											<button type="submit" class="btn btn-danger center-block submitbutton" name="DeleteSpent">Delete</button></form></td>
										</tr>';
									}
									echo'
								</tbody>
							</table>
						</div>';

						echo '<div class="visibletable">
						<table class="table tablespendings visibletable" id="myTable1">
							<thead>
								<tr class= "text-center">
									<th class= "text-center">Product</th>
								</tr>
							</thead>
							<tbody>';
								for ($i=0; $i < sizeof($spents); $i++) { 
									$spent = $spents[$i];
									$product = getProductByID($spent['ProductID']);
									$subCat = getSubCatByID($product['SubCatID']);
									$cat = getCatByID($subCat['CatID']);
									$productName = $product['Name'];
									$subCatName = $subCat['Name'];
									$catName = $cat['Name'];
									$productPrice = $spent['Price'];
									$datePuhrcased = $spent['Datepuhrcased'];
									echo '<tr class= "text-center">';
									echo "
									<td>
										<strong> Cat :</strong> $catName - $subCatName
										<br><strong> Product :</strong> $productName
										<br><strong> Date    :</strong> $datePuhrcased
										<br><strong> Price   :</strong> $ $productPrice
										<br><strong> ".'<form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
										<input type="hidden" name="SpentID" value="'.$spent['ID'].'">
										<button type="submit" class="btn btn-danger center-block submitbutton"  name="DeleteSpent">Delete</button></form></td>
									</td>
								</tr>';
							}
							echo'
						</tbody>
					</table>
				</div>';
			}
			$incomes = getBudgetIncomesByID($defBudgetID);
			if(sizeof($incomes) > 0)
			{
				echo'
				<div class="row">		
					<div class="col-md-12 text-center budgetsinfoheaders">

						<h2>Your income</h2>
					</div>
				</div>
				<div class="originaltable">
				<table class="table tableincome" id="myTable2">
					<thead>
						<tr>
							<th>Source</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>';

						for ($i=0; $i < sizeof($incomes); $i++) { 
							$income = $incomes[$i];
							echo '<tr>
							<td scope="row">'.$income['Source'].'</td>
							<td>'.$income['DateCreated'].'</td>
							<td>$'.$income['Amount'].'</td>
							<td><form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
								<input type="hidden" name="IncomeID" value="'.$income['ID'].'">
								<button type="submit" class="btn btn-default center-block submitbutton" name="DeleteIncome">Delete</button></form></td>

							</tr>';
						}
						echo'
					</tbody>
				</table>
				</div>';
				echo '
				<div class="visibletable">
				<table class="table tableincome visibletable" id="myTable3">
				<thead>
					<tr class= "text-center"> 
						<th class= "text-center">Sources</th>
					</tr>
				</thead>
				<tbody>';

					for ($i=0; $i < sizeof($incomes); $i++) { 
						$income = $incomes[$i];
						echo '<tr class= "text-center">
						<td scope="row"><strong>'.$income['Source'].'</strong>
							<br><strong>Date :</strong>'.$income['DateCreated'].'
							<br><strong>Price:</strong>$'.$income['Amount'].'
							<br><form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
							<input type="hidden" name="IncomeID" value="'.$income['ID'].'">
							<button type="submit" class="btn btn-default center-block submitbutton" name="DeleteIncome">Delete</button></form>
						</td>
					</tr>';
				}
				echo '</tbody>
			</table>
			</div>';


		}
		echo'
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
								<form role= "form" class="form-group" onsubmit="return validateIncomeForm()" method="POST" name="incomeForm" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
									<label for="source">Income source :</label>
									<input class="form-control signform" id="source" type="text"  name="Source">
									<label for = "Value">Amount  :</label>
									<input type="number" min="0" value="0" step="0.01" id="Value" class="form-control signform" name="Amount">
									<input type="hidden" name="BudgetID" value="'.$defBudget['ID'].'">
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-default" name="AddIncome">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 budgetbuttons">

				<button class="btn btn-primary center-block" data-toggle="modal" data-target="#buy">Phurcase</button>
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
								<form role= "form" class="form-group" onsubmit="return validateCatForm()" name="catForm" method="POST" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>
									<label for="Cat">Category             :</label>
									<input class="form-control signform" id="Cat" type="text"  name="Cat">
									<label for="SubCat">Sub-Category      :</label>
									<input class="form-control signform" id="SubCat" type="text"  name="SubCat">
									<label for="Choice">Product           :</label>
									<input class="form-control signform" id="Choice" type="text"  name="Product">
									<label for = "Value">Price(optional)  :</label>
									<input type="number" min="0" value="0" step="0.01" id="Value" class="form-control signform" name="Price">
									<label for = "Quantity">Quantity  :</label>
									<input type="number" id="Quantity" value="1" min="1" class="form-control signform" name=Quantity>
									<input type="hidden" name="BudgetID" value="'.$defBudget['ID'].'">
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-default" name="Phurcase">Phurcase</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4  budgetbuttons">

				<button class="btn btn-danger center-block" data-toggle="modal" data-target="#remove">Remove budget</button>
				<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-title" id="exampleModalLabel">Remove budget</h2>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p class="lead text-center">Are you sure?</p>
							</div>
							<div class="modal-footer">
								<form role= "form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input type="hidden" name="BudgetID" value="'.$defBudget['ID'].'">
									<button type="submit" class="btn btn-default" name="RemoveBudget">RemoveBudget</button>
								</form>
							</div>
						</div>
					</div>
				</div>			
			</div>
			<div class="col-md-12  budgetbuttons">
				<a href="BudgetDuration.php"><button class="btn btn-primary form-control">Add durable budgets</button></a>
			</div>
		</div>
	</div>
	';}?>
</div>


</div>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<script src="js/jquery-3.1.1.min.js">	</script>
<script src="js/bootstrap.min.js"></script>
<script src = "jquery.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>

<script>
	$(document).ready(function(){
		$('#myTable').DataTable();
          //alert("hii");
      });
	$(document).ready(function(){
		$('#myTable1').DataTable();
          //alert("hii");
      });
	$(document).ready(function(){
		$('#myTable2').DataTable();
          //alert("hii");
      });
	$(document).ready(function(){
		$('#myTable3').DataTable();
          //alert("hii");
      });
  </script>
</body>
</html>