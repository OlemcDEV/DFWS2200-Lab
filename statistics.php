<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Statistics</title>
</head>
<body>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
	?>
	<div class="header">
		<div class="header_left">
			<a href="index.html"><h1>WebQuiz</h1></a>
		</div>
		<div class="header_right">
			<p><a href="signup.php">Sign up</a></p>	
			<p><a href="quiz.php">Quiz</a></p>
			<p><a href="statistics.php">Statistics</a></p>
			<p><a href="about.html">ABOUT</a></p>
		</div>
	</div>
		<div class="container">
		<p>hei</p>
		</div>
	<div class="footer">
		<div class="footerText">
		<p>Made by Ole Magnus Carlstedt</p>
		</div>
	</div>
</body>
</html>