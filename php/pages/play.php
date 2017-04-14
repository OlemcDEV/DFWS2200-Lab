<?php
// Checking if the sessions variables where set
if (!isset($_SESSION["questions"]) || !isset($_SESSION["index"]) || !isset($_SESSION["correct"])) {
    header("location: /quiz/$args[1]");
}

$questions = $_SESSION["questions"];
$index = $_SESSION["index"];

// Check if user has posted an answer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Submit"])) {

    // Getting the quiz info from DB
    $stmt = $db->prepare("SELECT DISTINCT id, answer FROM question WHERE id=:id");
    $stmt->bindValue(":id", $questions[$index]["id"], PDO::PARAM_STR);
    $stmt->execute();
    $question = $stmt->fetch();

    // Check if answer is correct
    if (isset($_POST["option"]) && $_POST["option"] == $question["answer"]) {
        if (!in_array($question["id"], $_SESSION["correct"])) {
            array_push($_SESSION["correct"], $question["id"]);
        }
    }

    // Redirect to the new page with GET as we do not want the user to submit again with refresh
    // We also need to change session vars before leaving
    $_SESSION["index"]++;
    header("location: /quiz/$args[1]/play");
}

// Getting the quiz info from DB
$stmt = $db->prepare("SELECT DISTINCT * FROM quiz WHERE id=:id");
$stmt->bindValue(":id", $args[1], PDO::PARAM_STR);
$stmt->execute();

// Gixing feedback if the quiz exists or not
if ($stmt->rowCount() === 0) {
  echo "Could not find any quiz matching id = $args[1]";
} else {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $quiz = $rows[0];
    $question = $questions[$index];
    ?>

    Correct: <?=count($_SESSION["correct"])?> / <?=count($questions)?>

    <h1>Question: <?=$question["question"]?></h1>
    <div>
        <form method="post">
            <input id="option1" name="option" type="radio" value="1" required /><label for="option1"><?=$question["option1"]?></label>
            <input id="option2" name="option" type="radio" value="2" required /><label for="option2"><?=$question["option2"]?></label>
            <input id="option3" name="option" type="radio" value="3" required /><label for="option3"><?=$question["option3"]?></label>
            <input type="submit" name="Submit" value="Submit" />
        </form>
    </div>
<?php } ?>
