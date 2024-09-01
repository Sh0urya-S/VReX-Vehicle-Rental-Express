<?php
// Start the session
session_start();
echo "Session ID: " . session_id();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vrex"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store validation errors
    $errors = array();

    // Fetch form data with validation
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
    $vehicleModel = isset($_POST['selectedVehicle']) ? $_POST['selectedVehicle'] : '';

    echo "Start Date: " . $startDate . "<br>";
    echo "End Date: " . $endDate . "<br>";
    echo "Vehicle Model: " . $vehicleModel . "<br>";

    // Validate required fields
    if (empty($startDate)) {
        $errors[] = "Start Date is required";
    }
    if (empty($endDate)) {
        $errors[] = "End Date is required";
    }
    if (empty($vehicleModel)) {
        $errors[] = "Vehicle Model is required";
    }

    // If there are no validation errors, proceed with booking
    if (empty($errors)) {
        // Retrieve the username from the form
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        echo "Username: " . $username . "<br>"; // Debugging output

        $sql = "SELECT USERID FROM USERPROFILES WHERE LOWER(FIRSTNAME) = LOWER('$username')";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userID = $row['USERID'];

            // Fetch the cost per day based on the selected vehicle
            $costPerDay = fetchCostPerDay($vehicleModel);

            // Perform the calculation for total cost (replace with your logic)
            $totalCost = calculateTotalCost($startDate, $endDate, $costPerDay); // Call your calculation function

            // Insert into booking log
            $sql = "INSERT INTO bookinglog (USERID, startdate, enddate, vehiclebooked, totalcost) 
                    VALUES ('$userID', '$startDate', '$endDate', '$vehicleModel', '$totalCost')";

            if ($conn->query($sql) === TRUE) {
                echo "Booking submitted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "User not found";
        }
    } else {
        // Output validation errors
        foreach ($errors as $error) {
            echo "Error: " . $error . "<br>";
        }
    }
}

// Close the database connection
$conn->close();

// Function to fetch cost per day based on the selected vehicle
function fetchCostPerDay($vehicleModel) {
    // Replace this with your actual logic to fetch cost per day from the API
    $apiUrl = "/miniproj/js/fetch_cost_per_day.php?vehicleName=" . urlencode($vehicleModel);
    $costPerDay = file_get_contents($apiUrl);

    return $costPerDay;
}

// Function to calculate total cost (replace with your logic)
function calculateTotalCost($startDate, $endDate, $costPerDay) {
    // Replace this with your actual calculation logic
    // For example, you can calculate based on the difference in dates
    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate);
    $daysDifference = ceil(($endTimestamp - $startTimestamp) / (24 * 60 * 60));
    return $daysDifference * $costPerDay;
}
?>
