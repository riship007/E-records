<?php
  session_start();
  
  include('../includes/dbconnection.php');
  
  if (strlen($_SESSION['detsuid'])==0) {
	header('location:logout.php');
	}
else{
$fdate=$_POST['fromdate'];
 $tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
unset($_SESSION['month']);
unset($_SESSION['year']);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Monthwise Expense Report</title>
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
				<li class="active">Monthwise Expense Report</li>
			</ol>
			<form method="POST"	action="" >
				<div class="form-group has-success">
				<a href="generate_pdf.php?fdate=<?php echo $fdate ; ?> & tdate=<?php echo $tdate; ?>" class="btn btn-info">Generate PDF</a> 
				</div>
								
	      </form>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Monthwise Expense Report</div>
					<div class="panel-body">

						<div class="col-md-12">
					


<h5 align="center" style="color:blue">Monthwise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            
              <th>S.NO</th>
              <th>Month-Year</th>
              <th>Expense Amount</th>
			  <th>view All</th>
                </tr>
                                        
                                        </thead>
 <?php
$userid=$_SESSION['detsuid'];
$ret=$con->query("CALL mreport('$fdate','$tdate','$userid')");
$cnt=1;



while ($row=$ret->fetch_assoc()) {

?> 
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                  <td><?php  echo $row['rptmonth']."-".$row['rptyear'];?></td>
                  <td><?php  echo $ttlsl=$row['totalmonth'];?></td>
				  <td><a href="../views/view_all.php?month=<?php echo $row['rptmonth']; ?>&year=<?php echo $row['rptyear'];?>">View</a></td>
           
                </tr>
                <?php
                $totalsexp+=$ttlsl; 
$cnt=$cnt+1;
}?>

 <tr>
  <th colspan="2" style="text-align:center">Grand Total</th>     
  <td><?php echo $totalsexp;?></td>
 </tr>     

                                    </table>




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