
<?php
// define variables and set to empty values
$emailErr = $usernameErr = $passwordErr = $genderErr = "";
$email = $username = $password = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

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

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
}

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
/* Submit was clicked, try to insert data to database */
if(isset($_POST['Submit'])) {
    //connecting
    $link = mysqli_connect("localhost", "140438", "it", "140438");
    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo "could not connect";
    }
    else {
        echo "connected";
        //Insert data
        $sql = "INSERT INTO Weser (email, username, password)
        VALUES ($email, $username, $password)";
    }
}
?>

<div class="register">
    <form id='register' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'
            accept-charset='UTF-8'>
        <fieldset >
            <legend>Register</legend>
            <label for='email' >Email Address*:</label>
            <input type='email' placeholder="Thomas@gmail.com"
                    name='email' id='email' maxlength="45" value="<?php echo $email;?>"/>
            <span class="error"> <?php echo $emailErr;?></span>
            <br><br>

            <label for='username' >Username*:</label>
            <input type='text' placeholder="Thomas"
                    name='username' id='username' maxlength="45" value="<?php echo $username;?>"/>
            <span class="error"> <?php echo $usernameErr;?></span>
            <br><br>

            <label for='password' >Password*:</label>
            <input type='password' placeholder="Thomas123"
                    name='password' id='password' maxlength="45" value="<?php echo $password;?>"/>
            <span class="error"> <?php echo $passwordErr;?></span>
            <br><br>

            <label for="gender" >Gender*:</label>
            <br>
            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female")
                echo "checked";?> value="female">Female
            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male")
                echo "checked";?> value="male">Male
            <br>
            <span class="error"> <?php echo $genderErr;?></span>
            <br><br>
            <input type='submit' name='Submit' value='Submit' />
        </fieldset>
    </form>
    <?php
    echo "<h2>Your Input:</h2>";
    echo $email;
    echo "<br>";
    echo $username;
    echo "<br>";
    echo $gender;
    echo "<br>";
    ?>
</div>