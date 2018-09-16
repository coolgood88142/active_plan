<?php
    session_start();
    include("mysql.php");

    $us_account = $_POST['us_account'];
    $us_password = $_POST['us_password'];
    

    $sql = null;
    if(isset($_POST['update_user'])){
        
        $us_name = $_POST['us_name'];
        $us_gender = $_POST['us_gender'];
        $us_email = $_POST['us_email'];

        $sql = "UPDATE user SET ";

        if(!empty($us_password)){
            $us_password = password_hash($us_password, PASSWORD_DEFAULT);
            $sql = $sql . "us_password = '$us_password',";
        }

        if(!empty($us_name)){
            $sql = $sql . "us_name = '$us_name',";
        }

        if(!empty($us_gender)){
            $sql = $sql . "us_gender = '$us_gender',";
        }

        if(!empty($us_email)){
            $sql = $sql . "us_email = '$us_email' ";
        }

        $sql = $sql . "WHERE us_account = '$us_account'";

       
    }
    $conn->exec($sql);
    $conn=null;

    $us_admin = $_SESSION['us_admin'];
    if($us_admin!='Y'){
        $_SESSION['us_name'] = $us_name; 
    }
    
    echo '<meta http-equiv=REFRESH CONTENT=0;url=plan.php>';
?>