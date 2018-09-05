<?php
	include_once 'common_functions.php';

	if(!is_null(get_session('userid'))) {
		header('Location: dashboard.php');
	}

	if (isset($_POST['email']) && isset($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = md5($password);
		$result = $db_conn->query(
					"SELECT * FROM ( SELECT userid, null as sid, fname, lname, email, mobile_no, address, dob, nic, gender, reg_date, salary, password FROM users
						UNION
					SELECT null, sid, fname, lname, email, mobile_no, null, dob, null, gender, reg_date, null, password FROM students ) users
					WHERE email = '$email'
					AND password = '$password'"
				);

		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				if (isset($row['userid'])) {
					$userid = $row['userid'];
					set_session(USERID, $row['userid']);
					set_session(USER_ROLE, 'staff');
				} else {
					$userid = $row['sid'];
					set_session(USERID, $row['sid']);
					set_session(USER_ROLE, 'student');
				}
				set_session(FNAME, $row['fname']);
				set_session(LNAME, $row['lname']);
				set_session(EMAIL, $row['email']);
				set_session(MOBILE_NO, $row['mobile_no']);
				set_session(DOB, $row['dob']);
				set_session(REG_DATE, $row['reg_date']);
				break;
			}

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

			$login_state = true;
		} else {
			$login_state = false;
		}

		if ($login_state) {
			header('Location: dashboard.php');
		} else {
			set_error_msg("<strong>Login Failed!</strong> Employee ID or Password is incorrect");
			header('Location: login.php');
		}
	}
?>
<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Success International School | Login</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link href="assets/css/quill.snow.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
			<a class="navbar-brand" href="/">Success International School</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<span class="navbar-nav mr-auto"></span>
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<?php if(has_error_msg()) { ?>
				<div class="alert alert-danger" role="alert"><?php echo get_error_msg(); ?></div>
			<?php }	?>
			<div class="row">
				<div class="col-md-6 offset-md-3 mt-5">
					<div class="card">
						<h5 class="card-header">Login</h5>
						<div class="card-body">
							<form action="login.php" method="post">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" name="email" required>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" required>
									<small class="form-text text-muted">Contact department staff for forgotten / lost password.</small>
								</div>
								<button type="submit" class="btn btn-lg btn-dark">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
	</body>
</html>
