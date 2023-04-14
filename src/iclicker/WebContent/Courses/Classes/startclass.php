<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$dbusername = "dhairya";
$dbpassword = "db19082002";
$dbname = "iclicker";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
$course_name = $_GET['course_name'];
$course_id = $_GET['course_id'];
$instructor_id = $_GET['instructor_id'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['instructor_id']) && isset($_GET['course_id']) ) {
    
    echo $course_name;

    
    // Insert new class into database
    $sql = "INSERT INTO class (course_id, instructor_id, start_time, end_time) 
    VALUES ('$course_id', $instructor_id, NOW(), NULL)";
    if (mysqli_query($conn, $sql)) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

} else {
    // Redirect to the previous page if course name, instructor ID, class date, or class time is not provided
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();

}

echo $sql;
?>
