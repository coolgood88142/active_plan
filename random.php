<html>
  <head>
    <title>規劃行程系統</title>
  </head>
<?php session_start();
    $islogin=false;$us_admin = "";
    include("checklogin.php");
    include("mysql.php");
    if($islogin){
        if(isset($_SESSION["us_admin"])){
            $us_admin = $_SESSION['us_admin'];
            include("select_plan.php");
            include("select_random.php");
        }
    }else{
        exit;
    }

    if(isset($_SESSION["us_id"]) && isset($_SESSION["us_name"])){
        $pt_usid = $_SESSION['us_id'];
        $pt_usname = $_SESSION['us_name'];
    }else if(!empty($_COOKIE['us_id']) && !empty($_COOKIE['us_name'])){
        $pt_usid = $_COOKIE['us_id'];
        $pt_usname = $_COOKIE['us_name'];
    }

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

    $post_actimetype = "";
    if(isset($_POST['post_actimetype']) && $_POST['post_actimetype']!=""){
        $post_actimetype =  $_POST['post_actimetype'];
        $post_actimetype =substr($post_actimetype,0,-1);
        $post_actimetype = explode(",", $post_actimetype);
    }

    $post_pnorderby = "";
    if(isset($_POST['post_pnorderby']) && $_POST['post_pnorderby']!=""){
        $post_pnorderby =  $_POST['post_pnorderby'];
        $post_pnorderby =substr($post_pnorderby,0,-1);
        $post_pnorderby = explode(",", $post_pnorderby);
    }

    $is_query = "";
    if(isset($_POST['is_query'])){
        $is_query =  $_POST['is_query'];    
    }

 ?>
 <?php include("link.php");?>
 <link rel="stylesheet" href="./assets/css/datepicker3.css"/>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="./assets/js/bootstrap-datetimepicker.zh-TW.js" charset="UTF-8"></script>
