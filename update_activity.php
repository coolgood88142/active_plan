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