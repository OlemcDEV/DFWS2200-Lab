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
            <a href="signup.php">sign up</a>
            <a href="quiz.php">quiz</a>
            <a href="statistics.php">statistics</a>
            <a href="about.html">about</a>
		</div>
	</div>
		<div class="container">
            <div class="register">
            <form id='register' action='register.php' method='post'
                  accept-charset='UTF-8'>
                <fieldset >
                    <legend>Register</legend>
                    <label for='email' >Email Address*:</label>
                    <input type='email' placeholder="Thomas@gmail.com"
                           name='email' id='email' maxlength="45" /><br><br>

                    <label for='username' >UserName*:</label>
                    <input type='text' placeholder="Thomas"
                           name='username' id='username' maxlength="45" /><br><br>

                    <label for='password' >Password*:</label>
                    <input type='password' placeholder="Thomas123"
                           name='password' id='password' maxlength="45" />
                    <input type='submit' name='Submit' value='Submit' />
                </fieldset>
            </form>
            </div>
		</div>
	<div class="footer">
		<div class="footerText">
		<p>Made by Ole Magnus Carlstedt</p>
		</div>
	</div>
</body>
</html>