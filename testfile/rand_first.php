<?php

    $rand_first = array_rand($ac_id,1);
    if($day_time>$ac_hours[$rand_first]){
        $hour = $day_time-$ac_hours[$rand_first];
    }else{
        $hour = 0;
    }
?>