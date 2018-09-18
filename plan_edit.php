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
        include("select_activity.php"); 
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
    <style>
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
    </style>
    
    <form name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div> 
        <H2>行程列表</H2>
        <br/><br/>
        行程名稱:<input type="text" name="pt_name" value="<?=$pt_name?>"/><br/><br/>
        出發日期:<input type="text" name="pt_date" value="<?=$pt_date?>"/>
        <input type="hidden" name="pt_usid" value="<?=$pt_usid?>"/>
        <input type="hidden" name="pt_usname" value="<?=$pt_usname?>"/>
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
                    <td bgcolor="#00FFFF">動作</td>
                    <td bgcolor="#00FFFF" style="display:none;">活動ID</td>
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
                    <td class="ac_weather">
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
                    <td>
                        <input type="checkbox" name="dalete" >刪除</input>
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
        <table id="example2">
	<thead>
        <tr>
            <td bgcolor="#00FFFF">活動項目</td>
            <td bgcolor="#00FFFF">類型</td>
            <td bgcolor="#00FFFF">天氣</td>
            <td bgcolor="#00FFFF">車程(小時)</td>
            <td bgcolor="#00FFFF">攜帶物品</td>
            <td bgcolor="#00FFFF">花費</td>
            <td bgcolor="#00FFFF">時間(小時)</td>
            <td bgcolor="#00FFFF">加入</td>
            <td bgcolor="#00FFFF" style="display:none;">類型ID</td>
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
                <input type="checkbox" name="add" ></input>
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
        <input type="button" name="addplan" value="新增" onClick="add_plan()"/>
        <input type="button" name="goplan" value="送出" onClick="go_plan()"/> 
    </form>
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
        $('#button').load('button.php');
        $('#example1').DataTable();
        $('#example2').DataTable();
        $('#example2_wrapper').hide();
        
    } );

    function add_plan(){
        $('#example1_wrapper').hide();
        $('#example2_wrapper').show();
        $("input[name='addplan']").hide();
    }

    function go_plan(){
        if($('#example1_wrapper').is(':visible')){
            var ad_acname="",ad_typename="",ad_acweather="",ad_acdrive="",ad_accarry="",ad_acspend=0,ad_achours=0,ad_acid="",pn_id="",ad_hours= "",
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

            isdelete = isdelete.substring(0, isdelete.length-1);
            pn_id = pn_id.substring(0, pn_id.length-1);

            $(from).find("input[name='pn_id']").val(pn_id);
            $(from).find("input[name='isdelete']").val(isdelete);
            $(from).find("input[name='de_acspend']").val(de_acspend);
            $(from).find("input[name='de_achours']").val(de_achours);

            var cancel = $("#example1 input[name='cancel']");
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


            var table = $('#example1').DataTable();
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

                td = tr.insertCell(tr.cells.length);
                td.setAttribute("class","ac_id");
                td.setAttribute("style","display:none;");
                td.innerHTML = ac_ids[i];

                td = tr.insertCell(tr.cells.length);
                td.innerHTML = '<input type="button" name="cancel" value="取消" onClick="Cancel(this)"/>';

                // table.row.add( [ ac_names[i], ac_types[i], ac_weathers[i], ac_drives[i], ac_carrys[i], ac_spends[i], ac_hourss[i] ],
                // '<input type="button" name="cancel" value="取消" onClick="Cancel(this)"/>')
                // .draw()
                // .node();


                }
            }
            

            $("input[name='add']").each(function(){
                $(this).prop("checked",false);//把所有的核方框的property都取消勾選
            });

            $("input[name='addplan']").show();
            $('#example1_wrapper').show();
            $('#example2_wrapper').hide();
        }

        



        //$('#example1_wrapper').show();
        
        
        // document.showForm.action="plan.php"; 
        // document.showForm.submit();
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

