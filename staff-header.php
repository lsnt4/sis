<?php
	include_once 'common_functions.php';
	include_once 'ClassStaff.php';

	$AuthHandler = new AuthHandler();
	if (!$AuthHandler->auth_status()) {
		header('Location: login.php');
	}
?>
<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Success International School | Dashboard</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
			<a class="navbar-brand" href="dashboard.php"><strong class="ml-3">Success International School</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<span class="navbar-nav mr-auto"></span>
				<ul class="navbar-nav">
					<li class="nav-item <?php $active_state = (is_on_page("profile")) ? 'active' : '' ; echo $active_state; ?>"><a class="nav-link" href="profile.php">Profile</a></li>
					<li class="nav-item <?php $active_state = (is_on_page("dashboard")) ? 'active' : '' ; echo $active_state; ?>"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
			<?php if(has_error_msg()) { ?>
				<div class="alert alert-danger" role="alert"><?php echo get_error_msg(); ?></div>
			<?php }	?>
			<?php if(has_success_msg()) { ?>
				<div class="alert alert-success" role="alert"><?php echo get_success_msg(); ?></div>
			<?php }	?>
			<div class="row">
				<div class="col-md-2">
					<div class="list-group mb-5">
						<a href="students.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("students")) ? 'active' : '' ; echo $active_state; ?>">Students</a>
						<a href="staff.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("staff")) ? 'active' : '' ; echo $active_state; ?>">Staff</a>
						<a href="payments.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("payments")) ? 'active' : '' ; echo $active_state; ?>">Payments</a>
						<a href="exams.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("exams")) ? 'active' : '' ; echo $active_state; ?>">Exams</a>
						<a href="courses.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("courses")) ? 'active' : '' ; echo $active_state; ?>">Courses</a>
						<a href="finance.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("finance")) ? 'active' : '' ; echo $active_state; ?>">Finance</a>
						<a href="library.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("library")) ? 'active' : '' ; echo $active_state; ?>">Library</a>
						<a href="resources.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("resources")) ? 'active' : '' ; echo $active_state; ?>">Resources</a>
						<a href="profile.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("profile")) ? 'active' : '' ; echo $active_state; ?>">Profile</a>
					</div>
				</div>
