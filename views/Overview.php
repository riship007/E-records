<?php
session_start();

include('../includes/dbconnection.php');
include('../includes/procedures.php');
if (strlen($_SESSION['detsuid'])==0) {
	header('location:../controller/logout.php');
	} else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker - Overview</title>
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
    <?php
       $userid=$_SESSION['detsuid'];
	   $arr=array();
	   $i=1;
	   
	  while($i<19){
	    $query=$con->query("CALL overview('$userid','$i')");
		$row=$query->fetch_assoc();
		
		if($row['total']==NULL){
			array_push($arr,0);
			$i=$i+1;
		}else{
			array_push($arr,$row['total']);
			$i=$i+1;
	  }
	  clearStoredResults($con);
	  
	}
	?>
	  
      
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<i class="fas fa-"></i>
				</a></li>
				<li class="active">Overview</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Overview</h1>
			</div>
		</div><!--/.row-->
    
	<div class="container my-4">
    <div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);


function drawChart() {
 
	var data = google.visualization.arrayToDataTable([
	['Task', 'Hours per Day'],
	['Groceries', <?php  print_r($arr[0]); ?>],
	['Food', <?php  print_r($arr[1]); ?>],
	['Meals And Entertainment', <?php  print_r($arr[2]); ?>],
	['Electronics', <?php  print_r($arr[3]); ?>],
	['Rent', <?php  print_r($arr[4]); ?>],
	['Home Ofice Cost', <?php  print_r($arr[5]); ?>],
	['Furniture,Equipment and Machinery', <?php  print_r($arr[6]); ?>],
	['Advertisement And Marketing', <?php  print_r($arr[7]); ?>],
	['Travel Expense', <?php  print_r($arr[8]); ?>],
	['Vehical expense', <?php  print_r($arr[9]); ?>],
	['Taxes', <?php  print_r($arr[10]); ?>],
	['Insurance and Lincense', <?php  print_r($arr[11]); ?>],
	['Training And Education', <?php  print_r($arr[12]); ?>],
	['Personal Expense', <?php  print_r($arr[13]); ?>],
	['Stationary Expense', <?php  print_r($arr[14]); ?>],
	['Festival Expense', <?php  print_r($arr[15]); ?>],
	['Toy And Decoration', <?php  print_r($arr[16]); ?>],
	['Others', <?php  print_r($arr[17]); ?>]
]);


  var options = {'title':'My Expense Overview', 'width':900, 'height':500};

  
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
</div>
</div>
  	<?php include_once('../includes/footer.php');?>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	

	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
</body>
</html>
<?php } ?>