<?php
$stmt = $db->query("SELECT result.id AS rid, result.finished AS rf, result.question_count AS rqc, result.correct_answers AS rca, user.username AS uu, quiz.name AS qn 
                    FROM result, user, quiz 
                    WHERE result.user_id=user.id 
                    AND quiz.id = result.quiz_id 
                    ORDER BY result.id");
?>
<h1>Log</h1>
<div id="table-wrapper">
    <div id="table-scroll">
        <table>
            <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>QUIZ NAME</th>
                <th>QUESTION</th>
                <th>CORRECT</th>
                <th>USERNAME</th>
            </tr>
            <!--Shows username and quiz name for each result id-->
            <?php while  ($row = $stmt->fetch()) { ?>
            <tr>
                <td><?=$row["rid"]?></td>
                <td><?=$row["rf"]?></td>
                <td><a href="/quiz/<?=$row["quiz_id"]?>"><?=$row["qn"]?></a></td>
                <td><?=$row["rqc"]?></td>
                <td><?=$row["rca"]?></td>
                <td><?=$row["uu"]?></td>
            <?php } ?>
        </table>
    </div>
</div>