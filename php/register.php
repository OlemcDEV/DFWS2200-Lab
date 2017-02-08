<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
    </head>
    <body>
        <div class="header">
            <div class="header_left">
                <a href="index.php"><h1>WebQuiz</h1></a>
            </div>
            <div class="header_right">
                <a href="quizzes.php">quizzes</a>
                <a href="statistics.php">statistics</a>
                <a href="about.php">about</a>
                <a href="signuplogin.php">sign up/log in</a>
            </div>
        </div>
        <div class="container">
            <?php
            // Variables
            $input_email = $_POST["email"];
            $input_username = $_POST["username"];
            $input_password = $_POST["password"];
            /* Attempt MySQL server connection. Assuming you are running MySQL
            server with default setting (user 'root' with no password) */
            $link = mysqli_connect("localhost", "root", "", "webquiz");

            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            //Announce email and username
            echo "Your email is: $input_email and your username is $input_username";

            // Attempt insert query execution
            $sql = "INSERT INTO user (email, username, password) VALUES ('$input_email','$input_username','$input_password')";
            if(mysqli_query($link, $sql)){
                echo "Records added successfully.";
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }

            // Close connection
            mysqli_close($link);
            ?>
        </div>
    </body>
</html>