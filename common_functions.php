<?php

define('USERID', 'userid');
define('FNAME', 'fname');
define('LNAME', 'lname');
define('EMAIL', 'email');
define('MOBILE_NO', 'mobile_no');
define('ADDRESS', 'address');
define('DOB', 'dob');
define('GENDER', 'gender');
define('NIC', 'nic');
define('REG_DATE', 'reg_date');
define('SALARY', 'salary');
define('PASSWORD', 'password');
define('USER_ROLE', 'user_role');

define('PERMISSION_STAFF', 'permission_staff');
define('PERMISSION_STUDENTS', 'permission_students');
define('PERMISSION_PAYMENTS', 'permission_payments');
define('PERMISSION_EXAMS', 'permission_exams');
define('PERMISSION_COURSES', 'permission_courses');
define('PERMISSION_FINANCE', 'permission_finance');
define('PERMISSION_LIBRARY', 'permission_library');
define('PERMISSION_RESOURCES', 'permission_resources');
define('PERMISSION_EMPLOYEES', 'permission_employees');

define('ERROR_MSG', 'error_msg');
define('SUCCESS_MSG', 'success_msg');
session_start();

$db_conn = new mysqli('localhost', 'root', '', 'itpprojectdb', '3306');
if($db_conn->connect_error) {
	define('DB_CONN_STATUS', false);
	die("Database connection error: " . $db_conn->connect_error);
} else {
	define('DB_CONN_STATUS', true);
}


// Navigation Functions
function is_on_page($page_name) {
	return (substr(strtolower(basename($_SERVER["SCRIPT_NAME"],'.php')), 0, 3) == substr(strtolower($page_name), 0, 3) );
}


// Error Message Functions
function has_error_msg() {
	return (strlen(@$_COOKIE[ERROR_MSG]) != 0);
}

function get_error_msg() {
	$error = $_COOKIE[ERROR_MSG];
	reset_error_msg();
	return $error;
}

function set_error_msg($message)	{
	setcookie(ERROR_MSG, $message, time() + (86400 * 30), "/");
}

function reset_error_msg() {
	setcookie(ERROR_MSG, '', time() - (86400 * 30), "/");
}


// Success Message Functions
function has_success_msg() {
	return (strlen(@$_COOKIE[SUCCESS_MSG]) != 0);
}

function get_success_msg() {
	$success = $_COOKIE[SUCCESS_MSG];
	reset_success_msg();
	return $success;
}

function set_success_msg($message)	{
	setcookie(SUCCESS_MSG, $message, time() + (86400 * 30), "/");
}

function reset_success_msg() {
	setcookie(SUCCESS_MSG, '', time() - (86400 * 30), "/");
}

// Session Handling Functions
function set_session($name, $value) {
	$_SESSION[$name] = $value;
}

function unset_session($name) {
	$_SESSION[$name] = null;
}

function get_session($name) {
	if(isset($_SESSION[$name])) {
		return $_SESSION[$name];
	} else {
		return null;
	}
}

function destroy_session() {
	session_destroy();
	$_SESSION = array();
}

?>
