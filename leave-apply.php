<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	
	$user = $session->get_session('userid');
	  	      
	
	if(isset($_POST["add"])){
		
		
		$type = $_POST["type"];
		$days = $_POST["days"];
		$reason = $_POST["reason"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		$status = "pending";
		

		
			$sql_insert = "insert into leave_request (userid,l_type,days,reason,added_date,status) values"
						  ." ('$added_by','$type','$days','$reason','$added_date','$status')";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong> New Leave Request has been successfully inserted!");
									header("Location: leave-apply.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: leave-apply.php");
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
							<form method="post" name="AddIncome" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return confirm('WARNING!\n\n1. Accidentally applying leave cannot backup from the system.\n2. There is no way to undo this action.\n\nDo you still really want to apply a leave?');">
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
												<input id="amount" min="1" type="number" class="form-control" name="days" placeholder="No. of Days">
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