<?php
    include("mysql.php");

    $sql = "select ac_id,ac_name,ac_type,(select name from activity_types where id = ac_type) as type_name,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours,ac_timetype from activity";

    $query = $conn->query($sql);
    $active = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "select * from activity_types";

    $query = $conn->query($sql);
    $active_type = $query->fetchAll(PDO::FETCH_ASSOC);
   
    $sql = "SELECT * FROM time_types ";
    $query = $conn->query($sql);
    $timetypes = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM activity_weather ";
    $query = $conn->query($sql);
    $activity_weather = $query->fetchAll(PDO::FETCH_ASSOC);

    function array_to_json($sel_array){
        foreach($sel_array as $key => $value){
            
         if(is_string($key) || is_string($value)) {
            
             foreach($value as $key2 => $value2){
                $new_array[urlencode($key2)] = urlencode($value2);
            }
            $new_array2[urlencode($key)] =  $new_array;

         }
        }
       
        return urldecode(json_encode($new_array2));
       }
?>