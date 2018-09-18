<?php
    $count = $rand_count;
    $previous = $ac_hours[$count];

    // $active_count = $rand_active;

    if(($hour>$ac_hours[$count] || $hour==$ac_hours[$count]) && count($ac_id)>0){
        $hour = (int)$hour-(int)$ac_hours[$count];
        
        $name = $name . $ac_name[$count] . ",";
        $type = $type . $ac_type[$count] . ",";
        $weather = $weather . $ac_weather[$count]. ",";
        $drive = $drive . $ac_drive[$count] . ",";
        $carry = $carry . $ac_carry[$count] . ",";
        $spend = $spend . $ac_spend[$count] . ",";
        $hours = $hours . $ac_hours[$count] . ",";
        $id = $id . $ac_id[$count] . ",";
        $orderby = $orderby . ((Int)$i+1) . ",";

        array_splice($ac_hours,$count,1);
        array_splice($ac_name,$count,1);
        array_splice($ac_type,$count,1);
        array_splice($ac_weather,$count,1);
        array_splice($ac_drive,$count,1);
        array_splice($ac_carry,$count,1);
        array_splice($ac_spend,$count,1);
        array_splice($ac_id,$count,1);

        if($hour>0 && count($ac_id)>0){
            $rand_count = array_rand($ac_id,1); 
            include("rand_acid.php");
        }
    }else if($hour<$ac_hours[$count] && count($ac_id)>0){
        
        $rand_count = array_rand($ac_id,1); 
        if($rand_count==$count){
            $rand_count = array_rand($ac_id,1);
            
            if($ac_hours[$rand_count]>$previous || $ac_hours[$rand_count]==$previous){
                // $hour = (int)$hour + 1;
                return;
            }
            // echo "有進來";
            // echo "<br/>";

            // echo "ac_hours_count=" . $ac_hours[$rand_count];
            // echo "<br/>";

            // echo "ac_id_count=" . count($ac_id);
            // echo "<br/>";
            
            // echo "ac_id陣列:" . var_dump($ac_id);
            // echo "<br/>";

            // echo " 前一筆:" . $previous;
            // echo "<br/>";
        }
            include("rand_acid.php");
        
    }

    // if(($hour>$active_array['ac_id'][$active_count] || $hour==$active_array['ac_id'][$active_count]) 
    //     && count($active_array['ac_id'])>0){
    //      $hour = (int)$hour-(int)$active_array['ac_id'][$active_count];

    //     $name = $name . $ac_name[$count] . ",";
    //     $type = $type . $ac_type[$count] . ",";
    //     $weather = $weather . $ac_weather[$count]. ",";
    //     $drive = $drive . $ac_drive[$count] . ",";
    //     $carry = $carry . $ac_carry[$count] . ",";
    //     $spend = $spend . $ac_spend[$count] . ",";
    //     $hours = $hours . $ac_hours[$count] . ",";
    //     $id = $id . $ac_id[$count] . ",";

    //     array_splice($ac_hours,$count,1);
    // }
?>