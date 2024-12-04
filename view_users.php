<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: todolist.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, year, course, program FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="view.css">
<head>
    <title>Registered Users</title>

</head>
<body>
    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Year</th>
            <th>Course</th>
            <th>Program</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['username']}</td>
                        <td>{$row['year']}</td>
                        <td>{$row['course']}</td>
                        <td>{$row['program']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    <a href="logout.php">
        <button class="btn btn-gradient-border btn-glow">Log-out</button>
    </a>
</body>
</html>
