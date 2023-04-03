<?php
session_start();
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
            WHERE grades.course_id = $course_id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $attendance = $row['attendance'];
        $stats = $row['marks'];
    }
} else {
    // Redirect to login page if the user is not logged in
    header("Location: ../login.php");
    exit();
}
?>
<html>
    <body>
<title>Qclicker System</title>
<div class = "course_name"><h1><?php echo $course_name ?></h1></div>
<div class = "statistics"><h3><i><b>Statistics: <?php echo $stats;?> %</b></i></h3></div>
<div class = "attendance"><h3><i>Attendance :  <?php echo $attendance;?> %</i></h3></div>
<a href = "../dashboard.php">
</body>
</html>