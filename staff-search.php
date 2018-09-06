<?php include_once 'staff-header.php'; ?>
<?php
	if (isset($_GET['s'])) {
		$keyword = $_GET['s'];

		$users = array();
		$result = $db_conn->query("
			SELECT userid, fname, lname, email, mobile_no, address, dob, reg_date
			FROM users
			WHERE userid LIKE '%$keyword%'
				OR fname LIKE '%$keyword%'
				OR lname LIKE '%$keyword%'
				OR email LIKE '%$keyword%'
				OR mobile_no LIKE '%$keyword%'
				OR address LIKE '%$keyword%'
				OR dob LIKE '%$keyword%'
				OR reg_date LIKE '%$keyword%'
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'dob' => $row['dob'],
					'reg_date' => $row['reg_date'],
				));
			}
		} else {
			$users = null;
		}

	} else {

		$users = array();
		$result = $db_conn->query("
			SELECT userid, fname, lname, email, mobile_no, address, dob, reg_date
			FROM users
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'dob' => $row['dob'],
					'reg_date' => $row['reg_date'],
				));
			}
		} else {
			$users = null;
		}

	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="staff-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="staff-search.php" class="nav-item nav-link active">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link disabled">Attendance</a>
							<a href="staff-departments.php" class="nav-item nav-link disabled">Departments</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="get" action="staff-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" value="<?php echo $retVal = (isset($_GET['s'])) ? $_GET['s'] : '' ; ?>" name="s" class="form-control" placeholder="Employee id, name, email, address" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
													<th scope="col">Mobile</th>
													<th scope="col">Email</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($users as $user) { ?>
												<tr>
													<th><?php echo $user['userid']; ?></th>
													<td><?php echo $user['fname']; ?></td>
													<td><?php echo $user['lname']; ?></td>
													<td><?php echo $user['mobile_no']; ?></td>
													<td><?php echo $user['email']; ?></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<form action="staff-profile.php" method="get">
																<button name="uid" value="<?php echo $user['userid']; ?>" type="submit" class="btn btn-dark">View</button>
															</form>
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
