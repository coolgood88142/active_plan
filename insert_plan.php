<?php
    session_start();
    include("mysql.php");
    $ad_acspend = (int)$_POST['ad_acspend'];
    $ad_achours = (int)$_POST['ad_achours'];

    $ad_acid = $_POST['ad_acid'];
    $ad_acid = explode(",", $ad_acid);

    $us_id = "";
    $us_name = "";
    $ad_acname = "";
    $ad_hours = "";
    $count = 0;

    if(isset($_POST['us_id'])){
        $us_id = $_POST['us_id'];
    }

    if(isset($_POST['us_name'])){
        $us_name = $_POST['us_name'];
    }

    if(isset($_POST['ad_acname'])){
        $ad_acname = $_POST['ad_acname'];
        $ad_acname = explode(",", $ad_acname);
    }

    if(isset($_POST['ad_hours'])){
        $ad_hours = $_POST['ad_hours'];
        $ad_hours = explode(",", $ad_hours);
    }

    $count=count($ad_acid);

    if($count>0){
        $sql = "INSERT INTO plan_trip (pt_name, pt_hours, pt_spend, pt_date, pt_usid, pt_usname, pt_status)
        VALUES ('$pt_name', $ad_achours, $ad_acspend, '$pt_date', $pt_usid, '$pt_usname', 1)";
        $conn->exec($sql);
    }



   

    for($i=0 ; $i<$count ; $i++){
        $acid = $ad_acid[$i];
        $acname = $ad_acname[$i];
        $achours = $ad_hours[$i];

        $sql = "SELECT * FROM plan_trip WHERE pt_name = '$pt_name' and pt_date = '$pt_date' and pt_usid = $pt_usid and pt_status = 1 ";
        $query = $conn->query($sql);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $pt_id = $data['pt_id'];

        if($acid!="" && $acid!=null && $acname!="" && $acname!=null && $achours!="" && $achours!=null){
            $sql = "INSERT INTO plan_acname (pn_ptid, pn_acid, pn_acname, pn_achours)
            VALUES ($pt_id, $acid, '$acname', $achours)";
            $conn->exec($sql);
        }

        

    }
?>