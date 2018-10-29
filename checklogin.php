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
        echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
    }
?>