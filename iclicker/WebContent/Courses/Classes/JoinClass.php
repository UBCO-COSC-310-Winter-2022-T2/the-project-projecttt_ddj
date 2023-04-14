<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Connect to database
$host = 'localhost';
$dbusername = 'dhairya';
$dbpassword = 'db19082002';
$dbname = 'iclicker';
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

// Check for connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if poll has started
$sql = "SELECT * FROM poll WHERE poll_id = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (!$row) {
    // No polls found, display message
    echo "There are no polls currently available.<br> ";
    echo '<a href="javascript:history.go(-1)">Go back </a>';

}
else if ($row['end_time'] !== null && strtotime($row['end_time']) > time()) {
  // Poll has started, display poll form
  ?>
  <html>
  <head>
  <title>Polling</title>
  </head>
  <body>
  <h1><?php echo $row['question']; ?></h1>
  <form method="post" action="submit_poll.php">
  <input type="hidden" name="poll_id" value="<?php echo $row['poll_id']; ?>">
  <input type="radio" name="answer" value="1"> <?php echo $row['option1']; ?><br>
  <input type="radio" name="answer" value="2"> <?php echo $row['option2']; ?><br>
  <?php if ($row['option3']) { ?>
    <input type="radio" name="answer" value="3"> <?php echo $row['option3']; ?><br>
  <?php } ?>
  <?php if ($row['option4']) { ?>
    <input type="radio" name="answer" value="4"> <?php echo $row['option4']; ?><br>
  <?php } ?>
  <input type="submit" value="Submit">
  </form>
  </body>
  </html>
  <?php
} else {
  // Poll has not started or has ended, display poll summary
  $sql = "SELECT * FROM poll WHERE poll_id = 1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $correct_answer = $row['correct_answer'];
  $num_correct = 0;
  $num_answered = 0;
  $sql = "SELECT * FROM poll_responses WHERE poll_id = 1";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $num_answered++;
    if ($row['response'] == $correct_answer) {
      $num_correct++;
    }
  }
  ?>
 

  <html>
  <head>
  <title>Polling</title>
  </head>
  <body>
  <h1>Poll Summary</h1>
  <p>Number of polls: <?php echo $num_answered; ?></p>
  <p>Number of correct answers: <?php echo $num_correct; ?></p>
  </body>
  </html>
  <?php
}

// Close database connection
mysqli_close($conn);
?>

