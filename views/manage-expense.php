<?php  
session_start();
// error_reporting(0);
include('../includes/dbconnection.php');

if (strlen($_SESSION['detsuid'])==0) {
  header('location:../controller/logout.php');
  } else{

//code deletion
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=$con->query("CALL deletee('$rowid')");
if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
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
	<title>Daily Expense Tracker || Manage Expense</title>
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
							
							<div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Expense Item</th>
                  <th>Expense Cost</th>
                  <th>Expense Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
			   $userid=$_SESSION['detsuid'];
			  $results_per_page = 9;  
  
			   
			  
			  $result =$con->query("CALL alle('$userid')");  
			  $number_of_result =$result->num_rows;  
			
			  
			  $number_of_page = ceil($number_of_result / $results_per_page);  
			 
			  if (!isset ($_GET['page']) ) {  
				  $page = 1;  
			  } else {  
				  $page = $_GET['page'];  
			  }  
			
			 
			  $page_first_result = ($page-1) * $results_per_page; 
             
			  clearStoredResults($con);
			    $query="CALL pagee('$userid','$page_first_result','$results_per_page') ";
				$ret=$con->query($query);  
				if(isset($_GET['page']) && $_GET['page']>=2)
				  $cnt=3*3*($_GET['page']-1)+1;
				else
				  $cnt=1;
				
            while ($row=$ret->fetch_assoc()) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['ExpenseItem'];?></td>
                  <td><?php  echo $row['ExpenseCost'];?></td>
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><a href="manage-expense.php?delid=<?php echo $row['ID'];?>">Delete</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
          </div>
		  
						</div>Page:<nav aria-label="Page navigation example">
							<ul class="pagination">
							<li class="page-item"><a class="page-link" href="manage-expense.php?page=<?php if($page==1)echo $page; else echo $page-1;?>"> Previous </a></li>
								<?php
						for($i = 1; $i<=$number_of_page; $i++) { ?>
							
								<li class="page-item"><a class="page-link" href="manage-expense.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
							
								<?php } ?>
								<li class="page-item"><a class="page-link" href="manage-expense.php?page=<?php if($page>$number_of_page-1) echo $page; else echo $page+1;?>"> Next </a></li>
							</ul>
							</nav>
							
							
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