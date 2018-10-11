<?php
include_once 'database_credentials.php';



class CourseManager{

  function database_check(){
  $db =new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($db->connect_errno)
      {
        die("Failed to connect to MySQL: " .  $db->connect_error);
      }
  return $db;
  }

  function loadAllCourses(){
    $db = CourseManager::database_check();
    $loadCourseQuery = "SELECT * FROM courses";
    $loadCourseResult = $db->query($loadCourseQuery);

    if ($loadCourseResult->num_rows > 0) {
    	$courses = array();
    	while($row = $loadCourseResult->fetch_assoc()) {
    		array_push($courses, array(

    		'cid' => $row['cid'],
    		'name' => $row['name'],
    		'grade' => $row['grade'],
    		'day' => $row['day'],
    		'time_start' => $row['time_start'],
    		'time_end' => $row['time_end'],
    		'hall_no' => $row['hall_no'],
    		'fee' => $row['fee'],

    	));
    	}
    }else{
    	return null;
    }

    return $courses;
  }

  function loadCoursesName($courseName){
    $db = CourseManager::database_check();
    $loadCourseQuery = "SELECT * FROM courses WHERE name ='".$courseName."'";
    $loadCourseResult = $db->query($loadCourseQuery);

    if ($loadCourseResult->num_rows > 0) {
      $courses = array();
      while($row = $loadCourseResult->fetch_assoc()) {
        array_push($courses, array(

        'cid' => $row['cid'],
        'name' => $row['name'],
        'grade' => $row['grade'],
        'day' => $row['day'],
        'time_start' => $row['time_start'],
        'time_end' => $row['time_end'],
        'hall_no' => $row['hall_no'],
        'fee' => $row['fee'],

      ));
      }
    }else{
      return null;
    }

    return $courses;
  }

  function getAllCourse(){
    $allCourses = "SELECT cid, name FROM courses";

    $allCoursesResult = Database::$DB_CONN->query($allCourses);

    if ($allCoursesResult->num_rows > 0){
      return $allCoursesResult;
    }
  }

}

?>
