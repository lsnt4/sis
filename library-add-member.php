<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active">Add Member</a>
							<a href="library-search-members.php" class="nav-item nav-link disabled">Search Members</a>
							<a href="library-add-book.php" class="nav-item nav-link disabled">Add Book</a>
							<a href="library-search-books.php" class="nav-item nav-link disabled">Search Books</a>
							<a href="library-borrow-books.php" class="nav-item nav-link disabled">Book Borrows</a>
							<a href="library-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="library-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-add.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">User ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="eid" value="STD2458">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Membership Duration</label>
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
													<option value="Staff" selected>12 Months</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Add Member</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>