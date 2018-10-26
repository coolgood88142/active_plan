<?php
    include("mysql.php");

    $us_account="";
    $us_password="";
    if(isset($_POST['us_account']) && isset($_POST['us_account'])){
        $us_account = $_POST['us_account'];
        $us_password= $_POST['us_password'];
    }

    $sql = "select * from user where us_account='" . $us_account  ."' and us_passwords = " . $us_password;
        
    $query = $conn->query($sql);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if($row!=""){
        echo json_encode(array('success' => true));
    }else{
        echo json_encode(array('success' => false));
    }

?>