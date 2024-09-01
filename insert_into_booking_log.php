<?php
session_start();
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vrex";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $userID = isset($_POST['userID']) ? $_POST['userID'] : '';
    $location = isset($_POST['bookingLocation']) ? $_POST['bookingLocation'] : '';
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
    $selectedVehicle = isset($_POST['selectedVehicle']) ? $_POST['selectedVehicle'] : '';
    $totalCost = isset($_POST['totalCost']) ? $_POST['totalCost'] : '';

    // Insert into booking log
    $sql = "INSERT INTO booking_log (USERID, location, start_date, end_date, vehiclebooked, total_cost) 
            VALUES ('$userID', '$location', '$startDate', '$endDate', '$selectedVehicle', '$totalCost')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
