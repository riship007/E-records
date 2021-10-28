<?php
session_start();
include('../includes/dbconnection.php');

// error_reporting(0);
if (strlen($_SESSION['detsuid'])==0) {
  header('location:../controller/logout.php');
  } else{
	if(isset($_POST['submit']))
	{
		$userid=$_SESSION['detsuid'];
		$cpassword=$_POST['currentpassword'];
		$newpassword=$_POST['newpassword'];
		$query=$con->query("CALL password('$userid','$cpassword')");
		$row=$query->fetch_assoc();
	if($row>0){
		if (!function_exists('clearStoredResults'))
		   include('../includes/procedures.php');
		clearStoredResults($con);
		$ret=$con->query("CALL upassword('$newpassword','$userid')");
		
		$msg= "Your password successully changed"; 
	} else {
		$tag = 1;
		$msg="Your current password is wrong";
	}



	}

  
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Change Password</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
	alert('New Password and Confirm Password field does not match');
	document.changepassword.confirmpassword.focus();
	return false;
}
return true;
} 

</script>
</head>
<body>
	<?php include('../includes/header.php');?>
	<?php include('../includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Change Password</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Change Password</div>
					<div class="panel-body">
						<p style="font-size:16px; color:<?php
						if($tag){echo "red";} else {echo "green";} ?>;" >
							<?php 
								if($msg){
									echo $msg;
								}  
							?> 
						</p>
						<div class="col-md-12">
							 <?php
$userid=$_SESSION['detsuid'];
?>
							<form role="form" method="post" action="" name="changepassword" onsubmit="return checkpass();">
								<div class="form-group">
									<label>Current Password</label>
									<input type="password" name="currentpassword" class=" form-control" value="" required= "true" >
								</div>
								<div class="form-group">
									<label>New Password</label>
									<input type="password" name="newpassword" class="form-control" value="" required="true">
								</div>
								
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="confirmpassword" class="form-control" value="" required="true">
								</div>
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Change</button>
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