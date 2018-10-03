<?php
    include("mysql.php");

    $sql = "select ac_id,ac_name,ac_type,(select name from activity_types where id = ac_type) as type_name,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours,ac_timetype from activity";

    $query = $conn->query($sql);
    $active = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "select * from activity_types";

    $query = $conn->query($sql);
    $active_type = $query->fetchAll(PDO::FETCH_ASSOC);

    //起迄日期用年月日(yy-mm-dd)
    $begin_date = "";$end_date = "";
    if(isset($_POST['begin_date']) && isset($_POST['end_date'])){
        $begin_date = $_POST['begin_date'];
        $end_date = $_POST['end_date'];   
    }

    $chart_type = "";
    if(isset($_POST['chart_type'])){
        $chart_type = $_POST['chart_type'];
        // session_start();
        $us_admin = $_SESSION['us_admin'];
    }

    $us_id = $_SESSION['us_id'];
    $sql = "SELECT ac_name,  (select count(pn_id) from plan_acname,plan_trip where pn_acid = ac_id and pn_ptid = pt_id ";

    if($us_admin!='Y' && $us_id!=""){
        $sql = $sql . "  and pt_usid = $us_id"; 
    }

    if($chart_type=='1' && $begin_date!="" && $end_date!=""){
        $sql = $sql . " and pt_date between '$begin_date' and '$end_date')";
    }else{
        $sql = $sql . ")";
    }

    $sql = $sql . " as ac_count FROM activity order by ac_id";
    
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

    $begin="";$end="";
    if(isset($today_year) || isset($_POST['today_year'])){
        if(isset($_POST['today_year']) && $_POST['today_year']=='Y'){
            $today_year = date ("Y");
        }

        $sql = "SELECT name FROM activity_types";
        $query = $conn->query($sql);
        $name = $query->fetchAll(PDO::FETCH_ASSOC);

        $name_array=[];$count=0;
        foreach($name as $key => $value){
            $name_array[$count] = $value['name'];
            $count++;
        }

        $begin_month = "";$end_month = "";$begin_month=0;
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        if($chart_type=='2' && isset($_POST['begin_date']) && isset($_POST['end_date'])){
            $begin = explode("-", $_POST['begin_date']);
            $end = explode("-", $_POST['end_date']);
            $month = [$begin[1],$end[1]];
        }

        $month_array=[];
        $month_count = count($month);
        for($i=$begin_month;$i<$month_count;$i++){
            $year_month_01 = $today_year . "-". $month[$i] . "-01";
            $year_month_31 = $today_year . "-". $month[$i] . "-31";
            $sql = "SELECT name, ";

            if($us_admin!='Y' && $us_id!=""){
                $sql = $sql . " (select count(ac_type) from plan_acname,activity,plan_trip where pn_acid = ac_id and ac_type = type_id and pn_ptid = pt_id 
                and pt_usid = $us_id and pt_date BETWEEN '$year_month_01' AND '$year_month_31') " ;
            }else{
                $sql = $sql . " (select count(ac_type) from plan_acname,activity,plan_trip where pn_acid = ac_id and ac_type = type_id and pn_ptid = pt_id 
                and pt_date BETWEEN '$year_month_01' AND '$year_month_31') " ;
            }
            $sql = $sql . " as count FROM activity_types order by type_id";

            $query = $conn->query($sql);
            $type_count = $query->fetchAll(PDO::FETCH_ASSOC);

            
            $name_count = count($name_array);
            for($j=0;$j<$name_count;$j++){
                foreach($type_count as $key => $type){
                    if($name_array[$j]==$type['name']){
                        $type_name = $type['name'];
                        $month_typecount = $type['count'];
                        $month_array[$type_name][$i] = $type['count'];
                        break;
                    }
                }
                
            }
        }
        
    }



    $sql = "SELECT * FROM time_types ";
    $query = $conn->query($sql);
    $timetypes = $query->fetchAll(PDO::FETCH_ASSOC);

    $time_array = [];
    $field_count=0;
    foreach ($timetypes as $key => $value){
        $ty_type = $value['ty_type'];
        $ty_name = $value['ty_name'];
        $sql = "SELECT count(ac_timetype) as time_count FROM activity ";

        if($us_admin!='Y' && $us_id!=""){
            $sql = $sql . ",plan_trip,plan_acname where ac_timetype like '%$ty_type%' and pn_acid = ac_id and  pn_ptid = pt_id and pt_usid = $us_id";
        }else{
            $sql = $sql . " where ac_timetype like '%$ty_type%'";
        }
        
        // SELECT count(ac_timetype) as time_count FROM activity,plan_acname,plan_trip where pn_acid = ac_id and pn_ptid = pt_id and ac_timetype like '%1%' and pt_date BETWEEN '2018-09-01' AND '2018-09-31'

        $query = $conn->query($sql);
        $activity_time = $query->fetch(PDO::FETCH_ASSOC);
        
        $time_array['time_name'][$field_count] = $ty_name;
        $time_array['time_count'][$field_count] = $activity_time['time_count'];
        $field_count++;
    }

    $sql = "SELECT * FROM activity_weather ";
    $query = $conn->query($sql);
    $activity_weather = $query->fetchAll(PDO::FETCH_ASSOC);
?>