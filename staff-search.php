<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="staff-add.php" class="nav-item nav-link disabled">Add</a>
							<a class="nav-item nav-link active">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link disabled">Attendance</a>
							<a href="staff-permissions.php" class="nav-item nav-link disabled">Permissions</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-search.php">
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
													<th scope="col">Employee ID</th>
													<th scope="col">First Name</th>
													<th scope="col">Last Name</th>
													<th scope="col">Deparment</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">EMP3952</th>
													<td>Mark</td>
													<td>Otto</td>
													<td>Staff Management</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Edit</button>
															<button type="button" class="btn btn-dark">View</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">EMP3935</th>
													<td>Jacob</td>
													<td>Thornton</td>
													<td>Student Management</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Edit</button>
															<button type="button" class="btn btn-dark">View</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">EMP1725</th>
													<td>Larry</td>
													<td>Bird</td>
													<td>Finance Department</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Edit</button>
															<button type="button" class="btn btn-dark">View</button>
														</div>
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