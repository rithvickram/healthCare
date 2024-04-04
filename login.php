<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $user_password = $_POST['password']; // Rename the variable to avoid overwriting

    // Database connection (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $db_password = "nFE_04jI7_4iU8v."; // Rename the variable
    $dbname = "health_care";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname); // Use the renamed variable here

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to retrieve user from database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($user_password, $row['password'])) { // Use the renamed variable here
            echo "Login successful!";
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $email;

            header("Location: dashbord1.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "no account found. or account is not created!";
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>user Login</title>
<link rel="stylesheet" href="style3.css">
</head>
<body>
<nav class="navbar">
<a href="index.php">home</a>
</nav>
<main>

<h1>Login</h1>
<br>
<form id="loginForm" class="form" action="login.php" method="post">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>
<p>
forgot password:
<a href="change.php">forgot password</a>
<br>
don't have an account?
<br>
<a href="register.php">click hear</a>
</p>
</main>

</body>
</html>
