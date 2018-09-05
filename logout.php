<?php
	include_once 'common_functions.php';

	// User session removal
	unset_session(USERID);
	unset_session(FNAME);
	unset_session(LNAME);
	unset_session(EMAIL);
	unset_session(MOBILE_NO);
	unset_session(DOB);
	unset_session(REG_DATE);
	unset_session(USER_ROLE);

	// User permission removal
	unset_session(PERMISSION_STAFF);
	unset_session(PERMISSION_STUDENTS);
	unset_session(PERMISSION_PAYMENTS);
	unset_session(PERMISSION_EXAMS);
	unset_session(PERMISSION_COURSES);
	unset_session(PERMISSION_FINANCE);
	unset_session(PERMISSION_LIBRARY);
	unset_session(PERMISSION_RESOURCES);
	unset_session(PERMISSION_EMPLOYEES);

	destroy_session();

	header('Location: login.php');
?>
