<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['hospitalName'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Perform validation
    if ($password != $cpassword) {
        echo "Error: Passwords do not match.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection (replace with your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "nFE_04jI7_4iU8v.";
        $dbname = "health_care";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert data into database
        $sql = "INSERT INTO hospitals (hospital_name, city, state, country, email, phone, password) VALUES ('$name', '$city', '$state', '$country', '$email', '$phone', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
                header("location: index.php");

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>user Registration</title>
<link rel="stylesheet" href="style2.css">
</head>
<body>
<nav class="navb">
<a href="index.php">home</a>
</nav>
<main class="main">
<h1>Healthcare Registration</h1>
<br>
<form id="hospitalForm" class="form" action="register2.php" method="post">
    <h2>Hospital Registration</h2>
    <label>Hospital Name: <input type="text" name="hospitalName" required></label><br>
    <label>city: <input type="text" name="city" required></label><br>
    <label>state: <input type="text" name="state" required></label><br>
    <label>country: <input type="text" name="country" required></label><br>
    <label>phone: <input type="number" name="phone" required></label><br>
    <label>email: <input type="email" name="email" required></label><br>
    <label>password: <input type="password" name="password" required></label><br>
    <label>confirm password: <input type="password" name="cpassword" required></label><br>

    <button type="submit">Register</button>
</form>
<p>
Already have an account?
<br>
<a href="login2.php">click hear</a>
</p>
</main>
</body>
</html>
