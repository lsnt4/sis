<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-4 p-2">
								<div class="row">
									<?php $session = new SessionManager(); ?>
									<div class="col-1"><span class="dashboard-avatar"><?php echo substr($session->get_session('fname'), 0,1); ?></span></div>
									<div class="col-11">
										<div class="dashboard-username"><?php echo $session->get_session('fname') . " " . $session->get_session('lname'); ?></div>
										<div class="dashboard-department">Admin, Staff Management</div></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/businessman.png" alt="Image">
								<div class="card-body">
									<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/businessman-search.png" alt="Image">
								<div class="card-body">
									<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/businessman-attendance.png" alt="Image">
								<div class="card-body">
									<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/businessman-permissions.png" alt="Image">
								<div class="card-body">
									<a href="staff-permissions.php" class="btn btn-lg btn-dark btn-block">Permissions</a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/businessman-overview.png" alt="Image">
								<div class="card-body">
									<a href="staff-overview.php" class="btn btn-lg btn-dark btn-block">Overview</a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/businessman-reports.png" alt="Image">
								<div class="card-body">
									<a href="staff-reports.php" class="btn btn-lg btn-dark btn-block">Reports</a>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
