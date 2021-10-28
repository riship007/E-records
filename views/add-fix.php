<?php
session_start();
// error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['detsuid'])==0) {
  header('location:../controller/logout.php');
  } else{

if(isset($_POST['submit']))
  {
  	$userid=$_SESSION['detsuid'];
    $Ttype=$_POST['transaction'];
    $Tname=$_POST['tname'];
    $Amount=$_POST['amount'];
    $fdate=$_POST['date'];
   
    $query=$con->query("CALL ifix('$userid','$Ttype','$Tname','$Amount','$fdate')");
if($query){
    echo "<script>alert('Fix Transaction has been added');</script>";
    
} else {
    echo "<script>alert('Something went wrong. Please try again');</script>";

}
  
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Add Fix Transaction</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
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
				<li class="active">Add Fix Transaction</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Add Fix Transaction</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
					


							<form role="form" method="post" action="" name="fix">
                            
                            <div class="form-group">
                                <label for="transaction">Choose a type:</label>
                                    <select name="transaction" id="transaction">
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                        
                                    </select>
                                    <br><br>
                            </div>
                                <div class="form-group">
									<label>Name</label>
									<input class="form-control" type="text"  id="tname" name="tname" required="true">
								</div>
                                <div class="form-group">
									<label>Amount</label>
									<input class="form-control" type="int"  id="amount" name="amount" required="true">
								</div>
								<div class="form-group">
									<label> Date</label>
									<input class="form-control" type="date"  id="date" name="date" required="true">
								</div>
								
								
							
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
