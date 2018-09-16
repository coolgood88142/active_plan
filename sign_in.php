<?php
    include("mysql.php");

    $us_account="";
    $us_password="";
    if(!empty($_COOKIE['us_account'])&& !empty($_COOKIE['us_password'])){
        $us_account = $_COOKIE['us_account'];
        $us_password = $_COOKIE['us_password'];
    }else{
        $us_account = $_POST['us_account'];
        $us_password= $_POST['us_password'];

        if(isset($_POST['us_remember'])){
            setcookie("us_account",$us_account,time()+3600*24*365);
            setcookie("us_password",$us_password,time()+3600*24*365);
        }
    }

    $sql = "select us_id,us_name,us_password,us_admin from user where us_account='" . $us_account  ."' and us_status = 1 ";
        
    $query = $conn->query($sql);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    // // 登入後更新登入時間
    date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s");
    
    $success = false;
    $errorMessage = "";
    if($row!=""){
        if(password_verify($us_password,$row['us_password'])){
            session_start();
            $_SESSION['us_account'] = $us_account;      //帳號
            $_SESSION['us_id'] = $row['us_id'];         //id
            $_SESSION['us_name'] = $row['us_name'];     //使用者姓名   
            $_SESSION['us_admin'] = $row['us_admin'];   //是否有權限
            
    
            $sql = "update user set us_last_login = '$datetime' where us_account='$us_account'"  ;
            $conn->exec($sql);
            
            $success = true;
            echo '<meta http-equiv=REFRESH CONTENT=0;url=activity.php>';
        }else{
            echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php?error=true>';
        }
    }else{
        $errorMessage = "該帳號已停用!";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php?error=true&errorMessage='.$errorMessage.'>';
    }
    
    
    // $sql = "select us_name,us_password,us_admin from user where us_account='" . $us_account  ."' and us_last_login='" . $datetime . "'";
    // $query = $conn->query($sql);
    // $login = $query->fetchAll(PDO::FETCH_ASSOC);
    // return $login;

?>