<?php
    include("mysql.php");

    $question="";$answer="";$order="";$last_order="";$qu_count=0;$qo_count=0;
    if(isset($_POST['question']) && isset($_POST['answer'])){
        $question =  $_POST['question'];
        $question = explode(",", $question);

        $answer =  $_POST['answer'];
        $answer = explode(",", $answer);

        $qu_count=count($question);
        $qo_count=count($order);
    }

    if(isset($_POST['order'])){
        $order =  $_POST['order'];
        $order = explode(",", $order);
    }

    if(isset($_POST['last_order'])){
        $last_order =  $_POST['last_order'];
        $last_order = explode(",", $last_order);
    }
        
    $success = false;
    if(isset($_POST['insert_quesion']) && $question!="" && $answer!="" && $order!="" && $qu_count!=0){
        if($qu_count>0 && $qu_count==count($answer)){
            $question_array = "";$answer_array = "";
            $sql="INSERT INTO question (qu_question, qu_answer) VALUES (";
            for($i=0 ; $i<$qu_count ; $i++) {
                $question_array = "'" . $question[$i] . "','";
                $answer_array = "'" . $answer[$i] . "','";
                $sql = $sql . "'" . $question[$i] . "','" .  $answer[$i] . "'),";
            }
            $question_array = substr($question_array,0,-1);
            $answer_array = substr($answer_array,0,-1);
            $sql = substr($sql,0,-1);
            // $conn->exec($sql);

            if($qo_count>0 && $question_array!="" && $answer_array!=""){
                $sql="SELECT qu_id FROM question WHERE qu_question IN ($question_array) AND qu_answer IN ($answer_array)";
                $query = $conn->query($sql);
                $qu_data = $query->fetchAll(PDO::FETCH_ASSOC);

                $sql="INSERT INTO question_order (qo_order,qo_quid) VALUES (";
                $j=0;
                foreach($qu_data as $key => $value){
                    $sql = $sql . $order[$j] ."," . $value['qu_id'] . "),";
                    $j++;
                }
                $sql = substr($sql,0,-1);
                // $conn->exec($sql);
                $success = true;
            }
        }
    }else if(isset($_POST['update_quesion']) && (($question!="" && $answer!="" && $order!="") || ($order!="" && $last_order!=""))){
        if($question!="" && $answer!="" && $order!=""){
            if($qu_count>0 && $qu_count==count($answer)){
                for($i=0 ; $i<$qu_count ; $i++) {
                    $questions = $question[$i];
                    $answers = $answer[$i];
                    $orders = $order[$i];
                    $sql = "UPDATE question SET qu_question = '$questions',qu_answer = '$answers' WHERE qu_id = $orders";
                    // $conn->exec($sql);
                    $success = true;
                }
            }
        }

        if($order!="" && $last_order!=""){
            if(count($order)>0 && count($order)==count($last_order)){
                for($i=0 ; $i<count($order) ; $i++) {
                    $lasts = $last_order[$i];
                    $orders = $order[$i];
                    $sql = "UPDATE question_order SET qo_order = '$lasts' WHERE qo_quid = $orders";
                    // $conn->exec($sql);
                    $success = true;
                }
            }

        }
    }else if(isset($_POST['delete_quesion']) && $order!=""){
        if(count($order)>0){
            for($i=0 ; $i<count($order) ; $i++) {
                $orders = $order[$i];
                $sql = "DELETE qu_question WHERE qu_id = $orders";
                // $conn->exec($sql);

                $sql = "DELETE qo_order WHERE qo_quid = $orders";
                // $conn->exec($sql);
                $success = true;
            }
        }
    }else{
        $sql = "SELECT (select qo_order from question_order  where qo_quid = qu_id) as qo_order,qu_question,qu_answer FROM question ORDER BY qo_order";

        $query = $conn->query($sql);
        $quertsion = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    if($success==true){
        echo "success";
    }
?>