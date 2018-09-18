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

    $pt_usid = $_SESSION['us_id'];
    $pt_usname = $_SESSION['us_name'];

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
        <input type="button" name="addplan" value="新增行程" onClick="add_plan()"/>
        <p class="plan">行程名稱:<input type="text" name="plan_name" value=""/></p>
        <p class="date">出發日期:<input type="text" name="plan_date" value=""/>(yyyy-mm-dd)</p>
        <input type="hidden" name="pt_usid" value="<?=$pt_usid?>"/>
        <input type="hidden" name="pt_usname" value="<?=$pt_usname?>"/>
        <table id="example1">
	        <thead>
                <tr>
                    <td bgcolor="#00FFFF"></td>
                    <td bgcolor="#00FFFF" style="display:none;">序號</td>
                    <td bgcolor="#00FFFF" style="display:none;">user_id</td>
                    <td bgcolor="#00FFFF" style="display:none;">user_name</td>
                    <td bgcolor="#00FFFF">行程名稱</td>
                    <td bgcolor="#00FFFF">出發時間</td>
                    <td bgcolor="#00FFFF">時間(小時)</td>
                    <td bgcolor="#00FFFF">花費</td>
                    <td bgcolor="#00FFFF">已完成</td>
                    <td bgcolor="#00FFFF">編輯設定</td>
                </tr>
	        </thead>
	        <tbody>
                <?php
                    foreach ($plan as $key => $value) {
                ?>
                <tr>
                    <td class=" details-control"></td>
                    <td class="pt_id" style="display:none;">
                        <?php echo $value["pt_id"]?>
                    </td>
                    <td class="pt_usid" style="display:none;">
                        <?php echo $value["pt_usid"]?>
                    </td>
                    <td class="pt_usname" style="display:none;">
                        <?php echo $value["pt_usname"]?>
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
                        <input type="button" value="編輯" onClick="edit(this)"/>
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
                    <?php
                            }
                        }
                    ?>
                    </td>

                    <?php 
                    }
                    ?>
                </tr>
                
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
<table id="example3">
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
            <td bgcolor="#00FFFF" style="display:none;">類型ID</td>
        </tr>
	</thead>
    <tbody>
    </tbody>
    <tfoot>
    </tfoot>
</table>
    <input type="button" name="addactivity" value="新增" onClick="add_activity()"/>
    <input type="button" name="goplan" value="送出" onClick="go_plan()"/>  
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
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        $('#example3').DataTable();
        $('#example3_wrapper').hide();
        $('#example2').DataTable();
        $('#example2_wrapper').hide();
        $("input[name='goplan']").hide();
        $("input[name='addactivity']").hide();
        $(".plan").hide();
        $("input[name='pt_name']").hide();
        $(".date").hide();
        $("input[name='pt_date']").hide();

        $('#example1').DataTable();
        $('#example1 tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = $('#example1').DataTable().row( tr );
            
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
                row.child( format(pn_acname,ac_type,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours,type) ).show();
                tr.addClass('shown');
            }
        } );
    } );

    function add_plan(){  
        $('#example1_wrapper').hide();
        $('#example2_wrapper').show();
        $("input[name='addplan']").hide();
        $("input[name='goplan']").show();
        $(".plan").show();
        $("input[name='pt_name']").show();
        $(".date").show();
        $("input[name='pt_date']").show();
    }

    function add_activity(){
        $("input[name='addactivity']").hide();
        $('#example2_wrapper').show();
        $('#example3_wrapper').hide();      
    }

    function go_plan(){
        $("input[name='addactivity']").show();
        if($('#example3_wrapper').is(':visible')){
            var ad_acname="",ad_typename="",ad_acweather="",ad_acdrive="",ad_accarry="",ad_acspend=0,ad_achours=0,ad_acid="",type="",ad_hours="",
            isdelete="";
            var from = $("form[name='updateForm']");
            $("#example3 .type").each(function(){
                var text = $(this).text().trim();
                type = type + text + ",";
            });

            type = type.substring(0, type.length-1);

            $("input[name='dalete']:checked").each(function(){
                var obj = $(this).closest("tr");
                isdelete = isdelete + "true" + ",";
            });

            isdelete = isdelete.substring(0, isdelete.length-1);

            $(from).find("input[name='type']").val(type);
            $(from).find("input[name='isdelete']").val(isdelete);

            var cancel = $("#example3 input[name='cancel']");
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
            var pt_usid = $("input[name='pt_usid']").val();
            var pt_usname = $("input[name='pt_usname']").val();

            if(plan_name==""){
                return alert("請輸入行程名稱!");
            }else if(plan_date==""){
                return alert("請輸入出發日期!");
            }else if(!plan_date.match("^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02/(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$")){
                return alert("出發日期格式錯誤!");
            }
            
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


            var table = $('#example3').DataTable();
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
        }

    }

    function format (pn_acname,ac_type,ac_weather,ac_drive,ac_carry,ac_spend,ac_hours,type) {

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

    function edit(obj){
        var tr = $(obj).closest('tr');
        var pt_status = $(tr).find(".pt_status").text().trim();
        if(pt_status!="V"){
            var pn_id = [],pn_acname = [],ac_type = [],ac_weather = [],ac_drive = [],ac_carry = [],ac_spend = [],ac_hours = [],ac_id = [];
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

            $(from).submit();
        }else{
            return alert("已完成不能編輯!");
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

