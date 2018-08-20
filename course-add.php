<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active">Add</a>
							<a href="course-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="course-schedule.php" class="nav-item nav-link disabled">Schedule</a>
							<a href="course-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="course-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-add.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Course ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="eid" value="CRS223" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="fname" placeholder="" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Grade</label>
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
													<option value="Staff" selected>Grade 11</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Hall</label>
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
													<option value="Staff" selected>H0204</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Fee</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="doby" placeholder="" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Add Course</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>