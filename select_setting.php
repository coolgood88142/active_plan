<?php
    include("mysql.php");

    $us_account = $_SESSION['us_account'];
    $us_admin = $_SESSION['us_admin'];

    $isStatus="";$img="";
    if(isset($_POST['isStatus']) && isset($_POST['img'])){
        $isStatus = $_POST['isStatus'];
        $img = $_POST['img'];
    }

    if($isStatus=="update_headshot" && $img!=""){
        date_default_timezone_set('Asia/Taipei');
        $datetime = date ("YmdHis");
        
        $array = array('datetime' => $datetime);
        echo json_encode($array);
    }else{
        $sql = "select us_account,us_password,us_name,us_gender,us_email,us_status,us_headshot_path from user where us_admin not in ('Y') ";
    
        if(!empty($us_account) && !empty($us_admin) && $us_admin!='Y'){
            $sql = $sql . " and us_account='$us_account'";
        }
        $sql = $sql . " order by us_id";
    
        $query = $conn->query($sql);
        $setting = $query->fetchAll(PDO::FETCH_ASSOC);
    }
   
?>