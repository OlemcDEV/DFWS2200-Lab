<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>includexml</title>
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
    /*$xmlDoc = new DOMDocument();
    $xmlDoc->load("books.xml");

    print $xmlDoc->saveXML();*/

    $xml=simplexml_load_file("../xml/books.xml") or die("Error: Cannot create object");
    foreach($xml->children() as $books) {
        echo $books->title . ", ";
        echo $books->author . ", ";
        echo $books->year . ", ";
        echo $books->price . "<br>";
    }
    ?>
</div>
</body>
</html>