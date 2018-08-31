<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-4 p-2">
								<div class="row">
									<div class="col-1"><span class="dashboard-avatar"><?php echo substr($session->get_session('fname'), 0,1); ?></span></div>
									<div class="col-11">
										<div class="dashboard-username"><?php echo $session->get_session('fname') . " " . $session->get_session('lname'); ?></div>
										<div class="dashboard-department">
											<span class="badge badge-dark"><?php echo ucwords($session->get_session('user_role')); ?> Member</span>
											<?php if ($session->get_session('user_role') == 'staff') { ?>
												<span class="badge badge-pill">for</span>
												<?php if($session->get_session('permission_students')) { ?><span class="badge badge-pill badge-secondary">student</span> <?php } ?>
												<?php if($session->get_session('permission_staff')) { ?><span class="badge badge-pill badge-secondary">staff</span> <?php } ?>
												<?php if($session->get_session('permission_payments')) { ?><span class="badge badge-pill badge-secondary">payments</span> <?php } ?>
												<?php if($session->get_session('permission_exams')) { ?><span class="badge badge-pill badge-secondary">exams</span> <?php } ?>
												<?php if($session->get_session('permission_courses')) { ?><span class="badge badge-pill badge-secondary">course</span> <?php } ?>
												<?php if($session->get_session('permission_finance')) { ?><span class="badge badge-pill badge-secondary">finance</span> <?php } ?>
												<?php if($session->get_session('permission_library')) { ?><span class="badge badge-pill badge-secondary">library</span> <?php } ?>
												<?php if($session->get_session('permission_resources')) { ?><span class="badge badge-pill badge-secondary">resource</span> <?php } ?>
												<?php if($session->get_session('permission_employees')) { ?><span class="badge badge-pill badge-secondary">employee</span> <?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Overview</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3">
											<div class="card text-white bg-secondary mb-3">
												<div class="card-header">Total Employees</div>
												<div class="card-body">
													<h3 class="card-title">3</h3>
													<p class="card-text"></p>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="card text-white bg-success mb-3">
												<div class="card-header">Total Departments</div>
												<div class="card-body">
													<h3 class="card-title">8</h3>
													<p class="card-text"></p>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="card text-white bg-info mb-3">
												<div class="card-header">Today Attendance</div>
												<div class="card-body">
													<h3 class="card-title">13</h3>
													<p class="card-text"></p>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="card text-white bg-primary mb-3">
												<div class="card-header">Total Students</div>
												<div class="card-body">
													<h3 class="card-title">180</h3>
													<p class="card-text"></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if($session->get_session('permission_staff')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Staff Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($session->get_session('permission_students')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Student Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($session->get_session('permission_payments')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Payment Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($session->get_session('permission_exams')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Exams Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($session->get_session('permission_courses')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Courses Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="course-add.php" class="btn btn-lg btn-dark btn-block">Add Course</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="course-search.php" class="btn btn-lg btn-dark btn-block">Search Courses</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="course-schedule.php" class="btn btn-lg btn-dark btn-block">Schedule Courses</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($session->get_session('permission_finance')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Finance Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($session->get_session('permission_library')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Library Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if($session->get_session('permission_resources')) { ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card bg-light mb-3">
								<div class="card-header">Resources Management</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 mb-3">
											<a href="staff-add.php" class="btn btn-lg btn-dark btn-block">Add Employee</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-search.php" class="btn btn-lg btn-dark btn-block">Search Employees</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-attendance.php" class="btn btn-lg btn-dark btn-block">Attendance</a>
										</div>
										<div class="col-md-3 mb-3">
											<a href="staff-departments.php" class="btn btn-lg btn-dark btn-block">Departments</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
<?php include_once 'staff-footer.php'; ?>
