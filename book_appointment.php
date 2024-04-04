<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $hospital = $_POST['hospital'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    // Get user's email from session
    $email = $_SESSION['username'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $db_password = "nFE_04jI7_4iU8v."; // Change this to your actual database password
    $dbname = "health_care";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to retrieve user from database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, get user details
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        // Insert appointment into appointments table
        $query = "INSERT INTO appointments (user_id, hospital_id, date, time) VALUES ('$user_id', '$hospital', '$date', '$time')";
        if ($conn->query($query) === TRUE) {
            echo "Appointment booked successfully!";
            header("Location: dashbord1.php");
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "User not found.";
    }

    // Close the database connection
    $conn->close();
}
?>
