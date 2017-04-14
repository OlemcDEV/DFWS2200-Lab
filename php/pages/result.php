<?php
$stmt = $db->prepare("SELECT DISTINCT * FROM quiz WHERE id=:id");
$stmt->bindValue(":id", $args[1], PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() === 0) {
  echo "Could not find any quiz matching id = $args[1]";
} else {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $quiz = $rows[0];

    $stmt = $db->query("SELECT * FROM question WHERE quiz_id=$quiz[id]");
    $count = $stmt->rowCount();

    $questions = $_SESSION["questions"];
    $correct = $_SESSION["correct"];

    // Set the session variables back to start as we are finished
    $_SESSION["questions"] = $stmt->fetchAll(); // The questions in correct order
    $_SESSION["index"] = 0; // The current question
    $_SESSION["correct"] = array(); // Showing which answer is correct from user
    ?>

    <h1>Quiz: <?=$quiz["name"]?></h1>
    <p>Description: <?=$quiz["description"]?></p>

    <div><?="Questions: $count";?><div>

    <h2>Your result:</h2>
    <p><b>Correct:</b> <?=count($correct)?> / <?=count($questions)?> = <?=floor(count($correct)/count($questions)*100)?>%</p>

    <h5>You failed at:</h5>
    <ul>
        <?php foreach ($questions as $question) { if (!in_array($question["id"], $correct)) { ?>
        <li><?=$question["question"]?></li>
        <?php } } ?>
    </ul>

    <br />
    <a href="/quiz/<?=$quiz["id"]?>/play"><button>Play again!</button></a>
<?php } ?>
