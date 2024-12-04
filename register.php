<?php
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
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $year = $_POST['year'];
    $course = $_POST['course'];
    $program = $_POST['program'];

    $sql = "INSERT INTO users (username, password, year, course, program) VALUES ('$username', '$password', '$year', '$course', '$program')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
<head>
    <title>Register</title>
</head>
<body>
    <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
            <h2>Registration Form</h2>
            <form action="" method="post">
                <div class="inputBx">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="inputBx">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="inputBx">
                    <input type="text" name="year" placeholder="Year">
                </div>
                <div class="inputBx">
                    <input type="text" name="course" placeholder="Course">
                </div>
                <div class="inputBx">
                    <input type="text" name="program" placeholder="Program">
                </div>
                <div class="inputBx">
                    <input type="submit" value="Register">
                </div>
            </form>
    </body>
</html>

<?php
$conn->close();
?>