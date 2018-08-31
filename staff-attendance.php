<?php include_once 'staff-header.php'; ?>
<?php
	if (isset($_GET['s'])) {
		$query = $_GET['s'];
		$StaffManager = new StaffManager();
		$users = $StaffManager->get_attendances($query);
	} else {
		$StaffManager = new StaffManager();
		$users = $StaffManager->get_attendance_list();
	}

	if (isset($_POST['a'])) {
		$query = $_POST['a'];
		$StaffManager = new StaffManager();
		$attendance_mark_status = $StaffManager->mark_attendance($query);

		if($attendance_mark_status) {
			set_success_msg("<strong>Success!</strong> Attendance has been successfully marked!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to mark attendance!");
		}

		header('Location: staff-attendance.php');
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="staff-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="staff-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link active">Attendance</a>
							<a href="staff-departments.php" class="nav-item nav-link disabled">Departments</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="get" action="staff-attendance.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" value="<?php echo $retVal = (isset($_GET['s'])) ? $_GET['s'] : '' ; ?>" name="s" class="form-control" placeholder="Employee id, name, email, date" aria-label="Recipient's username" aria-describedby="basic-addon2">
											<div class="input-group-append">
												<button class="btn btn-dark" type="submit">Search</button>
											</div>
										</div>
									</div>
								</div>
							</form>
								<div class="row">
									<div class="col-md-12">
										<?php if( count($users) != 0) { ?>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th scope="col">Employee ID</th>
														<th scope="col">First Name</th>
														<th scope="col">Last Name</th>
														<th scope="col">Email</th>
														<th scope="col">Date</th>
														<th scope="col">Time</th>
														<th scope="col"></th>
													</tr>
												</thead>
												<tbody>
												<?php foreach ($users as $user) { ?>
													<tr>
														<th scope="row"><?php echo $user['userid']; ?></th>
														<td><?php echo $user['fname']; ?></td>
														<td><?php echo $user['lname']; ?></td>
														<td><?php echo $user['email']; ?></td>
														<td><?php echo $user['date']; ?></td>
														<td><?php echo $user['time']; ?></td>
														<td>
															<div class="btn-group" role="group" aria-label="Basic example">
																<?php if($user['date'] != $user['today']) { ?>
																	<form action="staff-attendance.php" method="post">
																		<button type="submit" name="a" class="btn btn-dark" value="<?php echo $user['userid'] ?>">Mark Attendance</button>
																	</form>
																<?php } else { ?>
																	<button type="button" class="btn btn-secondary disabled" disabled>Mark Attendance</button>
																<?php } ?>
															</div>
														</td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										<?php } else { ?>
											<div class="alert alert-danger" role="alert">No matching records found!</div>
										<?php } ?>
									</div>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