<script src="./vendor/select2/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./assets/fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="./vendor/select2/select2.min.css">
<link rel="stylesheet" href="./assets/css/util.css">
<link rel="stylesheet" href="./assets/css/main.css">
<link rel="stylesheet" href="./assets/css/myStyle.css">
  <body>
    <style>
        .wrap-contact100{
            background : #ffffff;
            border-color : rgb(63,169,221);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            overflow: inherit;
        }
        .wrap-input100{
            border-color : rgb(63,169,221);
            border-radius: 13px;
            padding: 10px 30px 9px 22px;
            margin-bottom: 20px;
            position: relative;
            font-family: '微軟正黑體';
        }
        .plan,.date{
            font-size:24px;
            margin-top:30px;
        }
        @media screen and (max-width: 768px) {
            .jumbotron,.btn{
                font-size:14px;
            }
            #title{
                font-size:28px;
            }
            .plan,.date{
                font-size:20px;
            }
        }
        .titletext{
            font-size: 18px;
        }
        .accordion .card-header:after {
            font-family: 'FontAwesome';  
            content: "\f068";
            float: right; 
        }
        .accordion .card-header.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\f067"; 
        }
        #show_select{
            background: rgb(63,169,221);
            border-color : rgb(63,169,221);
        }
        #show_select .card-header.collapsed{
            background: #FFFFFF;
            color:#000000;
        }
        #show_select .card-header{
            color:#FFFFFF;
        }
        .wrap-border{
            border-radius: 10px;
            background:rgb(0,166,218);
            padding:1.5px;
        }
        /* @media (min-width: 1200px){
            .datetext{
                max-width:12%
            }
        }

        @media (min-width: 768px) {
            .col-md-3{
                max-width:25%
            }
        } */

        /* @media (min-width: 992px) {
            .col-lg-2{
                max-width: 14.4%;
            }
        } */
        
    </style>
    <div id="navbar"></div>
    <div class="jumbotron container bg-white side-collapse-container-left">
        <form name="showForm" action="<?php echo "select_random.php" ?>"method="post">
            <div class="col-md-12" style="top: 50px;">
                <h2 class="text-center font-weight-bold" style="margin-bottom:20px;">隨機行程</h2>
                <input type="hidden" name="admin" value="<?=$us_admin?>"/>
                <input type="hidden" name="pt_usid" value="<?=$pt_usid?>"/>
                <input type="hidden" name="pt_usname" value="<?=$pt_usname?>"/>
                <input type="hidden" id="is_query" value="<?=$is_query?>"/>
                <input type="hidden" id="post_day" value="<?=$post_day?>"/>
                <input type="hidden" id="post_typeid" value="<?=$post_typeid?>"/>
                <input type="hidden" id="post_daytime" value="<?=$post_daytime?>"/>
                <input type="hidden" id="post_timetype" value="<?=$post_timetype?>"/>
    
                <div id="accordion" class="accordion">
                    <div class="card mb-0" id="show_select">
                        <div class="card-header" data-toggle="collapse" href="#collapseExample">
                            <a class="titletext font-weight-bold card-title">
                                顯示表單
                            </a>
                        </div>
                    </div>

                    <div class="wrap-border">
                        <div id="collapseExample" class="card-body collapse show wrap-contact100" data-parent="#accordion" style="width:100%">
                            <div class="wrap-input100 bg1 rs1-wrap-input100 weather">
                                <span>
                                    <label style="color:red;">*</label>類型：
                                </span>
                                <div class="col">
                                <?php 
                                    foreach($types as $key => $value){
                                        $type_id = $value['type_id'];
                                        $name = $value['name'];
                                ?>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="typeid[]" value="<?=$type_id?>">
                                        <label class="form-check-label"><?php echo $name ?></label>
                                    </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="wrap-input100 bg1 rs1-wrap-input100 day">
                                <span>
                                    <label style="color:red;">*</label>天數：
                                </span>
                                <input class="input100" type="text" name="day" value="" size="2" placeholder="輸入天數!">
                            </div>
                            <div class="wrap-input100 bg1 rs1-wrap-input100 day_time">
                                <span>
                                    <label style="color:red;">*</label>天數小時：
                                </span>
                                <input class="input100" type="text" name="day_time" value="" placeholder="輸入天數小時!">
                                <input type="hidden" name="istime_type" value="" size="2"/>
                            </div>
                            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 userlist" style="display:none;">
                                <span>
                                    <label style="color:red;">*</label>使用者名稱：
                                </span>
                                <select class="js-select2" name="pt_userlist">
                                    <?php
                                        if($us_admin=='Y'){
                                            foreach($user as $key => $value){
                                    ?>
                                                <option value='<?php echo $value["us_id"]?>'><?php echo $value["us_name"]?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="wrap-input100 bg1 rs1-wrap-input100 time" style="display:none;">
                                <span>
                                    <label style="color:red;">*</label>時段選項：
                                </span>
                                <div>
                                    <select class="js-select2" name="time_type">
                                        <option value="*">全部</option>
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
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                            <div class="container-contact100-form-btn justify-content-end">
                                <input type="submit" class="btn btn-primary" name="gorandom" value="執行"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="plan">
                    <div class="row justify-content-start align-items-start">
                        <label class="col-sm-3 col-md-3 col-lg-2 col-lg-2 datetext control-label">行程名稱：</label>
                        <div class="col">
                          <input type="text" class="form-control" name="plan_name">
                        </div>
                    </div>
                </div>
                <div class="date">
                    <div class="row justify-content-start align-items-start">
                        <label class="col-sm-3 col-md-3 col-lg-2 datetext control-label">出發日期：</label>
                        <div class="col">
                          <input type="text" class="form-control" name="plan_date" data-provide="datepicker">
                        </div>
                    </div>
                </div>
                <br/>
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>天數排序</td>
                            <td>活動項目</td>
                            <td>類型</td>
                            <td>天氣</td>
                            <td>車程(小時)</td>
                            <td>攜帶物品</td>
                            <td>花費</td>
                            <td>時間(小時)</td>
                            <td>地址</td>
                            <td style="display:none;">動作</td>
                            <td style="display:none;">類型ID</td>
                            <td>時段</td>   
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($count>0){
                                for($i=0 ; $i<$count ; $i++) {
                        ?>
                            <tr>
                                <td class="pn_orderby">
                                    第<?php echo $post_pnorderby[$i]?>天
                                </td>
                                <td class="ac_name">
                                    <?php echo $post_acname[$i]?>
                                </td>
                                <td class="type_name">
                                    <?php echo $post_actype[$i]?>
                                </td>
                                <td class="ac_weather">
                                    <?php echo $post_acweather[$i]?>
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
                                <td class="pn_address<?=$i?>" align="center">
                                    <span data-toggle="modal" data-target="#myModal">
                                        <img src="./assets/images/magnifier.png" alt="" id="magnifier" name="magnifier" class="img-thumbnail" data-toggle="tooltip"  title="" onClick="openAddressMap('','<?=$i?>')"/>
                                    </span>
                                </td>
                                <td class="run" style="display:none;">
                                   <input type="hidden" name="in_address<?=$i?>" value="">
                                </td>
                                <td class="ac_id" style="display:none;">
                                    <?php echo $post_acid[$i]?>
                                </td>
                                <td class="ac_timetype">
                                    <?php echo $post_actimetype[$i]?>
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
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center font-weight-bold" id="myModalLabel">地址地圖</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6>地址:</h6><input type="text" class="copy_address" name="copy_address" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div id="map" name="map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="text" class="form-control" name="address" value=""/>
                            <button type="button" class="btn btn-primary" onClick="openAddressMap()">查詢</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="saveAddress()">儲存後關閉</button>
                        </div>
                        </div>
                    </div>
                    <input type="text" name="no_address" style="display:none;" value="">
                </div>
                <div style="text-align:right">
                    <input type="button" class="btn btn-primary" name="goplan" value="送出" onClick="go_plan()"/>
                </div>
            </div>
        </form>
    </div>
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
        <input type="hidden" name="ad_pnorderby" />
        <input type="hidden" name="pn_address" />

        <input type="hidden" name="plan_name" /> 
        <input type="hidden" name="plan_date" />

        <input type="hidden" name="us_id" />
        <input type="hidden" name="us_name" />
        <input type="hidden" name="newplan" value="true"/>
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        $('#example1').DataTable(datatable_language());
        $('#example1_wrapper').hide();
        $("input[name='goplan']").hide();
        $(".plan").hide();
        $(".date").hide();
        $(".time").hide();
        $(".userlist").hide();
        openDate($("input[name='plan_date']"));

        if($("#is_query").val()=="true"){
            $('#example1_wrapper').show();
            $(".plan").show();
            $(".date").show();
            $("input[name='goplan']").show();
            
        }

        if($("input[name='admin']").val()=="Y"){
            $(".userlist").show();
        }

        var post_day = $("#post_day").val();
        var post_daytime = $("#post_daytime").val();
        $("input[name='day']").val(post_day);
        $("input[name='day_time']").val(post_daytime);

        var post_typeid = $("#post_typeid").val();
        post_typeid = post_typeid.split(",");
        for(var i=0;i<post_typeid.length;i++){
            $("input[name='typeid[]']").each(function() {
                if($(this).val()==post_typeid[i]){
                    $(this).prop("checked", true);
                }
            });
        }

        var post_timetype = $("#post_timetype").val();
        $("select[name='time_type']").find("option[value='"+ post_timetype +"']").attr("selected",true);
        if(parseInt(post_daytime)<8){
            $(".time").show();
            $("input[name='istime_type']").val('Y');
        }else{
            $(".time").hide();
        }

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

        $('#myModal').on('hidden.bs.modal', (function() {
            //每關閉時清空
            $("input[name='address']").val('');
        }));

    } );

    $("input[name='day']").on('keyup', function() {
        if(this.value == "0"){
            this.value = "";
            SweetAlertMessage("請天數輸入0以上!");
        }
        if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
            this.value = this.value.replace(/[^0-9\.]/g, '');
            SweetAlertMessage("請天數輸入數字!");
        }
    });

     $("input[name='day_time']").on('keyup', function() {
        if(this.value == "0"){
            this.value = "";
            SweetAlertMessage("請天數小時輸入0以上!");
        }
        if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
            this.value = this.value.replace(/[^0-9\.]/g, '');
            SweetAlertMessage("請天數小時輸入數字!");
        }

        var day = $("input[name='day']").val();
        var day_time = parseInt(this.value);
        var max_dayhours = 0;

        if(day>0){
            for(var i=0; i<day; i++){
            max_dayhours = max_dayhours + 24;
            }

            if(day_time>max_dayhours){
                this.value = "";
                SweetAlertMessage("請輸入天數適當的小時!");
            }
        }

        if(day_time<8){
            $(".time").show();
            $("input[name='istime_type']").val('Y');
        }else{
            $(".time").hide();
        }

    });

    function openDate(name){
        $(name).datepicker({
        uiLibrary: 'bootstrap4',
            format: "yyyy-mm-dd",
            language:"zh-TW",
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            utoclose: true,
            todayHighlight: true,
        });
    }

    function go_plan(){
        if($('#example1_wrapper').is(':visible')){
            var ad_acname="",ad_typename="",ad_acweather="",ad_acdrive="",ad_accarry="",ad_acspend=0,ad_achours=0,ad_acid="",ac_id="",ad_hours="",ad_pnorderby="",pn_address="";
            var from = $("form[name='updateForm']");
            var row = $("#example1 .ac_id");
            if(row.length>0){
                var no = 0;
                $(row).each(function() {
                    var obj = $(this).closest("tr");
                    ad_acname = ad_acname + obj.find(".ac_name").text().trim() + ",";
                    ad_typename = ad_typename + obj.find(".type_name").text().trim() + ",";
                    ad_acweather = ad_acweather + obj.find(".ac_weather").text().trim() + ",";
                    ad_acdrive = ad_acdrive + obj.find(".ac_drive").text().trim() + ",";
                    ad_accarry = ad_accarry + obj.find(".ac_carry").text().trim() + ",";

                    var pnorderby = obj.find(".pn_orderby").text().trim();
                    pnorderby = pnorderby.substring(1, pnorderby.length-1);
                    ad_pnorderby = ad_pnorderby + pnorderby + ",";

                    var spend = obj.find(".ac_spend").text().trim();
                    spend = parseInt(spend.substring(0, spend.length-1));
                    ad_acspend = ad_acspend + spend;

                    var hours = parseInt(obj.find(".ac_hours").text().trim());
                    ad_achours = ad_achours + hours;
                    ad_hours = ad_hours + hours + ",";
                    ad_acid = ad_acid + obj.find(".ac_id").text().trim() + ",";

                    pn_address = pn_address + obj.find(".run input[name='in_address"+no+"']" ).val() + ",";
                    no++;
                });
            }

            ad_acname = ad_acname.substring(0, ad_acname.length-1);
            ad_typename = ad_typename.substring(0, ad_typename.length-1);
            ad_acweather = ad_acweather.substring(0, ad_acweather.length-1);
            ad_acdrive = ad_acdrive.substring(0, ad_acdrive.length-1);
            ad_accarry = ad_accarry.substring(0, ad_accarry.length-1);
            ad_hours = ad_hours.substring(0, ad_hours.length-1);
            ad_acid = ad_acid.substring(0, ad_acid.length-1);
            ad_pnorderby = ad_pnorderby.substring(0, ad_pnorderby.length-1);
            pn_address = pn_address.substring(0, pn_address.length-1);

            $(from).find("input[name='ad_acname']").val(ad_acname);
            $(from).find("input[name='ad_typename']").val(ad_typename);
            $(from).find("input[name='ad_acweather']").val(ad_acweather);
            $(from).find("input[name='ad_acdrive']").val(ad_acdrive);
            $(from).find("input[name='ad_accarry']").val(ad_accarry);
            $(from).find("input[name='ad_acspend']").val(ad_acspend);
            $(from).find("input[name='ad_achours']").val(ad_achours);
            $(from).find("input[name='ad_hours']").val(ad_hours);
            $(from).find("input[name='ad_acid']").val(ad_acid);
            $(from).find("input[name='ad_pnorderby']").val(ad_pnorderby);
            $(from).find("input[name='pn_address']").val(pn_address);

            var plan_name = $("input[name='plan_name']").val();
            var plan_date = $("input[name='plan_date']").val();

            if(plan_name==""){
                return SweetAlertMessage("請輸入行程名稱!");
            }else if(plan_date==""){
                return SweetAlertMessage("請輸入出發日期!");
            }else if(!plan_date.match("^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02/(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$")){
                return SweetAlertMessage("出發日期格式錯誤!");
            }

            var day = $("input[name='day']").val();
            var day_time = $("input[name='day_time']").val();
            var max_dayhours = 0;

            if(day>0){
                for(var i=0; i<day; i++){
                    max_dayhours = max_dayhours + 24;
                }

                if(day_time>max_dayhours){
                    this.value = "";
                    return SweetAlertMessage("請輸入天數適當的小時!");
                }
            }

            if(day_time<8){
                $(".time").show();
                $("input[name='istime_type']").val('Y');
            }else{
                $(".time").hide();
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
        if($("input[name='admin']").val()=="Y" && (page=="setting" || page=="question")){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>
