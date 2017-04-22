<?php
$quizname_query = $db->query("SELECT * FROM result r, quiz q WHERE r.quiz_id=q.id");
$username_query = $db->query("SELECT * FROM user u, result r WHERE r.user_id=u.id");
?>
<h1>Highscore</h1>
<h1>Log</h1>
<table>
    <tr>
        <th>Username</th>
        <th>Name of quiz</th>
        <th>Results</th>
        <th>Questions</th>
    </tr>
    <!--Shows username and quiz name for each result id-->
    <?php while ( ($col1 = $username_query->fetch()) && ($col2 = $quizname_query->fetch()) ) { ?>
    <tr>
        <td><?=$col1["username"]?></td>
        <td><a href="/quiz/<?=$row["quiz_id"]?>"><?=$col2["name"]?></a></td>
        <td><?=$col2["correct_answers"]?></td>
        <td><?=$col2["question_count"]?></td>
    <?php } ?>
</table>
