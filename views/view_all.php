<?php
session_start();

include('../includes/dbconnection.php');
if(!isset($_GET['page'])){
	unset($_SESSION['date']);
	unset($_SESSION['month']);
	unset($_SESSION['year']);
}
if (strlen($_SESSION['detsuid'])==0) {
	header('location:../controller/logout.php');
	} else{
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker - Data</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	<link href="../css/bootstrap-chart.css" rel="stylesheet">
	
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
				<li class="active">Records</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Records</h1>
			</div>
		</div><!--/.row-->
    
	    
		<div class="row">
			<div class="col-lg-12">
			        <?php
                     

					 if(isset($_GET['date']) || isset($_SESSION['date'])){
						 if(isset($_SESSION['date']))
						   $dat=$_SESSION['date'];
						else{
							$dat=$_GET['date'];
							$_SESSION['date']=$_GET['date'];
						}
                        echo "<div class='panel-heading'>Expenses of  => $dat</div>";
					 }
					 elseif(isset($_GET['month'],$_GET['year']) || isset($_SESSION['month'],$_SESSION['year'])){
						 if(isset($_SESSION['month'],$_SESSION['year'])){
							$mont=$_SESSION['month'];
							$yar=$_SESSION['year'];
   
						 }else{
						 $mont=$_GET['month'];
						 $yar=$_GET['year'];
						 $_SESSION['month']=$_GET['month'];
						 $_SESSION['year']=$_GET['year'];
						 }
						 echo "<div class='panel-heading'>Expenses of   => $mont - $yar</div>";
					 }
					 else{
						 if(isset($_SESSION['year']))
						   $yar=$_SESSION['year'];
						else{
						 $yar=$_GET['year'];
						 $_SESSION['year']=$_GET['year'];
						}
						 echo "<div class='panel-heading'>Expense of   => $yar</div>";
					 }
					   ?>
					
				
				
					
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
 
			 if (!isset ($_GET['page']) ) {  
				$page = 1;  
			} else {  
				$page = $_GET['page']; 
				
			}  
		
			 if(isset($_GET['date']) || isset($_SESSION['date'])){
				if(isset($_SESSION['date'])){
				$datee=$_SESSION['date'];
				$cnt=3*3*($_GET['page']-1)+1;}
				else{
					$datee=$_GET['date'];
					$_SESSION['date']=$_GET['date'];
					$cnt=1;
					
				}
              
				$ret=$con->query("CALL dview('$userid','$datee')");
				$number_of_result =$ret->num_rows;  
		   
			 
				$number_of_page = ceil($number_of_result / $results_per_page);  
			   
				
			   
				$page_first_result = ($page-1) * $results_per_page; 
				clearStoredResults($con);
				$query=$con->query("CALL deview('$userid','$datee','$page_first_result','$results_per_page')");
				
			}
			elseif(isset($_GET['month'],$_GET['year']) || isset($_SESSION['month'],$_SESSION['year'])){
				if(isset($_SESSION['month'],$_SESSION['year'])){
					$month=$_SESSION['month'];
				    $year=$_SESSION['year'];
					$cnt=3*3*($_GET['page']-1)+1;
					
				}else{
					$month=$_GET['month'];
					$year=$_GET['year'];
					$_SESSION['month']=$_GET['month'];
					$_SESSION['year']=$_GET['year'];
					$cnt=1;
					
				}

				clearStoredResults($con);
				$ret=$con->query("CALL mview('$userid','$month','$year')");
				$number_of_result =$ret->num_rows;  
		   
			 
				$number_of_page = ceil($number_of_result / $results_per_page);  
			   
				
				$page_first_result = ($page-1) * $results_per_page;
				clearStoredResults($con);
				$query=$con->query("CALL meview('$userid','$month','$year','$page_first_result','$results_per_page')");
				
			}
			else{
				if(isset($_SESSION['year'])){
				$year=$_SESSION['year'];
				$cnt=3*3*($_GET['page']-1)+1;}
				else{
				$year=$_GET['year'];
				$_SESSION['year']=$_GET['year'];
				$cnt=1;
				}
				
				clearStoredResults($con);
				$ret=$con->query("CALL yview('$userid','$year')");
				$number_of_result =$ret->num_rows;  
		   
				
				
				$number_of_page = ceil($number_of_result / $results_per_page);  
			
			    
				$page_first_result = ($page-1) * $results_per_page; 
				clearStoredResults($con);
				// $query=$con->query("CALL yeview('$userid','$year','$page_first_result','$results_per_page'");
				$query=$con->query("select * from tblexpense where UserId='$userid' && year(ExpenseDate)='$year' LIMIT $page_first_result,$results_per_page");
				
			}
			if($_GET['page']==1 || $_GET['page']==NULL){
				$cnt=1;
			 }
            while ($row=$query->fetch_assoc()) {

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
							<li class="page-item"><a class="page-link" href="view_all.php?page=<?php if($page==1)echo $page; else echo $page-1;?>"> Previous </a></li>
								<?php
						for($i = 1; $i<=$number_of_page; $i++) { ?>
							
								<li class="page-item"><a class="page-link" href="view_all.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
							
								<?php } ?>
								<li class="page-item"><a class="page-link" href="view_all.php?page=<?php if($page>$number_of_page-1) echo $page; else echo $page+1;?>"> Next </a></li>
							</ul>
							</nav>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('../includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->



  	
		
	<?php include_once('../includes/footer.php');?>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
	
		
</body>
</html>
<?php } ?>