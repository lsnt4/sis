<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="student-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="student-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="student-attendance.php" class="nav-item nav-link active">Attendance</a>
							<a href="student-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="student-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-attendance.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" placeholder="Employee name, email, id" aria-label="Recipient's username" aria-describedby="basic-addon2">
											<div class="input-group-append">
												<button class="btn btn-dark" type="button">Search</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">Student ID</th>
													<th scope="col">First Name</th>
													<th scope="col">Last Name</th>
													<th scope="col">Grade</th>
													<th scope="col">Mobile</th>
													<th scope="col">Gender</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">STD2458</th>
													<td>Mark</td>
													<td>Otto</td>
													<td>11</td>
													<td>94123548945</td>
													<td>Male</td>
													<td>
														<button class="btn btn-dark">Mark Attendance</button>
													</td>
												</tr>
												<tr>
													<th scope="row">STD2548</th>
													<td>Jacob</td>
													<td>Thornton</td>
													<td>5</td>
													<td>94546584214</td>
													<td>Male</td>
													<td>
														<button class="btn btn-dark">Mark Attendance</button>
													</td>
												</tr>
												<tr>
													<th scope="row">STD3254</th>
													<td>Larry</td>
													<td>Smith</td>
													<td>9</td>
													<td>94325458754</td>
													<td>Male</td>
													<td>
														<button class="btn btn-secondary" disabled>Mark Attendance</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
