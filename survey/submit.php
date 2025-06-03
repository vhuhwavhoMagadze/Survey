<?php
// Database connection settings
$host = "localhost";
$user = "root";
$pass = "";
$db = "survey_db";

// Create a new connection to the MySQL database
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection failed and stop the script if it did
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data sent via POST method
$full_name     = $_POST['full_name'];
$email         = $_POST['email'];
$dob           = $_POST['dob'];
$contact       = $_POST['contact'];
$favorite_food = $_POST['favorite_food'];
$watch_movies  = $_POST['watch_movies'];
$listen_radio  = $_POST['listen_radio'];
$eat_out       = $_POST['eat_out'];
$watch_tv      = $_POST['watch_tv'];

// Prepare an SQL statement to insert the form data into the database
$sql = "INSERT INTO survey_responses (
            full_name, email, date_of_birth, contact_number, 
            favorite_food, watch_movies, listen_radio, eat_out, watch_tv
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare($sql);

// Bind the form data to the SQL statement parameters
$stmt->bind_param(
    "ssssssiii", 
    $full_name, $email, $dob, $contact, 
    $favorite_food, $watch_movies, $listen_radio, $eat_out, $watch_tv
);

// Execute the SQL statement and check if it was successful
if ($stmt->execute()) {
    // If successful, show a success message and redirect to results page after 2 seconds
    echo "<!DOCTYPE html>
    <html><head>
        <meta http-equiv='refresh' content='2;url=results.php' />
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head><body>
    <div class='container mt-5'>
        <div class='alert alert-success'>Survey submitted successfully! Redirecting to results...</div>
    </div></body></html>";
} else {
    // If there was an error, display the error message
    echo "Error: " . $stmt->error;
}

// Close the database connection
$conn->close();
?>
