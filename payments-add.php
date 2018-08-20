<?php include_once 'staff-header.php'; ?>
				<div class="col-md-8">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active">Add</a>
							<a href="payments-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="payments-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="payments-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-add.php" class="form-seperator">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Invoice ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="eid" value="INV0348" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Type</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<select name="department" class="form-control">
													<option value="Admin">Admin</option>
													<option value="Resource">Resource</option>
													<option value="Student">Student</option>
													<option value="Course">Course</option>
													<option value="Exam">Exam</option>
													<option value="Finance">Finance</option>
													<option value="Library">Library</option>
													<option value="Payment">Payment</option>
													<option value="Staff" selected>Library</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Description</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<select name="department" class="form-control">
													<option value="Admin">Admin</option>
													<option value="Resource">Resource</option>
													<option value="Student">Student</option>
													<option value="Course">Course</option>
													<option value="Exam">Exam</option>
													<option value="Finance">Finance</option>
													<option value="Library">Library</option>
													<option value="Payment">Payment</option>
													<option value="Staff" selected>Late Payment Fee</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Amount (LKR)</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" name="fname" placeholder="" value="250" required>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-danger">Remove</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							<form method="post" action="staff-add.php" class="form-seperator">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Invoice ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="eid" value="INV0349" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Type</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<select name="department" class="form-control">
													<option value="Admin">Admin</option>
													<option value="Resource">Resource</option>
													<option value="Student">Student</option>
													<option value="Course">Course</option>
													<option value="Exam">Exam</option>
													<option value="Finance">Finance</option>
													<option value="Library">Library</option>
													<option value="Payment">Payment</option>
													<option value="Staff" selected>Course</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Description</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<select name="department" class="form-control">
													<option value="Admin">Admin</option>
													<option value="Resource">Resource</option>
													<option value="Student">Student</option>
													<option value="Course">Course</option>
													<option value="Exam">Exam</option>
													<option value="Finance">Finance</option>
													<option value="Library">Library</option>
													<option value="Payment">Payment</option>
													<option value="Staff" selected>Mathematics</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Amount (LKR)</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" name="fname" placeholder="" value="1200" required>
											</div>
											<div class="col-md-3">
												<button type="submit" class="btn btn-danger">Remove</button>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-success">Add +</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="payment-box">
						<h5>Total Amount:</h5>
						<h3>Rs. 1450/=</h3>
						<hr>
						<button class="btn btn-success btn-lg btn-block">Pay</button>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>