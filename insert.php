<?php
    session_start();
    include("mysql.php");

    $us_account = "";
    if(isset($_POST['us_account'])){
        $us_account = $_POST['us_account'];
    }

    $us_password = "";
    if(isset($_POST['us_password'])){
        $us_password = $_POST['us_password'];
        $us_password = password_hash($us_password, PASSWORD_DEFAULT);
    }

    date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s");

    $sql = null;$errorMessage="";
    if(isset($_POST['setup_user'])){
        //先檢查帳號是否已建立
        $sql = "SELECT count(us_account) as account FROM user WHERE us_account in ('$us_account')";
        $query = $conn->query($sql);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row['account']==0){
            //剛建立，姓名暫時用帳號
            $sql = "INSERT INTO user (us_account, us_password, us_name, us_gender, us_admin, us_status, us_email, us_last_login)
            VALUES ('$us_account', '$us_password', '$us_account', '', 'N', 1, '', '$datetime')";

            $conn->exec($sql);

            //建立帳號後建立session物件
            $sql = "select us_id,us_name,us_password,us_admin from user where us_account='" . $us_account  ."'";
        
            $query = $conn->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $_SESSION['us_account'] = $us_account;      //帳號
            $_SESSION['us_id'] = $row['us_id'];         //id
            $_SESSION['us_name'] = $row['us_name'];     //使用者姓名   
            $_SESSION['us_admin'] = $row['us_admin'];   //是否有權限
            $_POST['setup_user'] = 'Y';
        }else{
            $errorMessage = "這組帳號已存在了";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php?error=true&errorMessage='.$errorMessage.'>';
        }
    }else if(isset($_POST['add_account'])){
        $us_name = $_POST['us_name'];
        $us_gender = $_POST['us_gender'];
        $us_email = $_POST['us_email'];
        $us_status = $_POST['us_status'];

        if(empty($us_status)){
            $us_status = 1;
        }
        
        $sql = "INSERT INTO user (us_account, us_password, us_name, us_gender, us_admin, us_status, us_email, us_last_login)
        VALUES ('$us_account', '$us_password', '$us_name', '$us_gender', 'N', $us_status, '$us_email', '$datetime')";
        $conn->exec($sql);
    }else if(isset($_POST['add_activitys']) && $_POST['add_activitys']=='Y'){
        $add_acname = $_POST['add_acname'];
        $add_actype = $_POST['add_actype'];
        $add_acweather = $_POST['add_acweather'];
        $add_acdrive = $_POST['add_acdrive'];
        $add_accarry = $_POST['add_accarry'];
        $add_acspend = $_POST['add_acspend'];
        $add_achours = $_POST['add_achours'];
        $add_actimetype = $_POST['add_actimetype'];

        $add_weather="";
        if(count($add_acweather)>0){
            foreach($add_acweather as $key => $weather){
                $add_weather = $add_weather . $weather . ",";
            }
            $add_weather = substr($add_weather,0,-1);
        }
        
        $add_timetype="";
        if(count($add_actimetype)>0){
            foreach($add_actimetype as $key => $timetype){
                $add_timetype = $add_timetype . $timetype . ",";
            }
            $add_timetype = substr($add_timetype,0,-1);
        }     
        
        $sql = "INSERT INTO activity (ac_type, ac_name, ac_weather, ac_drive, ac_carry, ac_spend, ac_hours, ac_timetype)
        VALUES ($add_actype, '$add_acname', '$add_weather', $add_acdrive, '$add_accarry', $add_acspend, $add_achours, '$add_timetype')";
        $conn->exec($sql);
    }else if(isset($_POST['add_timetypes']) && $_POST['add_timetypes']=='Y'){
        $add_typename = $_POST['add_typename'];
        
        $sql = "select MAX(id) as max_id from activity_types ";
        $query = $conn->query($sql);
        $count = $query->fetch(PDO::FETCH_ASSOC);
        $max_id = (int)$count['max_id']+1;


        $sql = "INSERT INTO activity_types (type_id, name)
        VALUES ($max_id, '$add_typename')";
        $conn->exec($sql);
    
    }

    $conn=null;
?>
<script language="JavaScript">
    <?php 
    if(isset($_POST['setup_user']) && $_POST['setup_user']=='Y'){
    ?>
        location.href = "activity.php";
    <?php   
    }else if(isset($_POST['add_account'])){
    ?>
        location.href = "setting_admin.php";
    <?php
    }else if(isset($_POST['add_activitys'])){
    ?>
        location.href = "activity.php";
    <?php
    }else if(isset($_POST['add_timetypes'])){
    ?>
        location.href = "activity_type.php";
    <?php
    }
    ?>
</script>