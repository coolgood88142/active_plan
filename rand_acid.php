<?php
    $count = $rand_count;
    $previous = $active_array['ac_hours'][$count];
    
    if(($hour>$active_array['ac_hours'][$count] || $hour==$active_array['ac_hours'][$count]) && count($active_array['ac_id'])>0){
        $hour = (int)$hour-(int)$active_array['ac_hours'][$count];
        
        $name = $name . $active_array['ac_name'][$count] . ",";
        $type = $type . $active_array['ac_type'][$count] . ",";
        $weather = $weather . $active_array['ac_weather'][$count]. ",";
        $drive = $drive . $active_array['ac_drive'][$count] . ",";
        $carry = $carry . $active_array['ac_carry'][$count] . ",";
        $spend = $spend . $active_array['ac_spend'][$count] . ",";
        $hours = $hours . $active_array['ac_hours'][$count] . ",";
        $id = $id . $active_array['ac_id'][$count] . ",";
        $orderby = $orderby . ((Int)$i+1) . ",";

        array_splice($active_array['ac_name'],$count,1);
        array_splice($active_array['ac_type'],$count,1);
        array_splice($active_array['ac_weather'],$count,1);
        array_splice($active_array['ac_drive'],$count,1);
        array_splice($active_array['ac_carry'],$count,1);
        array_splice($active_array['ac_spend'],$count,1);
        array_splice($active_array['ac_hours'],$count,1);
        array_splice($active_array['ac_id'],$count,1);

        if($hour>0 && count($active_array['ac_id'])>0){
            $rand_count = array_rand($active_array['ac_id'],1); 
            include("rand_acid.php");
        }
    }else if($hour<$active_array['ac_hours'][$count] && count($active_array['ac_id'])>0){
        
        $rand_count = array_rand($active_array['ac_id'],1); 
        if($rand_count==$count){
            $rand_count = array_rand($active_array['ac_id'],1);
            
            if($active_array['ac_hours'][$rand_count]>$previous || $active_array['ac_hours'][$rand_count]==$previous){
                $hour = (int)$hour + 1;              
                return;
            }
        }
            include("rand_acid.php");
        
    }
?>