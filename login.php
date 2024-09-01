<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a connection to the MySQL database
    $servername = "localhost";
    $username = "root"; // Default username for XAMPP
    $password = ""; // Default password for XAMPP
    $dbname = "vrex"; // Replace with your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $sql = "SELECT * FROM userprofiles WHERE EMAIL = '$email' AND PWD = '$password'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user's FIRSTNAME
        $row = $result->fetch_assoc();
        $firstname = $row['FIRSTNAME'];

        // Redirect to the dashboard with the user's first name as a parameter
        header("Location: /miniproj/dashboard.html?firstname=$firstname");
        exit();
    } else {
        // Display an error message if login fails
        echo "<script>alert('Invalid username or password');</script>";
        // You can choose to redirect to the login page or display an error message on the same page
    }

    $conn->close();
}
?>
