<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    $income_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM incomes");
	$result = mysqli_fetch_assoc($income_max); 
	$max = $result['maximum']+1;
	
	
	 

?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active"> Add Incomes </a>
                            <a href="Finance_Update_Incomes.php" class="nav-item nav-link"> Update Incomes </a>
                            <a href="Finance_Delete_Incomes.php" class="nav-item nav-link"> Delete Incomes </a>
                            <a href="Finance_Verify_Incomes.php" class="nav-item nav-link"> Verify Incomes </a>
                            <a href="Finance_Closed_Incomes.php" class="nav-item nav-link"> Closed Incomes </a>
                            <a class="nav-item nav-link disabled"> Income Overview </a>
							<a class="nav-item nav-link disabled"> Income Reports </a>				
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" name="AddIncome" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return(incomeValidation());">
                            	
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Income ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="incomeid" type="text" class="form-control" name="incomeid" value="<?php echo " INC".$max; ?>"  readonly="readonly">
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="income_id_alert" class="message-hide" role="alert">
  											<strong id="strong_message1"></strong><span id="soft_message1"></span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Catogory</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                    <?php 
														$deparments = "select * from departments";
														$result_deparment = $conn->query($deparments);
														if($result_deparment->num_rows>0){
															echo "<select id='dept' name='department' class='form-control' onChange='deptChange(this);selOthers(this);progress();'>";
															echo "<option value='Selected' selected>Please Select</option>";
															while($row_dept = $result_deparment->fetch_assoc()){
																echo "<option value='".$row_dept["name"]."'> ".$row_dept["name"]." </option>";
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
									<div class="col-sm-7">
                                    	<div id="catogory_alert" class="message-hide" role="alert">  											<strong id="strong_message2"></strong><span id="soft_message2"></span>
										</div>
									</div>
								</div>
                                
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Description</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<select id="dept_task" name='description' class='form-control' onChange='deptOthers(this);progress();'>
                                                	<option value="Selected" selected>Please Select a Department</option>
                                                </select>
											</div>
                                            <div class="col-md-3">
                                            	<input id="other_desc" type="hidden" class="form-control" name="other_desc" placeholder=" Other Description ">
                                            </div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="dept_task_alert" class="message-hide" role="alert">
  											<strong id="strong_message3"></strong><span id="soft_message3"></span>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Payment Method</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<select id="pay" name="payment" class="form-control" onChange="payOthers(this);">
                                                	<option value="Selected" selected>Please Select</option>
													<option value="Cash">Cash</option>
													<option value="Cheque">Cheque</option>
													<option value="Others">Others</option>
												</select>
											</div>
                                            <div class="col-md-3">
                                            	<input id="other_pay" type="hidden" class="form-control" name="other_pay" placeholder=" Other Payment Option ">
                                            </div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="payment_alert" class="message-hide" role="alert">
  											<strong id="strong_message4"></strong><span id="soft_message4"></span>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Amount</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="amount" type="text" class="form-control" name="amount" placeholder="Amount">
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="amount_alert" class="message-hide" role="alert">
                                        
  											<strong id="strong_message5"></strong><span id="soft_message5"></span>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">Paid By</label>
									<div class="col-sm-10">
										<div class="form-row">
                                        	<div class="col-md-3">
												<select id="paidby_cat" name="department" class="form-control" onchange="paidCatogory(this);progress();">
													<option value="Selected">Please Select</option>
                                                    <option value="student">Student</option>
                                                    <option value="staff">Staff</option>
                                                    <option value="others">Others</option>
												</select>
											</div>
                                        	<div class="col-md-3">
												<input id="paidby_others" type="text" class="form-control message-hide" name="paid_by" placeholder=" Other Payee ">
                                                <select id="paidby_staff" name="department" class="form-control message-hide">
													<option value="Selected">Please Select a Staff</option>
                                                    <?php
                                                     require_once "DB_Connection.php";
													 $sql_staff = "select userid,fname,lname from users";
													 $result_staff = $conn->query($sql_staff);
													 if($result_staff->num_rows>0){
														 while($row_staff = $result_staff->fetch_assoc()){
															 echo "<option value='".$row_staff["userid"]."'>".$row_staff["userid"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row_staff["fname"]." ".$row_staff["lname"]."</option>";
														 }
													 }
													  
													?>
												</select>
                                                
                                                <select id="paidby_student" name="department" class="form-control message-hide">
													<option value="Selected">Please Select a Student</option>
                                                    <?php
													 
													 $sql_student = "select sid,fname,lname from students";
													 $result_student = $conn->query($sql_student);
													 if($result_student->num_rows>0){
														 while($row_student = $result_student->fetch_assoc()){
															 echo "<option value='".$row_student["sid"]."'>".$row_student["sid"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row_student["fname"]." ".$row_student["lname"]."</option>";
														 }
													 }
													 $conn->close();
													  
													?>
												</select>
                                                
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="paidby_alert" class="message-hide" role="alert">
  											<strong id="strong_message6"></strong><span id="soft_message6"></span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
                                    	<div class="form-row">
										<div class="col-md-7">
                                    		<!--div class="progress">
<div id="progress_bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success active" role="progressbar" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><strong id="progress_value">  </strong></div>
											</div-->
										</div>
										<div class="col-md-3">
											<input id="income_submit" type="submit" class="btn btn-dark" value=" Add an Income">
                                        </div>
                                        </div>
									</div>
                               	 </div>
                            
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
