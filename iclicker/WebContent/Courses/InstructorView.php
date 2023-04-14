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
$course_id = $_GET['course_id'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['course_name']) && isset($_GET['instructor_id'])) {
    $course_name = $_GET['course_name'];
    $instructor_id = $_GET['instructor_id'];
} else {
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}

$sql = "SELECT * FROM class WHERE course_id = '$course_id' AND end_time IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<html><body><title>Qclicker System</title>';
    echo '<h1>' . $course_name . '</h1>';
    echo '<h3><i><b>End Class:</b></i> <a href="Classes/end_class.php?course_id=' . urlencode($course_id) . '">Click Here</a></h3>';
    echo '<h3><i><b>Start Poll:</b></i> <a href="Classes/startPoll.php?course_name=' . urlencode($course_name) . '">Click Here</a></h3>';    
    echo '</body></html>';
} else {
    echo '<html><body><title>Qclicker System</title>';
    echo '<h1>' . $course_name . '</h1>';
    echo '<h3><i><b>Start Class:</b></i> <a href="Classes/startclass.php?course_name=' . urlencode($course_name).'&course_id=' . urlencode($course_id).'&instructor_id='.urlencode($instructor_id) . '">Click Here</a></h3>';
    echo '</body></html>';
}

echo '<h3><i><b>Grading the results</b></i></h3>
<h3><i><b>Submitting the correct answer</b></i></h3>
<h3><i><b>Polling Statistics</b></i></h3>
<h3><i><b><a href = "../dashboard.php">Go Back</a></b></i></h3>';


?>
<link rel ='stylesheet' href="css/InstructorView.css">