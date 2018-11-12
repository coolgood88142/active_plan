<?php
    //建立mysql連線
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname= "plan";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>