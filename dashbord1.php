<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
$city = $row['city'];
$state = $row['state'];
$country = $row['country'];
$user_id = $row['user_id'];
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
<a href="#" onclick="showAppointment()">book an appointment</a>
<br>
<a href="#" onclick="showAppointments()">view your appointments</a>
<br>
<a href="#" onclick="showReview()">write a review</a>
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

<section id="appointment" style="display: none;">
<h2>Book an Appointment</h2>
<form action="book_appointment.php" method="post">
  <label for="hospital">Choose a hospital:</label><br>
  <select id="hospital" name="hospital">
<option value="">select any hospital from the list</option>
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
        $sql = "SELECT * FROM hospitals where city = '$city' and state = '$state' and country = '$country'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['hospital_id'] . '">' . $row['hospital_name'] . '</option>';
            }
        } else {
            echo '<option value="">No hospitals found</option>';
        }

        mysqli_close($conn);
        ?>
  </select><br>
  <label for="date">Preferred Date:</label><br>
  <input type="date" id="date" name="date" required><br>
  <label for="time">Preferred Time:</label><br>
  <input type="time" id="time" name="time" required><br><br>
  <input type="submit" value="Submit">
</form>
</section>

<section id="appointments" style="display: none;">
    <h2>Your Appointments</h2>
    <table>
        <tr>
            <th>Hospital</th>
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
        $query = "SELECT a.*, h.hospital_name FROM appointments a JOIN hospitals h ON a.hospital_id = h.hospital_id WHERE a.user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['hospital_name'] . "</td>";
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
<h2>Write a Review</h2>

<form action="review.php" method="post">
<label for="review_text">Write your review:</label><br>
<textarea id="review_text" name="review_text" rows="4" cols="50"></textarea><br><br>
<label for="rating">your rating: </label>
<br>
<select id="rating" name="rating">
<option value="">select one</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
<br>
  <input type="submit" value="Submit">
</form>
</section>
</main>

<script>
function showHome() {
  document.getElementById("home").style.display = "block";
  document.getElementById("appointment").style.display = "none";
  document.getElementById("appointments").style.display = "none";
  document.getElementById("review").style.display = "none";
}

function showAppointment() {
  document.getElementById("home").style.display = "none";
  document.getElementById("appointment").style.display = "block";
  document.getElementById("appointments").style.display = "none";
  document.getElementById("review").style.display = "none";
}

function showAppointments() {
  document.getElementById("home").style.display = "none";
  document.getElementById("appointment").style.display = "none";
  document.getElementById("appointments").style.display = "block";
  document.getElementById("review").style.display = "none";
}

function showReview() {
  document.getElementById("home").style.display = "none";
  document.getElementById("appointment").style.display = "none";
  document.getElementById("appointments").style.display = "none";
  document.getElementById("review").style.display = "block";
}
showHome();
</script>
</body>
</html>
