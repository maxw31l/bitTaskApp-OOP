<?php
$title = "Home";
include "layout/header.php";
require_once "config/Database.php";
require "app/Controllers/Task.php";
$database = new Database;
$db = $database->getConnection();

$tasks = Task::index($db);


?>


<div class="container-lg py-5 bg-dark position-absolute translate-middle top-50 start-50" style="width: 65vw; height: 40vh; opacity: 100%; border-radius: 20px; border-radius: 50px; margin-top: 30px">
<table class="text-white" style="margin: 0 auto;">
    <th>Task Name</th>
    <th>Task Record</th>
    <th>Task Deadline</th>
    <th>Task Created</th>
    <th>Task Action</th>
<?php
foreach ($tasks as $task){
    echo "<tr><td>".$task['taskName']."</td><td>".$task['taskRecord']."</td><td>".$task['deadline']."</td><td>".$task['taskCreated']."</td><td><a href='views/task.edit.php/?id=".$task['id']."'>Update</a><a href='app/Controllers/task.delete.php/?id=".$task['id']."'>Delete</a></td></tr>";
}
?>
</table>

</div>

<?php
include "layout/footer.php";
?>