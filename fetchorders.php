<?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "vrex"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from the URL parameter
$userID = $_GET['userID'];

// Fetch orders based on the user ID
$sql = "SELECT * FROM orders WHERE user_id = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Order " . $row['order_id'] . ": " . $row['details'] . "</p>";
    }
} else {
    echo "<p>No previous orders</p>";
}

$conn->close();
?>
