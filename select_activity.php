<?php
    include("mysql.php");

    $sql = "select ac_id,ac_name,ac_type,(select name from activity_types where id = ac_type) as type_name,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours from activity";

    $query = $conn->query($sql);
    $active = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT ac_name,(select count(pn_id) from plan_acname where pn_acid = ac_id) as ac_count FROM activity order by ac_id";
    $query = $conn->query($sql);
    $activity_count = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT name,(select count(ac_type) from plan_acname,activity where pn_acid = ac_id and ac_type = type_id) as type_count FROM activity_types order by type_id";
    $query = $conn->query($sql);
    $type_count = $query->fetchAll(PDO::FETCH_ASSOC);
?>