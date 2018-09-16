<?php
    include("mysql.php");

    $sql = "";

    $day = "";
    if(isset($_POST['day'])){
        $day = $_POST['day'];
    }

    $time_type = "";
    if(isset($_POST['time_type'])){
        $time_type = $_POST['time_type']; 
    }

    $day_time = "";
    if(isset($_POST['day_time'])){
        $day_time = $_POST['day_time'];
    }

    $typeid = "";
    $type_count="";
    if(isset($_POST['typeid'])){
        $typeid = $_POST['typeid'];
    }

    
    $is_submit="";
    $data = "";$has_data = "";$ordery=0;
    if($day!="" && $typeid!="" && $day_time!="" && $time_type!=""){
        $name="";$type="";$weather="";$drive="";$carry="";$spend="";$hours="";$id="";
        for($i=0;$i<$day;$i++){
            $sql = "select * from activity where  ac_timetype in($time_type) ";
        if(count($typeid)>0){
            $sql = $sql . "and ac_type in (";
            foreach($typeid as $key => $id){
                $sql = $sql . $id . ",";
                $type_count = $type_count . $id . ",";
            }
            $sql = substr($sql,0,-1) . ")";
        }

        $query = $conn->query($sql);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $ac_id=array();$ac_hours=array();$ac_name=array();$ac_type=array();$ac_weather=array();$ac_drive=array();$ac_carry=array();$ac_spend=array();
        // $active_array = [];
        // $active_field = ['ac_id','ac_hours'];
        foreach($data as $key => $value){
            // foreach ($active_field as $key2 => $value2) {
            //      $active_array[$value2] = $value[$value2];
            // }
           
            array_push($ac_id,$value['ac_id']);
            array_push($ac_hours,$value['ac_hours']);
            array_push($ac_name,$value['ac_name']);
            array_push($ac_type,$value['ac_type']);
            array_push($ac_weather,$value['ac_weather']);
            array_push($ac_drive,$value['ac_drive']);
            array_push($ac_carry,$value['ac_carry']);
            array_push($ac_spend,$value['ac_spend']);
        }

        $hour = "";
        
        if(count($ac_id)>0){
            $rand_count = array_rand($ac_id,1);  
            $hour=$day_time;$min_hour=3;$previous="";
            include("rand_acid.php");
            $ordery = $ordery + 1;

            // $rand_active = array_rand($active_array['ac_id'],1);

            $has_data = "true";
        }else{
            //沒資料不要組
            break;
        }
        }
        
        
        $is_submit = "true";
        
    }else{
        $sql = "select * from activity_types";

        $query = $conn->query($sql);
        $types = $query->fetchAll(PDO::FETCH_ASSOC);
    
    
        $sql = "select * from time_types";
    
        $query = $conn->query($sql);
        $time = $query->fetchAll(PDO::FETCH_ASSOC);
    }


?>
<script src="jquery-3.3.1.js"></script>
<link href="jquery.dataTables.min.css" rel="stylesheet" />
<script src="jquery.dataTables.min.js"></script>

<input type="hidden" name="is_submit" value="<?=$is_submit?>" />
<input type="hidden" name="day" value="<?=$day?>" />
<input type="hidden" name="typeid" value="<?=$type_count?>" />
<input type="hidden" name="day_time" value="<?=$day_time?>" />
<input type="hidden" name="time_type" value="<?=$time_type?>" />

<form action="random.php" name="submitForm" method="post">
    <input type="hidden" name="post_day" />
    <input type="hidden" name="post_typeid" />
    <input type="hidden" name="post_daytime" /> 
    <input type="hidden" name="post_timetype" />
    <input type="hidden" name="post_acname" value="<?=$name?>"/>
    <input type="hidden" name="post_actype" value="<?=$type?>"/>
    <input type="hidden" name="post_acweather" value="<?=$weather?>"/>
    <input type="hidden" name="post_acdrive" value="<?=$drive?>"/>
    <input type="hidden" name="post_accarry" value="<?=$carry?>"/>
    <input type="hidden" name="post_acspend" value="<?=$spend?>"/>
    <input type="hidden" name="post_achours" value="<?=$hours?>"/>
    <input type="hidden" name="post_acid" value="<?=$id?>"/>
    <input type="hidden" name="is_query" value="<?=$is_submit?>" />
</form>
<script language="JavaScript">
    $(document).ready(function() {
        var from = $("form[name='submitForm']");
        if($("input[name='is_submit']").val()=="true"){
            var day = $("input[name='day']").val();
            var time_type = $("input[name='time_type']").val();
            var day_time = $("input[name='day_time']").val();
            var typeid = $("input[name='typeid']").val();

            typeid = typeid.substring(0, typeid.length-1);

            $(from).find("input[name='post_day']").val(day);
            $(from).find("input[name='post_typeid']").val(typeid);
            $(from).find("input[name='post_daytime']").val(day_time);
            $(from).find("input[name='post_timetype']").val(time_type);
            
            $(from).submit();
        }
    });
</script>