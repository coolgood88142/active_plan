<html>
  <head>
    <title>規劃行程系統</title>
  </head>
<?php include("link.php");?>
<link rel="stylesheet" href="./assets/css/datepicker3.css"/>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="./assets/js/bootstrap-datetimepicker.zh-TW.js" charset="UTF-8"></script>
<script src="./vendor/select2/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./assets/fonts/iconic/css/material-design-iconic-font.min.css">
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
            include("select_plan.php");
            include("select_activity.php"); 
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
        .wrap-contact100{
            background : #ffffff;
            border-color : rgb(63,169,221);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            overflow: inherit;
        }
        .wrap-input100{
            border: 1px solid rgb(63,169,221);
            border-radius: 13px;
            padding: 10px 30px 9px 22px;
            margin-bottom: 20px;
            position: relative;
            font-family: '微軟正黑體';
        }
        @media screen and (max-width: 768px) {
            .jumbotron,.btn,.form-control{
                font-size:14px;
            }
            #title{
                font-size:28px;
            }
            #addplan{
                display: none;
            }
        }
        .titletext{
            font-size: 18px;
        }
        .accordion .card-header:after {
            font-family: 'FontAwesome';  
            content: "\f068";
            float: right; 
            font-size: 18px;
        }
        .accordion .card-header.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\f067"; 
            font-size: 18px;
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
            background:rgb(63,169,221);
            padding:1px;
        }
    </style>
    <div id="navbar"></div>
    <div class="jumbotron container bg-white side-collapse-container-left">
        <form name="showForm" method="post">
            <div class="col-md-12 col-from">
                <h2 id="title" class="text-center font-weight-bold" style="margin-bottom:20px;">行程列表</h2>
                <input type="hidden" name="admin" value="<?=$us_admin?>"/>
                <!-- <input type="button" name="back" value="回上一頁" onClick="back_page()"/> -->
                <div id="addbutton" style="text-align:right">
                    <img src="./assets/images/add.png" alt="" id="img" name="img" class="img-thumbnail d-md-none" onClick="add_plan()">
                    <input type="button" class="btn btn-primary d-none d-md-inline d-sm-none" style="margin-bottom:20px;" id="addplan" name="addplan" value="新增" onClick="add_plan()"/>
                </div>
                <div id="accordion" class="accordion" style="display:none;">
                    <div class="card mb-0" id="show_select">
                        <div class="card-header" data-toggle="collapse" href="#collapseExample">
                            <a class="titletext font-weight-bold card-title">
                                顯示表單
                            </a>
                        </div>
                    </div>
                    <div class="wrap-border">
                        <div id="collapseExample" class="card-body collapse show wrap-contact100" data-parent="#accordion" style="width:100%">
                            <div class="wrap-input100 validate-input bg1 plan" style="margin-top:20px;">
                                <span>
                                    <label style="color:red;">*</label>行程名稱：
                                </span>
                                <input class="input100" type="text" name="plan_name" placeholder="輸入行程名稱!">
                            </div>
                            <div class="wrap-input100 bg1 rs1-wrap-input100 date">
                                <span>
                                    <label style="color:red;">*</label>出發日期：
                                </span>
                                <input class="input100" type="text" name="plan_date" placeholder="輸入出發日期!">
                            </div>
                            <input type="hidden" name="pt_usid" value="<?=$pt_usid?>"/> 
                            <input type="hidden" name="pt_usname" value="<?=$pt_usname?>"/>   
                            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 userlist">
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
                            <input type="hidden" name="pt_usid" value="<?=$pt_usid?>"/>
                        </div>
                    </div>
                </div>
                <br/>

                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td></td>
                            <td>姓名</td>
                            <td>行程數量</td>
                            <td>編輯設定</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($us_admin=='Y'){
                            foreach ($plan_count as $key => $count) {
                                if($count["pt_count"]>0){      
                        ?>
                        <tr>
                            <td class=" details-control"></td>
                            <td class="us_name">
                                <?php echo $count["us_name"]?>
                            </td>
                            <td class="pt_count">
                                <?php echo $count["pt_count"]?>
                            </td>
                            <td class="pt_plan">
                                <input type="button" class="btn btn-primary" value="編輯" onClick="edit_plan(this)"/>
                            <?php
                                foreach ($plan as $key => $value) {
                                    if($value["pt_usid"]==$count["us_id"]){
                            ?>       
                                        <input type="hidden" name="pt_id" value="<?=$value["pt_id"]?>"/>
                                        <input type="hidden" name="pt_usid" value="<?=$value["pt_usid"]?>"/>
                                        <input type="hidden" name="pt_usname" value="<?=$value["pt_usname"]?>"/>
                                        <input type="hidden" name="pt_name" value="<?=$value["pt_name"]?>"/>
                                        <input type="hidden" name="pt_date" value="<?=$value["pt_date"]?>"/>
                                        <input type="hidden" name="pt_hours" value="<?=$value["pt_hours"]?>"/>
                                        <input type="hidden" name="pt_spend" value="<?=$value["pt_spend"]?>"/>
                                        <input type="hidden" name="pt_status" value="<?=$value["pt_status"]?>"/>

                            <?php
                                        foreach ($plan_trip as $key => $trip) {
                                            if($trip["pt_id"]==$value["pt_id"]){
                            ?>
                                                <input type="hidden" name="pn_ptid" value="<?=$trip["pn_ptid"]?>"/>
                                                <input type="hidden" name="pn_id" value="<?=$trip["pn_id"]?>"/>
                                                <input type="hidden" name="pn_acname" value="<?=$trip["pn_acname"]?>"/>
                                                <input type="hidden" name="pn_address" value="<?=$trip["pn_address"]?>"/>
                                                <input type="hidden" name="ac_type" value="<?=$trip["ac_type"]?>"/>
                                                <input type="hidden" name="ac_weather" value="<?=$trip["ac_weather"]?>"/>
                                                <input type="hidden" name="ac_drive" value="<?=$trip["ac_drive"]?>"/>
                                                <input type="hidden" name="ac_carry" value="<?=$trip["ac_carry"]?>"/>
                                                <input type="hidden" name="ac_spend" value="<?=$trip["ac_spend"]?>"/>
                                                <input type="hidden" name="ac_hours" value="<?=$trip["ac_hours"]?>"/>
                                                <input type="hidden" name="ac_id" value="<?=$trip["ac_id"]?>"/>
                            <?php
                                            }
                                        }
                                    }
                                }
                            ?>
                            </td>

                            <?php 
                                }
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

                <table id="example4" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <?php
                                if($us_admin!='Y'){
                            ?>
                                <td></td>
                                <td style="display:none;">user_id</td>
                                <td style="display:none;">user_name</td>
                            <?php
                                }
                            ?>
                            <td style="display:none;">行程ID</td>
                            <td>行程名稱</td>
                            <td>出發日期</td>
                            <td>時間(小時)</td>
                            <td>花費</td>
                            <td>已完成</td>
                            <td>編輯設定</td>
                        </tr>  
                    </thead>
                    <tbody>
                    <?php
                        if($us_admin!='Y'){
                            foreach ($plan as $key => $value) {
                    ?>
                        <tr>
                            <td class=" details-control"></td>
                            <td class="pt_usid" style="display:none;">
                                <?php echo $value["pt_usid"]?>
                            </td>
                            <td class="pt_usname" style="display:none;">
                                <?php echo $value["pt_usname"]?>
                            </td>
                            <td class="pt_id" style="display:none;">
                                <?php echo $value["pt_id"]?>
                            </td>
                            <td class="pt_name">
                                <?php echo $value["pt_name"]?>
                            </td>
                            <td class="pt_date">
                                <?php echo $value["pt_date"]?>
                            </td>
                            <td class="pt_hours">
                                <?php echo $value["pt_hours"]?>
                            </td>
                            <td class="pt_spend">
                                <?php echo $value["pt_spend"]?>元
                            </td>
                            <td class="pt_status">
                                <?php 
                                    if($value["pt_status"]==2){
                                        echo "V";
                                    }
                                ?>
                            </td>

                            <td>
                                <input type="button" class="btn btn-primary" value="編輯" onClick="edit(this)"/>
                            <?php
                                foreach ($plan_trip as $key => $trip) {
                                    if($trip["pt_id"]==$value["pt_id"]){
                            ?>

                                        <input type="hidden" name="pn_id" value="<?=$trip["pn_id"]?>"/>
                                        <input type="hidden" name="pn_acname" value="<?=$trip["pn_acname"]?>"/>
                                        <input type="hidden" name="ac_type" value="<?=$trip["ac_type"]?>"/>
                                        <input type="hidden" name="ac_weather" value="<?=$trip["ac_weather"]?>"/>
                                        <input type="hidden" name="ac_drive" value="<?=$trip["ac_drive"]?>"/>
                                        <input type="hidden" name="ac_carry" value="<?=$trip["ac_carry"]?>"/>
                                        <input type="hidden" name="ac_spend" value="<?=$trip["ac_spend"]?>"/>
                                        <input type="hidden" name="ac_hours" value="<?=$trip["ac_hours"]?>"/>
                                        <input type="hidden" name="ac_id" value="<?=$trip["ac_id"]?>"/>
                                        <input type="hidden" name="pn_address" value="<?=$trip["pn_address"]?>"/>
                            <?php
                                    }
                                }
                            ?>
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

                <table id="example2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>活動項目</td>
                        <td>類型</td>
                        <td>天氣</td>
                        <td style="display:none;">天氣ID</td>
                        <td>車程(小時)</td>
                        <td>攜帶物品</td>
                        <td>花費</td>
                        <td>時間(小時)</td>
                        <td>加入</td>
                        <td style="display:none;">類型ID</td>
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
                        <td>
                            <input type="checkbox" name="add" >
                        </td>
                        <td class="ac_id" style="display:none;">
                            <?php echo $value["ac_id"]?>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>

            <table id="example3" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>活動項目</td>
                        <td>類型</td>
                        <td>天氣</td>
                        <td style="display:none;">天氣ID</td>
                        <td>車程(小時)</td>
                        <td>攜帶物品</td>
                        <td>花費</td>
                        <td>時間(小時)</td>
                        <td>地址</td>
                        <td>動作</td>
                        <td style="display:none;">類型ID</td>
                    </tr>
                </thead>
                <tbody>
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
                        <img src="./assets/images/copy.png" alt="" id="copy" name="copy" class="img-thumbnail" data-toggle="tooltip" title="複製" onClick="copyAddress()"/>
                    </div>
                    </div>
                </div>
                <input type="text" name="no_address" style="display:none;" value="">
            </div>
            <br/>
            <div style="text-align:right">
                <input type="button" class="btn btn-primary" name="addactivity" value="新增" onClick="add_activity()"/>
                <input type="button" class="btn btn-primary" name="goplan" value="送出" onClick="go_plan()"/>
            </div>
        </div>
        <input type="hidden" name="Responsive_Button" />
    </form>
    <form action="update_plan.php" name="updateForm" method="post">
        <input type="hidden" name="type" />
        <input type="hidden" name="isdelete" /> 

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
        <input type="hidden" name="pt_usid" />
        <input type="hidden" name="pt_usname" />
        <input type="hidden" name="pn_address" />

        <input type="hidden" name="us_id" />
        <input type="hidden" name="us_name" />
        <input type="hidden" name="newplan" value="true"/>
    </form>
    <form action="plan_edit.php" name="submitForm" method="post">
        <input type="hidden" name="pt_id" />
        <input type="hidden" name="pt_usid" />
        <input type="hidden" name="pt_usname" />
        <input type="hidden" name="pt_name" />
        <input type="hidden" name="pt_date" />
        <input type="hidden" name="pn_id" />
        <input type="hidden" name="pn_acname" />
        <input type="hidden" name="ac_type" />
        <input type="hidden" name="ac_weather" />
        <input type="hidden" name="ac_drive" />
        <input type="hidden" name="ac_carry" />    
        <input type="hidden" name="ac_spend" />    
        <input type="hidden" name="ac_hours" />
        <input type="hidden" name="ac_id" />
        <input type="hidden" name="pn_address" />
    </form>
  </div>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        $('#link').load('link.php');
        $('#example3').DataTable(datatable_language());
        $('#example3_wrapper').hide();
        $('#example2').DataTable(datatable_language());
        $('#example2_wrapper').hide();
        $('#example4').DataTable(datatable_language());
        $('#example4_wrapper').hide();
        $("input[name='goplan']").hide();
        $("input[name='addactivity']").hide();
        $(".plan").hide();
        $("input[name='plan_name']").hide();
        $(".date").hide();
        $("input[name='plan_date']").hide();
        $(".userlist").hide();
        $("select[name='pt_userlist']").hide();
        $("input[name='back']").hide();
        $(".add_activityText").hide();
        $(".check_activity").hide();
        $("#accordion").hide();
        openDate($("input[name='plan_date']"));
        
        $('#example1').DataTable(datatable_language());
        $('#example1 tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = $('#example1').DataTable().row( tr );
            
            var pt_usid = [],pt_name = [],pt_date = [],pt_hours = [],pt_spend = [],pt_status = [];
            $(tr).find("td input[name='pt_usid']").each(function(){
                pt_usid.push($(this).val());
            })
            $(tr).find("td input[name='pt_name']").each(function(){
                pt_name.push($(this).val());
            })
            $(tr).find("td input[name='pt_date']").each(function(){
                pt_date.push($(this).val());
            })
            $(tr).find("td input[name='pt_hours']").each(function(){
                pt_hours.push($(this).val());
            })
            $(tr).find("td input[name='pt_spend']").each(function(){
                pt_spend.push($(this).val());
            })
            $(tr).find("td input[name='pt_status']").each(function(){
                pt_status.push($(this).val());
            })
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child( format_admin(pt_usid,pt_name,pt_date,pt_hours,pt_spend,pt_status) ).show();
                tr.addClass('shown');
            }
        } );

        $("#example2 tbody tr").click(function(){
            var add = $(this).find("td input[name='add']");
            
            if($(add).is(":checked")){
                $(add).prop("checked",false);
                $(this).css("background","");
            }else{
                $(add).prop("checked",true);
                $(this).css("background","rgb(63,169,221)");
            }
        });

        if($("input[name='admin']").val()!='Y'){
            $('#example1_wrapper').hide();
            $('#example4_wrapper').show();
            $('#example4').DataTable();
            $('#example4 tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = $('#example4').DataTable().row( tr );
            
            var pn_acname = [],ac_type = [],ac_weather = [],ac_drive = [],ac_carry = [],ac_spend = [],ac_hours = [],type = [];
            $(tr).find("td input[name='pn_acname']").each(function(){
                pn_acname.push($(this).val());
            })
            $(tr).find("td input[name='ac_type']").each(function(){
                ac_type.push($(this).val());
            })
            $(tr).find("td input[name='ac_weather']").each(function(){
                ac_weather.push($(this).val());
            })
            $(tr).find("td input[name='ac_drive']").each(function(){
                ac_drive.push($(this).val());
            })
            $(tr).find("td input[name='ac_carry']").each(function(){
                ac_carry.push($(this).val());
            })
            $(tr).find("td input[name='ac_spend']").each(function(){
                ac_spend.push($(this).val());
            })
            $(tr).find("td input[name='ac_hours']").each(function(){
                ac_hours.push($(this).val());
            })
            $(tr).find("td input[name='type']").each(function(){
                type.push($(this).val());
            })
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child( format_user(pn_acname,ac_type,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours,type) ).show();
                tr.addClass('shown');
            }
            } );
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

    function openDate(name){
    $(name).datepicker({
      uiLibrary: 'bootstrap4',
        format: "yyyy-mm-dd",
        language:"zh-TW",
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
  }

    function add_plan(){
        $('#example1_wrapper').hide();
        $('#example2_wrapper').show();
        $("input[name='goplan']").show();
        $(".plan").show();
        $("input[name='plan_name']").show();
        $(".date").show();
        $("input[name='plan_date']").show();             
        $("input[name='back']").show();
        $(".add_activityText").show();
        $('#example4_wrapper').hide();
        $(".wrap-contact100").show();
        $("#accordion").show();
        if($("input[name='admin']").val()=='Y'){
            $(".userlist").show(); 
            $("select[name='pt_userlist']").show();
        }

        if($("#addplan").is(":visible")){
            $("#addbutton").css("display", "none");
            $("input[name='Responsive_Button']").val(false);
        }else if($("#img").is(":visible")){
            $("#img").css("display", "none");
            $("input[name='Responsive_Button']").val(true);
        }
    }
    function add_activity(){
        $("input[name='addactivity']").hide();
        $('#example2_wrapper').show();
        $('#example3_wrapper').hide();     
        $('.add_activityText').show();
        $(".check_activity").hide(); 
    }
        function go_plan(){
        $("input[name='addactivity']").show();
        if($('#example3_wrapper').is(':visible')){
            var ad_acname="",ad_typename="",ad_acweather="",ad_acdrive="",ad_accarry="",ad_acspend=0,ad_achours=0,ad_acid="",ac_id="",ad_hours="",pn_address="",
            isdelete="";
            var from = $("form[name='updateForm']");
            $("#example3 .ac_id").each(function(){
                var text = $(this).text().trim();
                ac_id = ac_id + text + ",";
            });
            ac_id = ac_id.substring(0, ac_id.length-1);
            $("input[name='dalete']:checked").each(function(){
                var obj = $(this).closest("tr");
                isdelete = isdelete + "true" + ",";
            });
            isdelete = isdelete.substring(0, isdelete.length-1);
            $(from).find("input[name='ac_id']").val(ac_id);
            $(from).find("input[name='isdelete']").val(isdelete);
            var cancel = $("#example3 input[name='cancel']");
            if(cancel.length>0){
                var no = 0;
                $(cancel).each(function() {
                    var obj = $(this).closest("tr");
                    ad_acname = ad_acname + obj.find(".ac_name").text().trim() + ",";
                    ad_typename = ad_typename + obj.find(".type_name").text().trim() + ",";
                    ad_acweather = ad_acweather + obj.find(".ac_weather").text().trim() + ";";
                    ad_acdrive = ad_acdrive + obj.find(".ac_drive").text().trim() + ",";
                    ad_accarry = ad_accarry + obj.find(".ac_carry").text().trim() + ",";
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
            $(from).find("input[name='pn_address']").val(pn_address);
            var plan_name = $("input[name='plan_name']").val().trim();
            var plan_date = $("input[name='plan_date']").val().trim();
            
            if(plan_name==""){
                return SweetAlertMessage("請輸入行程名稱!");
            }else if(plan_date==""){
                return SweetAlertMessage("請輸入出發日期!");
            }
      
            $(from).find("input[name='plan_name']").val(plan_name);
            $(from).find("input[name='plan_date']").val(plan_date);
            
            var us_id = $("select[name='pt_userlist'] :selected").val();
            var us_name = $("select[name='pt_userlist'] :selected").text();
            $(from).find("input[name='us_id']").val(us_id);
            $(from).find("input[name='us_name']").val(us_name);

            var pt_usid = $("input[name='pt_usid']").val();
            var pt_usname = $("input[name='pt_usname']").val();

            if($("input[name='admin']").val()=="Y"){
                pt_usid = us_id;
                pt_usname = us_name;
            }
            $(from).find("input[name='pt_usid']").val(pt_usid); 
            $(from).find("input[name='pt_usname']").val(pt_usname); 
            $(from).submit();
            
        }
        
        if($('#example2_wrapper').is(':visible')){
            var ac_name="",type_name="",weather_name="";ac_weather="",ac_drive="",ac_carry="",ac_spend="",ac_hours="",ac_id="";
            $("input[name='add']:checked").each(function(){
                var obj = $(this).closest("tr");
                ac_name = ac_name + obj.find(".ac_name").text() + ",";
                type_name = type_name + obj.find(".type_name").text() + ",";
                weather_name = weather_name + obj.find(".weather_name").text() + ",";
                ac_weather = ac_weather + obj.find(".ac_weather").text() + ";";
                ac_drive = ac_drive + obj.find(".ac_drive").text() + ",";
                ac_carry = ac_carry + obj.find(".ac_carry").text() + ",";
                ac_spend = ac_spend + obj.find(".ac_spend").text() + ",";
                ac_hours = ac_hours + obj.find(".ac_hours").text() + ",";
                ac_id = ac_id + obj.find(".ac_id").text() + ",";
            });
            ac_name = ac_name.substring(0, ac_name.length-1);
            type_name = type_name.substring(0, type_name.length-1);
            weather_name = weather_name.substring(0, weather_name.length-1);
            ac_weather = ac_weather.substring(0, ac_weather.length-1);
            ac_drive = ac_drive.substring(0, ac_drive.length-1);
            ac_carry = ac_carry.substring(0, ac_carry.length-1);
            ac_spend = ac_spend.substring(0, ac_spend.length-1);
            ac_hours = ac_hours.substring(0, ac_hours.length-1);
            ac_id = ac_id.substring(0, ac_id.length-1);
            
            var ac_names = ac_name.split(",");
            var type_names = type_name.split(",");
            var weather_names = weather_name.split(",");
            var ac_weathers = ac_weather.split(";");
            var ac_drives = ac_drive.split(",");
            var ac_carrys = ac_carry.split(",");
            var ac_spends = ac_spend.split(",");
            var ac_hourss = ac_hours.split(",");
            var ac_ids = ac_id.split(",");
            
            
            if(ac_names!="" && ac_names!=null){
                for(var i=0; i<ac_names.length; i++){
                var num = document.getElementById("example3").rows.length;
                var tr = document.getElementById("example3").insertRow(num);
                var td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_name");
                td.innerHTML = ac_names[i];
                
                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","type_name");
                td.innerHTML = type_names[i];

                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","weather_name");
                td.innerHTML = weather_names[i];

                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_weather");
                td.setAttribute("style","display:none;");
                td.innerHTML = ac_weathers[i];
                
                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_drive");
                td.innerHTML = ac_drives[i];
                
                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_carry");
                td.innerHTML = ac_carrys[i];
                
                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_spend");
                td.innerHTML = ac_spends[i];
                
                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_hours");
                td.innerHTML = ac_hourss[i];

                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","pn_address"+i);
                td.setAttribute("align","center");
                td.innerHTML = '<span data-toggle="modal" data-target="#myModal">'
                +'<img src="./assets/images/magnifier.png" alt="" id="magnifier" name="magnifier" class="img-thumbnail" data-toggle="tooltip"  title="" onClick="openAddressMap(\'\',\''+i+'\')"/>'
                +'</span>';

                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_id");
                td.setAttribute("style","display:none;");
                td.innerHTML = ac_ids[i];

                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","run");
                td.innerHTML = '<input type="button" class="btn btn-primary" name="cancel" value="取消" onClick="Cancel(this)"/>'
                + '<input type="hidden" name="in_address'+i+'" value="">';
                    //預設有兩行，刪除文字行
                    if(num==2){
                        $("#example3").find(".odd").remove();
                    }  
                }
                
            }
            
            $("input[name='add']").each(function(){
                $(this).prop("checked",false);//把所有的核方框的property都取消勾選
            });
            $('#example3_wrapper').show();
            $('#example2_wrapper').hide();
            $('.add_activityText').hide();
            $(".check_activity").show();
        }
        
    }
    function format_admin (pt_usid,pt_name,pt_date,pt_hours,pt_spend,pt_status) {
        var length = pt_usid.length;
        var table = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>行程名稱</td>'+
                '<td>出發日期</td>'+
                '<td>時間(小時)</td>'+
                '<td>花費</td>'+
                '<td>已完成</td>'+
            '</tr>';
        for(i=0;i<length;i++){
            table = table + '<tr>';
            table = table + '<td>' + pt_name[i] + '</td>';
            table = table + '<td>' + pt_date[i] + '</td>';
            table = table + '<td>' + pt_hours[i] + '</td>';
            table = table + '<td>' + pt_spend[i] + '</td>';
            table = table + '<td>';
            if(pt_status[i]=="2"){
                table = table + 'V';
            }
            table = table + '</td>';
            table = table + '</tr>';
        }
        table = table + '</table>';
        return table;
    }
    function edit(obj){
        var tr = $(obj).closest('tr');
        var pt_status = $(tr).find(".pt_status").text().trim();
        if(pt_status!="V"){
            var pn_id = [],pn_acname = [],ac_type = [],ac_weather = [],ac_drive = [],ac_carry = [],ac_spend = [],ac_hours = [],ac_id = [],pn_address = [];
            var pt_id = $(tr).find(".pt_id").text().trim();
            var pt_usid = $(tr).find(".pt_usid").text().trim();
            var pt_usname = $(tr).find(".pt_usname").text().trim();  
            var pt_name = $(tr).find(".pt_name").text().trim();
            var pt_date = $(tr).find(".pt_date").text().trim();
            $(tr).find("td input[name='pn_id']").each(function(){
                pn_id.push($(this).val());
            })
            $(tr).find("td input[name='pn_acname']").each(function(){
                pn_acname.push($(this).val());
            })
            $(tr).find("td input[name='ac_type']").each(function(){
                ac_type.push($(this).val());
            })
            $(tr).find("td input[name='ac_weather']").each(function(){
                ac_weather.push($(this).val());
            })
            $(tr).find("td input[name='ac_drive']").each(function(){
                ac_drive.push($(this).val());
            })
            $(tr).find("td input[name='ac_carry']").each(function(){
                ac_carry.push($(this).val());
            })
            $(tr).find("td input[name='ac_spend']").each(function(){
                ac_spend.push($(this).val());
            })
            $(tr).find("td input[name='ac_hours']").each(function(){
                ac_hours.push($(this).val());
            })
            $(tr).find("td input[name='ac_id']").each(function(){
                ac_id.push($(this).val());
            })
            $(tr).find("td input[name='pn_address']").each(function(){
                pn_address.push($(this).val());
            })
            // $(tr).find("td input[name='pt_usid']").each(function(){
            //     pt_usid.push($(this).val());
            // })
            // $(tr).find("td input[name='pt_usname']").each(function(){
            //     pt_usname.push($(this).val());
            // })
            var from = $("form[name='submitForm']");
            $(from).find("input[name='pt_id']").val(pt_id);
            $(from).find("input[name='pt_usid']").val(pt_usid);
            $(from).find("input[name='pt_usname']").val(pt_usname);
            $(from).find("input[name='pt_name']").val(pt_name);
            $(from).find("input[name='pt_date']").val(pt_date);
            $(from).find("input[name='pn_id']").val(pn_id);
            $(from).find("input[name='pn_acname']").val(pn_acname);
            $(from).find("input[name='ac_type']").val(ac_type);
            $(from).find("input[name='ac_weather']").val(ac_weather);
            $(from).find("input[name='ac_drive']").val(ac_drive);
            $(from).find("input[name='ac_carry']").val(ac_carry);
            $(from).find("input[name='ac_spend']").val(ac_spend);
            $(from).find("input[name='ac_hours']").val(ac_hours);
            $(from).find("input[name='ac_id']").val(ac_id);
            $(from).find("input[name='pn_address']").val(pn_address);  
            $(from).submit();
        }else{
            return alert("已完成不能編輯!");
        }
    }
        function format_user (pn_acname,ac_type,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours,type) {
        var length = pn_acname.length;
        var table = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
            '<td>活動項目</td>'+
            '<td>類型</td>'+
            '<td>天氣</td>'+
            '<td>車程(小時)</td>'+
            '<td>攜帶物品</td>'+
            '<td>花費</td>'+
            '<td>時間(小時)</td>'+
            '<td style="display:none;">類型ID</td>'+
            '</tr>';
        for(i=0;i<length;i++){
            table = table + '<tr>';
            table = table + '<td>' + pn_acname[i] + '</td>';
            table = table + '<td>' + ac_type[i] + '</td>';
            table = table + '<td>' + ac_weather[i] + '</td>';
            table = table + '<td>' + ac_drive[i] + '</td>';
            table = table + '<td>' + ac_carry[i] + '</td>';
            table = table + '<td>' + ac_spend[i] + '</td>';
            table = table + '<td>' + ac_hours[i] + '</td>';
            table = table + '<td style="display:none;">' + type[i] + '</td>';
            table = table + '</tr>';
        }
            table = table + '</table>';
        // `d` is the original data object for the row
            return table;
        }
    function edit_plan(obj){
        $('#example1_wrapper').hide();
        $('#example4_wrapper').show();
        $("input[name='addplan']").hide();
        $("input[name='back']").show();
        var tr = $(obj).closest('tr');
        var td = $(obj).closest('td');
        var pt_id = [],pt_usid = [],pt_usname = [],pt_name = [],pt_date = [],pt_hours = [],pt_spend = [],pt_status = [],
        pn_id = [],pn_ptid = [],pn_acname = [],pn_address = [],ac_type = [],ac_weather = [],ac_drive = [],ac_carry = [],ac_spend = [],ac_hours = [],ac_id = [];
        $(tr).find("td input[name='pt_id']").each(function(){
            pt_id.push($(this).val());
        })
        $(tr).find("td input[name='pt_usid']").each(function(){
            pt_usid.push($(this).val());
        })
        $(tr).find("td input[name='pt_usname']").each(function(){
            pt_usname.push($(this).val());
        })
        $(tr).find("td input[name='pt_name']").each(function(){
            pt_name.push($(this).val());
        })
        $(tr).find("td input[name='pt_date']").each(function(){
            pt_date.push($(this).val());
        })
        $(tr).find("td input[name='pt_hours']").each(function(){
            pt_hours.push($(this).val());
        })
        $(tr).find("td input[name='pt_spend']").each(function(){
            pt_spend.push($(this).val());
        })
        $(tr).find("td input[name='pt_status']").each(function(){
            pt_status.push($(this).val());
        })
            
        $(tr).find("td input[name='pn_id']").each(function(){
            pn_id.push($(this).val());
        })
        $(tr).find("td input[name='pn_ptid']").each(function(){
            pn_ptid.push($(this).val());
        })
        $(tr).find("td input[name='pn_acname']").each(function(){
            pn_acname.push($(this).val());
        })
        $(tr).find("td input[name='pn_address']").each(function(){
            pn_address.push($(this).val());
        })
        $(tr).find("td input[name='ac_type']").each(function(){
            ac_type.push($(this).val());
        })
        $(tr).find("td input[name='ac_weather']").each(function(){
            ac_weather.push($(this).val());
        })
        $(tr).find("td input[name='ac_drive']").each(function(){
            ac_drive.push($(this).val());
        })
        $(tr).find("td input[name='ac_carry']").each(function(){
            ac_carry.push($(this).val());
        })
        $(tr).find("td input[name='ac_spend']").each(function(){
            ac_spend.push($(this).val());
        })
        $(tr).find("td input[name='ac_hours']").each(function(){
            ac_hours.push($(this).val());
        })
        $(tr).find("td input[name='ac_id']").each(function(){
            ac_id.push($(this).val());
        })
        if(pt_usid!="" && pt_usid!=null){
            for(var i=0; i<pt_usid.length; i++){
            var num = document.getElementById("example4").rows.length;
            var tr = document.getElementById("example4").insertRow(num);
            var td = tr.insertCell(tr.cells.length);
            td.setAttribute("class","pt_usid");
            td.setAttribute("style","display:none;");
            td.innerHTML = pt_usid[i];
                
            td = tr.insertCell(tr.cells.length);
            td.setAttribute("class","pt_name");
            td.innerHTML = pt_name[i];
            td = tr.insertCell(tr.cells.length);
            td.setAttribute("class","pt_date");
            td.innerHTML = pt_date[i];
            td = tr.insertCell(tr.cells.length);
            td.setAttribute("class","pt_hours");
            td.innerHTML = pt_hours[i];
                
            td = tr.insertCell(tr.cells.length);
            td.setAttribute("class","pt_spend");
            td.innerHTML = pt_spend[i];
                
            td = tr.insertCell(tr.cells.length);
            td.setAttribute("class","pt_status");
            if(pt_status[i]==2){
                td.innerHTML = "V";
            }
                
            td = tr.insertCell(tr.cells.length);
            var plan_td = "<input type='button' class='btn btn-primary' value='編輯' onClick='edit(this)'/>" +
            "<input type='hidden' name='pt_id' value='"+pt_id[i]+"'/>" + 
            "<input type='hidden' name='pt_usid' value='"+pt_usid[i]+"'/>" + 
            "<input type='hidden' name='pt_usname' value='"+pt_usname[i]+"'/>" + 
            "<input type='hidden' name='pt_name' value='"+pt_name[i]+"'/>" + 
            "<input type='hidden' name='pt_date' value='"+pt_date[i]+"'/>" + 
            "<input type='hidden' name='pt_hours' value='"+pt_hours[i]+"'/>" + 
            "<input type='hidden' name='pt_status' value='"+pt_status[i]+"'/>";
            var activity = "";
            if(pn_ptid!="" && pn_ptid!=null){
                for(var j=0; j<pn_ptid.length; j++){
                    if(pt_id[i]==pn_ptid[j]){
                        activity = activity + "<input type='hidden' name='pn_id' value='"+pn_id[j]+"'/>";
                        activity = activity + "<input type='hidden' name='pn_acname' value='"+pn_acname[j]+"'/>";
                        activity = activity + "<input type='hidden' name='pn_address' value='"+pn_address[j]+"'/>";
                        activity = activity + "<input type='hidden' name='ac_type' value='"+ac_type[j]+"'/>";
                        activity = activity + "<input type='hidden' name='ac_weather' value='"+ac_weather[j]+"'/>";
                        activity = activity + "<input type='hidden' name='ac_drive' value='"+ac_drive[j]+"'/>";
                        activity = activity + "<input type='hidden' name='ac_carry' value='"+ac_carry[j]+"'/>";
                        activity = activity + "<input type='hidden' name='ac_spend' value='"+ac_spend[j]+"'/>";
                        activity = activity + "<input type='hidden' name='ac_hours' value='"+ac_hours[j]+"'/>";
                        activity = activity + "<input type='hidden' name='ac_id' value='"+ac_id[j]+"'/>";
                    }
                }
                
            }
            td.innerHTML = plan_td + activity;
            }
            //預設有兩行，刪除文字行
            if(num>1){
                $("#example4").find(".odd").remove();
            } 
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
