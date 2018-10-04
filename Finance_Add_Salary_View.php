<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	
		if(isset($_POST["add"])){
			$userid=$_POST["payid"];
			$month_pay = $_POST["month"];
			$year_pay = $_POST["year"];
			$pay_method = $_POST["pay_method"];
			$allowance= $_POST["allowance"];
			$ot_pay= $_POST["ot"];
			$empepf= $_POST["emp_epf"];
			$emptax= $_POST["emp_tax"];
			$comepf= $_POST["com_epf"];
			$cometf= $_POST["com_etf"];
			$net_sal= $_POST["net_sal"];
			$added_by=$session->get_session('userid');;
			date_default_timezone_set('Asia/Colombo');
			$added_date = date("Y-m-d h:i:s",time());
			$status = "pending";
					
			
			$sql_check_pay = "select * from payroll where staff_id='$userid' and month='$month_pay' and year='$year_pay'";
			$result_check_pay = $conn->query($sql_check_pay);
			
			if($result_check_pay->num_rows>0){
				set_error_msg("<strong>Failed!</strong> Already available in the Database!... Try new record to insert!...");
				header("Location: Finance_Add_Salary.php");	
			}else{
				$sql = "insert into payroll (staff_id,month,year,employee_epf,employee_tax,employer_epf,employer_etf,payment_method,allowance,overtime,net_sal,added_by,added_date,status) values".
				" ('$userid','$month_pay','$year_pay','$empepf','$emptax','$comepf','$cometf','$pay_method','$allowance','$ot_pay','$net_sal','$added_by','$added_date','$status')";
				
						if($conn->query($sql) == true){
							  		set_success_msg("<strong>Success!</strong> New payroll has been successfully inserted!");
									header("Location: Finance_Add_Salary.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Salary.php");
						  }
				
				}
		}
 
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gen_pay'])){
			$user_id = $_POST["user"];
			$payid = $_POST["user"];
			$month = $_POST["month"];
			$year = $_POST["year"];
			$method = $_POST["method"];

function getMonthNo($m){
    if($m=="January"){
        return 1;
    }else if($m=="February"){
        return 2;
    }else if($m=="March"){
        return 3;
    }else if($m=="April"){
        return 4;
    }else if($m=="May"){
        return 5;
    }else if($m=="June"){
        return 6;
    }else if($m=="July"){
        return 7;
    }else if($m=="August"){
        return 8;
    }else if($m=="September"){
        return 9;
    }else if($m=="October"){
        return 10;
    }else if($m=="November"){
        return 11;
    }else if($m=="December"){
        return 12;
    }
} 	
			
			$sql_check_pay = "select * from payroll where staff_id='$user_id' and month='month' and year='year'";
			$result_check_pay = $conn->query($sql_check_pay);
			
			if($result_check_pay->num_rows>0){
				set_error_msg("<strong>Failed!</strong> Already available in the Database!... Try new record to insert!...");
				header("Location: Finance_Add_Salary.php");	
			}
			
			$staff = "select * from users where userid='$user_id'";
			$result_staff = $conn->query($staff);
			$row = $result_staff->fetch_assoc();
			$salary = $row["salary"];
			
			$sql_standards = "select * from emp_pay_standards";
			$result_standards = $conn->query($sql_standards);
			$row_standards = $result_standards->fetch_assoc();
			
			$attendence = "select * from attendance where userid='$user_id' and MONTH(date) = '".getMonthNo($month)."' and YEAR(date) = '$year'";			
			$result_at=mysqli_query($conn,$attendence);
			$row_att=mysqli_num_rows($result_at);
	 	

