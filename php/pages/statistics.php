<?php
$stmt = $db->query("SELECT *, AVG(correct_answers) AS average FROM result r, quiz q WHERE r.quiz_id=q.id GROUP BY quiz_id ORDER BY average");
?>
<h1>Average Score</h1>
<div id="table-wrapper">
    <div id="table-scroll">
    <table>
        <tr>
            <th>Quiz name</th>
            <th>Results</th>
            <th>Correct</th>
        </tr>
        <?php while ($row = $stmt->fetch()) { ?>
        <tr>
            <td><a href="/quiz/<?=$row["quiz_id"]?>"><?=$row["name"]?></a></td>
            <td><?=floor($row["average"]*100 / $row["question_count"])?>%</td>
            <td><?=$row["question_count"]?></td>
        </tr>
        <?php } ?>
    </table>
    <?php
    $quizname_query = $db->query("SELECT * FROM result r, quiz q WHERE r.quiz_id=q.id");
    $username_query = $db->query("SELECT * FROM user u, result r WHERE r.user_id=u.id");
    $date_query = $db->query("SELECT finished FROM result");

    ?>
    </div>
</div>

<h1>Log</h1>
<div id="table-wrapper">
    <div id="table-scroll">
        <table>
            <tr>
                <th>Date</th>
                <th>Username</th>
                <th>Quiz name</th>
                <th>Results</th>
                <th>Questions</th>
            </tr>
            <!--Shows username and quiz name for each result id-->
            <?php while ( ($col1 = $username_query->fetch()) && ($col2 = $quizname_query->fetch()) && ($col0 = $date_query->fetch()) ) { ?>
            <tr>
                <td><?=$col0["finished"]?></td>
                <td><?=$col1["username"]?></td>
                <td><a href="/quiz/<?=$row["quiz_id"]?>"><?=$col2["name"]?></a></td>
                <td><?=$col2["correct_answers"]?></td>
                <td><?=$col2["question_count"]?></td>
            <?php } ?>
        </table>
    </div>
</div>
