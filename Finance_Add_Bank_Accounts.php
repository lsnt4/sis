<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php";

$com_acc = "select * from bank_accounts where userid = 0";
$result_com_acc = $conn->query($com_acc);
$tot_com_acc = $result_com_acc->num_rows;


$staff_acc = "select * from bank_accounts where userid != 0";
$result_staff_acc = $conn->query($staff_acc);
$tot_Staff_acc = $result_staff_acc->num_rows;

$error_msg = " ";

	if(isset($_POST["add"])){
		
		$ano = $_POST["ano"];
		$bank_name = $_POST["bank_name"];
		$branch_name = $_POST["branch_name"];
		$added_by = $session->get_session('userid');
		date_default_timezone_set('Asia/Colombo');
		$added_date = date("Y-m-d h:i:s",time());
		
		foreach($ano AS $key => $value){
			$sql_check = "select * from bank_accounts where account_no = '".$value."'";
			$result_check = $conn->query($sql_check);
			
			if($result_check->num_rows>0){
				$error_msg .= "<div class='alert alert-danger' role='alert'>
  									<strong>Oh snap! ".$value." </strong> is already available in database!... Try new account number!...
							   </div>";
				//continue;
			}else{
				$sql_insert = "insert into bank_accounts (account_no,bankname,branch,added_by,added_date) values ('".$value."','".$bank_name[$key]."','".$branch_name[$key]."','$added_by','$added_date')";
				
						  if($conn->query($sql_insert) == true){
							  		$error_msg .= "<div class='alert alert-success' role='alert'>
  														<strong>Well Done! ".$value." </strong> New Company Bank Account has been successfully inserted!!...
							   						</div>";
							  }
						  else{
								  	$error_msg .= "<div class='alert alert-danger' role='alert'>
  														<strong>Oops! ".$value." </strong> is not inserted!... Something went wrong!...
							   					   </div>";
								  
						  }
						  //header("Location: Finance_Add_Incomes.php");
			}
			
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
							<a class="nav-item nav-link active"><strong> Add Bank Account </strong></a>
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
							<a href="Finance_Add_Deposits.php" class="nav-item nav-link"><strong> Deposits 
                            <?php 
							if($row_dep > 0){
								echo "<span class='badge badge-danger badge-pill'> ".$row_dep." <span>";
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
                        <div class="row">
                        <div class="col-md-9">
							<form method="post" action="Finance_Add_Bank_Accounts.php">
                            	<div id="account_form">
                                <!-- div class="form-seperator" -->
                                <div class="form-group row">
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-8">
                                            	<?php echo $error_msg; ?>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Account No.</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" placeholder=" Account No. " class="form-control" name="ano[]" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Bank Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" placeholder=" Bank Name " class="form-control" name="bank_name[]" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Branch Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" placeholder=" Branch Name " class="form-control" name="branch_name[]" required>
											</div>
                                            <div class="col-md-3">
												<button id="add" type="button" class="btn btn-success">Add Multiple Accounts</button>
											</div>
										</div>
									</div>
								</div>
                                <hr>
                                <!-- /div -->
                                </div>
                                <div class="form-group row">
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<button type="submit" name="add" class="btn btn-info">Submit all Accounts</button>
											</div>
										</div>
									</div>
								</div>
							</form>
                            </div>
                            <div class="col-md-3">
					<div class="payment-box">
						<h5>Total Company Accounts:</h5>
						<h3> <?php echo $tot_com_acc; ?> Accounts</h3>
						<hr>
						<a href="Finance_Search_Bank_Accounts.php" class="btn btn-success btn-lg btn-block"> View Company Accounts </a>
                        <hr>
                        <h5>Total Staff Accounts:</h5>
						<h3> <?php echo $tot_Staff_acc; ?> Accounts</h3>
						<hr>
						<a href="Finance_Search_Staff_Bank_Accounts.php" class="btn btn-success btn-lg btn-block"> View Staff Accounts </a>
                        <hr>
					</div>
				</div>
                            </div>
						</div>
					</div>
				</div>
<!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script -->

<?php include_once 'staff-footer.php'; ?>