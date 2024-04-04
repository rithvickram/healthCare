<?PHP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST['email'];
$password = $_POST['new-password'];
$cpassword = $_POST['confirm-password'];
if($password == $cpassword) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

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

$sql1 = "select * from users where email = '$email'";
    $result_users = $conn->query($sql1);
        $sql2 = "SELECT * FROM hospitals WHERE email = '$email'";
        $result_hospitals = $conn->query($sql2);
        if ($result_users->num_rows > 0) {
            $sql_update1 = "UPDATE users SET password = '$hash' WHERE email = '$email'";
            if ($conn->query($sql_update1) === TRUE) {
                session_start();
                session_unset();
                session_destroy();
                header("location: index.php");
                exit;
            } else {
                echo "Error updating password.";
                header("location: index.php");
                exit;
            }
}
else if($result_hospitals->num_rows > 0) {
            $sql_update2 = "UPDATE hospitals SET password = '$hash' WHERE email = '$email'";
            if ($conn->query($sql_update2) === TRUE) {
                session_start();
                session_unset();
                session_destroy();
                header("location: index.php");
                exit;
            } else {
                echo "Error updating password.";
                header("location: index.php");
                exit;
            }
}
else {
            echo "Error: Email not found.";
}
}
else {
        echo "Error: Passwords do not match.";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form action="change.php" method="post">
            <label for="email">email:</label>
            <input type="email" id="email" name="email" required>
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required>
            <label for="confirm-password">Confirm New Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <input type="submit" value="Change Password">
        </form>
    </div>
</body>
</html>
