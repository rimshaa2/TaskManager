<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['task'])) {
    $task = $_POST['task'];
    $pdo->prepare("INSERT INTO tasks (description) VALUES (?)")->execute([$task]);
}

$tasks = $pdo->query("SELECT * FROM tasks")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>
<h1>Tasks</h1>
<form method="post">
    <input type="text" name="task" placeholder="Enter a task">
    <input type="submit" value="Add Task">
</form>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li><?= htmlspecialchars($task['description']) ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
