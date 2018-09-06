<?php include_once 'staff-header.php'; ?>
<?php
	$userid = get_session('userid');

	$user = array();
	$result = $db_conn->query("
		SELECT userid, fname, lname, email, mobile_no, address, dob, reg_date, salary, nic, gender
		FROM users
		WHERE userid='$userid'
	");
	if ($result->num_rows != 0) {
		while($row = $result->fetch_assoc()) {

			$departments = array();
			$result_dept = $db_conn->query("
				SELECT did, name, userid
				FROM departments
				LEFT JOIN user_departments ON departments.did=user_departments.department_id
			");
			if ($result_dept->num_rows != 0) {
				while($row_dept = $result_dept->fetch_assoc()) {
					array_push($departments, array(
						'did' => $row_dept['did'],
						'name' => $row_dept['name'],
						'status' => ($row_dept['userid'] == $userid)
					));
				}
			} else {
				$departments = null;
			}

			array_push($user, array(
				'userid' => $row['userid'],
				'fname' => $row['fname'],
				'lname' => $row['lname'],
				'email' => $row['email'],
				'mobile_no' => $row['mobile_no'],
				'address' => $row['address'],
				'dob' => $row['dob'],
				'reg_date' => $row['reg_date'],
				'salary' => $row['salary'],
				'nic' => $row['nic'],
				'gender' => $row['gender'],
				'departments' => $departments,
			));
			break;
		}
	} else {
		$user = null;
	}
	$user = $user[0];


	if (isset($_POST['mobile_no']) && isset($_POST['address']) && isset($_POST['email'])) {
		$mobile_no = $_POST['mobile_no'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "UPDATE users SET mobile_no='$mobile_no', address='$address', email='$email' WHERE userid='$userid'";
		if ($db_conn->query($sql)) {
			$status_progress = 1;
		} else {
			$status_progress = 0;
			echo "Error updating record: " . $db_conn->error;
		}

		if ($password != '') {
			$password = md5($password);
			$sql = "UPDATE users SET password='$password' WHERE userid='$userid'";
			if ($db_conn->query($sql)) {
				$status_progress = 1;
			} else {
				$status_progress = 0;
				echo "Error updating record: " . $db_conn->error;
			}
		}

		if($status_progress) {
			set_success_msg("<strong>Success!</strong> User has been successfully updated!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to update!");
		}

		header('Location: profile.php');
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="profile.php" class="nav-item nav-link active">Profile</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form action="profile.php" method="post">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">User ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="<?php echo $user['userid']; ?>" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Departments</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                <select size="5" class="form-control" multiple disabled>
                                                    <?php foreach($user['departments'] as $department) { ?>
                                                    <option value="<?php echo $department['did']; ?>" <?php echo ($department['status']) ? 'selected' : '' ; ?>><?php echo $department['name']; ?></option>
                                                    <?php } ?>
                                                </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?php echo $user['fname']; ?>" disabled>
												<small class="form-text text-muted">First Name</small>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?php echo $user['lname']; ?>" disabled>
												<small class="form-text text-muted">Last Name</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Birth</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="text" class="form-control" value="<?php echo substr($user['dob'], 0, 4); ?>" disabled>
												<small class="form-text text-muted">Year</small>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" value="<?php echo substr($user['dob'], 5, 2); ?>" disabled>
												<small class="form-text text-muted">Month</small>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" value="<?php echo substr($user['dob'], 8, 2); ?>" disabled>
												<small class="form-text text-muted">Date</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">NIC</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="<?php echo $user['nic']; ?>" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Contacts</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="mobile_no" value="<?php echo $user['mobile_no']; ?>">
												<small class="form-text text-muted">Mobile</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea type="text" class="form-control" name="address" rows="3"><?php echo $user['address']; ?></textarea>
												<small class="form-text text-muted">Address</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>">
												<small class="form-text text-muted">Email</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<legend class="col-form-label col-sm-2 pt-0">Gender</legend>
									<div class="col-sm-10 col-md-2">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="<?php echo ($user['gender']) ? 'Male' : 'Female' ; ?>" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Password</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="password" name="password" class="form-control">
												<small class="form-text text-muted">Leave blank if no password change required</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
