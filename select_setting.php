<?php
    include("mysql.php");

    $us_account = "";$us_admin = "";$array="";
    if(isset( $_SESSION['us_account']) && isset( $_SESSION['us_admin'])){
        $us_account = $_SESSION['us_account'];
        $us_admin = $_SESSION['us_admin'];
    }else if(isset( $_POST['us_account']) && isset( $_POST['admin'])){
        $us_account = $_POST['us_account'];
        $us_admin = $_POST['admin'];
    }

    $success = false;
    if(isset($_FILES['headshot_img'])){
        $file_name = $_FILES['headshot_img']['name'];
        $file_path = strripos($file_name , '.');
        $file_type = substr($file_name,$file_path);

        date_default_timezone_set('Asia/Taipei');
        $datetime = date ("YmdHis");
        $now_file = $datetime . $file_type;
        $datetime_file =  "assets/images/upload_file/" . $now_file;     

        $tmp_file = $_FILES['headshot_img']["tmp_name"];

        //複製檔案並把剛剛的選取檔案刪除，成功的話回傳 true
        if(move_uploaded_file($tmp_file,$datetime_file)){
            $sql = "SELECT us_headshot_path FROM user WHERE us_account IN ('$us_account') ";
            $query = $conn->query($sql);
            $headshot_path = $query->fetch(PDO::FETCH_ASSOC);
            $headshot =   $headshot_path['us_headshot_path'];

            if(file_exists($headshot)){
                unlink($headshot);

                //刪除後更新資料
                $sql = "UPDATE user SET us_headshot_path = '$datetime_file' WHERE us_account IN ('$us_account')";
                $conn->exec($sql);
                $success = true;
                $array = array('success' => $success);
            }
        }
    }else{
        $sql = "SELECT us_account,us_password,us_name,us_gender,us_email,us_status,us_headshot_path FROM user WHERE us_admin NOT IN ('Y') ";
    
        if(!empty($us_account) && !empty($us_admin) && $us_admin!='Y'){
            $sql = $sql . " and us_account='$us_account'";
        }
        $sql = $sql . " order by us_id";
    
        $query = $conn->query($sql);
        $setting = $query->fetchAll(PDO::FETCH_ASSOC);
    }
   
    if($success==true && $array!=""){
        echo json_encode($array);
    }
?>