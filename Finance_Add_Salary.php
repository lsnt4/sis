<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    $income_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM payroll");
	$result = mysqli_fetch_assoc($income_max); 
	$max = $result['maximum']+1;
	
	
	 

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
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Add_Salary_View.php" onSubmit="">
                            	<div class="form-group row">
									<label class="col-sm-2 col-form-label"> Payroll ID </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="" type="text" class="form-control" name="payid" value="<?php echo " PAY".$max; ?>"  readonly="readonly">
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> Payroll Month </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<select id="pay" name="month" class="form-control" required>
													<option value="January"> January </option>
													<option value="February"> February </option>
                                                    <option value="March"> March </option>
                                                    <option value="April"> April </option>
                                                    <option value="May"> May </option>
                                                    <option value="June"> June </option>
                                                    <option value="July"> July </option>
                                                    <option value="August"> August </option>
                                                    <option value="September"> September </option>
                                                    <option value="October"> October </option>
                                                    <option value="November"> November </option>
                                                    <option value="December"> December </option>
												</select>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> Payroll Year </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<select id="pay" name="year" class="form-control">
                                                	<option value="<?php echo date("Y");?>" selected><?php echo date("Y");?></option>
												</select>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label"> Payroll Method </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<select id="pay" name="method" class="form-control">
													<option value="Cash"> Cash </option>
													<option value="Cheque"> Cheque </option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"> Employee </label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
											<?php 
														$user = "select * from users";
														$result_user = $conn->query($user);
														if($result_user->num_rows>0){
															echo "<select id='' name='user' class='form-control' onChange=''>";
															while($row_user = $result_user->fetch_assoc()){
																echo "<option value='".$row_user["userid"]."'> ".$row_user["userid"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$row_user["fname"]." ".$row_user["lname"]." </option>";
															}
															echo "</select>";
														}else{
															echo "<input type='text' class='form-control' value='There are no Departments' readonly>";
														}
													?>	
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
												
													<input type="submit" name="gen_pay" class="btn btn-info" value="Generate Employee Payroll">
											
											</div>
                                            
										</div>
									</div>
								</div>
                             </form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>