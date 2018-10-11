<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="exam-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="exam-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="exam-schedule.php" class="nav-item nav-link disabled">Schedule</a>
							<a href="exam-report.php" class="nav-item nav-link active">Reports</a>
						</div>
					</nav>

								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Exam History</div>
										<div class="card-body">
											<p class="card-text">View exam Details.</p>
											<form action="exam-report-file.php">
												<button class="btn btn-dark btn-block" type="submit">View Report</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
