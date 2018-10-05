<?php include_once 'staff-header.php'; ?>
<?php
	// Department Create and Search Section
	if ((isset($_POST['deptname']) && isset($_POST['s'])) || (isset($_POST['deptname']) && ($_POST['deptname'] != '') && isset($_POST['c']) )) {
		// Department Create Section
		if (isset($_POST['c'])) {
			$AdminManager = new AdminManager();
			$department_creation_status = $AdminManager->create_department($_POST['deptname']);
			if($department_creation_status) {
				set_success_msg("<strong>Success!</strong> New department has been successfully created!");
			} else {
				set_error_msg("<strong>Failed!</strong> Something strange happened while trying to add new department!");
			}
			header('Location: staff-departments.php');
		// Department Search Section
		} else if (isset($_POST['s'])) {
			$AdminManager = new AdminManager();
			$department_list = $AdminManager->get_departments($_POST['deptname']);
		}
	} else {
		// Load the unfiltered list if there's no user input
		$AdminManager = new AdminManager();
		$department_list = $AdminManager->get_departments_list();
	}

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

		$AdminManager = new AdminManager();
		$department_list_update = $AdminManager->update_department($uid, $emp, $res, $stu, $cou, $exa, $fin, $lib, $pay, $sta);

		if ($department_list_update) {
			set_success_msg("<strong>Success!</strong> Department has been successfully updated!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to update department!");
		}
		header('Location: staff-departments.php');
	}

	if (isset($_POST['did'])) {
		$AdminManager = new AdminManager();
		$department_delete_status = $AdminManager->delete_department($_POST['did']);

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
