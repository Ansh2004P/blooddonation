<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert donor information into the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $diseases = $conn->real_escape_string($_POST['diseases']);
    $age = (int)$_POST['age'];
    $contact = $conn->real_escape_string($_POST['contact']);
    $weight = (float)$_POST['weight'];
    $blood_group = $conn->real_escape_string($_POST['blood_group']);
    $address = $conn->real_escape_string($_POST['address']);

    // Prepare the SQL statement
    $sql = "INSERT INTO donors (name, email, age, contact, diseases, blood_group, weight, address) 
            VALUES ('$name', '$email', $age, '$contact', '$diseases', '$blood_group', $weight, '$address')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Thank you for your donation! Your details have been saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>