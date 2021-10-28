<?php
include_once('procedures.php');
include('dbconnection.php');
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
              <?php  
               
                $uid=$_SESSION['detsuid'];
                clearStoredResults($con);
                $sql = "CALL simage('$uid')";  
                $result = $con->query($sql);  
                while($row = $result->fetch_assoc())  
                {    
                           
                    echo '<a href="../views/user-profile.php"> <img src="../images/'.$row['Images'].'" alt="" /> </a> ';    
                }  
                clearStoredResults($con);
                ?> 
            </div>
            <div class="profile-usertitle">
                <?php
                    $uid=$_SESSION['detsuid'];
                    
                    $ret=$con->query("CALL sfullname('$uid')");
                    $row=$ret->fetch_assoc();
                    $name=$row['FullName'];
                    clearStoredResults($con);
                ?>

                <div class="profile-usertitle-name"><?php echo $name; ?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        
        <ul class="nav menu">
            <li><a href="../views/dashboard.php"><em class="fas fa-columns">&nbsp;</em> Dashboard</a></li>
            
            
           
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em><i class="fas fa-money-bill-wave"></i> Transactions <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="../views/add-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Expenses
                    </a></li>
                    <li><a class="" href="../views/add-income.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Income
                    </a></li>
                    <li><a class="" href="../views/manage-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Manage Expenses
                    </a></li>
                    
                </ul>

            </li>
           
            <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-navicon">&nbsp;</em><i class="fas fa-book"></i> Expense Report <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2">
                    <li><a class="" href="../views/expense-datewise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Daywise Expenses
                    </a></li>
                    <li><a class="" href="../views/expense-monthwise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Monthwise Expenses
                    </a></li>
                    <li><a class="" href="../views/expense-yearwise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Yearwise Expenses
                    </a></li>
                    
                </ul>
            </li>
      




            <li><a href="../views/add-fix.php"><em class="fab fa-autoprefixer">&nbsp;</em> Add Fix Transaction</a></li>
            <li><a href="../views/Overview.php"><em class="fas fa-chart-pie">&nbsp;</em> Overview</a></li>
            <li><a href="../views/user-profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
             <li><a href="../views/change-password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a></li>
<li><a href="../controller/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>

        </ul>
    </div>



