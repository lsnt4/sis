<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="payments-add.php" class="nav-item nav-link disabled">Add</a>
							<a class="nav-item nav-link active">Search</a>
							<a href="payments-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="payments-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" placeholder="Studnet name, mobile, id" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
													<th scope="col">Status</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">STD2458</th>
													<td>Mark</td>
													<td>Otto</td>
													<td>11</td>
													<td>Pending</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Edit</button>
															<button type="button" class="btn btn-dark">View</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">STD2548</th>
													<td>Jacob</td>
													<td>Thornton</td>
													<td>5</td>
													<td>Pending</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Edit</button>
															<button type="button" class="btn btn-dark">View</button>
															<button type="button" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">STD3254</th>
													<td>Larry</td>
													<td>Smith</td>
													<td>9</td>
													<td>Confirmed</td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="button" class="btn btn-dark">Edit</button>
															<button type="button" class="btn btn-dark">View</button>
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