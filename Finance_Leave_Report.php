<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php"; 

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="Finance_Income_Report.php" class="nav-item nav-link"><strong> Income Reports </strong></a>
							<a href="Finance_Expense_Report.php" class="nav-item nav-link"><strong> Expense Reports </strong></a>
							<a href="Finance_Payroll_Report.php" class="nav-item nav-link"><strong> Payroll Reports </strong></a>
							<a class="nav-item nav-link active"><strong> Leave Reports </strong></a>
							<a href="Finance_Bank_Accounts_Report.php" class="nav-item nav-link"><strong> Bank Account Reports </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<div class="row">
								<div class="col-md-3">
									    <div class="card bg-light mb-4" style="height:350px;">
										<div class="card-header"><center>View Leave Request History</center></div>
										<div class="card-body">
											
											<form action="Finance_Leave_Report_Date_View.php" method="post">
                                            	<p class="card-text">View leaves during a specific period of time.</p>
												<div class="form-group">
													<small class="form-text text-muted">Start Date</small>
													<input type="date" name="startdate" class="form-control" required>
												</div>
												<div class="form-group">
													<small class="form-text text-muted">End Date</small>
													<input type="date" name="enddate" class="form-control" required>
												</div>
												<button class="btn btn-dark btn-block" name="report" type="submit"> View Leave Request Report </button>
											</form>
									   </div>
									   </div>
							</div> 
                            <div class="col-md-3">   
                                		<div class="card bg-light mb-4" style="height:350px;">
										<div class="card-header"><center>View Leave History</center></div>
										<div class="card-body">
											
											<form action="Finance_Leave_Report_Status_View.php" method="post">
                                                <p class="card-text">View leaves by their current status.</p>
                                                <div class="form-group">
                                                	<small class="form-text text-muted">Leave Status</small>
													<select name="status" class="form-control" required>
														<option value="all" selected>All</option>
														<option value="pending">Pending</option>
                                                        <option value="approved">Approved</option>
                                                        <option value="rejected">Rejected</option>
													</select>
                                                </div>
												<button class="btn btn-dark btn-block" name="report" type="submit">View Leave Status Report</button>
											</form>
										</div>
										</div>
								</div>
                             <div class="col-md-3">
                                		<div class="card bg-light mb-4" style="height:350px;">
										<div class="card-header"><center>View Leave Balance</center></div>
										<div class="card-body">
											
											<form action="Finance_Leave_Report_Count_View.php" method="post">
                                                <p class="card-text">View leaves balance of each staff.</p>
                                                <p class="card-text">Three kind of leaves available. They are Vacation Leaves, Casual Leaves and Sick Leaves.</p>
												<button class="btn btn-dark btn-block" name="report" type="submit">View Leave Balance Report</button>
											</form>
										</div>
										</div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light mb-4" style="height:350px;">
										<div class="card-header"><center>View Leave History</center></div>
										<div class="card-body">
											
											<form action="Finance_Leave_Report_Type_View.php" method="post">
                                                <p class="card-text">View leave requests by their type.</p>
                                                <div class="form-group">
                                                	<small class="form-text text-muted">Leave Type</small>
													<select name="pay_method" class="form-control" required>
														<option value="All" selected>All</option>
                                                        <option value="Vacation">Vacation</option>
														<option value="Casual">Casual</option>
														<option value="Sick">Sick</option>
													</select>
                                                </div>
												<button class="btn btn-dark btn-block" name="report" type="submit">View Leave Report</button>
											</form>
										</div>
									</div>
                            </div>    
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
