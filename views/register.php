<?php 
session_start();
// error_reporting(0);
include('../includes/dbconnection.php');
include('../includes/procedures.php');
if(isset($_POST['submit']))
  {
    $fname=$_POST['name'];
    $mobno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $password=$_POST['password'];
	$ret=$con->query("CALL email('$email')");
    $result=$ret->fetch_assoc();
    if($result>0){
		$msg="This email  associated with another account";
    }
	else{

		if(isset($_FILES['image'])){
			$img_name = $_FILES['image']['name'];
			
			$tmp_name = $_FILES['image']['tmp_name'];

			$img_explode = explode('.',$img_name);
			$img_ext = end($img_explode);

			$extensions = ["gif","jpeg", "png", "jpg"];
			if(in_array($img_ext, $extensions) === true){
			   
				$time = time();
			    $new_img_name = $time.$img_name;
			if(move_uploaded_file($tmp_name,"../images/".$new_img_name)){
				$msg="image uploaded";
			} 
			
			}
		}
    
		clearStoredResults($con);
       $query=$con->query("CALL iuser('$fname', '$mobno', '$email', '$password', '$new_img_name' )");
			if ($query) {
			 clearStoredResults($con);
			 $query=$con->query("CALL config('$email','$password')");
			 $ret=$query->fetch_assoc();
			 if($ret)
			  $_SESSION['detsuid']=$ret['ID'];
			 header("location: dashboard.php");
		    }
		    else
			{
			 $msg="Something Went Wrong. Please try again";
			}
		
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker - Signup</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	<script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.repeatpassword.value)
{
	alert('Password and Repeat Password field does not match');
	document.signup.repeatpassword.focus();
	return false;
}
return true;
} 

}

</script>
<body>
	<div class="row">
			<h2 align="center">Daily Expense Tracker</h2>
	<hr />
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Sign Up</div>
				<div class="panel-body">
					<form role="form" action="" method="post" id="" name="signup" enctype="multipart/form-data" onsubmit="return checkpass();">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Full Name" name="name" type="text" required="true">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" required="true">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" maxlength="10" pattern="[0-9]{10}" required="true">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required="true">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Repeat Password" required="true">
							</div>
							<label>Upload Your Image</label>
							<div class="form-group">
							    <input type="file" class="form-control" name="image" id="image" placeholder="Upload Image">
							</div>
							
							<div class="checkbox">
								<button type="submit" value="submit" name="submit" class="btn btn-primary">Register</button><span style="padding-left:250px">
								<a href="index.php" class="btn btn-primary">Login</a></span>
							</div>
							 </fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>