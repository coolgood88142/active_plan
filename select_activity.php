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
        session_start();
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

        $name_array=[];$count=0;$json_name_array="";
        foreach($name as $key => $value){
            $name_array[$count] = $value['name'];
            $count++;
        }
        $json_name_array = json_encode($name_array,JSON_UNESCAPED_UNICODE);

        $begin_month = "";$end_month = "";$defult_month=0;
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        if($chart_type=='2' && isset($_POST['begin_date']) && isset($_POST['end_date'])){
            $month=[];
            $begin = explode("-", $_POST['begin_date']);
            $end = explode("-", $_POST['end_date']);

            $begin_month = $begin[0] . $begin[1];
            $end_month = $end[0] . $end[1];
            $diff = $end_month - $begin_month;

            $j=0;
            $last_month=$begin_month;$array_month="";
            for($i=1;$i<$diff+2;$i++){
                $last_month = $last_month + 1;
                $count = substr($last_month,-2);
                $month[$j] = $count;
                $j++;
            }  
        }

        $month_array=[];
        $month_count = count($month);
        for($i=$defult_month;$i<$month_count;$i++){
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

            
            $name_count = count($name_array);$json_month_array="";
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
            $json_month_array = json_encode($month_array,JSON_UNESCAPED_UNICODE);
        }
    }



    $sql = "SELECT * FROM time_types ";
    $query = $conn->query($sql);
    $timetypes = $query->fetchAll(PDO::FETCH_ASSOC);
    $time_array = [];$field_count=0;$json_time_array="";

    foreach ($timetypes as $key => $value){
        $ty_type = $value['ty_type'];
        $ty_name = $value['ty_name'];
        $sql = "SELECT count(ac_timetype) as time_count FROM activity,plan_trip,plan_acname 
        where ac_timetype like '%$ty_type%' and pn_acid = ac_id and pn_ptid = pt_id ";

        if($us_admin!='Y' && $us_id!=""){
            $sql = $sql . " and pt_usid = $us_id";
        }

        if($chart_type=='3' && $begin_date!="" && $end_date!=""){
            $sql = $sql . " and pt_date BETWEEN '$begin_date' AND '$end_date'";
        }

        $query = $conn->query($sql);
        $activity_time = $query->fetch(PDO::FETCH_ASSOC);
        
        $time_array['time_name'][$field_count] = $ty_name;
        $time_array['time_count'][$field_count] = $activity_time['time_count'];
        $field_count++;
    }
    $json_time_array = json_encode($time_array,JSON_UNESCAPED_UNICODE);

    $sql = "SELECT * FROM activity_weather ";
    $query = $conn->query($sql);
    $activity_weather = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<form action="analysis.php" name="submitForm" method="post">
    <input type="hidden" name="post_chart_type" value="<?=$chart_type?>"/>
    <input type="hidden" name="post_begin_date" value="<?=$begin_date?>"/>
    <input type="hidden" name="post_end_date" value="<?=$end_date?>"/>
    <input type="hidden" name="post_activity_text" value="<?=$activity_text?>"/>
    <input type="hidden" name="post_name_array" value="<?=$json_name_array?>"/>
    <input type="hidden" name="post_month_array" value="<?=$json_month_array?>"/>
    <input type="hidden" name="post_time_array" value="<?=$json_time_array?>"/>
</form>
<script language="JavaScript">
    <?php 
        if(isset($_POST['chart_type'])){
    ?>
            document.submitForm.submit();
    <?php
        }
    ?>
</script>