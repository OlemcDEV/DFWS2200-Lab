<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Sign up</title>
</head>
<body>
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
            <form id='register' action='register.php' method='post'
                  accept-charset='UTF-8'>
                <fieldset >
                    <legend>Register</legend>
                    <label for='name' >Your Full Name*: </label>
                    <input type='text' name='name' id='name' maxlength="45" /><br><br>

                    <label for='email' >Email Address*:</label>
                    <input type='text' name='email' id='email' maxlength="45" /><br><br>

                    <label for='username' >UserName*:</label>
                    <input type='text' name='username' id='username' maxlength="45" /><br><br>

                    <label for='password' >Password*:</label>
                    <input type='password' name='password' id='password' maxlength="45" />
                    <input type='submit' name='Submit' value='Submit' />
                </fieldset>
            </form>
		</div>
	<div class="footer">
		<div class="footerText">
		<p>Made by Ole Magnus Carlstedt</p>
		</div>
	</div>
</body>
</html>