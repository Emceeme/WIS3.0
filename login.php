<?php
session_start();

$servername = "localhost";
$username = "root"; // Change if your MySQL username is different
$password = ""; // Change if you have a password set for MySQL
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: todolist.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found.";
    }
}
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
<head>
    <title>Login</title>
</head>
<body>
    <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
    </div>
    <div class="login">
    <h2>Login Form</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="" method="post">
        <div class="inputBx">
        <input type="text" name="username" required>
        </div>
        <div class="inputBx">
        <input type="password" name="password" required>
        </div>
        <div class="inputBx">
        <input type="submit" value="Login">
        </div>
    </form>
    <a href="register.php">Register</a>
    <a href="todolist.php">Log-In</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>