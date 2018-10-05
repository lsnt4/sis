<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    $sql = "select * from emp_pay_standards where id = '1'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	
	if(isset($_POST['add'])){
		$com_epf = $_POST['comepf'];
		$com_etf = $_POST['cometf'];
		$emp_epf = $_POST['empepf'];
		$emp_tax = $_POST['emptax'];
		$allowance = $_POST['all'];
		$ot = $_POST['ot'];
		
		$sql_check = "select * from emp_pay_standards where allowance_per_day='$allowance' and ot_per_hour='$ot' and emp_epf='$emp_epf' and emp_tax='$emp_tax' and com_epf='$com_epf' and com_etf='$com_etf'";
		$result_check = $conn->query($sql_check);
		if($result_check->num_rows>0){
								set_error_msg("<strong>Oops!</strong> You are trying to update the same thing!...!");
								header("Location: Finance_Edit_Standards.php");
		}else{
								$sql_update = "update emp_pay_standards set allowance_per_day='$allowance', ot_per_hour='$ot', emp_epf='$emp_epf', emp_tax='$emp_tax' , com_epf='$com_epf' , com_etf='$com_etf' where id = 1";
								
								if($conn->query($sql_update) ==true){
									set_success_msg("<strong>Success!</strong> standards successfully updated!");
									header("Location: Finance_Edit_Standards.php");
								}else{
									set_error_msg("<strong>Oops!</strong> Something went wrong!...");
								  header("Location: Finance_Edit_Standards.php");
								}
			
		}
		
	}
	
	 

?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Payroll_Dashboard.php" class="nav-item nav-link"><strong> Payroll Dashboard </strong></a>
							<a href="Finance_Add_Salary.php" class="nav-item nav-link"><strong> Add Payroll </strong></a>
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
                            <a class="nav-item nav-link active"><strong> Edit Standards </strong></a>				
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Edit_Standards.php">
                            	<div class="form-group row">
									<label class="col-sm-2 col-form-label"> Company EPF </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="" type="text" class="form-control" name="comepf" value="<?php echo $row["com_epf"]; ?>" > 
											</div>
                                            <div class="col-md-3">
												%
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> Company ETF </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="" type="text" class="form-control" name="cometf" value="<?php echo $row["com_etf"]; ?>"> 
											</div>
                                            <div class="col-md-3">
												%
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> Employee EPF </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="" type="text" class="form-control" name="empepf" value="<?php echo $row["emp_epf"]; ?>"> 
											</div>
                                            <div class="col-md-3">
												%
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> Employee Tax </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="" type="text" class="form-control" name="emptax" value="<?php echo $row["emp_tax"]; ?>"> 
											</div>
                                            <div class="col-md-3">
												%
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> Allowance per Day </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="" type="text" class="form-control" name="all" value="<?php echo $row["allowance_per_day"]; ?>"> 
											</div>
                                            <div class="col-md-3">
												LKR
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> OT Rate per Hour </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="" type="text" class="form-control" name="ot" value="<?php echo $row["ot_per_hour"]; ?>">
											</div>
                                            <div class="col-md-3">
												LKR
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-10">
										<div class="form-row">
                                        
                                        	<div class="col-md-2">
												
													<input type="reset" class="btn btn-danger" value=" Reset all Fields ">
											
											</div>
                                        
											<div class="col-md-3">
												
													<input type="submit" name="add" class="btn btn-info" value="Edit Standards">
											
											</div>
                                            
										</div>
									</div>
								</div>
                             </form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>