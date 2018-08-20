<?php

define('ERROR_MSG', 'error_msg');
define('SUCCESS_MSG', 'success_msg');

// Navigation Functions
function is_on_page($page_name) {
	return (substr(strtolower(basename($_SERVER["SCRIPT_NAME"],'.php')), 0, 3) == substr(strtolower($page_name), 0, 3) );
}


// Error Message Functions
function has_error_msg() {
	return (strlen(@$_COOKIE[ERROR_MSG]) != 0);
}

function get_error_msg() {
	return $_COOKIE[ERROR_MSG];
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
	return $_COOKIE[SUCCESS_MSG];
}

function set_success_msg($message)	{
	setcookie(SUCCESS_MSG, $message, time() + (86400 * 30), "/");
}

function reset_success_msg() {
	setcookie(SUCCESS_MSG, '', time() - (86400 * 30), "/");
}

?>
