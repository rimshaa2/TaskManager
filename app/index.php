<?php
require 'db.php';

// Add a new task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $task = $_POST['task'];
    $pdo->prepare("INSERT INTO tasks (description) VALUES (?)")->execute([$task]);
}

// Delete a task
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $pdo->prepare("DELETE FROM tasks WHERE id = ?")->execute([$id]);
    header("Location: index.php"); // Prevent resubmission
    exit;
}

// Fetch all tasks
$tasks = $pdo->query("SELECT * FROM tasks")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task Manager</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Task Manager</h3>
      </div>
      <div class="card-body">
        <form method="post" class="row g-3 mb-4">
          <div class="col-md-9">
            <input type="text" name="task" class="form-control" placeholder="Enter a new task" required>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-success w-100">Add Task</button>
          </div>
        </form>

        <?php if (count($tasks) > 0): ?>
          <ul class="list-group">
            <?php foreach ($tasks as $task): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($task['description']) ?>
                <a href="?delete=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')">Delete</a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <div class="alert alert-info">No tasks yet. Add one above!</div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
