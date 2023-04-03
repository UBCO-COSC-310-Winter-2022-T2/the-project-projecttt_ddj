<?php
session_start();
if (isset($_GET['course_name']) && isset($_GET['instructor_id'])) {
    $course_name = $_GET['course_name'];
    $instructor_id = $_GET['instructor_id'];
    // Do something with course name and instructor ID
} else {
    // Redirect to the previous page if course name or instructor ID is not provided
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>

<html>
<body>
<title>Qclicker System</title>
<h1>COURSES</h1>
<h3><i><b>Starting/Ending the class</b></i></h3>
<h3><i><b>Starting/Ending the poll</b></i></h3>
<h3><i><b>Grading the results</b></i></h3>
<h3><i><b>Submitting the correct answer</b></i></h3>
<h3><i><b>Polling Statistics</b></i></h3>
</html>