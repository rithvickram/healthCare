<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password != $cpassword) {
        echo "Error: Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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
        $sql = "INSERT INTO users (name, phone, city, state, country, email, password) VALUES ('$name', '$phone', '$city', '$state', '$country', '$email', '$hashed_password')";

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
<na class="navbar">
<a href="index.php">home</a>
</nav>
<main class="main">
<h1>Healthcare Registration</h1>
<br>

<form id="userForm" class="hidden" action="register.php" method="post">
    <h2>User Registration</h2>
    <label>name: <input type="text" name="name" required></label><br>
    <label>phone: <input type="number" name="phone" required></label><br>
    <label>city: <input type="text" name="city" required></label><br>
    <label>state: <input type="text" name="state" required></label><br>
    <label>country: <input type="text" name="country" required></label><br>
    <label>emailID: <input type="email" name="email" required></label><br>

    <label>Password: <input type="password" name="password" required></label><br>
    <label>confirm Password: <input type="password" name="cpassword" required></label><br>
    <button type="submit">Register</button>
</form>
<p.
Already have an account?
<br>
<a href="login.php">click hear</a>
</p>
</main>

</body>
</html>
