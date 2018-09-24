<?php
    include("mysql.php");

    $sql = "select ac_id,ac_name,ac_type,(select name from activity_types where id = ac_type) as type_name,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours from activity";

    $query = $conn->query($sql);
    $active = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT ac_name,(select count(pn_id) from plan_acname where pn_acid = ac_id) as ac_count FROM activity order by ac_id";
    $query = $conn->query($sql);
    $activity_count = $query->fetchAll(PDO::FETCH_ASSOC);
    $activity_text="";

    foreach($activity_count as $key => $value){
        $text_count=$value['ac_count'];
        for($i=0;$i<$text_count;$i++){
            $activity_text = $activity_text . $value['ac_name'] . ",";
        }
    }
    $activity_text = substr($activity_text,0,-1);

    // $type_array=[$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12];
    if(isset($today_year)){
        $month_array=['01','02','03','04','05','06','07','08','09','10','11','12'];
        $month1="";$month2="";
        $month_count=count($month_array);
        for($i=0;$i<$month_count;$i++){
            $year_month_01 = $today_year . "-". $month_array[$i] . "-01";
            $year_month_31 = $today_year . "-". $month_array[$i] . "-31";

            $sql = "SELECT name,(select count(ac_type) from plan_acname,activity,plan_trip where pn_acid = ac_id and ac_type = type_id and pn_ptid = pt_id 
                and pt_date BETWEEN '$year_month_01' AND '$year_month_31') as count FROM activity_types order by type_id";
            $query = $conn->query($sql);
            $type_count = $query->fetchAll(PDO::FETCH_ASSOC);

            // $month.$i['name'][$i]=$type_count['name'];
            // $month.$i['count'][$i]=$type_count['count'];
        }
        
    }

    // echo var_dump($type_array);


    $sql = "SELECT * FROM time_types ";
    $query = $conn->query($sql);
    $timetypes = $query->fetchAll(PDO::FETCH_ASSOC);

    $time_array = [];
    $field_count=0;
    foreach ($timetypes as $key => $value){
        $ty_type = $value['ty_type'];
        $ty_name = $value['ty_name'];
        $sql = "SELECT count(ac_timetype) as time_count  FROM activity 
            where ac_timetype like '%$ty_type%'";
        $query = $conn->query($sql);
        $activity_time = $query->fetch(PDO::FETCH_ASSOC);
        
        $time_array['time_name'][$field_count] = $ty_name;
        $time_array['time_count'][$field_count] = $activity_time['time_count'];
        $field_count++;
    }

    // $ss =  json_encode($time_array);

    // print_r ($time_array["time_name"]);
    // var_dump($ss["time_name"]);
?>