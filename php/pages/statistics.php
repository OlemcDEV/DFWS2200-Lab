<?php
$stmt = $db->query("SELECT *, AVG(correct_answers) AS average FROM result r, quiz q WHERE r.quiz_id=q.id GROUP BY quiz_id ORDER BY average");
?>
<table>
    <tr>
        <th>Name</th>
        <th>Results</th>
        <th>Questions</th>
    </tr>
    <?php while ($row = $stmt->fetch()) { ?>
    <tr>
        <td><a href="/quiz/<?=$row["quiz_id"]?>"><?=$row["name"]?></a></td>
        <td><?=floor($row["average"]*100 / $row["question_count"])?>%</td>
        <td><?=$row["question_count"]?></td>
    </tr>
    <?php } ?>
</table>
