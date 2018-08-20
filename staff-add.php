<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active">Add</a>
							<a href="staff-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link disabled">Attendance</a>
							<a href="staff-permissions.php" class="nav-item nav-link disabled">Permissions</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-add.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Employee ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="eid" value="EMP3928" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Deparment</label>
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
													<option value="Staff" selected>Staff</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" name="fname" placeholder="First name" required>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="lname" placeholder="Last name" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Birth</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="text" class="form-control" name="doby" placeholder="Year" required>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" name="dobm" placeholder="Month" required>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" name="dobd" placeholder="Date" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">NIC</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="nic" placeholder="Ex: 123456789V" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Contacts</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="mobile" placeholder="Mobile" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="address" placeholder="Address" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="email" class="form-control" name="email" placeholder="Email" required>
											</div>
										</div>
									</div>
								</div>
								<fieldset class="form-group">
									<div class="row">
										<legend class="col-form-label col-sm-2 pt-0">Gender</legend>
										<div class="col-sm-10 col-md-2">
											<select name="gender" class="form-control" required>
												<option value="1" selected>Male</option>
												<option value="0">Female</option>
											</select>
										</div>
									</div>
								</fieldset>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Add Employee</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>