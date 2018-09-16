<?php
    session_start();
    include("mysql.php");
    
    $add_acid = $_POST['add_acid'];
    $add_acname = $_POST['add_acname'];
    $add_actype = $_POST['add_actype'];
    $add_acweather = $_POST['add_acweather'];
    $add_acdrive = $_POST['add_acdrive'];
    $add_accarry = $_POST['add_accarry'];
    $add_acspend = $_POST['add_acspend'];
    $add_achours = $_POST['add_achours'];


    $sql = "UPDATE activity SET ac_name='$add_acname', ac_type = $add_actype, ac_weather = '$add_acweather', ac_drive = $add_acdrive, ac_drive = $add_acdrive, ac_carry = '$add_accarry', ac_spend = $add_acspend, ac_hours = $add_achours WHERE ac_id =  $add_acid ";
    $conn->exec($sql);

?>  
<script language="JavaScript">
    location.href = "activity.php";
</script>