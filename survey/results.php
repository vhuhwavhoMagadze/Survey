<?php
// Database connection settings
$host = "localhost";
$user = "root";
$pass = "";
$db = "survey_db";

// Create a new database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all survey responses from the database
$result = $conn->query("SELECT * FROM survey_responses");
$total = $result->num_rows; // Total number of responses

// Start HTML output
echo '<!DOCTYPE html>
<html>
<head>
    <title>Survey Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white"><h4>Survey Results</h4></div>
        <div class="card-body">';

// If there are survey responses
if ($total > 0) {
    // Fetch all data as an associative array
    $data = $result->fetch_all(MYSQLI_ASSOC);

    // Calculate ages from date of birth
    $ages = array_map(function($entry) {
        $birthDate = date_create($entry['date_of_birth']);
        $today = date_create();
        return date_diff($birthDate, $today)->y;
    }, $data);

    // Calculate age statistics
    $avg_age = round(array_sum($ages) / count($ages));
    $max_age = max($ages);
    $min_age = min($ages);

    // Initialize food preference counters
    $food_counts = ['Pizza' => 0, 'Pasta' => 0, 'Pap and Wors' => 0];

    // Initialize rating totals
    $movie_sum = $radio_sum = $eat_out_sum = $tv_sum = 0;

    // Loop through each survey entry
    foreach ($data as $entry) {
        // Count favorite food choices
        $food = $entry['favorite_food'];
        if (isset($food_counts[$food])) {
            $food_counts[$food]++;
        }

        // Sum up ratings
        $movie_sum += $entry['watch_movies'];
        $radio_sum += $entry['listen_radio'];
        $eat_out_sum += $entry['eat_out'];
    }

    // Function to calculate percentage
    $percent = function($count) use ($total) {
        return round(($count / $total) * 100, 2);
    };

    // Display results
    echo "
        <p>Total number of surveys: <strong>$total</strong></p>
        <p>Average Age: <strong>$avg_age</strong></p>
        <p>Oldest person: <strong>$max_age</strong></p>
        <p>Youngest person: <strong>$min_age</strong></p>
        <p>Percentage who like Pizza: <strong>{$percent($food_counts['Pizza'])}%</strong></p>
        <p>Percentage who like Pasta: <strong>{$percent($food_counts['Pasta'])}%</strong></p>
        <p>Percentage who like Pap and Wors: <strong>{$percent($food_counts['Pap and Wors'])}%</strong></p>
        <p>Average rating for watching movies: <strong>" . round($movie_sum / $total, 2) . "</strong></p>
        <p>Average rating for listening to radio: <strong>" . round($radio_sum / $total, 2) . "</strong></p>
        <p>Average rating for eating out: <strong>" . round($eat_out_sum / $total, 2) . "</strong></p>
    ";
} else {
    // If no survey data is available
    echo '<div class="alert alert-warning">No Surveys Available.</div>';
}

// Close HTML tags
echo '</div></div></div>
</body>
</html>';

// Close the database connection
$conn->close();
?>
