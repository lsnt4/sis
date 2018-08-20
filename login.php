<?php
	include_once 'common_functions.php';
	include_once 'ClassStaff.php';

	if (isset($_POST['empid']) && isset($_POST['password'])) {
		$empid = $_POST['empid'];
		$password = $_POST['password'];

		$login_state = $Helpers->login($empid, $password);

		if ($login_state) {
			header('Location: dashboard.php');
		} else {
			set_error_msg("<strong>Login Failed!</strong> Employee ID or Password is incorrect");
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
									<label for="empid">Employee ID</label>
									<input type="hidden" class="form-control" id="tmp" name="tmp" pattern="[A-Za-z0-9]{6}" required>
									<input type="text" class="form-control" id="empid" name="empid" required>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" required>
									<small class="form-text text-muted">Contact department staff for forgotten / lost password.</small>
								</div>
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
									<label class="form-check-label" for="rememberme">Remember Me</label>
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
