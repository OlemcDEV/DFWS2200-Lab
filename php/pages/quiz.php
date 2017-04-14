<?php
$stmt = $db->prepare("SELECT DISTINCT * FROM quiz WHERE id=:id");
$stmt->bindValue(":id", $args[1], PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() === 0) {
  echo "Could not find any quiz matching id = $args[1]";
} else {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $quiz = $rows[0]; ?>

    <h1>Quiz: <?=$quiz["name"]?></h1>
    <p>Description: <?=$quiz["description"]?></p>

    <div>
        <?php
          $stmt = $db->query("SELECT COUNT(*) AS count FROM question WHERE quiz_id=$quiz[id]");
          $count = $stmt->fetch()["count"];
          echo "Questions: $count";
        ?>
    <div>
<?php } ?>
