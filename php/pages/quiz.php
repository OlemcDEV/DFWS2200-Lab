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

    // Setting the session vars to init and play the quiz
    $_SESSION["questions"] = $stmt->fetchAll(); // The questions in correct order
    $_SESSION["index"] = 0; // The current question
    $_SESSION["correct"] = array(); // Showing which answer is correct from user
    ?>

    <h1>Quiz: <?=$quiz["name"]?></h1>
    <p>Description: <?=$quiz["description"]?></p>

    <div><?="Questions: $count";?><div>

    <?php if ($count > 0) { ?>
    <br />
    <a href="/quiz/<?=$quiz["id"]?>/play"><button>Start quiz</button></a>
    <?php } ?>
<?php } ?>
