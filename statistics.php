<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>Statistics</title>
    </head>
    <body>
        <div class="header">
            <div class="header_left">
                <a href="index.html"><h1>WebQuiz</h1></a>
            </div>
            <div class="header_right">
                <a href="quiz.php">quiz</a>
                <a href="statistics.php">statistics</a>
                <a href="about.html">about</a>
                <a href="signup.php">sign up</a>
                <a href="login.php">login</a>
            </div>
        </div>
        <div class="container">
            <?php
            include "constants.php";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM webquiz.questions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Question.nr: " . $row["questionID"]. " - Q: " . $row["question"]. " A: " . $row["answer"]. "<br>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
        <div class="footer">
            <div class="footerText">
            <p>Made by Ole Magnus Carlstedt</p>
            </div>
        </div>
    </body>
</html>