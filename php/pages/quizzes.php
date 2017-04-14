<h1>Quizzes:</h1>

<div>
<?php
$stmt = $db->query("SELECT * FROM quiz");
while ($row = $stmt->fetch()) { ?>
    <h2>
        <a href="/quiz/<?=$row["id"]?>"><?=$row["name"]?></a> - <?=$row["description"]?>
    </h2>
<?php } ?>
<div>
