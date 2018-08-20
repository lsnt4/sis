<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="exam-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="exam-search.php" class="nav-item nav-link disabled">Search</a>
							<a class="nav-item nav-link active">Schedule</a>
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
											<input type="text" class="form-control" placeholder="Exam name, id, grade" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
													<th scope="col">Hall</th>
													<th scope="col">Date</th>
													<th scope="col">Time Start</th>
													<th scope="col">Time End</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">EXM223</th>
													<td>Mathematics Spot Test II</td>
													<td>Mathematics</td>
													<td>H0211</td>
													<td>2018-08-25</td>
													<td>15:30</td>
													<td>16:00</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Reschedule</button>
															<button type="button" class="btn btn-danger">Cancel</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">EXM428</th>
													<td>Science MCQ - 14</td>
													<td>Science</td>
													<td>H0210</td>
													<td>2018-08-25</td>
													<td>15:30</td>
													<td>16:00</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Reschedule</button>
															<button type="button" class="btn btn-danger">Cancel</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">EXM223</th>
													<td>Mathematics Spot Test II</td>
													<td>Mathematics</td>
													<td>H0211</td>
													<td>2018-08-25</td>
													<td>15:30</td>
													<td>16:00</td>
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