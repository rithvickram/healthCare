<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login2.php");
    exit();
}

$email = $_SESSION['username'];
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
$sql = "SELECT * FROM hospitals WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    $name = $row['hospital_name'];
$city = $row['city'];
$state = $row['state'];
$country = $row['country'];
$hospital_id = $row['hospital_id'];
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Healthcare: Health is important</title>
<link rel="stylesheet" href="style4.css">
</head>
<body>
<header class="header">
<a href="index.php"> healthcare</a>
</header>
<nav class="navbar">
<a href="#" onclick="showHome()">home</a>
<br>
<a href="#" onclick="showAppointments()">view appointments</a>
<br>
<a href="#" onclick="showReview()">view a reviews</a>
<br>
<a href="logout.php">logout</a>
<br>
<a href="change.php">change password</a>
</nav>
<main class="main">
<section id="home">
<h1>Welcome to Our Healthcare Portal</h1>

<p>
<?php
echo "hello  $name";
?>
<br>

This is the homepage for our healthcare services. We offer a range of medical services to ensure your well-being.</p>
</section>

<section id="appointments" style="display: none;">
    <h2>Appointments</h2>
    <table>
        <tr>
<th>appointment id</th>
            <th>Patient</th>
<th>phone</th>
<th>email</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
        $connection;
        $username = 'root';
        $password = 'nFE_04jI7_4iU8v.';
        $host = 'localhost';
        $db = 'health_care';

        $conn = mysqli_connect($host, $username, $password, $db);
        if ($conn) {
            $connection = true;
        } else {
            die("Error" . mysqli_connect_error());
        }
        // Fetch appointments for the logged-in user
        $query = "SELECT a.*, u.* FROM appointments a JOIN users u ON a.user_id = u.user_id WHERE a.hospital_id = '$hospital_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['appointment_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['time'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No appointments found</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</section>
<section id="review" style="display: none;">
    <h2>View Reviews</h2>
    <table>
        <tr>
            <th>Patient</th>
            <th>Review</th>
            <th>Rating</th>
        </tr>
        <?php
        $connection;
        $username = 'root';
        $password = 'nFE_04jI7_4iU8v.';
        $host = 'localhost';
        $db = 'health_care';

        $conn = mysqli_connect($host, $username, $password, $db);
        if ($conn) {
            $connection = true;
        } else {
            die("Error" . mysqli_connect_error());
        }

        // Fetch reviews with patient's name
        $sql = "SELECT r.review, r.rating, u.name 
                FROM reviews r 
                JOIN users u ON r.user_id = u.user_id where r.hospital_id = '$hospital_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['review'] . "</td>";
                echo "<td>" . $row['rating'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No reviews found</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</section>

</main>

<script>
function showHome() {
  document.getElementById("home").style.display = "block";
  document.getElementById("appointments").style.display = "none";
  document.getElementById("review").style.display = "none";
}

function showAppointments() {
  document.getElementById("home").style.display = "none";
  document.getElementById("appointments").style.display = "block";
  document.getElementById("review").style.display = "none";
}

function showReview() {
  document.getElementById("home").style.display = "none";
  document.getElementById("appointments").style.display = "none";
  document.getElementById("review").style.display = "block";
}
showHome();
</script>
</body>
</html>
