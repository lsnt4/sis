<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
    		$sql_tot = "SELECT * FROM payroll";
			$result_tot=mysqli_query($conn,$sql_tot);
			$row_tot=mysqli_num_rows($result_tot);
			
			$sql_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM payroll");
			$result_max = mysqli_fetch_assoc($sql_max); 
			$row_max = $result_max['maximum'];
			$row_del = $row_max - $row_tot;
			
			$sql_close = "SELECT * FROM payroll where status='closed'";
			$result_close=mysqli_query($conn,$sql_close);
			$row_close=mysqli_num_rows($result_close);
			
			$sql_pen = "SELECT * FROM payroll where status='pending'";
			$result_pen=mysqli_query($conn,$sql_pen);
			$row_pen=mysqli_num_rows($result_pen);
	
	 

?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a class="nav-item nav-link active"><strong> Payroll Dashboard </strong></a>
							<a href="Finance_Add_Salary.php" class="nav-item nav-link"><strong> Add Payroll </strong></a>
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
                        	<div class="card bg-light mb-4">
								<div class="card-header">Payroll Overview</div>
								<div class="card-body">
							<ul class="ca-menu">
									<li>
										<a href="Finance_Update_Salary.php">
											
											<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main"><?php echo $row_tot; ?></h4>
												<h3 class="ca-sub"> Total Payroll </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Delete_Salary.php">
										  <i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one"><?php echo $row_del; ?></h4>
												<h3 class="ca-sub one"> Deleted Payroll </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Closed_Salary.php">
											<i class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i>
											<div class="ca-content">
											<h4 class="ca-main two"><?php echo $row_close; ?></h4>
												<h3 class="ca-sub two"> Closed Payroll </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Verify_Salary.php">
											<i class="glyphicon glyphicon-warning-sign" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three"><?php echo $row_pen; ?></h4>
												<h3 class="ca-sub three"> Pending Payroll </h3>
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