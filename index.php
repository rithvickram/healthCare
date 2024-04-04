<DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0">
<title>
Healthcare: Health is important
</title>
<link rel="stylesheet" href="style1.css">
</head>
<body>
<header>
<a href="index.php"> Healthcare</a>
</header>
<nav class="nav-bar" id="navbar">
<a href="index.php">home</a>
<br>
<a href="login.php">login as user</a>
<br>
<a href="login2.php">login as hospital</a>
<br>
<a href="register.php">register as a user</a>
<br>
<a href="register2.php">register a hospital</a>
<br>
<a href="#" onclick="showAbout()">about</a>
<br>
<a href="#" onclick="showContact()">contact</a>
</nav>
<main class="main">
<section id="main_section">
<h1> Healthcare</h1>
<p>
Health is very essential for everyone in the world.
<br>
We at healthcare allow you to save your time and choose your hospital based on your preferences
<br>
You can book an appointment in the hospital of your choice.
<br>
Our primary audience are working people who have lesser time with compare to others. That is to Help them have good health Along with saving their time which can be used in other efficient works
</p>
</section>
<section id="about" style="display: none">
<h2>about us</h2>
<p>
we are b.tech students at NIT andhra pradesh.
<br>
my self ram my team mate is amar.
</p>
</section>
<section id="contact" style="display: none">
<h2>contact us</h2>
<p>
ram:
<br>
phone: 7730857936
<br>
email: rithvickram2003@outlook.com
<br>
amar:
<br>
phone: 7085939044
<br>
email: 421261@student.nitandhra.ac.in
</p>
</main>
<footer class="footer">
<a href="#" onclick="showAbout()">about</a>
<br>
<a href="#" onclick="showContact()">contact</a>
<br>
<p >
Designed and developed in March 2024.
<br>
by ram and amar.
</p>
</footer>
</body>
<script>
function showAbout() {
document.getElementById("about").style.display = "block";
document.getElementById("contact").style.display = "none";
document.getElementById("navbar").style.display = "none";
document.getElementById("main_section").style.display = "none";
}
function showContact() {
document.getElementById("about").style.display = "none";
document.getElementById("contact").style.display = "block";
document.getElementById("navbar").style.display = "none";
document.getElementById("main_section").style.display = "none";
}
</script>

</html>