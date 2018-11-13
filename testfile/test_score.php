<?php
    include("mysql.php");

    $ts_no="";$ts_name="";$ts_grade="";$success=false;
    if(isset($_POST['isStatus']) && $_POST['isStatus']=='update'){
        $ts_no =  $_POST['ts_no'];
        $ts_no = explode(",", $ts_no);

        $ts_name =  $_POST['ts_name'];
        $ts_name = explode(",", $ts_name);

        $ts_grade =  $_POST['ts_grade'];
        $ts_grade = explode(",", $ts_grade);

        // $sleep = sleep(3);

        if(count($ts_no)>0){
            for($i=0 ; $i<count($ts_no) ; $i++) {
                $no = $ts_no[$i];
                $name = $ts_name[$i];
                $grade = $ts_grade[$i];

                $sql = "UPDATE test_score SET ts_name = '$name',ts_grade = $grade WHERE ts_no = '$no'";
                $conn->exec($sql);
                $success = true;
            }
        }

        if($success==true){
            $array = array('success' => true);
            echo json_encode($array);
        }
    }else{
        $sql = "SELECT * FROM test_score";
        $query = $conn->query($sql);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
    }

?>