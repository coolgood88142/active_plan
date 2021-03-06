<html>
  <head>
    <title>規劃行程系統</title>
  </head>
<?php include("link.php");?>
<link rel="stylesheet" href="./assets/css/datepicker3.css"/>
<script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="./assets/js/bootstrap-datetimepicker.zh-TW.js" charset="UTF-8"></script>
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

    $pt_id = $_POST['pt_id'];
    $pt_name = $_POST['pt_name'];
    $pt_date = $_POST['pt_date'];
    $pt_usid = $_POST['pt_usid'];
    $pt_usname = $_POST['pt_usname'];

    $pn_id =  $_POST['pn_id'];
    $pn_id = explode(",", $pn_id);

    $pn_acname = $_POST['pn_acname'];
    $pn_acname = explode(",", $pn_acname);

    $pn_address = $_POST['pn_address'];
    $pn_address = explode(",", $pn_address);

    $ac_type = $_POST['ac_type'];
    $ac_type = explode(",", $ac_type);

    $ac_weather = $_POST['ac_weather'];
    $ac_weather = explode(",", $ac_weather);

    $ac_drive = $_POST['ac_drive'];
    $ac_drive = explode(",", $ac_drive);

    $ac_carry = $_POST['ac_carry'];
    $ac_carry = explode(",", $ac_carry);

    $ac_spend = $_POST['ac_spend'];
    $ac_spend = explode(",", $ac_spend);

    $ac_hours = $_POST['ac_hours'];
    $ac_hours = explode(",", $ac_hours);

    $ac_id = $_POST['ac_id'];
    $ac_id = explode(",", $ac_id);    

    $count=count($pn_acname);

 ?>
  <body>
  <div id="navbar"></div>
  <div class="jumbotron container bg-white side-collapse-container-left">
    <form name="showForm" method="post">
        <div class="col-md-12 col-from">
            <h2 id="title" class="text-center font-weight-bold" style="margin-bottom:20px;">行程列表</h2>
            <input type="hidden" name="admin" value="<?=$us_admin?>"/>
            <div class="wrap-contact100" style="width:100%;">
                <div class="wrap-input100 validate-input bg1" style="margin-top:30px;">
                    <span>
                        <label style="color:red;">*</label>行程名稱：
                    </span>
                    <input class="input100" type="text" name="pt_name" value="<?=$pt_name?>">
                </div>
                <div class="wrap-input100 validate-input bg1">
                    <span>
                        <label style="color:red;">*</label>出發日期：
                    </span>
                    <input class="input100" type="text" name="pt_date" value="<?=$pt_date?>" data-provide="datepicker">
                </div>
                <div class="container-contact100-form-btn">
                    <div id="addbutton" class="col d-flex align-items-end flex-column" style="text-align:right">
                        <img src="./assets/images/add.png" alt="" id="img" name="img" class="img-thumbnail d-md-none"  onClick="add_plan()">
                        <input type="button" class="btn btn-primary d-none d-md-inline d-sm-none" id="addplan" name="addplan" value="新增" onClick="add_plan()"/>
                    </div>
                </div>
            </div>   
            <br/>
            <input type="hidden" name="pt_usid" value="<?=$pt_usid?>"/>
            <input type="hidden" name="pt_usname" value="<?=$pt_usname?>"/>

            <table id="example1" class="table table-striped table-bordered">
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
                        <td style="display:none;">更新地址</td>
                        <td>動作</td>
                        <td style="display:none;">活動ID</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i=0 ; $i<$count ; $i++) {
                    ?>
                    <tr>
                        <td class="pn_acname">
                            <?php echo $pn_acname[$i]?>
                        </td>
                        <td class="ac_type">
                            <?php echo $ac_type[$i]?>
                        </td>
                        <td class="weather_name">
                            <?php 
                                $acweather = $ac_weather[$i];
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
                            <?php echo $ac_weather[$i]?>
                        </td>
                        <td class="ac_drive">
                            <?php echo $ac_drive[$i]?>
                        </td>
                        <td class="ac_carry">
                            <?php echo $ac_carry[$i]?>
                        </td>
                        <td class="ac_spend">
                            <?php echo $ac_spend[$i]?>元
                        </td>
                        <td class="ac_hours">
                            <?php echo $ac_hours[$i]?>
                        </td>
                        <td class="pn_address<?=$i?>" align="center">
                            <?php 
                                if($pn_address[$i]!=''){
                            ?>
                                <span data-toggle="modal" data-target="#myModal">
                                    <img src="./assets/images/magnifier.png" class="img-thumbnail" alt="" id="magnifier" name="magnifier"  data-toggle="tooltip" title="<?=$pn_address[$i]?>" onClick="openAddressMap('<?=$pn_address[$i]?>','<?=$i?>')"/>
                                </span>
                            <?php
                                }
                            ?>
                        </td>
                        <td class="address<?=$i?>" style="display:none;">
                            <input type="hidden" name="pn_address" />
                            <input type="hidden" name="up_address" />
                        </td>
                        <td>
                            <input type="checkbox" name="dalete">刪除
                        </td>
                        <td class="pn_id" style="display:none;">
                            <?php echo $pn_id[$i]?>
                        </td>
                    </tr>
                    <?php 
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
                        <img src="./assets/images/copy.png" alt="" id="copy" name="copy" class="img-thumbnail" data-toggle="tooltip" title="複製" onClick="copyAddress()"/>
                    </div>
                    </div>
                </div>
                <input type="text" name="no_address" style="display:none;" value="">
            </div>

            <table id="example2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>活動項目</td>
                        <td>類型</td>
                        <td>天氣</td>
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
                        <td class="ac_weather">
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
            </table><br/>
            <div style="text-align:right">
                <input type="button" class="btn btn-primary" name="goplan" value="送出" onClick="go_plan()"/> 
            </div>
        </div>
        <input type="hidden" name="Responsive_Button" />
    </form>
  </div>
    <form action="update_plan.php" name="submitForm" method="post">
        <input type="hidden" name="pn_id" />
        <input type="hidden" name="isdelete" /> 
        <input type="hidden" name="de_acspend" />  
        <input type="hidden" name="de_achours" /> 

        <input type="hidden" name="ad_acname" />            
        <input type="hidden" name="ad_typename" />
        <input type="hidden" name="ad_acweather" />
        <input type="hidden" name="ad_acdrive" />
        <input type="hidden" name="ad_accarry" /> 
        <input type="hidden" name="ad_acspend" /> 
        <input type="hidden" name="ad_achours" />
        <input type="hidden" name="ad_hours" />
        <input type="hidden" name="ad_acid" />
        <input type="hidden" name="pn_address" />
        <input type="hidden" name="up_address" />
        <input type="hidden" name="up_pnid" />

        <input type="hidden" name="plan_name" /> 
        <input type="hidden" name="plan_date" />
        <input type="hidden" name="pt_name" value="<?=$pt_name?>"/> 
        <input type="hidden" name="pt_date" value="<?=$pt_date?>"/>
        <input type="hidden" name="pt_usid" />
        <input type="hidden" name="pt_usname" />
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        $('#example1').DataTable(datatable_language());
        $('#example2').DataTable(datatable_language());
        $('#example2_wrapper').hide();
        openDate($("input[name='pt_date']"));

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
        $(".wrap-contact100").show();

        if($("#addplan").is(":visible")){
            $("#addbutton").css("display", "none");
            $("input[name='Responsive_Button']").val(false);
        }else if($("#img").is(":visible")){
            $("#img").css("display", "none");
            $("input[name='Responsive_Button']").val(true);
        }
    }

    function go_plan(){
        if($('#example1_wrapper').is(':visible')){
            var ad_acname="",ad_typename="",ad_acweather="",ad_acdrive="",ad_accarry="",ad_acspend=0,ad_achours=0,ad_acid="",pn_id="",ad_hours= "",pn_address="",up_address="",up_pnid="",
            de_acspend=0,de_achours=0,isdelete="";
            var from = $("form[name='submitForm']");

            $("input[name='dalete']:checked").each(function(){
                var obj = $(this).closest("tr");
                isdelete = isdelete + "true" + ",";

                pn_id = pn_id + obj.find(".pn_id").text().trim() + ",";

                var spend = obj.find(".ac_spend").text().trim();
                spend = parseInt(spend.substring(0, spend.length-1));
                de_acspend = de_acspend + spend;

                var hours = parseInt(obj.find(".ac_hours").text().trim());
                de_achours = de_achours + hours;

            });

            var dalete = $("#example1 input[name='dalete']");
            if(dalete.length>0){
                $(dalete).each(function() {
                    var obj = $(this).closest("tr");
                    var address = obj.find("input[name='up_address']").val();
                    var address_no = obj.find(".pn_id").text().trim();
                    if(address!='' && address_no!=''){
                        up_address = up_address + address + ",";
                        up_pnid = up_pnid + address_no + ",";
                    }
                });
            }
            

            isdelete = isdelete.substring(0, isdelete.length-1);
            pn_id = pn_id.substring(0, pn_id.length-1);

            $(from).find("input[name='pn_id']").val(pn_id);
            $(from).find("input[name='isdelete']").val(isdelete);
            $(from).find("input[name='de_acspend']").val(de_acspend);
            $(from).find("input[name='de_achours']").val(de_achours);

            var cancel = $("#example1 input[name='cancel']");
            var no = dalete.length;
            if(cancel.length>0){
                $(cancel).each(function() {
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
                    pn_address = pn_address + obj.find("input[name='pn_address']").val().trim() + ",";
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
            up_address = up_address.substring(0, up_address.length-1);
            up_pnid = up_pnid.substring(0, up_pnid.length-1);

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
            $(from).find("input[name='up_address']").val(up_address);
            $(from).find("input[name='up_pnid']").val(up_pnid);

            var plan_name = $("input[name='pt_name']").val();
            var plan_date = $("input[name='pt_date']").val();
            var pt_usid = $("input[name='pt_usid']").val();
            var pt_usname = $("input[name='pt_usname']").val();
            
            $(from).find("input[name='plan_name']").val(plan_name);
            $(from).find("input[name='plan_date']").val(plan_date);
            $(from).find("input[name='pt_usid']").val(pt_usid); 
            $(from).find("input[name='pt_usname']").val(pt_usname); 

            $(from).submit();
            
        }

        if($('#example2_wrapper').is(':visible')){
            var ac_name="",type_name="",ac_weather="",ac_drive="",ac_carry="",ac_spend="",ac_hours="",ac_id="";
            $("input[name='add']:checked").each(function(){
                var obj = $(this).closest("tr");
                ac_name = ac_name + obj.find(".ac_name").text() + ",";
                type_name = type_name + obj.find(".type_name").text() + ",";
                ac_weather = ac_weather + obj.find(".ac_weather").text() + ",";
                ac_drive = ac_drive + obj.find(".ac_drive").text() + ",";
                ac_carry = ac_carry + obj.find(".ac_carry").text() + ",";
                ac_spend = ac_spend + obj.find(".ac_spend").text() + ",";
                ac_hours = ac_hours + obj.find(".ac_hours").text() + ",";
                ac_id = ac_id + obj.find(".ac_id").text() + ",";
            });

            ac_name = ac_name.substring(0, ac_name.length-1);
            type_name = type_name.substring(0, type_name.length-1);
            ac_weather = ac_weather.substring(0, ac_weather.length-1);
            ac_drive = ac_drive.substring(0, ac_drive.length-1);
            ac_carry = ac_carry.substring(0, ac_carry.length-1);
            ac_spend = ac_spend.substring(0, ac_spend.length-1);
            ac_hours = ac_hours.substring(0, ac_hours.length-1);
            ac_id = ac_id.substring(0, ac_id.length-1);
            
            var ac_names = ac_name.split(",");
            var type_names = type_name.split(",");
            var ac_weathers = ac_weather.split(",");
            var ac_drives = ac_drive.split(",");
            var ac_carrys = ac_carry.split(",");
            var ac_spends = ac_spend.split(",");
            var ac_hourss = ac_hours.split(",");
            var ac_ids = ac_id.split(",");

            if(ac_names!="" && ac_names!=null){
                for(var i=0; i<ac_names.length; i++){
                var num = document.getElementById("example1").rows.length;
                var tr = document.getElementById("example1").insertRow(num);
                var td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_name");
                td.innerHTML = ac_names[i];
                
                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","type_name");
                td.innerHTML = type_names[i];

                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_weather");
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

                var no = num-1;
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
                td.innerHTML = '<input type="button" class="btn btn-primary" name="cancel" value="取消" onClick="Cancel(this)"/>';
                }
            }
            

            $("input[name='add']").each(function(){
                $(this).prop("checked",false);//所有的加入都取消勾選
            });

            $("input[name='addplan']").show();
            $('#example1_wrapper').show();
            $('#example2_wrapper').hide();
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

