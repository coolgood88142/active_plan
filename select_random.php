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

    $istime_type = "";
    if(isset($_POST['istime_type'])){
        $istime_type = $_POST['istime_type'];
    }
    
    $is_submit="";
    $data = "";$has_data = "";$sum=0;
    $name="";$type="";$weather="";$drive="";$carry="";$spend="";$hours="";$id="";$orderby="";$timetype="";$time_sql="";
    if($day!="" && $typeid!="" && $day_time!="" && $time_type!=""){
        if($istime_type=='Y' && $time_type!="*"){
            $sql = "select MAX(ty_type) as max_type from time_types ";
            $query = $conn->query($sql);
            $achours = $query->fetch(PDO::FETCH_ASSOC);
            $max = $achours['max_type'];

            $count=0;$a=$max;
            for($i=0;$i<$a;$i++){
                $time_sql = $time_sql . ++$count . ","; 
                if($i==$a-1){
                    $time_sql = substr($time_sql,0,-1);
                }
        
            }
            $count=0;
            $time_sql = $time_sql . "','";

            for($j=$a;$j>0;$j--){
                if($j==$time_type+1){
                    if($j<$time_type){
                        $time_sql = $time_sql . $j . "," . $time_type . "','";
                    }else{
                        $time_sql = $time_sql . $time_type . "," . $j . "','";
                    }
                }           
            }
            $time_sql = $time_sql . $time_type;
        }     

        $name="";$type="";$weather="";$drive="";$carry="";$spend="";$hours="";$id="";$timetype="";
        for($i=0;$i<$day;$i++){
            $sql = "select ac_id,ac_hours,ac_name,(select name from activity_types where type_id = ac_type) as ac_type,
            ac_weather,ac_drive,ac_carry,ac_spend,ac_timetype from activity where ";
            if($time_sql==""){
                if($time_type!="*"){
                    $sql = $sql . " ac_timetype like '%$time_type%' ";
                }else{
                    $sql = $sql . " ac_timetype !='' ";
                }
            }else{
                $sql = $sql . " ac_timetype in ('" . $time_sql . "')";
            }
            
            if(count($typeid)>0){
                $sql = $sql . " and ac_type in (";
                foreach($typeid as $key => $query_typeid){
                    $sql = $sql . $query_typeid . ",";
                    $type_count = $type_count . $query_typeid . ",";
                }
                $sql = substr($sql,0,-1) . ")";
            }

            $query = $conn->query($sql);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            $active_array = [];
            $active_field = ['ac_id','ac_hours','ac_name','ac_type','ac_weather','ac_drive','ac_carry','ac_spend','ac_timetype'];
            $field_count = 0;
            foreach($data as $key => $value){        
                foreach ($active_field as $field) {
                    $active_array[$field][$field_count] = $value[$field];
                }
                $field_count++;
            }

            $hour = "";
            
            if(count($active_array['ac_id'])>0){
                $rand_count = array_rand($active_array['ac_id'],1);  
                $hour=$day_time;$min_hour=3;$previous="";
                include("rand_acid.php");

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
    <input type="hidden" name="post_actimetype" value="<?=$timetype?>"/>
    <input type="hidden" name="post_pnorderby" value="<?=$orderby?>"/>
    <input type="hidden" name="is_query" value="<?=$is_submit?>" />
</form>
<?php include("link.php");?>
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