<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <!-- jQuery v1.9.1 -->
<script src="jquery-3.3.1.js"></script>
<!-- DataTables v1.10.16 -->
<link href="jquery.dataTables.min.css" rel="stylesheet" />
<script src="jquery.dataTables.min.js"></script>
<?php session_start();
    include("mysql.php"); 

    $us_admin = $_SESSION['us_admin'];
    if(!empty($us_admin)){
        include("select_plan.php");
        include("select_random.php"); 
    }

    $pt_usid = $_SESSION['us_id'];
    $pt_usname = $_SESSION['us_name'];

    $post_day = "";
    if(isset($_POST['post_day'])){
        $post_day = $_POST['post_day'];
    }

    $post_typeid = "";
    if(isset($_POST['post_typeid'])){
        $post_typeid =  $_POST['post_typeid'];
    }

    $post_daytime = "";
    if(isset($_POST['post_daytime'])){
        $post_daytime =  $_POST['post_daytime'];
    }

    $post_timetype = "";
    if(isset($_POST['post_timetype'])){
        $post_timetype =  $_POST['post_timetype'];
    }
    
    $post_acname = "";$count="";
    if(isset($_POST['post_acname']) && $_POST['post_acname']!=""){
        $post_acname =  $_POST['post_acname'];
        $post_acname = substr($post_acname,0,-1);
        $post_acname = explode(",", $post_acname);
        $count=count($post_acname);
    }

    $post_actype = "";
    if(isset($_POST['post_actype']) && $_POST['post_actype']!=""){
        $post_actype =  $_POST['post_actype'];
        $post_actype = substr($post_actype,0,-1);
        $post_actype = explode(",", $post_actype);
    }

    $post_acweather = "";
    if(isset($_POST['post_acweather']) && $_POST['post_acweather']!=""){
        $post_acweather =  $_POST['post_acweather'];
        $post_acweather = substr($post_acweather,0,-1);
        $post_acweather = explode(",", $post_acweather);
    }

    $post_acdrive = "";
    if(isset($_POST['post_acdrive']) && $_POST['post_acdrive']!=""){
        $post_acdrive =  $_POST['post_acdrive'];
        $post_acdrive = substr($post_acdrive,0,-1);
        $post_acdrive = explode(",", $post_acdrive);
    }

    $post_accarry = "";
    if(isset($_POST['post_accarry']) && $_POST['post_accarry']!=""){
        $post_accarry =  $_POST['post_accarry'];
        $post_accarry = substr($post_accarry,0,-1);
        $post_accarry = explode(",", $post_accarry);
    }

    $post_acspend = "";
    if(isset($_POST['post_acspend']) && $_POST['post_acspend']!=""){
        $post_acspend =  $_POST['post_acspend'];
        $post_acspend = substr($post_acspend,0,-1);
        $post_acspend = explode(",", $post_acspend);
    }

    $post_achours = "";
    if(isset($_POST['post_achours']) && $_POST['post_achours']!=""){
        $post_achours =  $_POST['post_achours'];
        $post_achours = substr($post_achours,0,-1);
        $post_achours = explode(",", $post_achours);
    }

    $post_acid = "";
    if(isset($_POST['post_acid']) && $_POST['post_acid']!=""){
        $post_acid =  $_POST['post_acid'];
        $post_acid =substr($post_acid,0,-1);
        $post_acid = explode(",", $post_acid);
    }

    $is_query = "";
    if(isset($_POST['is_query'])){
        $is_query =  $_POST['is_query'];    
    }

 ?>
  <body>
    <style>
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
    </style>
    
    <form name="showForm" action="<?php echo "select_random.php" ?>"method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <input type="hidden" name="pt_usid" value="<?=$pt_usid?>"/>
        <input type="hidden" name="pt_usname" value="<?=$pt_usname?>"/>
        <input type="hidden" id="is_query" value="<?=$is_query?>"/>
        <div id="button"></div>
        <H2>隨機行程</H2>
        <br/><br/>
        <p class="plan">行程名稱:<input type="text" name="plan_name" value=""/></p>
        <p class="date">出發日期:<input type="text" name="plan_date" value=""/>(yyyy-mm-dd)</p>
        <p class="userlist">使用者名稱: 
        <select name="pt_userlist">
        <?php 
        if($us_admin=="Y"){
            foreach($user as $key => $value){
        ?>
            
                <option value='<?php echo $value["us_id"]?>'><?php echo $value["us_name"]?></option>
            
        <?php      
            }
        }
        ?>
        </select>
        </p>

        天數: <input type="text" name="day" value="<?=$post_day?>" size="2"/>天<br/><br/>

        類型: 
        <input type="hidden" name="type" value="<?=$post_typeid?>">
        <?php
            foreach($types as $key => $value){
                $type_id = $value['type_id'];
                $name = $value['name'];
        ?>
            <input type="checkbox" name="typeid[]" value="<?=$type_id?>"><?php echo $name ?></input>
        <?php
            }
        ?>
        <br/><br/>

        天數小時:<input type="text" name="day_time" value="<?=$post_daytime?>" size="2">小時<br/><br/>

        <p class="time">時段選項:
            <input type="hidden" name="time" value="<?=$post_timetype?>">
            <select name="time_type">
        <?php
            foreach($time as $key => $value){
                $ty_type = $value['ty_type'];
                $ty_name = $value['ty_name'];
        ?>
            <option value="<?=$ty_type?>"><?php echo $ty_name ?></option>
        <?php
            }
        ?>
            </select>
            </p>
        <input type="submit" name="gorandom" value="執行"/>  
            <br/><br/> 
        
        <table id="example1">
	        <thead>
                <tr>
                    <td bgcolor="#00FFFF">活動項目</td>
                    <td bgcolor="#00FFFF">類型</td>
                    <td bgcolor="#00FFFF">天氣</td>
                    <td bgcolor="#00FFFF">車程(小時)</td>
                    <td bgcolor="#00FFFF">攜帶物品</td>
                    <td bgcolor="#00FFFF">花費</td>
                    <td bgcolor="#00FFFF">時間(小時)</td>
                    <td bgcolor="#00FFFF" style="display:none;">類型ID</td>
                </tr>
	        </thead>
	        <tbody>
                <?php
                    if($count>0){
                        for($i=0 ; $i<$count ; $i++) {
                ?>
                    <tr>
                        <td class="ac_name">
                            <?php echo $post_acname[$i]?>
                        </td>
                        <td class="type_name">
                            <?php echo $post_actype[$i]?>
                        </td>
                        <td class="ac_weather">
                            <?php echo $post_acname[$i]?>
                        </td>
                        <td class="ac_drive">
                            <?php echo $post_acdrive[$i]?>
                        </td>
                        <td class="ac_carry">
                            <?php echo $post_accarry[$i]?>
                        </td>
                        <td class="ac_spend">
                            <?php echo $post_acspend[$i]?>元
                        </td>
                        <td class="ac_hours">
                            <?php echo $post_achours[$i]?>
                        </td>
                        <td class="ac_id" style="display:none;">
                            <?php echo $post_acid[$i]?>
                        </td>
                    </tr>
                <?php
                         }
                    }
                ?>
	        </tbody>
            <tfoot>
            </tfoot>
        </table>
        <input type="button" name="goplan" value="送出" onClick="go_plan()"/> 
    </form>
    <form action="update_plan.php" name="updateForm" method="post"> 

        <input type="hidden" name="ad_acname" />            
        <input type="hidden" name="ad_typename" />
        <input type="hidden" name="ad_acweather" />
        <input type="hidden" name="ad_acdrive" />
        <input type="hidden" name="ad_accarry" /> 
        <input type="hidden" name="ad_acspend" /> 
        <input type="hidden" name="ad_achours" />
        <input type="hidden" name="ad_hours" />
        <input type="hidden" name="ad_acid" />

        <input type="hidden" name="plan_name" /> 
        <input type="hidden" name="plan_date" />

        <input type="hidden" name="us_id" />
        <input type="hidden" name="us_name" />
        <input type="hidden" name="newplan" value="true"/>
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        $('#example1').DataTable();
        $('#example1_wrapper').hide();
        $("input[name='goplan']").hide();
        $(".plan").hide();
        $(".date").hide();
        $(".time").hide();
        $(".userlist").hide();

        if($("#is_query").val()=="true"){
            $('#example1_wrapper').show();
            $(".plan").show();
            $(".date").show();
            $("input[name='goplan']").show();
            
        }

        if($("input[name='admin']").val()=="Y"){
            $(".userlist").show();
        }

        var post_typeid = $("input[name='type']").val();
        post_typeid = post_typeid.split(",");
        for(var i=0;i<post_typeid.length;i++){
            $("input[name='typeid[]']").each(function() {
                if($(this).val()==post_typeid[i]){
                    $(this).prop("checked", true);
                }
            });
        }

        var time = $("input[name='time']").val();
        $("select[name='time_type'] option[value="+ time +"]").attr("selected",true);
        if(time<8){
            $(".time").show();
        }else{
            $(".time").hide();
        }
    } );

    $("input[name='day_time']").on('keyup', function() {
        var time = parseInt($(this).val());
        if(time<8){
            $(".time").show();
        }else{
            $(".time").hide();
        }
    });

    function go_plan(){
        if($('#example1_wrapper').is(':visible')){
            var ad_acname="",ad_typename="",ad_acweather="",ad_acdrive="",ad_accarry="",ad_acspend=0,ad_achours=0,ad_acid="",ac_id="",ad_hours="";
            var from = $("form[name='updateForm']");
            var row = $("#example1 .ac_id");
            if(row.length>0){
                $(row).each(function() {
                var obj = $(this).closest("tr");
                ad_acname = ad_acname + obj.find(".ac_name").text().trim() + ",";
                ad_typename = ad_typename + obj.find(".type_name").text().trim() + ",";
                ad_acweather = ad_acweather + obj.find(".ac_weather").text().trim() + ",";
                ad_acdrive = ad_acdrive + obj.find(".ac_drive").text().trim() + ",";
                ad_accarry = ad_accarry + obj.find(".ac_carry").text().trim() + ",";

                var spend = obj.find(".ac_spend").text().trim();
                spend = parseInt(spend.substring(0, spend.length-1));
                ad_acspend = ad_acspend + spend;

                var hours = parseInt(obj.find(".ac_hours").text().trim());
                ad_achours = ad_achours + hours;
                ad_hours = ad_hours + hours + ",";
                ad_acid = ad_acid + obj.find(".ac_id").text().trim() + ",";

                });
            }

            ad_acname = ad_acname.substring(0, ad_acname.length-1);
            ad_typename = ad_typename.substring(0, ad_typename.length-1);
            ad_acweather = ad_acweather.substring(0, ad_acweather.length-1);
            ad_acdrive = ad_acdrive.substring(0, ad_acdrive.length-1);
            ad_accarry = ad_accarry.substring(0, ad_accarry.length-1);
            ad_hours = ad_hours.substring(0, ad_hours.length-1);
            ad_acid = ad_acid.substring(0, ad_acid.length-1);
            

            $(from).find("input[name='ad_acname']").val(ad_acname);
            $(from).find("input[name='ad_typename']").val(ad_typename);
            $(from).find("input[name='ad_acweather']").val(ad_acweather);
            $(from).find("input[name='ad_acdrive']").val(ad_acdrive);
            $(from).find("input[name='ad_accarry']").val(ad_accarry);
            $(from).find("input[name='ad_acspend']").val(ad_acspend);
            $(from).find("input[name='ad_achours']").val(ad_achours);
            $(from).find("input[name='ad_hours']").val(ad_hours);
            $(from).find("input[name='ad_acid']").val(ad_acid);


            var plan_name = $("input[name='plan_name']").val().trim();
            var plan_date = $("input[name='plan_date']").val().trim();

            if(plan_name==""){
                return alert("請輸入行程名稱!");
            }else if(plan_date==""){
                return alert("請輸入出發日期!");
            }else if(!plan_date.match("^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02/(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$")){
                return alert("出發日期格式錯誤!");
            }
            
            $(from).find("input[name='plan_name']").val(plan_name);
            $(from).find("input[name='plan_date']").val(plan_date); 

            var us_id = "",us_name = "";
            if($("input[name='admin']").val()!="Y"){
                us_id = $("input[name='pt_usid']").val()
                us_name = $("input[name='pt_usname']").val()
            }else{
                us_id = $("select[name='pt_userlist'] :selected").val();
                us_name = $("select[name='pt_userlist'] :selected").text();
            }

            $(from).find("input[name='us_id']").val(us_id);
            $(from).find("input[name='us_name']").val(us_name);

            $(from).submit();
            
        }
    }

    function Cancel(obj){
        $(obj).parent().parent().remove();    
    }

    function show(page){
        if($("input[name='admin']").val()=="Y" && page!="activity" && page!="sign_out"){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }

   
  </script>
</html>

