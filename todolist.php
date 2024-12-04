<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_system');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to add a task
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_task'])) {
    $task = $conn->real_escape_string($_POST['task']);
    if (!empty($task)) {
        $conn->query("INSERT INTO todos (task) VALUES ('$task')");
    }
}

// Handle delete task
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM todos WHERE id = $id");
}

// Fetch all tasks
$result = $conn->query("SELECT * FROM todos ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="todo.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>
<body>
<a href="logout.php">    
<button class="btn btn-gradient-border btn-glow" >Log-out</button>
</a> 
<a href="view_users.php">
    <button class="tn btn-gradient-border btn-glow">View Users</button>
</a>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST" action="">
            <input type="text" name="task" placeholder="Enter your task" required>
            <button type="submit" name="add_task">Add Task</button>
        </form>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <?php echo htmlspecialchars($row['task']); ?>
                    <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>