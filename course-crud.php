<?php

    session_start();
    $data = mysqli_connect('localhost','root','','itpprojectdb');

    $cid = 0;
    $name = "";
    $grade = "";
    $day   = "";
    $sTime = "";
    $eTime = "";
    $hall  = "";
    $fee   = "";


    if(isset($_POST['addCourse'])){
        $cid = $_POST['cid'];
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $day = $_POST['day'];
        $time = $_POST['stime'];
        $etime = $_POST['etime'];
        $hall = $_POST['hall'];
        $fee = $_POST['fee'];


        mysqli_query($data,"INSERT INTO courses (cid,name,grade,day,time_strat,time_end,hall_no,fee)");
        header('location: course-add.php');
    }

    session_write_close();
?>