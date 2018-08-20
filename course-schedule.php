<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="course-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="course-search.php" class="nav-item nav-link disabled">Search</a>
							<a class="nav-item nav-link active">Schedule</a>
							<a href="course-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="course-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" placeholder="Course name, id, grade" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
													<th scope="col">Course ID</th>
													<th scope="col">Name</th>
													<th scope="col">Grade</th>
													<th scope="col">Hall</th>
													<th scope="col">Time Start</th>
													<th scope="col">Time End</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">MAT207</th>
													<td>Mathematics</td>
													<td>11</td>
													<td>H0201</td>
													<td>16:30</td>
													<td>18:30</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Reschedule</button>
															<button type="button" class="btn btn-danger">Cancel</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">SCI192</th>
													<td>Science</td>
													<td>11</td>
													<td>H0204</td>
													<td>16:30</td>
													<td>18:30</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Reschedule</button>
															<button type="button" class="btn btn-danger">Cancel</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">ENG027</th>
													<td>English</td>
													<td>11</td>
													<td>H0206</td>
													<td>16:30</td>
													<td>18:30</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Reschedule</button>
															<button type="button" class="btn btn-danger">Cancel</button>
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