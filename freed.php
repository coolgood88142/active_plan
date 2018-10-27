<?php
    session_start();
    session_unset( );
    session_destroy( );
    if(!empty($_COOKIE['us_account']) && !empty($_COOKIE['us_password'])){
        setcookie("us_account",$_COOKIE['us_account'],time()+0);
        setcookie("us_password",$_COOKIE['us_password'],time()+0);
    }
?>