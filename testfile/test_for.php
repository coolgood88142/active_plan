<?php
    $type="";
    $count=0;
    $a=3;
    for($i=0;$i<$a;$i++){
        for($j=$a;$j>$i;$j--){
            if($i!=$a-1){
                $type = $type . ++$count . ","; 
            }    
        }
        $count=0;
        if($i!=$a-1){
            $type = substr($type,0,-1) . "','";
        }else{
            $type = substr($type,0,-1);
        }

    }
    $type = $type . "'" . 2; 
    echo $type; 
?>