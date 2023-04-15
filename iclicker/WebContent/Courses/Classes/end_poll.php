<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host = 'localhost';
$dbusername = 'dhairya';
$dbpassword = 'db19082002';
$dbname = 'iclicker';
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

$class_id = $_SESSION['class_id'];
$sql = "UPDATE poll SET end_time=NOW() WHERE class_id='$class_id' AND end_time IS NULL";
mysqli_query($conn, $sql);

header("Location: ../../dashboard.php");
exit();
?>
