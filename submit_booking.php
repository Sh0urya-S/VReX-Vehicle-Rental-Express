<?php
session_start();
// Database connection parameters
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
    $location = $_POST['location'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];
    $vehicleType = $_POST['vehicle-type'];
    $vehicleModel = $_POST['vehicle-model'];

    // Perform necessary operations with the form data
    // Insert into the database, perform validations, etc.
    // You need to write the appropriate code here based on your requirements
    // Example insert query:
    $sql = "INSERT INTO booking_log (location, start_date, end_date, vehicle_type, vehicle_model) 
            VALUES ('$location', '$startDate', '$endDate', '$vehicleType', '$vehicleModel')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>
