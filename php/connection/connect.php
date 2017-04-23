<?php

include "constants.php";
try {
    $db = new PDO(
      "mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $ex) {
    print "ERROR: " . $ex->getMessage() . "<br/>";
    die();
}

?>
