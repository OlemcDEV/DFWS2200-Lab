<?php
// Define variables and set them to empty values
$usernameErr = $passwordErr = "";
$username = $password = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);

        // check if name only contains letters and whitespace
        if (!(ctype_alnum($username))) {
            $usernameErr = "Only letters and numbers allowed";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);

        if (!ctype_alnum($password)) {
            $passwordErr = "Only letters and numbers allowed!";
        }
    }

    // Submit was clicked, try to insert data to database
    if (isset($_POST["Submit"]) && !$usernameErr && !$passwordErr) {
        // Using prepared statement to safely insert user data into tables
        $stmt = $db->prepare("SELECT * FROM user WHERE username=:username AND password=:password");

        // Declearing types and adding values for the statement
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', "$2$".md5($password + "webquiz"), PDO::PARAM_STR);

        // Execute the query in the database with the inserted values
        $stmt->execute();

        // If the search has a row, then start session and create session variables
        if ($stmt->rowCount() > 0) {

            // Set the session variable for the user
            $_SESSION["userid"] = $insertId;
            $_SESSION["username"] = $username;

            // Change route as login was success
            header("location: /");
        } else {
            $passwordErr = "Username or password does not match...";
        }
    }
}

?>

<div class="register">
    <form id="register" action="/login" method="post">
        <fieldset>
            <legend>Login</legend>
            <label for="username">Username:</label>
            <input type="text" placeholder="Thomas"
                name="username" id="username" maxlength="45" value="<?=$username?>" />
            <span class="error"><?=$usernameErr?></span>
            <br /><br />

            <label for="password">Password:</label>
            <input type="password" placeholder="Thomas123"
                name="password" id="password" maxlength="45" value="<?=$password?>" />
            <span class="error"><?=$passwordErr?></span>
            <br /><br />

            <input type="submit" name="Submit" value="Submit" />
        </fieldset>
    </form>

    <a href="/register">Not a user yet? Register here!</a>
</div>
