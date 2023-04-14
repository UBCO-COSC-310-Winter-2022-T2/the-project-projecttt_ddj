<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['course_id']) && isset($_GET['course_name'])) {
    $course_id = $_GET['course_id'];
    $course_name = $_GET['course_name'];
    // Store course name in a session
} else {
    // Redirect to the previous page if course name is not provided
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Verify that the user is enrolled in the selected course
    $host = 'localhost';
    $dbusername = 'dhairya';
    $dbpassword = 'db19082002';
    $dbname = 'iclicker';
    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT enrollments.user_id 
            FROM enrollments 
            WHERE enrollments.course_id = $course_id 
            AND enrollments.user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // Redirect to the dashboard if the user is not enrolled in the selected course
        header("Location: ../dashboard/studentD.php");
        exit();
    }

    $sql = "SELECT grades.attendance, grades.marks 
            FROM grades 
            WHERE grades.course_id = $course_id 
            AND grades.student_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $attendance = $row['attendance'].'%';
            $stats = $row['marks'].'%';
        }
    } else {
        // Set grades as N/A if not available
        $attendance = "N/A";
        $stats = "N/A";
    }

    $sql = "SELECT * FROM class WHERE course_id = '$course_id' AND end_time IS NULL";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            echo $row['course_id'];

        }
    }

    $sql = "SELECT * FROM class WHERE course_id = '$course_id' AND end_time IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Get the class ID
    $row = $result->fetch_assoc();
    $class_id = $row['class_id'];
    
    // Display the link to the class page
    echo '<html><body><title>Qclicker System</title>';
    echo '<h1>' . $course_name . '</h1>';
    echo '<h3><i><b>Join Class:</b></i> <a href="UserInterface/classroom.php?class_id=' . urlencode($class_id) . '">Click Here</a></h3>';
    echo '</body></html>';
} else {
    echo '<html><body><title>Qclicker System</title>';
    echo '<h1>' . $course_name . '</h1>';
    echo '<h3><i><b>No Class In Progress</b></i></h3>';
    echo '</body></html>';
}



} else {
    // Redirect to login page if the user is not logged in
    header("Location: ../login.php");
    exit();
}
?>

<h3><i><b><a href = "../dashboard.php">Go Back</a></b></i></h3>'