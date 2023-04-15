<?php
session_start();
$student_id = $_SESSION['user_id'];
$poll_id = $_POST['poll_id'];
$response = $_POST['answer'];
$response_time = date('Y-m-d H:i:s');
$host = 'localhost';
$dbusername = 'dhairya';
$dbpassword = 'db19082002';
$dbname = 'iclicker';
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
$sql = "INSERT INTO poll_responses (poll_id, student_id, response, response_time) VALUES ('$poll_id', '$student_id', '$response', '$response_time')";
mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location: ../CourseView.php");
exit();
?>