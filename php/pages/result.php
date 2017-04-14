<?php
$stmt = $db->prepare("SELECT DISTINCT * FROM quiz WHERE id=:id");
$stmt->bindValue(":id", $args[1], PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() === 0) {
  echo "Could not find any quiz matching id = $args[1]";
} else {
    $quiz = $stmt->fetch();

    $stmt = $db->query("SELECT * FROM question WHERE quiz_id=$quiz[id]");
    $count = $stmt->rowCount();

    $questions = $_SESSION["questions"];
    $correct = $_SESSION["correct"];

    // Insert result into the DB
    $stmt = $db->prepare("INSERT INTO result (finished, question_count, correct_answers, quiz_id, user_id) VALUES (NOW(), :tot, :corr, :qid, :uid)");

    // Declearing types and adding values for the insert
    $stmt->bindValue(':tot', $count, PDO::PARAM_INT);
    $stmt->bindValue(':corr', count($correct), PDO::PARAM_INT);
    $stmt->bindValue(':qid', $args[1], PDO::PARAM_INT);
    $stmt->bindValue(':uid', $_SESSION["userid"], PDO::PARAM_INT);

    // Execute the query in the database with the inserted values
    $stmt->execute();

    // Set the session variables back to start as we are finished
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
