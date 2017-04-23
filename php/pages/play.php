<?php
// Checking if the sessions variables where set
if (!isset($_SESSION["questions"]) && !isset($_SESSION["index"]) && !isset($_SESSION["correct"])) {
    header("location: /quiz/$args[1]");
}

$questions = $_SESSION["questions"];
$index = $_SESSION["index"];

// Check if user has posted an answer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["option"])) {

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
    // We also need to change session vars and check if the quiz is finished before leaving
    $_SESSION["index"]++;
    if ($_SESSION["index"] >= count($questions)) {
        header("location: /quiz/$args[1]/result");
    } else {
        header("location: /quiz/$args[1]/play");
    }
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
    $count = count($questions);
    ?>

    Correct: <?=count($_SESSION["correct"])?> / <?=$count?>
    <svg height="16px" viewBox="0 0 100 10">
        <?php for ($i = 0; $i < $index; $i++) { ?>
        <rect x="<?=$i*100/$count?>" y="0" width="<?=100/$count?>" height="14" fill="<?=in_array($questions[$i]["id"], $_SESSION["correct"]) ? "lime" : "red"?>" />
        <?php } ?>
    </svg>

    <h4><?=$question["question"]?></h4>
    <div id="options">
        <form method="post">
            <em>
            <button type="submit" name="option" value="1"><?=$question["option1"]?></button>
            <button type="submit" name="option" value="2"><?=$question["option2"]?></button>
            <button type="submit" name="option" value="3"><?=$question["option3"]?></button>
            </em>
        </form>
    </div>
<?php } ?>
