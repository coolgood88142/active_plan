<html>
  <head>
    <title>規劃行程系統</title>
    <meta name="viewport" content="width=device-width">
  </head>
<?php include("link.php");?>
<link rel="stylesheet" href="./assets/css/buttons.dataTables.min.css">
<!-- <script src="./assets/js/jquery-3.3.1.min.js"></script> -->
<script src="./assets/js/dataTables.buttons.min.js"></script>
<script src="./assets/js/buttons.colVis.min.js"></script>
<script src="./vendor/select2/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.2/sweetalert2.all.min.js"></script>
<link rel="stylesheet" herf="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.2/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!-- <link rel="stylesheet" href="./vendor/select2/select2.min.css"> -->
<link rel="stylesheet" href="./assets/css/util.css">
<link rel="stylesheet" href="./assets/css/main.css">
<link rel="stylesheet" href="./assets/css/myStyle.css">
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
@media screen and (max-width: 768px) {
    .jumbotron,.btn,.form-control{
        font-size:14px;
    }
    #title{
        font-size:28px;
    }
    
    /* #drive,#spend,#time,.ac_drive,.ac_spend,.ac_hours{
        display:none;
    } */

}

.container-contact100-form-btn{
    justify-content:start;
    padding-top:0px;
}

 </style>
  <body>
    <div id="navbar"></div>
    <div class="jumbotron container bg-white side-collapse-container-left" style="background-color:white; border-color:white;">
        <form class="contact100-form" id="showForm" name="showForm" method="post" style="background-color:white; border-color:white;">
            <div class="col-md-12 col-from">
                <h2 id="title" class="text-center font-weight-bold" style="margin-bottom:20px;">活動列表</h2>
                <input type="hidden" name="admin" value="<?=$us_admin?>"/>
                <div id="addbutton" style="text-align:right;">
                    <img src="./assets/images/add.png" alt="" id="img" name="img" class="img-thumbnail d-md-none" style="margin-bottom:20px;" onClick="add_activity()">
                    <input type="button" class="btn btn-primary d-none d-md-inline d-sm-none" style="display:none; margin-bottom:20px;" id="add" name="add" value="新增" onClick="add_activity()"/>
                </div>
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td style="display:none;">活動項目ID</td>
                            <td style="display:none;">類型ID</td>
                            <td style="display:none;">天氣ID</td>
                            <td style="display:none;">時段</td>
                            <td>活動項目</td>
                            <td>類型</td>
                            <td>天氣</td>
                            <td id="drive">車程(小時)</td>
                            <td>攜帶物品</td>
                            <td id="spend">花費</td>
                            <td id="time">時間(小時)</td>
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
                            <td class="ac_id" style="display:none;">
                                <?php echo $value["ac_id"]?>
                            </td>
                            <td class="ac_type" style="display:none;">
                                <?php echo $value["ac_type"]?>
                            </td>
                            <td class="ac_weather" style="display:none;">
                                <?php echo $value["ac_weather"]?>
                            </td>
                            <td class="ac_timetype" style="display:none;">
                                <?php echo $value["ac_timetype"]?>
                            </td>
                            <td class="ac_name">
                                <?php echo $value["ac_name"]?>
                            </td>
                            
                            <td class="type_name">
                                <?php echo $value["type_name"]?>
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
                <div class="wrap-contact100" style="display:none; width:100%;">
                    <div class="container-contact100-form-btn">
                        <div class="row">
                            <div class="col-sm-4 col-md-2">
                                <input type="button" class="btn btn-primary" style="display:none; margin-bottom:20px;" name="backpage" value="回上一頁" onClick="back_activity()"/>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-input100 validate-input bg1 activity" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>活動項目：
                        </span>
                        <input class="input100" type="text" name="add_acname" placeholder="輸入活動項目!">
                    </div>
                    <div class="wrap-input100 input100-select bg1 type" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>類型：
                        </span>
                        <div>
                            <select class="js-select2" name="add_actype">
                                <?php
                                    foreach ($active_type as $key => $type) {
                                ?>
                                    <option value="<?=$type['type_id']?>"><?=$type['name']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>
                    <div class="wrap-input100 bg1 rs1-wrap-input100 weather" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>天氣：
                        </span>
                        <div class="col align-items-strat">
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
                    <div class="wrap-input100 bg1 rs1-wrap-input100 drive" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>車程(小時)：
                        </span>
                        <input class="input100" type="text" name="add_acdrive" placeholder="輸入車程!" value="" size="2"  
                                onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div class="wrap-input100 validate-input bg1 carry" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>攜帶物品：
                        </span>
                        <input class="input100" type="text" name="add_accarry" placeholder="輸入攜帶物品!">
                    </div>
                    <div class="wrap-input100 validate-input bg1 rs3-wrap-input100 bg1 spend" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>花費(元)：
                        </span>
                        <input class="input100" type="text" name="add_acspend" placeholder="輸入數字!" value="" size="2"  
                                onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div class="wrap-input100 validate-input bg1 rs3-wrap-input100 bg1 time" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>時間(小時)：
                        </span>
                        <input class="input100" type="text" name="add_achours" placeholder="輸入數字!" value="" size="2"  
                                onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div class="wrap-input100 validate-input rs3-wrap-input100 bg1 timetype" style="display:none;">
                        <span>
                            <label style="color:red;">*</label>時段：
                        </span>
                        <div class="col align-items-strat">
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
                    <div class="container-contact100-form-btn btn-end">
                        <div class="row">
                            <div class="col-sm-4 col-md-2">
                                <input type="button" class="btn btn-primary preview" style="display:none;" name="addactivity" value="新增" onClick="insert()" />
                                <input type="button" class="btn btn-primary" style="display:none;" name="up_submit" value="儲存" onClick="update()" />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="add_acid" value=""/>
                    <input type="hidden" name="add_activitys" />
                    <input type="hidden" name="up_activitys" />
                    <input type="hidden" name="Responsive_Button" />
                </div>
            </div>
        </form>
    </div>
</body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        var table = $('#example1').DataTable(datatable_language());
        var button = table.button();
        if($(window).width() <= 768){
            reload_activity();
        }

        $(window).resize(function() {
            if($(window).width() <= 768){
                reload_activity();
            }
        });


        // $('#example1').on('click', '.colvisButton', function(e){
        //     $("button.dt-button.buttons-columnVisibility.active").each(function(){
        //         if($(this).text()=="車程(小時)"){
        //             $("#drive").show();
        //             $(".ac_drive").show();
        //         }
        //     });
        // });
        
        // $("button.dt-button.buttons-columnVisibility.active").each(function(){
        //     $(this).toggle(
        //         function(){
        //             if($(this).text==="車程(小時)"){
        //                 $("#drive").show();
        //                 $(".ac_drive").show();
        //             }
        //         }
        //     );
        // });

        // $("button.dt-button.buttons-collection.buttons-colvis.colvisButton").toggle(
        //     function(){
        //         $("button.dt-button.buttons-columnVisibility.active").each(function(){
        //             if($(this).text==="車程(小時)"){
        //                 $("#drive").show();
        //                 $(".ac_drive").show();
        //             }
        //         });
        //     }
        // );



        if($("input[name='admin']").val()=="Y"){
            $("input[name='add']").show();
        }

        var drive,spend,time;
        drive = $("#drive").text();
        spend = $("#spend").text();
        time = $("#time").text();

        var d = $("td .ac_drive").html();

        //必需要點開隱藏選項，才能取得項目按鈕元素
        // if($(window).width() < 768){
        //     $(".dt-button").each(function(index) { 
        //         alert($(this).text());
        //     });
        // }


        // if($(window).width() < 768){
        //     $("#drive").hide();
        //     $(".ac_drive").hide();
        //  寫remove 標籤
        //  dt-button buttons-columnVisibility active 改成dt-button buttons-columnVisibility
        //  就可以更換按鈕樣式
        // }else{
        //  寫append 標籤
        // dt-button buttons-columnVisibility 改回 dt-button buttons-columnVisibility active
        // }
         


    } );


    // $("button.dt-button.active").each(function(){
    //     $(this).on('active:not(.disabled):hover:not(.disabled)', function(e){
    //         if($(this).text() == "車程(小時)") {
    //             $("#drive").show();
    //             $(".ac_drive").show();
    //         }
    //     });
    // });

    $(".js-select2").each(function(){
		$(this).select2({
			minimumResultsForSearch: 20,
			dropdownParent: $(this).next('.dropDownSelect2')
		});


		$(".js-select2").each(function(){
			$(this).on('select2:close', function (e){
				if($(this).val() == "Please chooses") {
					$('.js-show-service').slideUp();
				} else {
					$('.js-show-service').slideUp();
					$('.js-show-service').slideDown();
				}
			});
		});
	})

    function reload_activity(){
        $("button.dt-button.buttons-collection.buttons-colvis.colvisButton").click();
        $("button.dt-button.buttons-columnVisibility.active").each(function(){
            if($(this).text()=="車程(小時)" || $(this).text()=="花費" || $(this).text()=="時間(小時)"){
                $(this).click();
            }
        });
        $(".dt-button-background").remove();
        $(".dt-button-collection").hide();
    }
        

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
        $(".time").show();
        $(".timetype").show();
        $("input[name='addactivity']").show();
        $(".wrap-contact100").show();

        if($("#add").is(":visible")){
            $("#addbutton").css("display", "none");
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
        $(".wrap-contact100").hide();


        var Responsive_Button = $("input[name='Responsive_Button']").val();
        if(Responsive_Button == "true"){
            $("#img").show();
        }else{
            $("#addbutton").show();
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
                return SweetAlertMessage( "請輸入活動項目!");
            }

            if(add_acweather==false){
                return SweetAlertMessage("請至少打勾一項天氣!");
            }

            if(add_acdrive==""){
                return SweetAlertMessage("請輸入車程欄位!");
            }else if(add_acdrive=="0"){
                return SweetAlertMessage("請至少輸入1小時!");
            }

            if(add_accarry==""){
                return SweetAlertMessage("請輸入攜帶物品!");
            }

            if(add_acspend==""){
                return SweetAlertMessage("請輸入花費欄位!");
            }

            if(add_achours==""){
                return SweetAlertMessage("請輸入時間欄位!");
            }else if(add_achours=="0"){
                return SweetAlertMessage("請至少輸入1小時!");
            }

            if(add_actimetype==false){
                return SweetAlertMessage("請至少打勾一項時段!");
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
                return SweetAlertMessage("請輸入活動項目!");
            }

            if(add_acweather==false){
                return SweetAlertMessage("請至少打勾一項天氣!");
            }

            if(add_acdrive==""){
                return SweetAlertMessage("請輸入車程欄位!");
            }else if(add_acdrive=="0"){
                return SweetAlertMessage("請至少輸入1小時!");
            }

            if(add_accarry==""){
                return SweetAlertMessage("請輸入攜帶物品!");
            }

            if(add_acspend==""){
                return SweetAlertMessage("請輸入花費欄位!");
            }

            if(add_achours==""){
                return SweetAlertMessage("請輸入時間欄位!");
            }else if(add_achours=="0"){
                return SweetAlertMessage("請至少輸入1小時!");
            }

            if(add_actimetype==false){
                return SweetAlertMessage("請至少打勾一項時段!");
            }
        }

        document.showForm.action="update_activity.php"; 
        document.showForm.submit();
    }
  </script>
</html>

