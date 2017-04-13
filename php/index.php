<?php
session_start();

$paths = array(
    "^$"                => "home",
    "^about\/?.*"       => "about",
    "^quizzes\/?.*"     => "quizzes",
    "^register\/?.*"    => "register",
    "^login\/?.*"       => "login",
    "^register\/?.*"    => "register",
    "^logout\/?.*"      => "logout",
    "^statistics\/?.*"  => "statistics",
    "^.*"               => "home"
);

$sites = array(
    "home"        => array("title" => "Home",        "component" => "home"),
    "quizzes"     => array("title" => "Quizzes",     "component" => "quizzes"),
    "register"    => array("title" => "Register",    "component" => "register"),
    "login"       => array("title" => "Login",       "component" => "login"),
    "register"    => array("title" => "Register",    "component" => "register"),
    "logout"      => array("title" => "Logout",      "component" => "logout"),
    "statistics"  => array("title" => "Statistics",  "component" => "statistics"),
    "about"       => array("title" => "About",       "component" => "about")
);

$site = $sites["home"];

foreach ($paths as $path=>$site_obj) {
    if (preg_match("/$path/", $_GET["uri"])) {
        $site = $sites[$site_obj];
        break;
    }
}

$header_links = array(
    "quizzes" => "quizzes",
    "statistics" => "statistics",
    "about" => "about"
);

// Get the connection saved in the $db variable.
include "connection/connect.php";

if (!isset($_SESSION["username"]) && !preg_match("/^login$|^register$/", $site["component"])) {
    header("location: /login");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$site["title"]?> | WebQuiz</title>
    </head>
    <body>
        <div class="header">
            <div class="header_left">
                <a href="/"><h1>WebQuiz</h1></a>
            </div>
            <div class="header_right">
                <?php foreach ($header_links as $link=>$name) { ?>
                <a href="<?=$link?>" class="link<?php if ($site["component"] === $link) { echo " active"; } ?>"><?=$name?></a>
                <?php } ?>
                <?php if (!preg_match("/^login$|^register$/", $site["component"])) { ?>
                <a href="/logout" class="link">logout</a>
                <?php } ?>
            </div>
        </div>
        <div class="container">
            <?php include "pages/$site[component].php"; ?>
        </div>
    </body>
</html>
