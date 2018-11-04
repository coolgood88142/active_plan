<?php
    // include("mysql.php");
    // session_start();

    if(isset($_SESSION['us_admin'])){
        if(empty($_COOKIE['us_account'] ) && empty($_COOKIE['us_password'])){
            session_unset( );
            session_destroy( );
            echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
        }else{
            $islogin = true;
        }
    }else{
        if(empty($_COOKIE['us_admin'])){
            echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
        }else{
            $_SESSION['us_admin'] = $_COOKIE['us_admin'];
        }
    }

    if(!isset($_SESSION['us_id']) && !isset($_SESSION['us_name']) && !isset($_SESSION['us_account'])){
        if(!empty($_COOKIE['us_id']) && !empty($_COOKIE['us_name']) && !empty($_COOKIE['us_account'])){
            $_SESSION['us_id'] = $_COOKIE['us_id'];
            $_SESSION['us_name'] = $_COOKIE['us_name'];
            $_SESSION['us_account'] = $_COOKIE['us_account'];
        }else{
            echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
        }
    }
?>