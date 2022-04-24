<?php

$title = "Task Create";

require "../config/Database.php";
require "../app/Controllers/Task.php";

$database = new Database;
$db = $database->getConnection();

$task = new Task($db);

if ($_POST) {
  $task->taskName = $_POST['taskName'];
  $task->taskRecord = $_POST['taskRecord'];
  $task->deadline= $_POST['deadline'];
  $task->created= $_POST['created'];


  if($task->create()) {
    header ("Location: ../");
  } else {
    echo "Failed";
  }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<input type="text" name="taskName" placeholder="Task Name">
<textarea name="taskRecord" cols="30" rows="3" placeholder="Task Record"></textarea>
<label for="deadline">Deadline:</label>
<input type="date" name="deadline">
<input type="submit">


</form>








<?php
include "../layout/footer.php";
?>