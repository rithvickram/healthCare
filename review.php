<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $review = $_POST['review_text'];
    $rating = $_POST['rating'];

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

    // Prepare SQL statement to retrieve user ID from database
    $sql = "SELECT user_id FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user ID
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        // Retrieve appointment details
        $sql = "SELECT * FROM appointments WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch appointment details
            $row = $result->fetch_assoc();
            $hospital_id = $row['hospital_id'];
            $appointment_id = $row['appointment_id'];
            $query = "INSERT INTO reviews (user_id, hospital_id, appointment_id, review, rating) VALUES ('$user_id', '$hospital_id', '$appointment_id', '$review', '$rating')";
            if ($conn->query($query) === TRUE) {
                echo "Thanks for the review!";
                // Redirect to dashboard after successful review submission
                header("Location: dashbord1.php");
                exit(); // Ensure script execution stops after redirection
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        } else {
            echo "No appointments found for the user.";
<a href="index.php">click hear</a>

        }
    } else {
        echo "User not found.";
    }

    // Close the database connection
    $conn->close();
}
?>
