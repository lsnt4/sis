<?php

/**
* Session Management Class
*/
class SessionManager {

	public function set_session($name, $value) {
		setcookie($name, $value, time() + (86400 * 30), "/");
	}

	public function unset_session($name) {
		setcookie($name, '', time() - (86400 * 30), "/");
	}

	public function get_session($name) {
		if(isset($_COOKIE[$name])) {
			return $_COOKIE[$name];
		} else {
			return null;
		}
	}

	public function destroy_session() {
		session_destroy();
		$_SESSION = array();
	}
}

/**
* Auth Handler
*/
class AuthHandler extends Database {

	public $session;

	function __construct() {
		parent::__construct();
		$this->session = new SessionManager();
	}

	public function auth_status() {
		return (!is_null($this->session->get_session('userid')));
	}

	public function login($email, $password) {
		$password = md5($password);
		$result = $this->DB_CONN->query("SELECT userid, fname, lname, email, mobile_no, address, dob, nic, gender, reg_date, salary, password
								FROM users
								WHERE email = '$email'
								AND password = '$password'");

		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$this->session->set_session('userid', $row['userid']);
				$this->session->set_session('fname', $row['fname']);
				$this->session->set_session('lname', $row['lname']);
				$this->session->set_session('email', $row['email']);
				$this->session->set_session('mobile_no', $row['mobile_no']);
				$this->session->set_session('dob', $row['dob']);
				$this->session->set_session('reg_date', $row['reg_date']);
				break;
			}

			$this->session->set_session('permission_staff', '1');
			$this->session->set_session('permission_students', '1');
			$this->session->set_session('permission_payments', '1');
			$this->session->set_session('permission_exams', '1');
			$this->session->set_session('permission_courses', '1');
			$this->session->set_session('permission_finance', '1');
			$this->session->set_session('permission_library', '1');
			$this->session->set_session('permission_resources', '1');
			$this->session->set_session('permission_employees', '1');

			return true;
		} else {
			return false;
		}
		return false;
	}

	public function logout() {
		// User session removal
		$this->session->unset_session('userid');
		$this->session->unset_session('fname');
		$this->session->unset_session('lname');
		$this->session->unset_session('email');
		$this->session->unset_session('mobile_no');
		$this->session->unset_session('dob');
		$this->session->unset_session('reg_date');

		// User permission removal
		$this->session->unset_session('permission_staff');
		$this->session->unset_session('permission_students');
		$this->session->unset_session('permission_payments');
		$this->session->unset_session('permission_exams');
		$this->session->unset_session('permission_courses');
		$this->session->unset_session('permission_finance');
		$this->session->unset_session('permission_library');
		$this->session->unset_session('permission_resources');
		$this->session->unset_session('permission_employees');

		$this->session->destroy_session();
	}
}

/**
* Database Connection Class
*/
class Database {

	public $DB_CONN;
	private $DB_USER = 'root';
	private $DB_PASS = '';
	private $DB_NAME = 'itpprojectdb';
	private $DB_HOST = 'localhost';
	private $DB_PORT = '3306';
	private $DB_CONN_STATUS = false;

	public function __construct() {

		$this->DB_CONN = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME, $this->DB_PORT);

		if($this->DB_CONN->connect_error) {
			die("Database connection error: " . $this->DB_CONN->connect_error);
		} else {
			$this->DB_CONN_STATUS = true;
		}
	}

	public function db_conn_status() {
		return $this->DB_CONN_STATUS;
	}

	function __destruct() {
		if(!empty($this->DB_CONN) || !isset($this->DB_CONN) || !is_null($this->DB_CONN)) {
			$this->DB_CONN->close();
		}
	}
}
?>
