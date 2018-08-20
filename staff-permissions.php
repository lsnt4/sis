<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="staff-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="staff-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link disabled">Attendance</a>
							<a class="nav-item nav-link active">Permissions</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-permissions.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" placeholder="Permission name" aria-label="Recipient's username" aria-describedby="basic-addon2">
											<div class="input-group-append">
												<button class="btn btn-secondary" type="button">Search</button>
												<button class="btn btn-dark" type="button">Create</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Permission</th>
													<th scope="col">Admin</th>
													<th scope="col">Student</th>
													<th scope="col">Staff</th>
													<th scope="col">Payments</th>
													<th scope="col">Exams</th>
													<th scope="col">Courses</th>
													<th scope="col">Finance</th>
													<th scope="col">Library</th>
													<th scope="col">Resources</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">1</th>
													<td>Admin</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">2</th>
													<td>Staff</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">3</th>
													<td>Student</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">4</th>
													<td>Payments</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">5</th>
													<td>Exams</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">6</th>
													<td>Courses</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">7</th>
													<td>Library</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">8</th>
													<td>Resources</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">9</th>
													<td>Teacher</td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" checked id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" id="defaultCheck1"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
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