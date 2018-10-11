<?php
/**
 * Created by PhpStorm.
 * User: Akhila Hashan
 * Date: 10/5/2018
 * Time: 9:03 PM
 */
require('ClassStaff.php');
require('common_functions.php');

class StudentManager extends Database{

    function retrieveStudentData(){
        $studentDataQuery = "SELECT * FROM students";
        $studentDataQueryResult = Database::$DB_CONN->query($studentDataQuery);

        if ($studentDataQueryResult->num_rows > 0) {
            $students = [];
            while($row = $studentDataQueryResult->fetch_assoc()) {
                array_push($students, array(

                    'sid' => $row['sid'],
                    'fname' => $row['fname'],
                    'lname' => $row['lname'],
                    'email' => $row['email'],
                    'grade' => $row['grade'],
                    'mobile_no' => $row['mobile_no'],
                    'dob' => $row['dob'],
                    'gender' => $row['gender'],
                ));
            }
        }else{
            return null;
        }

        return $students;
    }

    function retrieveStudentGrade($grade){
        $studentDataQuery = "SELECT * FROM students WHERE grade =".$grade;
        $studentDataQueryResult = Database::$DB_CONN->query($studentDataQuery);

        if ($studentDataQueryResult->num_rows > 0) {
            $students = [];
            while($row = $studentDataQueryResult->fetch_assoc()) {
                array_push($students, array(

                    'sid' => $row['sid'],
                    'fname' => $row['fname'],
                    'lname' => $row['lname'],
                    'email' => $row['email'],
                    'grade' => $row['grade'],
                    'mobile_no' => $row['mobile_no'],
                    'dob' => $row['dob'],
                    'gender' => $row['gender'],
                ));
            }
        }else{
            return null;
        }

        return $students;
    }

}
?>
