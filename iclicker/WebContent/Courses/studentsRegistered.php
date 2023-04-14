<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $servername = "localhost";
    $dbusername = "dhairya";
    $dbpassword = "db19082002";
    $dbname = "iclicker";
    $conn = mysqli_connect("localhost", "$dbusername", "$dbpassword", "$dbname");
    $course_id = $_GET['course_id'];

    // check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT user_id FROM enrollments WHERE course_id = " . $course_id;

// Execute the query
if ($result = $conn->query($sql)) {
    // Loop through the results and store the student IDs in an array
    $student_ids = array();
    while ($row = $result->fetch_assoc()) {
        $student_ids[] = $row['user_id'];
    }
    
    // Free the result set
    $result->free();
} else {
    // Handle the error
    echo "Error: " . $mysqli->error;
}

// Close the connection
$conn->close();

// If there are any student IDs, retrieve the corresponding user information from the users table
if (!empty($student_ids)) {
    $mysqli = new mysqli("localhost", "$dbusername", "$dbpassword", "$dbname");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $sql = "SELECT * FROM users WHERE user_id IN (" . implode(',', $student_ids) . ")";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            echo $row['username'] . '<br>';
        }

        // Free the result set
        $result->free();
    } else {
        // Handle the error
        echo "Error: " . $mysqli->error;
    }

    // Close the connection
    $mysqli->close();
} else {
    // Output a message indicating no students are enrolled in the course
    echo "No students are enrolled in this course.";
}$sql = "SELECT user_id FROM enrollments WHERE course_id = " . $course_id;

// Execute the query
if ($result = $conn->query($sql)) {
    // Loop through the results and store the student IDs in an array
    $student_ids = array();
    while ($row = $result->fetch_assoc()) {
        $student_ids[] = $row['student_id'];
    }
    
    // Free the result set
    $result->free();
} else {
    // Handle the error
    echo "Error: " . $mysqli->error;
}

// Close the connection
$mysqli->close();

// If there are any student IDs, retrieve the corresponding user information from the users table
if (!empty($student_ids)) {
    // Create a new mysqli object
    $mysqli = new mysqli("localhost", "username", "password", "database");

    // Check for errors
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Define your SQL query to retrieve user information for the specified student IDs
    $sql = "SELECT * FROM users WHERE id IN (" . implode(',', $student_ids) . ")";

    // Execute the query
    if ($result = $mysqli->query($sql)) {
        // Loop through the results and do something with each row
        while ($row = $result->fetch_assoc()) {
            // Output the student name, for example
            echo $row['user_name'] . '<br>';
        }

        // Free the result set
        $result->free();
    } else {
        // Handle the error
        echo "Error: " . $mysqli->error;
    }

    // Close the connection
    $conn->close();
} else {
    // Output a message indicating no students are enrolled in the course
    echo "No students are enrolled in this course.";
}

?>