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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $question = $_POST['question'];
  $option1 = $_POST['option1'];
  $option2 = $_POST['option2'];
  $option3 = $_POST['option3'];
  $option4 = $_POST['option4'];
  $correct_answer = $_POST['correct_answer'];
  $class_id = $_SESSION['class_id'];
  $sql = "INSERT INTO poll (class_id,question, option1, option2, option3, option4, correct_answer, start_time, end_time)
          VALUES ('$class_id','$question', '$option1', '$option2', '$option3', '$option4', '$correct_answer', NOW(), NULL)";
  mysqli_query($conn, $sql);
  header("Location: ../../dashboard.php");
  exit();
}
?>

<html>
<head>
  <title>Create Poll</title>
</head>
<body>
  <h1>Create Poll</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="question">Question:</label><br>
    <input type="text" id="question" name="question"><br><br>

    <label for="option1">Option 1:</label><br>
    <input type="text" id="option1" name="option1"><br><br>

    <label for="option2">Option 2:</label><br>
    <input type="text" id="option2" name="option2"><br><br>

    <label for="option3">Option 3:</label><br>
    <input type="text" id="option3" name="option3"><br><br>

    <label for="option4">Option 4:</label><br>
    <input type="text" id="option4" name="option4"><br><br>

    <label for="correct_answer">Correct Answer:</label><br>
    <select id="correct_answer" name="correct_answer">
      <option value="1">Option 1</option>
      <option value="2">Option 2</option>
      <option value="3">Option 3</option>
      <option value="4">Option 4</option>
    </select><br><br>


    <input type="submit" value="Create Poll">
  </form>
</body>
</html>
