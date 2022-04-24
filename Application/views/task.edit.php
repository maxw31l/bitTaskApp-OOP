<?php
$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR: No User ID");
$title = "Task Edit";
include "../layout/header.php";
require "../config/Database.php";
require "../app/Controllers/Task.php";

$database = new Database;
$db = $database->getConnection();

$task = new Task($db);
$task->id = $id;
$task->getOne();



if ($_POST) {
  $task->taskName = $_POST['taskName'];
  $task->taskRecord = $_POST['taskRecord'];
  $task->deadline = $_POST['deadline'];
  
  

  if($task->update()) {
    header ("Location: ../../");
  } else {
    echo "Failed";
  }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?id={$id}");?>" method="POST">
<input type="text" name="taskName" placeholder="Task Name" value="<?php echo $task->taskName; ?>">
<input type="text" name="taskRecord" value="<?php echo $task->taskRecord; ?>">
<label for="deadline" value="<?php echo $task->deadline; ?>">Deadline:</label>
<input type="date" name="deadline" value="<?php echo $task->deadline; ?>">
<input type="submit" value="Update Task">
</form>







<?php
include "../layout/footer.php";
?>