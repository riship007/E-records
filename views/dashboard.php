<?php
session_start();
// error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['detsuid'])==0) {
	header('location:../controller/logout.php');
	} else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker - Dashboard</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	
	
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
					<i class="fas fa-"></i>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		
		
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php
// Today Expense
$userid=$_SESSION['detsuid'];
$tdate=date('Y-m-d');

$query1=$con->query("CALL todaye('$tdate','$userid',@texpense)");
$query=$con->query("SELECT @texpense");
$result=$query->fetch_assoc();
$sum_today_expense=$result['@texpense'];
 ?> 

						<h4>Today's Expense</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_today_expense;?>" ><span style= " font-size:35px " class="percent"><?php if($sum_today_expense==""){
echo "0";
} else {
echo $sum_today_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yestreday Expense
$userid=$_SESSION['detsuid'];
$ydate=date('Y-m-d',strtotime("-1 days"));
$sql=$con->query("CALL yesterdaye('$ydate','$userid',@yexpense)");
$query1=$con->query("SELECT @yexpense");
$result1=$query1->fetch_assoc();
$sum_yesterday_expense=$result1['@yexpense'];
 ?> 
					<div class="panel-body easypiechart-panel">
						<h4>Yesterday's Expense</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yesterday_expense;?>" ><span style= " font-size:35px " class="percent"><?php if($sum_yesterday_expense==""){
echo "0";
} else {
echo $sum_yesterday_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Weekly Expense
$userid=$_SESSION['detsuid'];
 $pastdate=  date("Y-m-d", strtotime("-1 week")); 
$crrntdte=date("Y-m-d");
$query=$con->query("CALL weeke('$pastdate','$crrntdte','$userid',@wexpense)");
$query2=$con->query("SELECT @wexpense");
$result2=$query2->fetch_assoc();
$sum_weekly_expense=$result2['@wexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 7day's Expense</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_weekly_expense;?>"><span style= " font-size:35px " class="percent"><?php if($sum_weekly_expense==""){
echo "0";
} else {
echo $sum_weekly_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Monthly Expense
$userid=$_SESSION['detsuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query4=$con->query("CALL monthe('$monthdate','$crrntdte','$userid',@mexpense)");
$query3=$con->query("SELECT @mexpense");
$result3=$query3->fetch_assoc();
$sum_monthly_expense=$result3['@mexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 30day's Expenses</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_monthly_expense;?>" ><span style= " font-size:35px " class="percent"><?php if($sum_monthly_expense==""){
echo "0";
} else {
echo $sum_monthly_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		</div><!--/.row-->
			<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Expense
$userid=$_SESSION['detsuid'];
 $cyear= date("Y");
$query3=$con->query("CALL yeare('$cyear','$userid',@yexpense)");
$query4=$con->query("SELECT @yexpense");
$result4=$query4->fetch_assoc();
$sum_yearly_expense=$result4['@yexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Current Year Expenses</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yearly_expense;?>" ><span style= " font-size:35px " class="percent"><?php if($sum_yearly_expense==""){
echo "0";
} else {
echo $sum_yearly_expense;
}

	?></span></div>


					</div>
				
				</div>

			</div>

		<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//total Expense
$userid=$_SESSION['detsuid'];
$query4=$con->query("CALL totale('$userid',@texpense)");
$query5=$con->query("SELECT @texpense");
$result5=$query5->fetch_assoc();
$sum_total_expense=$result5['@texpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Expenses</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_total_expense;?>" ><span style= " font-size:35px " class="percent"><?php if($sum_total_expense==""){
echo "0";
} else {
echo $sum_total_expense;
}

	?></span></div>


					</div>
				
				</div>

			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//total Income
$userid=$_SESSION['detsuid'];
$query5=$con->query("CALL totali('$userid',@tincome)");
$query6=$con->query("SELECT @tincome");
$result6=$query6->fetch_assoc();
$sum_total_income=$result6['@tincome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Income</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $sum_total_income;?>" ><span style= " font-size:35px " class="percent"><?php if($sum_total_income==""){
echo "0";
} else {
echo $sum_total_income;
}

	?></span></div>


					</div>
				
				</div>

			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
					    $balance = $sum_total_income - $sum_total_expense;

                    ?>
					<div class="panel-body easypiechart-panel">
						<h4><u><mark><b>Balance</b></mark></u></h4>
						<div class="easypiechart" id="easypiechart-black" data-percent="<?php echo $balance;?>" ><span style= " font-size:38px " class="percent"><?php if($balance==""){
echo "0";
} else {
	?>
<b> <?php echo $balance; ?> </b>
<?php } ?>

	</span></div>


					</div>
				
				</div>

			</div>

		</div>
		
		<!--/.row-->
	</div>	<!--/.main-->
	<?php include_once('../includes/footer.php');?>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
	
		
</body>
</html>
<?php } ?>