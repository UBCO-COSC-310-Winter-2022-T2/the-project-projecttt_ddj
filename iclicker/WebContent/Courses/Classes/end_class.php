<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $servername = "localhost";
    $dbusername = "dhairya";
    $dbpassword = "db19082002";
    $dbname = "iclicker";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    $course_id = $_GET['course_id'];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    // Get the course ID and instructor ID from the database
    $sql = "SELECT course_id, instructor_id FROM class WHERE course_id = '$course_id' AND end_time IS NULL ORDER BY start_time DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $course_id = $row['course_id'];
        $instructor_id = $row['instructor_id'];
    } else {
        echo "No running classes found for $course_name";
        exit();
    }
    
    // Check if the instructor ID matches the current user's ID
    if ($instructor_id != $_SESSION['user_id']) {
        echo "You are not authorized to end this class";
        exit();
    }

    // Update the end_time of the class
    $sql = "UPDATE class SET end_time = NOW() WHERE course_id = '$course_id' AND end_time IS NULL AND instructor_id = '$instructor_id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        echo "Error updating class end time: " . mysqli_error($conn);
    }
} else {
    echo "No course name provided";
}

?>