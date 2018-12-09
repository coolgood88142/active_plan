<html>
  <head>
    <title>規劃行程系統</title>
  </head>
<?php include("link.php");?>
<?php session_start();
    $islogin=false;$us_admin = "";
    include("checklogin.php");
    include("mysql.php");
    if($islogin){
        if(isset($_SESSION["us_admin"])){
            $us_admin = $_SESSION['us_admin'];
            include("select_activity.php"); 
        }
    }else{
        exit;
    }
    
 ?>
 <style>
   .vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */

  display: flex;
  align-items: center; 
}

.jumbotron{
  height:100%;
  width:100%;
  font-family:'微軟正黑體';
}

#example1 thead td {
  background: url("./assets/images/background.png");
  color: white;
}

.container{
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.img-thumbnail{
    width:48px;
    height:48px;
  }
@media screen and (max-width: 768px) {
    .jumbotron,.btn,.form-control{
        font-size:14px;
    }
    #title{
        font-size:28px;
    }
    #add{
        display: none;
    }

}
 </style>
  <body>
    <div id="navbar"></div>
    <div class="jumbotron container bg-Light side-collapse-container-left">
        <form id="showForm" name="showForm" method="post">
            <div class="col-md-12" style="top: 20px;">
                <h2 id="title" class="text-center font-weight-bold">活動列表</h2>
                <input type="hidden" name="admin" value="<?=$us_admin?>"/>
                <div style="text-align:right;">
                    <img src="./assets/images/add.png" alt="" id="img" name="img" class="img-thumbnail d-md-none" onClick="add_activity()">
                    <input type="button" class="btn btn-primary" style="display:none;" id="add" name="add" value="新增" onClick="add_activity()"/>
                </div><br/>
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>活動項目</td>
                            <td style="display:none;">活動項目ID</td>
                            <td>類型</td>
                            <td style="display:none;">類型ID</td>
                            <td>天氣</td>
                            <td style="display:none;">天氣ID</td>
                            <td>車程(小時)</td>
                            <td>攜帶物品</td>
                            <td>花費</td>
                            <td>時間(小時)</td>
                            <td style="display:none;">時段</td>
                            <?php
                                if($us_admin=='Y'){                
                            ?>
                                <td>編輯設定</td>
                            <?php
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($active as $key => $value) {
                        ?>
                        <tr>
                            <td class="ac_name">
                                <?php echo $value["ac_name"]?>
                            </td>
                            <td class="ac_id" style="display:none;">
                                <?php echo $value["ac_id"]?>
                            </td>
                            <td class="type_name">
                                <?php echo $value["type_name"]?>
                            </td>
                            <td class="ac_type" style="display:none;">
                                <?php echo $value["ac_type"]?>
                            </td>
                            <td class="weather_name">
                                <?php 
                                    $acweather = $value["ac_weather"];
                                    $acweather = explode(",", $acweather);
                                    $wather_count = count($acweather);

                                    $wather_name = "";
                                    for($j=0;$j<$wather_count;$j++){
                                        $aw_type = $acweather[$j];
                                        $sql = "SELECT aw_name FROM activity_weather where aw_type = $aw_type";
                                        $query = $conn->query($sql);
                                        $awname = $query->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($awname as $key => $name){
                                            $wather_name = $wather_name . $name['aw_name'];                                  
                                        }

                                        if($j!=$wather_count-1){
                                            $wather_name = $wather_name . "、";
                                        }
                                    }
                                    echo $wather_name;
                                ?>
                            </td>
                            <td class="ac_weather" style="display:none;">
                                <?php echo $value["ac_weather"]?>
                            </td>
                            <td class="ac_drive">
                                <?php echo $value["ac_drive"]?>
                            </td>
                            <td class="ac_carry">
                                <?php echo $value["ac_carry"]?>
                            </td>
                            <td class="ac_spend">
                                <?php echo $value["ac_spend"]?>元
                            </td>
                            <td class="ac_hours">
                                <?php echo $value["ac_hours"]?>
                            </td>
                            <td class="ac_timetype" style="display:none;">
                                <?php echo $value["ac_timetype"]?>
                            </td>
                            <?php
                                if($us_admin=='Y'){                
                            ?>
                                <td class="ac_edit">
                                    <input type="button" class="btn btn-primary" value="編輯" onClick="edit(this)"/>
                                </td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-sm-4 col-md-8">
                        <input type="button" class="btn btn-primary" style="display:none;" name="backpage" value="回上一頁" onClick="back_activity()"/>
                    </div>
                </div><br/>
                <div class="form-group row align-items-center activity" style="display:none;">
                    <label class="col-sm-4 col-md-8 control-label" for="add_acname">活動項目:</label>
                    <div class="col-sm-4 col-md-8">
                        <input type="text" class="form-control" name="add_acname" value="">
                    </div>
                </div>
                <div class="form-group row align-items-center type" style="display:none;">
                    <label class="col-sm-4 col-md-8 control-label" for="add_actype">類型:</label>
                    <div class="col-sm-4 col-md-8">
                        <select class="custom-select" name="add_actype">
                        <?php
                            foreach ($active_type as $key => $type) {
                        ?>
                            <option value="<?=$type['type_id']?>"><?=$type['name']?></option>
                        <?php
                            }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="form-group row align-items-center weather" style="display:none;">
                    <label class="col-sm-4 col-md-1 control-label" for="add_acweather[]">天氣:</label>
                    <div class="col">
                        <?php 
                            foreach($activity_weather as $key => $weather){
                        ?>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="add_acweather[]" value="<?=$weather['aw_type']?>"><?=$weather['aw_name']?>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group row align-items-center drive" style="display:none;">
                    <label class="col-sm-4 col-md-8 control-label" for="add_acdrive">活動項目:</label>
                    <div class="col-sm-4 col-md-8">
                        <input type="text" class="form-control" name="add_acdrive" value="" size="2"  
                            onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div class="col">
                        小時
                    </div>
                </div>
                    <div class="form-group row align-items-center carry" style="display:none;">
                    <label class="col-sm-4 col-md-8 control-label" for="add_accarry">攜帶物品:</label>
                    <div class="col-sm-4 col-md-8">
                        <input type="text" class="form-control" name="add_accarry" value="無">
                    </div>
                </div>
                <div class="form-group row align-items-center spend" style="display:none;">
                    <label class="col-sm-4 col-md-8 control-label" for="add_acspend">花費:</label>
                    <div class="col-sm-4 col-md-8">
                        <input type="text" class="form-control" name="add_acspend" value="0" 
                            onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div class="col">
                        元
                    </div>
                </div>
                <div class="form-group row align-items-center hours" style="display:none;">
                    <label class="col-sm-4 col-md-8 control-label" for="add_achours">時間:</label>
                    <div class="col-sm-4 col-md-8">
                        <input type="text" class="form-control" name="add_achours" value="" size="2"
                            onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div class="col">
                        小時
                    </div>
                </div>
                <div class="form-group row align-items-center timetype" style="display:none;">
                    <label class="col-sm-4 col-md-1 control-label" for="add_actimetype[]">天氣:</label>
                    <div class="col">
                        <?php 
                            foreach($timetypes as $key => $time){
                        ?>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="add_actimetype[]" value="<?=$time['ty_type']?>"><?=$time['ty_name']?>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-8">
                        <input type="button" class="btn btn-primary" style="display:none;" name="addactivity" value="新增" onClick="insert()" />
                        <input type="button" class="btn btn-primary" style="display:none;" name="up_submit" value="儲存" onClick="update()" />
                    </div>
                </div>
                <input type="hidden" name="add_acid" value=""/>
                <input type="hidden" name="add_activitys" />
                <input type="hidden" name="up_activitys" />
                <input type="hidden" name="Responsive_Button" />
            </div>
        </form>
    </div>
</body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        $('#example1').DataTable(datatable_language());
        if($("input[name='admin']").val()=="Y"){
            $("input[name='add']").show();
        }
        //可以重新定義datatable目前解析度縮放
        // $('#example1').fnAdjustColumnSizing();
        // $('#example1').fnDraw();
    } );

    function go_plan(){
        var objName = "",objType = "",objHour = "",objSpend = "";
        var trs=$("table#example1 tr");
        $("input[name='add']:checked").each(function(){
            var obj = $(this).closest("tr");
            objName = objName + obj.find(".ac_name").text().trim() + ",";
            objType = objType + obj.find(".ac_type").text().trim() + ",";
            objHour = objHour + obj.find("select[name='hour']").val() + ",";
            objSpend = objSpend + obj.find("input[name='spend']").val() + ","; 
        });
        objName = objName.substring(0, objName.length-1);
        objType = objType.substring(0, objType.length-1);
        objHour = objHour.substring(0, objHour.length-1);
        objSpend = objSpend.substring(0, objSpend.length-1);

        $("input[name='objName']").val(objName);
        $("input[name='objType']").val(objType);
        $("input[name='objHour']").val(objHour);
        $("input[name='objSpend']").val(objSpend);

        document.showForm.action="plan.php"; 
        document.showForm.submit();
    }

    function add_activity(){
        $('#example1_wrapper').hide()
        $("input[name='backpage']").show();
        $(".activity").show();
        $(".type").show();
        $(".weather").show();
        $(".drive").show();
        $(".carry").show();
        $(".spend").show();
        $(".hours").show();
        $(".timetype").show();
        $("input[name='addactivity']").show();

        if($("#add").is(":visible")){
            $("#add").hide();
            $("input[name='Responsive_Button']").val(false);
        }else if($("#img").is(":visible")){
            $("#img").css("display", "none");
            $("input[name='Responsive_Button']").val(true);
        }
    }

    function back_activity(){
        $('#example1_wrapper').show()
        $("input[name='backpage']").hide();
        $(".activity").hide();
        $(".type").hide();
        $(".weather").hide();
        $(".drive").hide();
        $(".carry").hide();
        $(".spend").hide();
        $(".hours").hide();
        $(".timetype").hide();
        $("input[name='addactivity']").hide();
        $("input[name='up_submit']").hide();

        var Responsive_Button = $("input[name='Responsive_Button']").val();
        if(Responsive_Button == "true"){
            $("#img").show();
        }else{
            $("#add").show();
        }
    }

    function insert(){
        var add_acname = $("input[name='add_acname']").val();    
        var add_acweather = $("input[name='add_acweather[]']").is(":checked");
        var add_acdrive = $("input[name='add_acdrive']").val();
        var add_accarry = $("input[name='add_accarry']").val();
        var add_acspend = $("input[name='add_acspend']").val();
        var add_achours = $("input[name='add_achours']").val();
        var add_actimetype = $("input[name='add_actimetype[]']").is(":checked");

        if($(".activity").is(":visible")){
            if(add_acname==""){
                return alert("請輸入活動項目!");
            }

            if(add_acweather==false){
                return alert("請至少打勾一項天氣!");
            }

            if(add_acdrive==""){
                return alert("請輸入車程欄位!");
            }else if(add_acdrive=="0"){
                return alert("請至少輸入1小時!");
            }

            if(add_accarry==""){
                return alert("請輸入攜帶物品!");
            }

            if(add_acspend==""){
                return alert("請輸入花費欄位!");
            }

            if(add_achours==""){
                return alert("請輸入時間欄位!");
            }else if(add_achours=="0"){
                return alert("請至少輸入1小時!");
            }

            if(add_actimetype==false){
                return alert("請至少打勾一項時段!");
            }

            $("input[name='add_activitys']").val('Y');
        }    

        document.showForm.action="insert.php"; 
        document.showForm.submit();
    }

    function edit(obj){
        if($('#example1_wrapper').is(':visible')){
            var tr = $(obj).closest('tr');
            var ac_id = $(tr).find(".ac_id").text().trim();
            var ac_name = $(tr).find(".ac_name").text().trim();
            var ac_type = $(tr).find(".ac_type").text().trim();             
            var ac_drive = $(tr).find(".ac_drive").text().trim();
            var ac_carry = $(tr).find(".ac_carry").text().trim();
            var ac_spend = $(tr).find(".ac_spend").text().trim();
            ac_spend = ac_spend.substring(0, ac_spend.length-1);
            var ac_hours = $(tr).find(".ac_hours").text().trim();

            var ac_weather = $(tr).find(".ac_weather").text().trim();
            ac_weather = ac_weather.split(",");
            for(var i=0;i<ac_weather.length;i++){
                $("input[name='add_acweather[]']").each(function() {
                    if($(this).val()==ac_weather[i]){
                        $(this).prop("checked", true);
                    }
                });
            }

            var ac_timetype = $(tr).find(".ac_timetype").text().trim();
            ac_timetype = ac_timetype.split(",");
            for(var i=0;i<ac_timetype.length;i++){
                $("input[name='add_actimetype[]']").each(function() {
                    if($(this).val()==ac_timetype[i]){
                        $(this).prop("checked", true);
                    }
                });
            }
            
            $("input[name='add_acid']").val(ac_id);
            $("input[name='add_acname']").val(ac_name);
            $("select[name='add_actype'] option[value="+ac_type+"]").attr("selected",true); 
            $("input[name='add_acdrive']").val(ac_drive);
            $("input[name='add_accarry']").val(ac_carry);
            $("input[name='add_acspend']").val(ac_spend);
            $("input[name='add_achours']").val(ac_hours);

            add_activity();
            $("input[name='up_activitys']").val('Y');
            $("input[name='addactivity']").hide();
            $("input[name='up_submit']").show();
        }
    }

    function update(){
        var add_acname = $("input[name='add_acname']").val();    
        var add_acweather = $("input[name='add_acweather[]']").is(":checked");
        var add_acdrive = $("input[name='add_acdrive']").val();
        var add_accarry = $("input[name='add_accarry']").val();
        var add_acspend = $("input[name='add_acspend']").val();
        var add_achours = $("input[name='add_achours']").val();
        var add_actimetype = $("input[name='add_actimetype[]']").is(":checked");

        if($("input[name='up_activitys']").val()=='Y'){
            if(add_acname==""){
                return alert("請輸入活動項目!");
            }

            if(add_acweather==false){
                return alert("請至少打勾一項天氣!");
            }

            if(add_acdrive==""){
                return alert("請輸入車程欄位!");
            }else if(add_acdrive=="0"){
                return alert("請至少輸入1小時!");
            }

            if(add_accarry==""){
                return alert("請輸入攜帶物品!");
            }

            if(add_acspend==""){
                return alert("請輸入花費欄位!");
            }

            if(add_achours==""){
                return alert("請輸入時間欄位!");
            }else if(add_achours=="0"){
                return alert("請至少輸入1小時!");
            }

            if(add_actimetype==false){
                return alert("請至少打勾一項時段!");
            }
        }

        document.showForm.action="update_activity.php"; 
        document.showForm.submit();
    }

    function show(page){
        if($("input[name='admin']").val()=="Y" && (page=="setting" || page=="question")){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

