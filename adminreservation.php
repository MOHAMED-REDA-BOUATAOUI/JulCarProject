<?php
session_start();




$dbhost = "Localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "jul_car_db";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM reservation";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
</head>
<body>

    <h2>Reservations</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Permis</th>
            <th>Marque</th>
            <th>Model</th>
            <th>Date Sortie</th>
            <th>Date Entrée</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["permis"] . "</td>";
            echo "<td>" . $row["marque"] . "</td>";
            echo "<td>" . $row["model"] . "</td>";
            echo "<td>" . $row["date_sortie"] . "</td>";
            echo "<td>" . $row["date_entree"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <p><a href="admindashboard.php">Back to Dashboard</a></p>

</body>
</html>
