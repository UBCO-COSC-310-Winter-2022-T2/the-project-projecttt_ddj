<?php
// Check if poll exists
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host = 'localhost';
$dbusername = 'dhairya';
$dbpassword = 'db19082002';
$dbname = 'iclicker';
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
$sql = "SELECT * FROM poll ORDER BY poll_id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
  // Poll does not exist, show error message
  echo "Poll does not exist.";
} else {
  $row = mysqli_fetch_assoc($result);

  if ($row['end_time'] !== null ) {
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
    ?>
    <html>
    <head>
    <title>Polling</title>
    </head>
    <body>
    <h1><?php echo $row['question']; ?></h1>
    <?php if ($row['end_time'] === null || strtotime($row['end_time']) <= time()) { ?>
      <p>Poll has ended. Here are the results:</p>
    <?php } else { ?>
      <p>Poll has not yet started. Here are the details:</p>
    <?php } ?>
    <ul>
    <li>Option 1: <?php echo $row['option1']; ?></li>
    <li>Option 2: <?php echo $row['option2']; ?></li>
    <?php if ($row['option3']) { ?>
      <li>Option 3: <?php echo $row['option3']; ?></li>
    <?php } ?>
    <?php if ($row['option4']) { ?>
      <li>Option 4: <?php echo $row['option4']; ?></li>
    <?php } ?>
    <li>Correct answer: <?php echo $row['correct_answer']; ?></li>
    <li>Total responses: <?php echo mysqli_num_rows($result); ?></li>
    <li>Number of correct responses: <?php echo $num_correct; ?></li>
    </ul>
    </body>
    </html>
    <?php
  }
}
?>
