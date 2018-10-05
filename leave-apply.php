<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	
	$user = $session->get_session('userid');
	  	      
	
	if(isset($_POST["add"])){
		$dept_task_other = "";
		$pay_method_others = "";
		$paid_by_stu = "";
		$paid_by_staff = "";
		$paid_by_others = "";
		
		
		$deparment_name = $_POST["department"];
		$dept_task = $_POST["description"];
		$dept_task_other = $_POST["other_desc"];
		$pay_method = $_POST["payment"];
		$pay_method_others = $_POST["other_pay"];
		$amount =  $_POST["amount"];
		$paid_by_cat = $_POST["paidby_cat"];
		$paid_by_stu = $_POST["student"];
		$paid_by_staff = $_POST["staff"];
		$paid_by_others = $_POST["others"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		$status = "pending";
		
		{
				if($dept_task == "Others")
					$final_dept_task = ucwords(strtolower($dept_task_other));
				else
					$final_dept_task = $dept_task;
		}
		
		{
			if($pay_method == "Others")
				$final_pay_method = ucwords(strtolower($pay_method_others));
			else
				$final_pay_method = $pay_method;
		}
		
		{
			if($paid_by_cat == "student")
				$final_paid_by = $paid_by_stu;
			else if($paid_by_cat == "staff")
				$final_paid_by = $paid_by_staff;
			else
				$final_paid_by = ucwords(strtolower($paid_by_others));
		}
		
		$sql_check = "select * from incomes where catogory='$deparment_name' and description='$final_dept_task' and payment_method='$final_pay_method' and amount='$amount' and paid_by='$final_paid_by'";
		$result_check = $conn->query($sql_check);
		
		if($result_check->num_rows>0){
			echo "<script> alert(' The record you inserted already available in database!.. Try a new record!..') </script>";
			set_error_msg("<strong>Failed!</strong> Already available in the Database!... Try new record to insert!...");
			header("Location: Finance_Add_Incomes.php");
			
		}
		else{
			reset_error_msg();
			$sql_insert = "insert into incomes (catogory,description,payment_method,amount,paid_by,added_by,added_date,status) values"
						  ." ('$deparment_name','$final_dept_task','$final_pay_method','$amount','$final_paid_by','$added_by','$added_date','$status')";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong> New income has been successfully inserted!");
									header("Location: Finance_Add_Incomes.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Incomes.php");
						  }
		}
	}
	 

?>

				<div class="col-md-8">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<?php 			
							$sql_close = "SELECT * FROM leave_request where userid = '$user'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_close=mysqli_num_rows($result_close);
							?>
                            <a href="leave-balance.php" class="nav-item nav-link"><strong> Leave Balance </strong></a>
                            <a class="nav-item nav-link active"><strong> Apply Leave </strong></a>	
                            <a href="leave-request.php" class="nav-item nav-link"><strong> Leave Requests 
                            <?php if($row_close>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" name="AddIncome" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return(incomeValidation());">
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="income_id_alert" class="message-hide" role="alert">
  											<strong id="strong_message1"></strong><span id="soft_message1"></span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Leave Type</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
														<select id='dept' name='type' class='form-control'>
															<option value='Selected' selected>Please Select</option>
                                                            <option value='Casual' >Casual Leave</option>
                                                            <option value='Vacation' >Vacation Leave</option>
                                                            <option value='Sick' >Sick Leave</option>
														</select>
												
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-sm-7">
                                    	<div id="catogory_alert" class="message-hide" role="alert">  											
                                        <strong id="strong_message2"></strong><span id="soft_message2"></span>
										</div>
									</div>
								</div>
                                <div class="form-group row">
									<label class="col-sm-2 col-form-label">No. of Days</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input id="amount" min="0.5" type="number" class="form-control" name="days" placeholder="No. of Days">
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
									<label class="col-sm-2 col-form-label">Reason</label>
									<div class="col-sm-10">
										<div class="form-row">
                                        	<div class="col-md-6">
												<textarea rows="10" class="form-control" placeholder=" Reason " name="reason"></textarea>
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
										<div class="col-md-3">
											<input id="income_submit" name="add" type="submit" class="btn btn-dark" value=" Apply Leave ">
                                        </div>
                                        </div>
									</div>
                               	 </div>
                            
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>