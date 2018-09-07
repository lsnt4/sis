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
* Admin Management Class
*/
class AdminManager extends Database {

	public $session;

	function __construct() {
		parent::__construct();
		$this->session = new SessionManager();
	}

	public function set_permissions($userid) {
		// Reset permissions
		$this->session->set_session(PERMISSION_STAFF, '0');
		$this->session->set_session(PERMISSION_STUDENTS, '0');
		$this->session->set_session(PERMISSION_PAYMENTS, '0');
		$this->session->set_session(PERMISSION_EXAMS, '0');
		$this->session->set_session(PERMISSION_COURSES, '0');
		$this->session->set_session(PERMISSION_FINANCE, '0');
		$this->session->set_session(PERMISSION_LIBRARY, '0');
		$this->session->set_session(PERMISSION_RESOURCES, '0');
		$this->session->set_session(PERMISSION_EMPLOYEES, '0');

		$dept_res = Database::$DB_CONN->query("
			SELECT userid, employee, resource, student, course, exam, finance, library, payment, staff
			FROM user_departments
			LEFT JOIN departments
			ON departments.did=user_departments.department_id
			WHERE userid=$userid
		");
		while($row = $dept_res->fetch_assoc()) {
			($row['staff']) ? $this->session->set_session(PERMISSION_STAFF, '1') : null;
			($row['student']) ? $this->session->set_session(PERMISSION_STUDENTS, '1') : null;
			($row['payment']) ? $this->session->set_session(PERMISSION_PAYMENTS, '1') : null;
			($row['exam']) ? $this->session->set_session(PERMISSION_EXAMS, '1') : null;
			($row['course']) ? $this->session->set_session(PERMISSION_COURSES, '1') : null;
			($row['finance']) ? $this->session->set_session(PERMISSION_FINANCE, '1') : null;
			($row['library']) ? $this->session->set_session(PERMISSION_LIBRARY, '1') : null;
			($row['resource']) ? $this->session->set_session(PERMISSION_RESOURCES, '1') : null;
			($row['employee']) ? $this->session->set_session(PERMISSION_EMPLOYEES, '1') : null;
		}
	}

	public function get_departments_list() {
		$departments = array();
		$result = Database::$DB_CONN->query("
			SELECT did, name, employee, resource, student, course, exam, finance, library, payment, staff
			FROM departments
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['name'] == 'Admin') { continue; }
				array_push($departments, array(
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
			return null;
		}
		return $departments;
	}

	// Returns true if an user has access to a department
	public function get_department_bools_for_user($userid) {
		$departments = array();
		$result = Database::$DB_CONN->query("
			SELECT did, name, userid
			FROM departments
			LEFT JOIN user_departments ON departments.did=user_departments.department_id
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {
				array_push($departments, array(
					'did' => $row['did'],
					'name' => $row['name'],
					'status' => ($row['userid'] == $userid)
				));
			}
			return $departments;
		} else {
			return null;
		}
	}

	public function get_departments($keyword) {
		$departments = array();
		$result = Database::$DB_CONN->query("
			SELECT did, name, employee, resource, student, course, exam, finance, library, payment, staff
			FROM departments
			WHERE name LIKE '%$keyword%'
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['name'] == 'Admin') { continue; }
				array_push($departments, array(
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
			return null;
		}
		return $departments;
	}

	public function create_department($name) {
		$sql_user = "
			INSERT INTO departments (name, employee, resource, student, course, exam, finance, library, payment, staff)
			VALUES ('$name', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
		if (Database::$DB_CONN->query($sql_user)) {
		    return true;
		} else {
		    echo "Error: " . Database::$DB_CONN->error;
			return false;
		}
	}

	public function update_department($uid, $emp, $res, $stu, $cou, $exa, $fin, $lib, $pay, $sta) {
		$sql = "UPDATE departments SET employee=$emp, resource=$res, student=$stu, course=$cou, exam=$exa, finance=$fin, library=$lib, payment=$pay, staff=$sta WHERE did=$uid";
		if (Database::$DB_CONN->query($sql)) {

			$AdminManager = new AdminManager();
			$userid = $this->session->get_session('userid');
			$AdminManager->set_permissions($userid);

			return true;
		} else {
			echo "Error updating record: " . Database::$DB_CONN->error;
			return false;
		}
	}

	public function delete_department($did) {
		$sql = "DELETE FROM departments WHERE did=$did";
		if (Database::$DB_CONN->query($sql)) {
			return true;
		} else {
			echo "Error deleting record: " . Database::$DB_CONN->error;
			return false;
		}
	}
}

/**
* Helpers Class
*/
class Helpers {

	public function generate_userid() {
		return substr(number_format(time() * rand(),0,'',''),0,6);
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
}
?>