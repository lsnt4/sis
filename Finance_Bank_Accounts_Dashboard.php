<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
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

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a class="nav-item nav-link active"><strong> Accounts Dashboard </strong></a>
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
                        	<div class="card bg-light mb-4">
								<div class="card-header">Bank Accounts Overview</div>
								<div class="card-body">
							<ul class="ca-menu">
									<li>
										<a href="Finance_Search_Bank_Accounts.php">
											
											<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main"><?php echo $row_tot_com; ?></h4>
												<h3 class="ca-sub"> Total Company Bank Accounts </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Search_Staff_Bank_Accounts.php">
										  <i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one"><?php echo $row_tot_emp; ?></h4>
												<h3 class="ca-sub one"> Total Staff Bank Accounts </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Add_Deposits.php">
											<i class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i>
											<div class="ca-content">
											<h4 class="ca-main two"><?php echo $row_dep; ?></h4>
												<h3 class="ca-sub two"> Total Deposits </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Add_Withdrawals.php">
											<i class="glyphicon glyphicon-warning-sign" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three"><?php echo $row_wit; ?></h4>
												<h3 class="ca-sub three"> Total Withdrawals </h3>
											</div>
										</a>
									</li>
								</ul>
                                </div>
                                </div>
                                </div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>