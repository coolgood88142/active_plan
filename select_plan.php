<?php
    include("mysql.php");
    
    $us_account = $_SESSION['us_account'];
    $sql = "SELECT us_id,us_name FROM user ";


    $usid = "";$id = "";$user="";
    if($us_admin!='Y'){
        $sql = $sql . " WHERE us_account='$us_account'";
        $query = $conn->query($sql);
        $user = $query->fetch(PDO::FETCH_ASSOC);
    }else{
        $sql = $sql . " WHERE us_admin NOT IN ('Y') ";
        $query = $conn->query($sql);
        $user = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    date_default_timezone_set('Asia/Taipei');
    $today = date ("Y-m-d");

    $pn_ptid="";$pn_usid="";$pn_acid="";$pn_date="";
    $sql = "SELECT pn_ptid,pn_acid,(select pt_date from plan_trip where pn_ptid = pt_id ) as pn_date FROM plan_acname ";
    $query = $conn->query($sql);
    $update = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($update as $key => $value) {
        if(strtotime($today)>strtotime($value['pn_date'])){
            $pn_ptid = $pn_ptid . $value['pn_ptid'] . ",";
            $pn_acid = $pn_acid . $value['pn_acid'] . ",";
            $pn_date = $pn_date . $value['pn_date'] . ",";
        }
    }

    if($pn_ptid!="" && $pn_acid!="" && $pn_date!=""){
        $pn_ptid = substr($pn_ptid,0,-1);
        $pn_acid = substr($pn_acid,0,-1);
        $pn_date = substr($pn_date,0,-1);

        $pn_ptid = explode(",", $pn_ptid);
        $pn_acid = explode(",", $pn_acid);
        $pn_date = explode(",", $pn_date);

        $count=count($pn_ptid);
        
        for($i=0 ; $i<$count ; $i++){
            $ptid = $pn_ptid[$i];
            $acid = $pn_acid[$i];
            $date = $pn_date[$i];
            $sql = "UPDATE plan_trip SET pt_status = 2 WHERE pt_date = '$date' and pt_id = $ptid ";
            $conn->exec($sql);
        }
    }

    $plan_count = "";
    if($us_admin=='Y'){
        $sql = "SELECT us_id,us_name,(select count(pt_name) from plan_trip where pt_usid = us_id) as pt_count FROM user WHERE us_admin NOT IN ('Y') ";
        $query = $conn->query($sql);
        $plan_count = $query->fetchAll(PDO::FETCH_ASSOC);
    }


    $usid="";
    $sql = "SELECT pt_id,pt_name,pt_date,pt_hours,pt_spend,pt_status,pt_usid,pt_usname FROM plan_trip ";
    if($us_admin!='Y'){
        $id = $user['us_id'];
        $usid = " WHERE pt_usid='$id'";
    }

    $sql = $sql.$usid." ORDER BY pt_date DESC ";
    $query = $conn->query($sql);
    $plan = $query->fetchAll(PDO::FETCH_ASSOC);


    $sql = "SELECT pn_id,pn_ptid,pn_acname,pt_id,pt_usid 
	,(select ac_id from activity where pn_acid = ac_id ) as ac_id 
	,(select name from activity,activity_types where pn_acid = ac_id and ac_type = type_id) as ac_type 
	,(select ac_weather from activity where pn_acid = ac_id ) as ac_weather 
	,(select ac_drive from activity  where pn_acid = ac_id ) as ac_drive 
    ,(select ac_carry from activity  where pn_acid = ac_id ) as ac_carry 
    ,(select ac_spend from activity  where pn_acid = ac_id ) as ac_spend 
    ,(select ac_hours from activity  where pn_acid = ac_id ) as ac_hours 
    FROM plan_acname,plan_trip
    WHERE pn_ptid = pt_id ";

    if($usid!=""){
        $usid = " and pt_usid='$id'";
    }

    $query = $conn->query($sql.$usid);
    $plan_trip = $query->fetchAll(PDO::FETCH_ASSOC);
?>