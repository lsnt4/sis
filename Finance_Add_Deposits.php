<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    $income_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM bank_transactions");
	$result = mysqli_fetch_assoc($income_max); 
	$max = $result['maximum']+1;
	
	$tot = 0;
	$income_tot = "select amount from bank_transactions where type='deposit'";
	$result_tot = $conn->query($income_tot);
	while($row_tot = $result_tot->fetch_assoc()){
		$tot = $tot + $row_tot["amount"];
	}
	
	if(isset($_POST["add"])){
		
		$account = $_POST["account"];
		$amount = $_POST["amount"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		
			$sql_insert = "insert into bank_transactions (acc_id,amount,type,added_by,added_date) values"
						  ." ('$account','$amount','deposit','$added_by','$added_date')";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong> New Deposit has been successfully inserted!");
									header("Location: Finance_Add_Deposits.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Deposits.php");
						  }
		
	}
	
	if(isset($_POST["delete"])){
		
		$id = $_POST["dep_id"];
			$sql_insert = "delete from bank_transactions where id = '$id'";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong>  Deposit DEP".$id." has been successfully deleted!");
									header("Location: Finance_Add_Deposits.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Deposits.php");
						  }
	}

	if(isset($_POST["pending"])){
		
		$id = $_POST["dep_id"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		
		
			$sql_insert = "Update bank_transactions set status='closed',verified_by='$added_by',verified_date='$added_date' where id = '$id'";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong>  Deposit DEP".$id." has been successfully Moved to Closed!");
									header("Location: Finance_Add_Deposits.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Deposits.php");
						  }
	}
	
	if(isset($_POST["closed"])){
		
		$id = $_POST["dep_id"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		
		
			$sql_insert = "Update bank_transactions set status='pending',verified_by='$added_by',verified_date='$added_date' where id = '$id'";
						  if($conn->query($sql_insert) == true){
							  		set_success_msg("<strong>Success!</strong>  Deposit DEP".$id." has been successfully Moved to Pending!");
									header("Location: Finance_Add_Deposits.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Deposits.php");
						  }
	}

?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Bank_Accounts_Dashboard.php" class="nav-item nav-link"><strong> Accounts Dashboard </strong></a>
                            <?php
							$sql_tot_com = "SELECT * FROM bank_accounts WHERE userid = 0";
							$result_tot_com=mysqli_query($conn,$sql_tot_com);
							$row_tot_com=mysqli_num_rows($result_tot_com);
			
							$sql_tot_emp = "SELECT * FROM bank_accounts WHERE userid != 0";
							$result_tot_emp=mysqli_query($conn,$sql_tot_emp);
							$row_tot_emp=mysqli_num_rows($result_tot_emp);
			
							$sql_close = "SELECT * FROM bank_transactions where type='deposit'";
							$result_close=mysqli_query($conn,$sql_close);
							$row_dep=mysqli_num_rows($result_close);
			
							$sql_pen = "SELECT * FROM bank_transactions where type='withdraw'";
							$result_pen=mysqli_query($conn,$sql_pen);
							$row_wit=mysqli_num_rows($result_pen);
							?>
							<a href="Finance_Add_Bank_Accounts.php" class="nav-item nav-link"><strong> Add Bank Account </strong></a>
							<a href="Finance_Search_Bank_Accounts.php" class="nav-item nav-link"><strong> Search Bank Account 
                            <?php 
							if($row_tot_com > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_tot_com." <span>";
							}
							?>
                            </strong></a>
							<a href="Finance_Add_Staff_Bank_Accounts.php" class="nav-item nav-link"><strong> Add Staff Account </strong></a>
							<a href="Finance_Search_Staff_Bank_Accounts.php" class="nav-item nav-link "><strong> Search Staff Account 
                            <?php 
							if($row_tot_emp > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_tot_emp." <span>";
							}
							?>
                            </strong></a>
							<a class="nav-item nav-link active"><strong> Deposits 
                            <?php 
							if($row_dep > 0){
								echo "<span class='badge badge-success badge-pill'> ".$row_dep." <span>";
							}
							?>
                            </strong></a>
                            <a href="Finance_Add_Withdrawals.php" class="nav-item nav-link"><strong> Withdrawals 
                            <?php 
							if($row_wit > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_wit." <span>";
							}
							?>
                            </strong></a>
                            <a href="Finance_Bank_Balance.php" class="nav-item nav-link"><strong> Bank Balance 
                            <?php 
							if($row_tot_com > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_tot_com." <span>";
							}
							?>
                            </strong></a>				
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
                        <form method="post" action="Finance_Add_Deposits.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="amount"> Amount </option>
                                                <option value="status"> Status </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Add_Deposits.php"> Refresh </a>
											</div>
										</div>
										</div>
									</div>
								</div>
                              </form>
                        <div class="row">
                        <div class="col-md-9">
							<form method="post" name="AddIncome" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return(incomeValidation());">
                            	
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Deposit ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="incomeid" type="text" class="form-control" name="dep_id" value="<?php echo " DEP".$max; ?>"  readonly="readonly">
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
									<label class="col-sm-2 col-form-label">Bank Account</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                    <?php 
														$deparments = "select * from bank_accounts where userid = 0";
														$result_deparment = $conn->query($deparments);
														if($result_deparment->num_rows>0){
															echo "<select id='dept' name='account' class='form-control' onChange='deptChange(this);selOthers(this);progress();'>";
															echo "<option value='Selected' selected>Please Select</option>";
															while($row_dept = $result_deparment->fetch_assoc()){
																echo "<option value='".$row_dept["id"]."'> ".$row_dept["account_no"]." ".$row_dept["bankname"]." ".$row_dept["branch"]." </option>";
															}
															echo "</select>";
														}else{
															echo "<input type='text' class='form-control' value='There are no Company Accounts' readonly>";
														}
													?>
												
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
									<label class="col-sm-2 col-form-label">Amount</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input id="amount" type="number" class="form-control" name="amount" placeholder="Amount">
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
									<div class="col-sm-10">
                                    	<div class="form-row">
										<div class="col-md-3">
											<input id="income_submit" name="add" type="submit" class="btn btn-dark" value=" Add Deposit">
                                        </div>
                                        </div>
									</div>
                               	 </div>
							</form>
                            </div>
                            
                <div class="col-md-3">
					<div class="finance-box">
						<h5>Total Deposit :</h5>
						<h3>Rs. <?php echo $tot; ?>/=</h3>
						<hr>
						<a href="Finance_Bank_Balance.php" class="btn btn-success btn-lg btn-block"> View Bank Account Balance </a>
                    </div>
				</div>
                </div>
                             <?php
												if(isset($_POST["search"])){
													$search = $_POST["search_opt"];
													$s_text = $_POST["s_text"];
													if(empty($s_text)){
														echo "<script>alert(' Search Text is Empty!... ')</script>";
														$sql_delete = "select * from bank_transactions where type='deposit'";
													}else{
														$sql_delete = "select * from bank_transactions where ".$search." like '%".$s_text."%' and type='deposit'";
													}
													
												}else{
													$sql_delete = "select * from bank_transactions where type='deposit'";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Deposit ID</center></th>
																<th scope="col" colspan="2"><center>Account Details</center></th>
																<th scope="col"><center>Amount</center></th>
																<th scope="col" colspan="2"><center>Added By</center></th>
                                                    			<th scope="col"><center>Added Date</center></th>
                                                                <th scope="col" colspan="2"><center>Verified By</center></th>
                                                    			<th scope="col"><center>Verified Date</center></th>
                                                                <th scope="col"><center>Status</center></th>
                                                    			<th scope="col"><center>Operation</center></th>   
															</tr>
														</thead>
                                            <?php
													$b = 0;
													while($row = $result->fetch_assoc()){
														$bg_color = ($b++%2==1) ? 'odd' : 'even';
											?>
                                            			<tbody>
															<tr class="<?php echo $bg_color; ?>">
																<th scope="row">DEP<?php echo $row["id"]; ?></th>
																<td>ACT<?php echo $row["acc_id"]; ?></td>
																<td><center><button class="btn btn-outline-info" type="button" onclick="openWinAccount(<?php echo $row["acc_id"]; ?>);"><span class="glyphicon glyphicon-list-alt"></span></button></center></td>
                                                    			<td><?php echo $row["amount"]; ?></td>
																<?php if($row["added_by"]==0 || $row["added_by"]==""){
																		$result_added_by = " _ ";
																		$result_added_by_btn = "message-hide";
																	}else{
																		$result_added_by = $row["added_by"];
																		$result_added_by_btn = "";
																	} 
																?>
                                                                <td><center><?php echo $result_added_by; ?></center></td>
                                                                <td><center><button class="btn btn-outline-info <?php echo $result_added_by_btn;  ?>" type="button" onclick="openWinStaff(<?php echo $row["added_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></center></td>
                                                                <?php if($row["added_date"]=="0000-00-00 00:00:00"){
																		$result_added_date = " _ ";
																	}else{
																		$result_added_date = $row["added_date"];
																	} 
																?>
																<td><center><?php echo $result_added_date; ?></center></td>
                                                                <?php if(empty($row["verified_by"])){
																		$result_verified_by = " _ ";
																		$result_verified_by_btn = "message-hide";
																	}else{
																		$result_verified_by = $row["verified_by"];
																		$result_verified_by_btn = "";
																	} 
																?>
                                                                <td><?php echo $result_verified_by; ?></td>
                                                                <td><button class="btn btn-outline-info <?php echo $result_verified_by_btn; ?>" type="button" onclick="openWinStaff(<?php echo $row["verified_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <?php if($row["verified_date"]=="0000-00-00 00:00:00"){
																		$result_ver_date = " _ ";
																	}else{
																		$result_ver_date = $row["verified_date"];
																	} 
																?>
                                                    			<td><?php echo $result_ver_date; ?></td>
                                                                <th class="<?php echo $row["status"]; ?>"><?php echo $row["status"]; ?></th>
                                                   				<th scope="row">
                                             					<form action="Finance_Add_Deposits.php" method="post" onSubmit="return confirm('WARNING!\n\n1. Accidentally verifying or deleting of records cannot backup from the system.\n2. There is no way to undo this action.\n\nDo you still really want to continue DEP<?php echo $row["id"]; ?>?');">
                                                               		<input type="hidden" value="<?php echo $row["id"]; ?>" name="dep_id">
                                                                    <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
  																		<?php if($row["status"] == "pending"){?>
  																		<button type="submit" name="pending" class="btn btn-dark">Move to Closed &nbsp; </button>
                                                                        <?php }  if($row["status"] == "closed"){?>
                                                                        <button type="submit" name="closed" class="btn btn-secondary">Move to Pending</button>
                                                                        <?php } ?>
  																		<button type="submit" name="delete" class="btn btn-danger">Delete</button>
																	</div>
                                                        		</form>
                                                                </th>
															</tr>
														</tbody>
				                             <?php
									
                                                	}
													echo "</table>";
													
											
													$conn->close();
												}else{
											?>
															<tr>
                                               				    <th scope="col" colspan="18"><center>No Results Available</center></th>   
															</tr>
											<?php
													}
												 
											?>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>