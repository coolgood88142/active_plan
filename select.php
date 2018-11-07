<?php
    include("mysql.php");

    $us_account="";
    $us_password="";
    if(isset($_POST['us_account']) && isset($_POST['us_account'])){
        $us_account = $_POST['us_account'];
        $us_password= $_POST['us_password'];
    }

    $sql = "select * from user where us_account='" . $us_account . "'";
        
    $query = $conn->query($sql);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if($row!=""){
        if(password_verify($us_password,$row['us_password'])){
            echo json_encode(array('success' => true));
        }else{
            echo json_encode(array('success' => false));
        }
    }else{
        echo json_encode(array('success' => false));
    }

?>