<?php
/**
*	=============================================
* 	               CLASS STRUCTURE
*	=============================================
*
*	StaffMember	- Hold data for an employee
*	StaffManager 	- Employee management tasks
*	AdminManager	- Admin management tasks
*	SessionManager	- Session management tasks
*	AuthHandler	- User authentication handler
*	Helpers		- Helper methods
*	Database 	- Database connection
*/

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

/**
* StaffMember
*/
class StaffMember {

	private $userid;
	private $department;
	private $fname;
	private $lname;
	private $dob;
	private $nic;
	private $mobile_no;
	private $address;
	private $email;
	private $gender;
	private $reg_date;
	private $salary;
	private $password;

	public function getUserid()	{
		return $this->userid;
	}

	public function setUserid($userid) {
		$this->userid = $userid;
	}

	public function getDepartment()	{
		return $this->department;
	}

	public function setDepartment($department) {
		$this->department = $department;
	}

	public function getFname() {
		return $this->fname;
	}

	public function setFname($fname) {
		$this->fname = $fname;
	}

	public function getLname() {
		return $this->lname;
	}

	public function setLname($lname) {
		$this->lname = $lname;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getMobileno() {
		return $this->mobile_no;
	}

	public function setMobileno($mobile_no) {
		$this->mobile_no = $mobile_no;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getDob() {
		return $this->dob;
	}

	public function setDob($dob) {
		$this->dob = $dob;
	}

	public function getGender() {
		return $this->gender;
	}

	public function setGender($gender) {
		$this->gender = $gender;
	}

	public function getNic() {
		return $this->nic;
	}

	public function setNic($nic) {
		$this->nic = $nic;
	}

	public function getRegdate() {
		return date("Y-m-d");
	}

	public function setRegdate($reg_date) {
		$this->reg_date = $reg_date;
	}

	public function getSalary() {
		return $this->salary;
	}

	public function setSalary($salary) {
		$this->salary = $salary;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function add() {
		$Helpers = new Helpers();
		$this->userid = $Helpers->generate_userid();
		$this->password = $this->nic;
		return (isset($this->userid) && isset($this->fname) && isset($this->lname) && isset($this->email) && isset($this->mobile_no) && isset($this->address) && isset($this->dob) && isset($this->gender) && isset($this->nic) && isset($this->salary) );
	}
}

/**
* Session Management Class
*/
class SessionManager {

	function __construct() {
		if (!isset($_SESSION)) {
			session_start();
		}
	}

	public function set_session($name, $value) {
		$_SESSION[$name] = $value;
	}

	public function unset_session($name) {
		$_SESSION[$name] = null;
	}

	public function get_session($name) {
		if(isset($_SESSION[$name])) {
			return $_SESSION[$name];
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
		return (!is_null($this->session->get_session(USERID)));
	}

	public function login($email, $password) {
		$password = md5($password);
		$result = Database::$DB_CONN->query(
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
					$this->session->set_session(USERID, $row['userid']);
					$this->session->set_session(USER_ROLE, 'staff');
				} else {
					$userid = $row['sid'];
					$this->session->set_session(USERID, $row['sid']);
					$this->session->set_session(USER_ROLE, 'student');
				}
				$this->session->set_session(FNAME, $row['fname']);
				$this->session->set_session(LNAME, $row['lname']);
				$this->session->set_session(EMAIL, $row['email']);
				$this->session->set_session(MOBILE_NO, $row['mobile_no']);
				$this->session->set_session(DOB, $row['dob']);
				$this->session->set_session(REG_DATE, $row['reg_date']);
				break;
			}

			$AdminManager = new AdminManager();
			$AdminManager->set_permissions($userid);

			return true;
		} else {
			return false;
		}
		return false;
	}

	public function logout() {
		// User session removal
		$this->session->unset_session(USERID);
		$this->session->unset_session(FNAME);
		$this->session->unset_session(LNAME);
		$this->session->unset_session(EMAIL);
		$this->session->unset_session(MOBILE_NO);
		$this->session->unset_session(DOB);
		$this->session->unset_session(REG_DATE);
		$this->session->unset_session(USER_ROLE);

		// User permission removal
		$this->session->unset_session(PERMISSION_STAFF);
		$this->session->unset_session(PERMISSION_STUDENTS);
		$this->session->unset_session(PERMISSION_PAYMENTS);
		$this->session->unset_session(PERMISSION_EXAMS);
		$this->session->unset_session(PERMISSION_COURSES);
		$this->session->unset_session(PERMISSION_FINANCE);
		$this->session->unset_session(PERMISSION_LIBRARY);
		$this->session->unset_session(PERMISSION_RESOURCES);
		$this->session->unset_session(PERMISSION_EMPLOYEES);

		$this->session->destroy_session();
	}
}

/**
* Database Connection Class
*/
class Database {

	public static $DB_CONN;
	private $DB_USER = 'root';
	private $DB_PASS = '';
	private $DB_NAME = 'itpprojectdb';
	private $DB_HOST = 'localhost';
	private $DB_PORT = '3306';
	private $DB_CONN_STATUS = false;

	public function __construct() {
		if(!isset(self::$DB_CONN)) {
			self::$DB_CONN = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME, $this->DB_PORT);
			if(self::$DB_CONN->connect_error) {
				die("Database connection error: " . self::$DB_CONN->connect_error);
			} else {
				$this->DB_CONN_STATUS = true;
			}
			$this->DB_CONN_STATUS = true;
		}
	}

	public function db_conn_status() {
		return $this->DB_CONN_STATUS;
	}

	function __destruct() {

	}
}
?>
