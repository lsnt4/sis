<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="exam-add.php" class="nav-item nav-link disabled">Add</a>
							<a class="nav-item nav-link active">Search</a>
							<a href="exam-schedule.php" class="nav-item nav-link disabled">Schedule</a>
							<a href="exam-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="exam-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" placeholder="Exam, course, grade" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
													<th scope="col">Exam ID</th>
													<th scope="col">Name</th>
													<th scope="col">Course</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">EXM223</th>
													<td>Mathematics Spot Test II</td>
													<td>Mathematics</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">EXM428</th>
													<td>Science MCQ - 14</td>
													<td>Science</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Update</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">EXM129</th>
													<td>English Mid Term Test</td>
													<td>English</td>
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