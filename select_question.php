<?php
    include("mysql.php");

    $question="";$answer="";$order="";$last_order="";$this_index="";$last_index="";$heading="";
    if(isset($_POST['question']) && isset($_POST['answer']) && $_POST['question']!="" && $_POST['answer']!=""){
        $question =  $_POST['question'];
        $answer =  $_POST['answer'];
    }

    if(isset($_POST['order']) && $_POST['order']!=""){
        $order =  $_POST['order'];
        $order = explode(",", $order);
    }

    if(isset($_POST['last_order']) && $_POST['last_order']!=""){
        $last_order =  $_POST['last_order'];
    }

    if(isset($_POST['this_index']) && $_POST['this_index']!="" && isset($_POST['last_index']) && $_POST['last_index']!=""){
        $this_index = $_POST['this_index'];
        $last_index = $_POST['last_index'];
    }

    if(isset($_POST['heading']) && $_POST['heading']!=""){
        $heading =  $_POST['heading'];
    }
    
    $success = false;
    $isStatus = "";
    if(isset($_POST['isStatus'])){
        $isStatus = $_POST['isStatus'];
    }
    if($isStatus=="insert" && $question!="" && $answer!=""){
        $sql="INSERT INTO question (qu_question, qu_answer) VALUES ('$question','$answer')";
        $conn->exec($sql);

        $sql="SELECT max(qo_order) as max_order FROM question_order";
        $query = $conn->query($sql);
        $max = $query->fetch(PDO::FETCH_ASSOC);
        $max_order = $max['max_order'];
        $max_order++;

        $sql="SELECT qu_id FROM question WHERE qu_question IN ('$question') AND qu_answer IN ('$answer')";
        $query = $conn->query($sql);
        $qu_data = $query->fetch(PDO::FETCH_ASSOC);
        $id = $qu_data['qu_id'];
        
        if($max_order>0 && $id>0){
            $sql="INSERT INTO question_order (qo_order,qo_quid) VALUES ($max_order,$id)";
            $conn->exec($sql);
            $success = true;
        }
    }else if($isStatus=="update" && $question!="" && $answer!="" && $order!=""){
        if($question!="" && $answer!="" && $order!=""){
            $qu_id = $order[0];
            $sql = "UPDATE question SET qu_question = '$question',qu_answer = '$answer' WHERE qu_id = $qu_id";
            $conn->exec($sql);
            $success = true;
        }      
    }else if($isStatus=="order" && $order!="" && $last_order!="" && $this_index!="" && $last_index!=""){
        if(count($order)==1){
            $orders = $order[0];
            $sql = "UPDATE question_order SET qo_order = $last_index WHERE qo_quid = $orders";
            $conn->exec($sql);

            $sql = "UPDATE question_order SET qo_order = $this_index WHERE qo_quid = $last_order";
            $conn->exec($sql);
            $success = true;
        }
    }else if($isStatus=="delete" && $order!=""){
        if(count($order)>0){
            for($i=0 ; $i<count($order) ; $i++) {
                $orders = $order[$i];
                $sql = "DELETE FROM question WHERE qu_id = $orders";
                $conn->exec($sql);

                $sql = "DELETE FROM question_order WHERE qo_quid = $orders";
                $conn->exec($sql);
                $success = true;
            }
        }
    }else if($isStatus=="all_update" && $heading!=""){
        // var_dump($_POST['item']);
    }
    else{
        $sql = "SELECT (select qo_order from question_order  where qo_quid = qu_id) as qo_order,qu_id,qu_question,qu_answer FROM question ";

        if(isset($_POST['qu_id'])){
            $sql = $sql . " WHERE qu_id =" .$_POST['qu_id'];
        }

        $sql = $sql . " ORDER BY qo_order";

        $query = $conn->query($sql);
        $quertsion = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    if($success==true){
        echo json_encode(array('success' => true));
    }
?>