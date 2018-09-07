<?php include_once 'staff-header.php'; ?>
<?php
	// Department Create and Search Section
	if ((isset($_POST['deptname']) && isset($_POST['s'])) || (isset($_POST['deptname']) && ($_POST['deptname'] != '') && isset($_POST['c']) )) {
		// Department Create Section
		if (isset($_POST['c'])) {
			$deptname = $_POST['deptname'];
			$sql_user = "
				INSERT INTO departments (name, employee, resource, student, course, exam, finance, library, payment, staff)
				VALUES ('$deptname', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
			if ($db_conn->query($sql_user)) {
			    $department_creation_status = true;
			} else {
			    echo "Error: " . $db_conn->error;
				$department_creation_status = false;
			}
			if($department_creation_status) {
				set_success_msg("<strong>Success!</strong> New department has been successfully created!");
			} else {
				set_error_msg("<strong>Failed!</strong> Something strange happened while trying to add new department!");
			}
			header('Location: staff-departments.php');
		// Department Search Section
		} else if (isset($_POST['s'])) {
			$keyword = $_POST['deptname'];
			$department_list = array();
			$result = $db_conn->query("
				SELECT did, name, employee, resource, student, course, exam, finance, library, payment, staff
				FROM departments
				WHERE name LIKE '%$keyword%'
			");
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if($row['name'] == 'Admin') { continue; }
					array_push($department_list, array(
						'did' => $row['did'],
						'name' => $row['name'],
						'employee' => $row['employee'],
						'resource' => $row['resource'],
						'student' => $row['student'],
						'course' => $row['course'],
						'exam' => $row['exam'],
						'finance' => $row['finance'],
						'library' => $row['library'],
						'payment' => $row['payment'],
						'staff' => $row['staff'],
					));
				}
			} else {
				$department_list = null;
			}
		}
	} else {
		// Load the unfiltered list if there's no user input
		$department_list = array();
		$result = $db_conn->query("
			SELECT did, name, employee, resource, student, course, exam, finance, library, payment, staff
			FROM departments
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['name'] == 'Admin') { continue; }
				array_push($department_list, array(
					'did' => $row['did'],
					'name' => $row['name'],
					'employee' => $row['employee'],
					'resource' => $row['resource'],
					'student' => $row['student'],
					'course' => $row['course'],
					'exam' => $row['exam'],
					'finance' => $row['finance'],
					'library' => $row['library'],
					'payment' => $row['payment'],
					'staff' => $row['staff'],
				));
			}
		} else {
			$department_list = null;
		}
	}

	// Department Update Section
	if (isset($_POST['uid'])) {
		$uid = $_POST['uid'];
		$emp = (isset($_POST['emp'])) ? '1' : '0' ;
		$res = (isset($_POST['res'])) ? '1' : '0' ;
		$stu = (isset($_POST['stu'])) ? '1' : '0' ;
		$cou = (isset($_POST['cou'])) ? '1' : '0' ;
		$exa = (isset($_POST['exa'])) ? '1' : '0' ;
		$fin = (isset($_POST['fin'])) ? '1' : '0' ;
		$lib = (isset($_POST['lib'])) ? '1' : '0' ;
		$pay = (isset($_POST['pay'])) ? '1' : '0' ;
		$sta = (isset($_POST['sta'])) ? '1' : '0' ;

		$sql = "UPDATE departments SET employee=$emp, resource=$res, student=$stu, course=$cou, exam=$exa, finance=$fin, library=$lib, payment=$pay, staff=$sta WHERE did=$uid";
		if ($db_conn->query($sql)) {

			$userid = get_session('userid');

			// Reset permissions
			set_session(PERMISSION_STAFF, '0');
			set_session(PERMISSION_STUDENTS, '0');
			set_session(PERMISSION_PAYMENTS, '0');
			set_session(PERMISSION_EXAMS, '0');
			set_session(PERMISSION_COURSES, '0');
			set_session(PERMISSION_FINANCE, '0');
			set_session(PERMISSION_LIBRARY, '0');
			set_session(PERMISSION_RESOURCES, '0');
			set_session(PERMISSION_EMPLOYEES, '0');

			$dept_res = $db_conn->query("
				SELECT userid, employee, resource, student, course, exam, finance, library, payment, staff
				FROM user_departments
				LEFT JOIN departments
				ON departments.did=user_departments.department_id
				WHERE userid=$userid
			");
			while($row = $dept_res->fetch_assoc()) {
				($row['staff']) ? set_session(PERMISSION_STAFF, '1') : null;
				($row['student']) ? set_session(PERMISSION_STUDENTS, '1') : null;
				($row['payment']) ? set_session(PERMISSION_PAYMENTS, '1') : null;
				($row['exam']) ? set_session(PERMISSION_EXAMS, '1') : null;
				($row['course']) ? set_session(PERMISSION_COURSES, '1') : null;
				($row['finance']) ? set_session(PERMISSION_FINANCE, '1') : null;
				($row['library']) ? set_session(PERMISSION_LIBRARY, '1') : null;
				($row['resource']) ? set_session(PERMISSION_RESOURCES, '1') : null;
				($row['employee']) ? set_session(PERMISSION_EMPLOYEES, '1') : null;
			}

			$department_list_update = true;
		} else {
			echo "Error updating record: " . $db_conn->error;
			$department_list_update = false;
		}

		if ($department_list_update) {
			set_success_msg("<strong>Success!</strong> Department has been successfully updated!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to update department!");
		}
		header('Location: staff-departments.php');
	}

	// Department Deletion Section
	if (isset($_POST['did'])) {
		$did = $_POST['did'];
		$sql = "DELETE FROM departments WHERE did=$did";
		if ($db_conn->query($sql)) {
			$department_delete_status = true;
		} else {
			echo "Error deleting record: " . $db_conn->error;
			$department_delete_status = false;
		}

		if ($department_delete_status) {
			set_success_msg("<strong>Success!</strong> Department has been successfully deleted!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to delete department!");
		}
		header('Location: staff-departments.php');
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="staff-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="staff-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link disabled">Attendance</a>
							<a href="staff-departments.php" class="nav-item nav-link active">Departments</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="staff-departments.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input name="deptname" value="<?php echo (isset($_POST['deptname'])) ? $_POST['deptname'] : '' ; ?>" type="text" class="form-control" placeholder="Department name" aria-label="Recipient's username" aria-describedby="basic-addon2" pattern="[A-Za-z ]{3,50}" required>
											<div class="input-group-append">
													<button class="btn btn-secondary" type="submit" name="s" value="1">Search</button>
													<button class="btn btn-dark" type="submit" name="c" value="1">Create</button>
											</div>
										</div>
									</div>
								</div>
							</form>
								<div class="row">
									<div class="col-md-12">
										<?php if(count($department_list) != 0) { ?>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Department</th>
													<th scope="col">Employee</th>
													<th scope="col">Resource</th>
													<th scope="col">Student</th>
													<th scope="col">Course</th>
													<th scope="col">Exam</th>
													<th scope="col">Finance</th>
													<th scope="col">Library</th>
													<th scope="col">Payment</th>
													<th scope="col">Staff</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<?php $x=1; foreach ($department_list as $department) { ?>
												<form action="staff-departments.php" method="post" onsubmit="return confirm('WARNING!\n\n1. Some permissions may not take effect immediately until user login again.\n2. Accidentally revoked permissions can make permanent denial of access.\n3. There\'s no way to undo this action.\n\nDo you still really want to proceed?');">
												<tr>
													<th><?php echo $x++; ?></th>
													<th><?php echo $department['name']; ?></th>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['employee']) ? 'checked' : '' ; ?> name="emp"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['resource']) ? 'checked' : '' ; ?> name="res"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['student']) ? 'checked' : '' ; ?> name="stu"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['course']) ? 'checked' : '' ; ?> name="cou"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['exam']) ? 'checked' : '' ; ?> name="exa"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['finance']) ? 'checked' : '' ; ?> name="fin"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['library']) ? 'checked' : '' ; ?> name="lib"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['payment']) ? 'checked' : '' ; ?> name="pay"></div></td>
													<td><div class="form-check text-center"><input class="form-check-input" type="checkbox" <?php echo ($department['staff']) ? 'checked' : '' ; ?> name="sta"></div></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="submit" name="uid" value="<?php echo $department['did']; ?>" class="btn btn-dark">Update</button>
															<button type="submit" name="did" value="<?php echo $department['did']; ?>" class="btn btn-danger">Delete</button>
														</div>
													</td>
												</tr>
												</form>
												<?php } ?>
											</tbody>
										</table>
										<?php } else { ?>
											<div class="alert alert-danger" role="alert"><strong>Oops!</strong> No departments found!</div>
										<?php } ?>
									</div>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
