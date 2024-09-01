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
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Store password as plain text
    $confirmPassword = $_POST['confirmPassword'];
    $aadharno = $_POST['aadharno'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    // Validate user credentials
    $sql = "INSERT INTO userprofiles (FIRSTNAME, LASTNAME, EMAIL, PWD, AADHAR, RESIDENTSTATE, RESIDENTCITY)
            VALUES ('$firstname', '$lastname', '$email', '$password', '$aadharno', '$state', '$city')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to dashboard with the user's first name as a parameter
        header("Location: dashboard.html?firstname=$firstname");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
