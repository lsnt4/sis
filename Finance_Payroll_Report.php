<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php"; 

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="Finance_Income_Report.php" class="nav-item nav-link"><strong> Income Reports </strong></a>
							<a href="Finance_Expense_Report.php" class="nav-item nav-link"><strong> Expense Reports </strong></a>
							<a class="nav-item nav-link active"><strong> Payroll Reports </strong></a>
							<a href="Finance_Leave_Report.php" class="nav-item nav-link"><strong> Leave Reports </strong></a>
							<a href="Finance_Bank_Accounts_Report.php" class="nav-item nav-link"><strong> Bank Account Reports </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<div class="row">
								<div class="col-md-3">
									    <div class="card bg-light mb-4" style="height:370px;">
										<div class="card-header"><center>View Payroll History</center></div>
										<div class="card-body">
											
											<form action="Finance_Payroll_Report_Date_View.php" method="post">
                                            	<p class="card-text">View payrolls during a specific period of time.</p>
												<div class="form-group">
													<small class="form-text text-muted">Start Date</small>
													<input type="date" name="startdate" class="form-control" required>
												</div>
												<div class="form-group">
													<small class="form-text text-muted">End Date</small>
													<input type="date" name="enddate" class="form-control" required>
												</div>
												<button class="btn btn-dark btn-block" name="report" type="submit"> View Payroll Report </button>
											</form>
									   </div>
									   </div>
							</div> 
                            <div class="col-md-3">   
                                		<div class="card bg-light mb-4" style="height:175px;">
										<div class="card-header"><center>View Payroll History</center></div>
										<div class="card-body">
											<form action="Finance_Payroll_Report_Employee_Expense_View.php" method="post">
                                                <p class="card-text">View Employee Deductions of payrolls.</p>
												<button class="btn btn-dark btn-block" name="report" type="submit">View Payroll Report</button>
											</form>
										</div>
										</div>
                                        
                                        <div class="card bg-light mb-4" style="height:175px;">
										<div class="card-header"><center>View Company Expenses of Payroll</center></div>
										<div class="card-body">
											<form action="Finance_Payroll_Report_Company_Expense_View.php" method="post">
                                                <p class="card-text">View Company Expenses and Cost of Payroll.</p>
												<button class="btn btn-dark btn-block" name="report" type="submit">View Payroll Report</button>
											</form>
										</div>
										</div>
								</div>
                             <div class="col-md-3">
                                		<div class="card bg-light mb-4" style="height:370px;">
										<div class="card-header"><center>View Payroll History</center></div>
										<div class="card-body">
											
											<form action="Finance_Payroll_Report_Status_View.php" method="post">
                                                <p class="card-text">View payrolls by their status.</p>
                                                <div class="form-group">
                                                	<small class="form-text text-muted">Payroll Status</small>
													<select name="status" class="form-control" required>
                                                    <option value="All" selected> All </option>
                                                    <option value="pending">Pending</option>
                                                    <option value="closed">Closed</option>
													</select>
                                                </div>
												<button class="btn btn-dark btn-block" name="report" type="submit">View Payroll Report</button>
											</form>
										</div>
										</div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light mb-4" style="height:370px;">
										<div class="card-header"><center>View Payroll History</center></div>
										<div class="card-body">
											
											<form action="Finance_Payroll_Report_Method_View.php" method="post">
                                                <p class="card-text">View payrolls by their payment method.</p>
                                                <div class="form-group">
                                                	<small class="form-text text-muted">Payroll Payment Method</small>
													<select name="pay_method" class="form-control" required>
														<option value="All" selected>All</option>
                                                        <option value="Cash">Cash</option>
														<option value="Cheque">Cheque</option>
													</select>
                                                </div>
												<button class="btn btn-dark btn-block" name="report" type="submit">View Payroll Report</button>
											</form>
										</div>
									</div>
                            </div>    
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
