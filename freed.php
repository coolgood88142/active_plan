<?php
    session_start();
    //登入時必需要取消勾選記住我才會釋放cookie
    if(!empty($_COOKIE['us_account']) && !empty($_COOKIE['us_password'])){
        setcookie("us_account",$_COOKIE['us_account'],time()+0);
        setcookie("us_password",$_COOKIE['us_password'],time()+0);
    }

    session_unset( );
    session_destroy( );
?>