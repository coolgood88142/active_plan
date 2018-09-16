<?php
    session_start();
    session_unset( );
    session_destroy( );
    if(!empty($_COOKIE['us_account'])&& !empty($_COOKIE['us_password'])){
        setcookie("us_account",$us_account,time()+0);
        setcookie("us_password",$us_password,time()+0);
    }
?>
<script language="JavaScript">
    location.href = "login.php";
</script>