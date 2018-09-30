<?php
    session_start();
    include("mysql.php");
    
    $up_activitys = $_POST['up_activitys'];
    $add_acid = $_POST['add_acid'];
    $add_acname = $_POST['add_acname'];
    $add_actype = $_POST['add_actype'];
    $add_acweather = $_POST['add_acweather'];
    $add_acdrive = $_POST['add_acdrive'];
    $add_accarry = $_POST['add_accarry'];
    $add_acspend = $_POST['add_acspend'];
    $add_achours = $_POST['add_achours'];

    $up_timetypes = $_POST['up_timetypes'];
    $add_typeid = $_POST['add_typeid'];
    $add_typename = $_POST['add_typename'];

    if($up_activitys=='Y'){
        if($add_acweather!="" && $add_acweather=="*"){
            $add_acweather = "";
            $sql = "SELECT aw_type FROM activity_weather ";
            $query = $conn->query($sql);
            $weather = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($weather as $key => $value){
                $add_acweather = $add_acweather . $value['aw_type'] . ",";
            }
            $add_acweather = substr($add_acweather,0,-1);
        }
        
        $sql = "UPDATE activity SET ac_name='$add_acname', ac_type = $add_actype, ac_weather = '$add_acweather', ac_drive = $add_acdrive, ac_drive = $add_acdrive, ac_carry = '$add_accarry', ac_spend = $add_acspend, ac_hours = $add_achours WHERE ac_id =  $add_acid ";
        $conn->exec($sql);
    }else if($up_timetypes=='Y'){
        $sql = "UPDATE activity_types SET name='$add_typename' WHERE type_id =  $add_typeid ";
        $conn->exec($sql);
    }
    

?>  
<script language="JavaScript">
    location.href = "activity.php";
</script>