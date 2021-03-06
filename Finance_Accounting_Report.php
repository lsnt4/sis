<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="Finance_Income_Report.php" class="nav-item nav-link"><strong> Income Reports </strong></a>
							<a href="Finance_Expense_Report.php" class="nav-item nav-link"><strong> Expense Reports </strong></a>
							<a href="Finance_Payroll_Report.php" class="nav-item nav-link"><strong> Payroll Reports </strong></a>
							<a href="Finance_Leave_Report.php" class="nav-item nav-link"><strong> Leave Reports </strong></a>
							<a href="Finance_Bank_Accounts_Report.php" class="nav-item nav-link"><strong> Bank Account Reports </strong></a>
							<a class="nav-item nav-link active"><strong> Accounting Reports </strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<div class="row">
								<div class="col-md-4">
									<div class="card bg-light mb-4">
										<div class="card-header"><center>Veiw Expense History</center></div>
										<div class="card-body">
											
											<form action="" method="">
                                            	<p class="card-text">View expenses during a specific period of time.</p>
												<div class="form-group">
													<small class="form-text text-muted">Start Date</small>
													<input type="date" name="startdate" class="form-control">
												</div>
												<div class="form-group">
													<small class="form-text text-muted">End Date</small>
													<input type="date" name="enddate" class="form-control">
												</div>
                                                <p class="card-text">View expenses by their current status.</p>
                                                <div class="form-group">
                                                	<small class="form-text text-muted">Expense Status</small>
													<select name="gender" class="form-control" required>
														<option value="1" selected>All</option>
														<option value="0">Pending</option>
                                                        <option value="0">Closed</option>
													</select>
                                                </div>
                                                <p class="card-text">View expenses by their departments.</p>
                                                <div class="form-group">
                                                	<small class="form-text text-muted">Expense Department</small>
													<select name="gender" class="form-control" required>
														<option value="1" selected>All</option>
														<option value="0">Pending</option>
                                                        <option value="0">Closed</option>
													</select>
                                                </div>
                                                <p class="card-text">View expenses by their payment method.</p>
                                                <div class="form-group">
                                                	<small class="form-text text-muted">Expense Payment Method</small>
													<select name="gender" class="form-control" required>
														<option value="1" selected>All</option>
														<option value="0">Pending</option>
                                                        <option value="0">Closed</option>
													</select>
                                                </div>
												<button class="btn btn-dark btn-block" type="submit">View Expense Report</button>
											</form>
										</div>
									</div>
								</div>
                                
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
