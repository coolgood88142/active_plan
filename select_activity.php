<?php
    include("mysql.php");

    $sql = "select ac_id,ac_name,ac_type,(select name from activity_types where id = ac_type) as type_name,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours from activity";

    $query = $conn->query($sql);
    $active = $query->fetchAll(PDO::FETCH_ASSOC);


?>