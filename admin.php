<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
if(validateAdmin($username, $password)){
    $_SESSION["username"]=$username;
    header("Location : admindashboard.php");

}

}
function validateAdmin($username, $password) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jul_car_db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Protect against SQL injection (you should use prepared statements in production)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Fetch admin record from the database
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $password = $row["password"];

       if($password == $password){
        $_SESSION["LogedInAdmin"]=$username;
        header("Location: dashboard.php");
       }
    }

    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

    <h2>Admin Login</h2>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form action="admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>

</body>
</html>
