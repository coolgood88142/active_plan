<?php
    session_start();
    include("mysql.php");

    $pt_name = "";
    if(isset($_POST['pt_name'])){
        $pt_name = $_POST['pt_name'];
    }

    $pt_date = "";
    if(isset($_POST['pt_date'])){
        $pt_date = $_POST['pt_date'];
    }

    $count = 0;
    $ac_id = "";
    if(isset($_POST['ac_id'])){
        $ac_id = $_POST['ac_id'];
        $ac_id = explode(",", $ac_id);
        $count=count($ac_id);
    }

    $pt_usid = "";
    if(isset($_POST['pt_usid'])){
        $pt_usid = $_POST['pt_usid'];
    }

    $pt_usname = "";
    if(isset($_POST['pt_usname'])){
        $pt_usname = $_POST['pt_usname'];
    }

    if($count>0){
        for($i=0 ; $i<$count ; $i++){
            $acid = $ac_id[$i];
            if($acid!="" && $acid!=null){
                $sql = "UPDATE plan_trip SET pt_name='$pt_name',pt_date = '$pt_date' WHERE pt_usid = $pt_usid and pt_acid = $acid ";
                $conn->exec($sql);
            }
        }
    }

    $plan_name = "";
    if(isset($_POST['plan_name'])){
        $plan_name = $_POST['plan_name'];
    }

    $plan_date = "";
    if(isset($_POST['plan_date'])){
        $plan_date = $_POST['plan_date'];
    }


    $isdelete = "";
    $count = 0;
    if(isset($_POST['isdelete'])){
        $isdelete = $_POST['isdelete'];
        $isdelete = explode(",", $isdelete);
        $count=count($isdelete);
    }

    $pn_id = "";
    if(isset($_POST['pn_id'])){
        $pn_id = $_POST['pn_id'];
        $pn_id = explode(",", $pn_id);
    }

    $de_acspend = "";
    if(isset($_POST['de_acspend'])){
        $de_acspend = (int)$_POST['de_acspend'];
    }

    $de_achours = "";
    if(isset($_POST['de_achours'])){
        $de_achours = (int)$_POST['de_achours'];
    }

    if(isset($_POST['plan_name']) && isset($_POST['plan_date']) && $pt_name!="" && $pt_date!="" && $pt_usid!="" ){
        $sql = "UPDATE plan_trip SET pt_name = '$plan_name',pt_date = '$plan_date' WHERE pt_name = '$pt_name' and pt_date = '$pt_date' and pt_usid = $pt_usid";
        $conn->exec($sql);
        $pt_name = $plan_name;
        $pt_date = $plan_date;
    }

    

    if($count>0){
        $sql = "SELECT pt_hours,pt_spend FROM plan_trip WHERE pt_name = '$pt_name' and pt_date = '$pt_date' and pt_usid = $pt_usid ";
        $query = $conn->query($sql);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $spend = (int)$user['pt_spend'];
        $hour= (int)$user['pt_hours'];                 

        if($de_achours>$hour){
            $de_achours = $de_achours - $hour;
        }else if($de_achours<$hour){
            $de_achours = $hour - $de_achours;
        }

        if($de_acspend>$spend){
            $de_acspend = $de_acspend - $spend;
        }else if($de_acspend<$spend){
            $de_acspend = $spend - $de_acspend;
         }

        if($de_achours>0 && $de_acspend>0){
            $sql = "UPDATE plan_trip SET pt_spend = $de_acspend,pt_hours = $de_achours WHERE pt_name = '$pt_name' and pt_date = '$pt_date' and pt_usid = $pt_usid";
            $conn->exec($sql);
        }

        for($i=0 ; $i<$count ; $i++){
            if($isdelete[$i]=="true"){
                $pnid = $pn_id[$i];
                if($pnid!="" && $pnid!=null){
                    $sql = "DELETE FROM plan_acname WHERE pn_id = $pnid ";
                    $conn->exec($sql);
                }
            }
        }
    }
    

    $ad_acspend = (int)$_POST['ad_acspend'];
    $ad_achours = (int)$_POST['ad_achours'];

    $ad_acid = $_POST['ad_acid'];
    $ad_acid = explode(",", $ad_acid);

    $us_id = "";
    $us_name = "";
    $ad_acname = "";
    $ad_hours = "";

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

    $newplan = "";
    if(isset($_POST['newplan'])){
        $newplan = $_POST['newplan'];
    }

    $count=count($ad_acid);

    if($count>0){
        if($us_id!="" && $us_name!=""){
            $pt_usid = $us_id;
            $pt_usname = $us_name;
        }else{
            $sql = "SELECT pt_hours,pt_spend FROM plan_trip WHERE pt_name = '$pt_name' and pt_date = '$pt_date' and pt_usid = $pt_usid ";
            $query = $conn->query($sql);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $hour= (int)$user['pt_hours'];
            $spend = (int)$user['pt_spend'];

            $ad_achours = $ad_achours + $hour;
            $ad_acspend = $ad_acspend + $spend;

            if($ad_acspend>0 && $ad_acspend>0){
                $sql = "UPDATE plan_trip SET pt_spend = $ad_acspend,pt_hours = $ad_achours WHERE pt_name = '$pt_name' and pt_date = '$plan_date' and pt_usid = $pt_usid";
                $conn->exec($sql);
            }
        }

        if($newplan!=""){
            $sql = "INSERT INTO plan_trip (pt_name, pt_hours, pt_spend, pt_date, pt_usid, pt_usname, pt_status)
            VALUES ('$plan_name', $ad_achours, $ad_acspend, '$plan_date', $pt_usid, '$pt_usname', 1)";
            $conn->exec($sql);
        }

        for($i=0 ; $i<$count ; $i++){
            $acid = $ad_acid[$i];
            $acname = $ad_acname[$i];
            $achours = $ad_hours[$i];

            $sql = "SELECT * FROM plan_trip WHERE pt_name = '$plan_name' and pt_date = '$plan_date' and pt_usid = $pt_usid and pt_status = 1 ";
            $query = $conn->query($sql);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $pt_id = $data['pt_id'];

            if($acid!="" && $acid!=null && $acname!="" && $acname!=null && $achours!="" && $achours!=null){
                $sql = "INSERT INTO plan_acname (pn_ptid, pn_acid, pn_acname, pn_achours)
                VALUES ($pt_id, $acid, '$acname', $achours)";
                $conn->exec($sql);
            }
        }
    }

    $us_admin = $_SESSION['us_admin'];
    if($us_admin=='Y'){
        echo '<meta http-equiv=REFRESH CONTENT=0;url=plan_admin.php>';
    }else{
        echo '<meta http-equiv=REFRESH CONTENT=0;url=plan.php>';
    }
?>