?>
				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="Finance_Payroll_Dashboard.php" class="nav-item nav-link"><strong> Payroll Dashboard </strong></a>
							<a class="nav-item nav-link active"><strong> Add Payroll </strong></a>
                            <?php 
							$sql_tot = "SELECT * FROM payroll";
							$result_tot=mysqli_query($conn,$sql_tot);
							$row_tot=mysqli_num_rows($result_tot);
			
							$sql_close = "SELECT * FROM payroll where status='closed'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_close=mysqli_num_rows($result_close);
			
							$sql_pen = "SELECT * FROM payroll where status='pending'";
							$result_pen=mysqli_query($conn,$sql_pen);
							$row_pen=mysqli_num_rows($result_pen);
							?>
                            <a href="Finance_Update_Salary.php" class="nav-item nav-link"><strong> Update Payroll 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Delete_Salary.php" class="nav-item nav-link"><strong> Delete Payroll 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Verify_Salary.php" class="nav-item nav-link"><strong> Verify Payroll 
                            <?php if($row_pen>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_pen." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Closed_Salary.php" class="nav-item nav-link"><strong> Closed Payroll 
                            <?php if($row_close>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Download_Salary.php" class="nav-item nav-link"><strong> Download Payroll 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Edit_Standards.php" class="nav-item nav-link"><strong> Edit Standards </strong></a>							
						</div>
					</nav>
 <div class="container-fluid  m-5">
<div class="row">
<form action="Finance_Add_Salary_View.php" method="post" class="form" role="form" autocomplete="off">
<div class="alert alert-success" role="alert">
    <strong>Well done!</strong> These all are auto generated by the system!...
</div>
<div class="card-deck">
  					<div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Payslip Information</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">User ID</label>
                                    <div class="col-lg-5">
                                        <input class="form-control" name="payid" type="text" value="<?php echo $payid; ?>" readonly>
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="btn btn-success" type="button" onclick="openWinStaff(<?php echo "'".$user_id."'"; ?>)" value=" View ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Name</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value="<?php echo $row["fname"].".".$row["lname"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Month</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" name="month" type="text" value="<?php echo $month; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Year</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" name="year" type="text" value="<?php echo $year; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Payment Date</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value="<?php date_default_timezone_set('Asia/Colombo');
		echo date("Y-m-d h:i:s",time()); ?>"  readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label" >Payment Method</label>
                                    <div class="col-lg-5">
                                        <input class="form-control" name="pay_method" type="text" value="<?php echo $method; ?>"  readonly>
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="btn btn-success" type="button" onclick="openWin(<?php echo "'".$user_id."'"; ?>)" value=" View ">
                                    </div>
                                </div>
                          </div>
                          <div class="card-header">
                            <h4 class="mb-0">Gross Salary</h4>
                           </div> 
                           <div class="card-body">     
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Allowance </label>
                                    <div class="col-lg-8">
                                    	<?php $all = $row_standards["allowance_per_day"]*$row_att;?>
                                        <input class="form-control" name="allowance" type="text" value="<?php echo number_format((float)$all, 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Overtime </label>
                                    <div class="col-lg-8">
                                    	<?php $ot = 0*$row_standards["ot_per_hour"]; ?>
                                        <input class="form-control" name="ot" type="text" value="<?php echo number_format((float)$ot, 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Total Gross </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value="<?php echo number_format((float)($all+$ot), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Gross Salary </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value="<?php echo number_format((float)($salary+$all+$ot), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                        </div>
                    </div>
  					<div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Employee Deduction</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">EPF (<?php echo number_format((float)$row_standards["emp_epf"], 1, '.', ''); ?>%)</label>
                                    <div class="col-lg-8">
                                    	<?php $epf_emp = ($salary*$row_standards["emp_epf"])/100.0 ;?>
                                        <input class="form-control" name="emp_epf" type="text" value="<?php echo number_format((float)($epf_emp), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Tax (<?php echo number_format((float)$row_standards["emp_tax"], 1, '.', ''); ?>%)</label>
                                    <div class="col-lg-8">
                                    	<?php $tax_emp = ($salary*$row_standards["emp_tax"])/100.0 ;?>
                                        <input class="form-control" name="emp_tax" type="text" value="<?php echo number_format((float)($tax_emp), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Total</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value="<?php echo number_format((float)($epf_emp+$tax_emp), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                        </div>
                       <div class="card-header">
                            <h4 class="mb-0">Company Deduction</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">EPF (<?php echo number_format((float)($row_standards["com_epf"]), 1, '.', ''); ?>%)</label>
                                    <div class="col-lg-8">
                                    	<?php $epf_com = ($salary*$row_standards["com_epf"])/100.0 ;?>
                                        <input class="form-control" name="com_epf" type="text" value="<?php echo number_format((float)($epf_com), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">ETF (<?php echo number_format((float)($row_standards["com_etf"]), 1, '.', ''); ?>%)</label>
                                    <div class="col-lg-8">
                                    	<?php $etf_com = ($salary*$row_standards["com_etf"])/100.0 ;?>
                                        <input id="emp_epf" class="form-control" name="com_etf" type="text" value="<?php echo number_format((float)($etf_com), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Total </label>
                                    <div class="col-lg-8">
                                        <input id="emp_tax" class="form-control" type="text" value="<?php echo number_format((float)($etf_com+$epf_com), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                        </div>
                        <div class="card-header">
                            <h4 class="mb-0">Net Salary</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Basic Salary</label>
                                    <div class="col-lg-8">
                                        <input id="bas_sal" class="form-control" name="bas_sal" type="text" value="<?php echo number_format((float)($salary), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">Net Salary</label>
                                    <div class="col-lg-8">
                                        <input id="net_sal" class="form-control" name="net_sal" type="text" value="<?php echo number_format((float)($salary+$all+$ot-$tax_emp-$epf_emp), 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <a href="Finance_Add_Salary.php" class="btn btn-danger"> Cancel </a>
                                        <input type="submit" name="add" class="btn btn-success" value="Save Changes">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Employee Attendence</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label form-control-label">Attendence (Days)</label>
                                    <div class="col-lg-4">
                                        <input class="form-control" type="text" value="<?php echo $row_att; ?>" readonly="readonly">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="btn btn-success" type="button" onclick="openWindow(<?php echo "'".$month."'"; ?>,<?php echo "'".$year."'"; ?>,<?php echo "'".$user_id."'"; ?>)" value=" View ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label form-control-label">Overtime (Hours)</label>
                                    <div class="col-lg-4">
                                        <input class="form-control" type="text" value="0" readonly="readonly">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="btn btn-success disabled" type="button" value=" View " disabled="disabled">
                                    </div>
                                </div>
                        </div>
                       <div class="card-header">
                            <h4 class="mb-0">Company Standards</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">EPF</label>
                                    <div class="col-lg-7">
                                        <input class="form-control" type="text" value="<?php echo number_format((float)$row_standards["com_epf"], 1, '.', ''); ?>" readonly="readonly">
                                    </div>
                                    <div class="col-lg-1">%</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">ETF</label>
                                    <div class="col-lg-7">
                                        <input class="form-control" type="email" value="<?php echo number_format((float)$row_standards["com_etf"], 1, '.', ''); ?>" readonly="readonly">
                                    </div>
                                    <div class="col-lg-1">%</div>
                                </div>
                        </div>
                        <div class="card-header">
                            <h4 class="mb-0">Employee Standards</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label form-control-label">EPF</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="url" value="<?php echo number_format((float)$row_standards["emp_epf"], 1, '.', ''); ?>" readonly="readonly">
                                    </div>
                                    <div class="col-lg-1">%</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label form-control-label">Tax</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" value="<?php echo number_format((float)$row_standards["emp_tax"], 1, '.', ''); ?>" readonly="readonly">
                                    </div>
                                    <div class="col-lg-1">%</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label form-control-label">Allowance(per Day)</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="url" value="<?php echo number_format((float)$row_standards["allowance_per_day"], 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                    <div class="col-lg-1">LKR</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label form-control-label">OT Rate(per Hour)</label>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" value="<?php echo number_format((float)$row_standards["ot_per_hour"], 2, '.', ''); ?>" readonly="readonly">
                                    </div>
                                    <div class="col-lg-1">LKR</div>
                                </div>
                        </div>
                    </div>
                    
</div> 
</form>            
</div>
				
                    
<?php } ?>                
<?php include_once 'staff-footer.php'; ?>