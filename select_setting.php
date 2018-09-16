<?php
    include("mysql.php");

    $us_account = $_SESSION['us_account'];
    $us_admin = $_SESSION['us_admin'];

    $sql = "select us_account,us_password,us_name,us_gender,us_email,us_status from user where us_admin not in ('Y') ";
    
    if(!empty($us_account) && !empty($us_admin) && $us_admin!='Y'){
        $sql = $sql . " and us_account='$us_account'";
    }
    $sql = $sql . " order by us_id";

    $query = $conn->query($sql);
    $setting = $query->fetchAll(PDO::FETCH_ASSOC);
    return $setting;
?>