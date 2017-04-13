<?php
// Variables
$input_email = $_POST["email"];
$input_username = $_POST["username"];
$input_password = $_POST["password"];

//Announce email and username
echo "Your email is: $input_email and your username is $input_username";

// Attempt insert query execution
$stmt = $db->prepare("INSERT INTO user (email, username, password) VALUES (:email, :username, :password)");

$stmt->bindValue(':email', $input_email, PDO::PARAM_STR);
$stmt->bindValue(':username', $input_username, PDO::PARAM_STR);
$stmt->bindValue(':password', "$2$".md5($input_password + "webquiz"), PDO::PARAM_STR);

$stmt->execute();

$insertId = $db->lastInsertId();

?>
