<?php

include "constants.php";
header('Content-Type: text/html; charset=utf-8');
try {
    $db = new PDO(
      "mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $ex) {
    print "ERROR: " . $ex->getMessage() . "<br/>";
    die();
}

?>
