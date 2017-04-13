<?php

$paths = array(
    "^$" => "home",
    "^about\/?.*" => "about",
    "^quizzes\/?.*" => "quizzes",
    "^register\/?.*" => "register",
    "^signuplogin\/?.*" => "signuplogin",
    "^statistics\/?.*" => "statistics",
    "^.*" => "home"
);

$sites = array(
    "home" => array("title" => "Home", "component" => "home"),
    "quizzes" => array("title" => "Quizzes", "component" => "quizzes"),
    "register" => array("title" => "Register", "component" => "register"),
    "signuplogin" => array("title" => "Sign Up", "component" => "signuplogin"),
    "statistics" => array("title" => "Statistics", "component" => "statistics"),
    "about" => array("title" => "About", "component" => "about")
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
    "about" => "about",
    "signuplogin" => "sign up/log in"
);

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
                <a href="index.php"><h1>WebQuiz</h1></a>
            </div>
            <div class="header_right">
                <?php foreach ($header_links as $link=>$name) { ?>
                <a href="<?=$link?>" class="link<?php if ($link === $site["component"]) { echo " active"; } ?>"><?=$name?></a>
                <?php } ?>
            </div>
        </div>
        <div class="container">
            <?php include "$site[component].php"; ?>
        </div>
    </body>
</html>
