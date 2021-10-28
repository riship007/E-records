<?php
session_start();
// error_reporting(0);

include('../includes/dbconnection.php');
if (strlen($_SESSION['detsuid'])==0) {
  header('location:../controller/logout.php');
  } else{

if(isset($_POST['submit']))
  {
   if(!$_POST['categories']==""){
  	 $userid=$_SESSION['detsuid'];
     $dateexpense=$_POST['dateexpense'];
     $item=$_POST['item'];
     $costitem=$_POST['costitem'];
	 $categories=$_POST['categories'];
	 $query1=$con->query("SELECT Cat_id FROM tblcategories WHERE Cat_name='$categories'");
	 $row=$query1->fetch_assoc();
	 $category=$row['Cat_id'];
	
     $query=$con->query("CALL iexpense('$userid','$dateexpense','$item','$costitem','$category')");
		if($query){
		echo "<script>alert('Expense has been added');</script>";
		echo "<script>window.location.href='manage-expense.php'</script>";
		} else {
		echo "<script>alert('Something went wrong. Please try again');</script>";

   }
   
  }
  else
    $msg="Please ,Select a category!";
 }


  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Add Expense</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
	<script src="../js/html5shiv.js"></script>
	<script src="../js/respond.min.js"></script>
	
</head>
<body>
	<?php include_once('../includes/header.php');?>
	<?php include_once('../includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Expense</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Expense</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<form role="form" method="post" action="">
                             <div class="form-group">
								 <label>Choose a Categorie</label></br>
								 
									
											<select name="categories" id="mySelect" data-show-content="true" class="form-control">
												<option value="">Select..</option>
												
												<option value="Groceries">Groceries</option>
												<option value="Food">Food</option>
												<option value="Meals And Entertainment">Entertainment</option>
												<option value="Electronics">Elecronics</option>
												<option value="Rent">Rent</option>
												<option value="Home Ofice Cost">Home Office Cost</option>
												<option value="Furniture,Equipment and Machinery">Furniture,Equipment and Machinery</option>
												<option value="Advertisement And Marketing">Advertisement And Marketing</option>
												<option value="Travel Expense">Travel Expense</option>
												<option value="Vehical expense">Vehical expense</option>
												<option value="Taxes">Taxes</option>
												<option value="Insurance and Lincense">Insurance and Licence</option>
												<option value="Training And Education">Training And Education</option>
												<option value="Personal Expense">Personal Expense</option>
												<option value="Stationary Expense">Stationary Expense</option>
												<option value="Festival Expense">Festival Expense</option>
												<option value="Toy And Decoration">Toy And Decoration</option>
												<option value="Others">Others</option>
												
											</select>
										
									
                             </div>
							    <?php 
								  $date=date("Y-m-d");
								?>
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="<?php echo $date; ?>" max="<?php echo $date; ?>" name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Item</label>
									<input type="text" class="form-control" name="item" value="" required="true">
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="" required="true" name="costitem">
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add</button>
								</div>
								
								
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('../includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
	
</body>
</html>
<?php } ?>