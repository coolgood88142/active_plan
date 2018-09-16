<?php 
    include("mysql.php");
    date_default_timezone_set('Asia/Taipei');
    $today = date ("Y-m-d");

    $pt_usid="";$pt_acid="";$pt_date="";
    $sql = "SELECT pt_usid,pt_acid,pt_date FROM plan_trip ";
    $query = $conn->query($sql);
    $update = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($update as $key => $value) {
        if(strtotime($today)>strtotime($value['pt_date'])){
            $pt_usid = $pt_usid . $value['pt_usid'] . ",";
            $pt_acid = $pt_acid . $value['pt_acid'] . ",";
            $pt_date = $pt_date . $value['pt_date'] . ",";
        }
    }

    
    $pt_usid = substr($pt_usid,0,-1);
    $pt_acid = substr($pt_acid,0,-1);
    $pt_date = substr($pt_date,0,-1);

    if($pt_usid!="" && $pt_acid!="" && $pt_date!=""){
        $pt_usid = substr($pt_usid,0,-1);
        $pt_acid = substr($pt_acid,0,-1);
        $pt_date = substr($pt_date,0,-1);

        $pt_usid = explode(",", $pt_usid);
        $pt_acid = explode(",", $pt_acid);
        $pt_date = explode(",", $pt_date);

        $count=count($pt_usid);
        
        for($i=0 ; $i<$count ; $i++){
            $usid = $pt_usid[$i];
            $acid = $pt_acid[$i];
            $date = $pt_date[$i];
            $sql = "UPDATE plan_trip SET pt_status = 2 WHERE pt_date = '$date' and pt_usid = $usid and pt_acid = $acid ";
            echo $sql;
            // $conn->exec($sql);
        }
    }


?>