<?php
    include("mysql.php");

    $sql = "SELECT (select qo_order from question_order  where qo_quid = qu_id) as qo_order,qu_question,qu_answer FROM question ORDER BY qo_order";

    $query = $conn->query($sql);
    $quertsion = $query->fetchAll(PDO::FETCH_ASSOC);
    
?>