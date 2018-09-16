<?php
    //加密後的密碼都是60個
    $password = '0000';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo $hash;

    echo "</br>";

    echo  strlen( $hash );
    //$password = "d5s56dfsg31";
    echo "</br>";
    if(password_verify($password,$hash)){
        echo "密碼正確";
    }else{
        echo "密碼錯誤";
    }
?>