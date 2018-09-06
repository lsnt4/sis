<?php include_once 'staff-header.php'; ?>
<?php
	if (isset($_GET['s'])) {
		$query = $_GET['s'];

		$users = array();
		$result = $db_conn->query("
			SELECT users.userid, users.fname, users.lname, users.email, users.mobile_no, users.address, attendance.date, attendance.time, CURRENT_DATE as curr_date
			FROM users
			LEFT JOIN attendance
			ON users.userid=attendance.userid
			WHERE users.userid LIKE '%$query%'
				OR users.fname LIKE '%$query%'
				OR users.lname LIKE '%$query%'
				OR users.email LIKE '%$query%'
				OR users.mobile_no LIKE '%$query%'
				OR users.address LIKE '%$query%'
				OR attendance.date LIKE '%$query%'
				OR attendance.time LIKE '%$query%'
			ORDER BY attendance.date DESC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'date' => $row['date'],
					'time' => $row['time'],
					'today' => $row['curr_date'],
				));
			}
		} else {
			$users = null;
		}

	} else {

		$users = array();
		$unique_users = array();
		$result = $db_conn->query("
			SELECT users.userid, users.fname, users.lname, users.email, users.mobile_no, users.address, attendance.date, attendance.time, CURRENT_DATE as curr_date
				FROM users
				LEFT JOIN attendance
				ON users.userid=attendance.userid
				ORDER BY attendance.date DESC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if (!is_numeric(array_search($row['userid'], $unique_users))) {
					array_push($unique_users, $row['userid']);
				} else {
					continue;
				}
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'date' => $row['date'],
					'time' => $row['time'],
					'today' => $row['curr_date'],
				));
			}
			$users = array_reverse($users);
		} else {
			$users = null;
		}

	}

	if (isset($_POST['a'])) {
		$query = $_POST['a'];

		$date = date("Y-m-d");
		$time = date("H:i:s");

		$sql = "INSERT INTO attendance (userid, date, time)
				VALUES ('$query', '$date', '$time')";
		if ($db_conn->query($sql)) {
		    $attendance_mark_status = true;
		} else {
		    die( "Error: " . $db_conn->error);
			$attendance_mark_status = false;
		}

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
