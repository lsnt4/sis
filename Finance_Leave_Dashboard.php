<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	  	      
   			$sql_tot = "select * from users where userid NOT IN (select userid from leaves)";
			$result_tot=mysqli_query($conn,$sql_tot);
			$row_tot=mysqli_num_rows($result_tot);
			
			$sql_del = "SELECT * FROM leave_request where status='rejected'";
			$result_del=mysqli_query($conn,$sql_del);
			$row_del=mysqli_num_rows($result_del);
			
			$sql_close = "SELECT * FROM leave_request where status='approved'";
			$result_close=mysqli_query($conn,$sql_close);
			$row_close=mysqli_num_rows($result_close);
			
			$sql_pen = "SELECT * FROM leave_request where status='pending'";
			$result_pen=mysqli_query($conn,$sql_pen);
			$row_pen=mysqli_num_rows($result_pen);
	
			$sql_lea = "select * from leaves";
			$result_lea=mysqli_query($conn,$sql_lea);
			$row_lea=mysqli_num_rows($result_lea);
	 

?>

				<div class="col-md-10">                    
                    <nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active"><strong> Leave Dashboard </strong></a>
                        	<a href="Finance_Add_Leaves.php" class="nav-item nav-link"><strong> Add Leaves 
                            <?php if($row_tot>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_tot." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Update_Leaves.php" class="nav-item nav-link"><strong> Update Leaves 
                            <?php if($row_lea>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_lea." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Delete_Leaves.php" class="nav-item nav-link"><strong> Delete Leaves 
                            <?php if($row_lea>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_lea." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Verify_Leave_Request.php" class="nav-item nav-link"><strong> Leave Requests 
                            <?php if($row_pen>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_pen." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Approved_Leave_Request.php" class="nav-item nav-link"><strong> Approved Leaves 
                            <?php if($row_close>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_close." <span>";
								  } 
							?>
                            </strong></a>
                            <a href="Finance_Rejected_Leave_Request.php" class="nav-item nav-link"><strong> Rejected Leaves 
                            <?php if($row_del>0){
									echo "<span class='badge badge-danger badge-pill'> ".$row_del." <span>";
								  } 
							?>
                            </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
                        <div class="card bg-light mb-4">
								<div class="card-header">Leave Dashboard</div>
								<div class="card-body">
							<ul class="ca-menu">
									<li>
										<a href="Finance_Add_Leaves.php">
											
											<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main"><?php echo $row_tot; ?></h4>
												<h3 class="ca-sub"> Pending Leaves </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Rejected_Leave_Request.php">
										  <i class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main one"><?php echo $row_del; ?></h4>
												<h3 class="ca-sub one"> Rejected Leave Requests  </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Approved_Leave_Request.php">
											<i class="glyphicon glyphicon-ok-circle" aria-hidden="true"></i>
											<div class="ca-content">
											<h4 class="ca-main two"><?php echo $row_close; ?></h4>
												<h3 class="ca-sub two"> Approved Leave Requests </h3>
											</div>
										</a>
									</li>
									<li>
										<a href="Finance_Verify_Leave_Request.php">
											<i class="glyphicon glyphicon-warning-sign" aria-hidden="true"></i>
											<div class="ca-content">
												<h4 class="ca-main three"><?php echo $row_pen; ?></h4>
												<h3 class="ca-sub three"> Pending Leave Requests </h3>
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