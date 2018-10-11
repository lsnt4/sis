<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="library-add-book.php" class="nav-item nav-link disabled">Add Book</a>
							<a href="library-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a class="nav-item nav-link active">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<div class="row">
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Book History</div>
										<div class="card-body">
											<p class="card-text">View Book Details.</p>
											<form action="library-book-report.php" method="post">
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
