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
        include("select_activity.php"); 
    }

 ?>
  <body>
    <form name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <H2>活動列表</H2>
        <br/><br/>
        <input type="button" style="display:none;" name="add" value="新增活動項目" onClick="add_activity()"/>
        <table id="example">
	<thead>
        <tr>
            <td bgcolor="#00FFFF">活動項目</td>
            <td bgcolor="#00FFFF" style="display:none;">活動項目ID</td>
            <td bgcolor="#00FFFF">類型</td>
            <td bgcolor="#00FFFF" style="display:none;">類型ID</td>
            <td bgcolor="#00FFFF">天氣</td>
            <td bgcolor="#00FFFF">車程(小時)</td>
            <td bgcolor="#00FFFF">攜帶物品</td>
            <td bgcolor="#00FFFF">花費</td>
            <td bgcolor="#00FFFF">時間(小時)</td>
            <?php
                if($us_admin=='Y'){                
            ?>
                <td bgcolor="#00FFFF">編輯設定</td>
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
            <?php
                if($us_admin=='Y'){                
            ?>
            <td class="ac_edit">
                <input type="button" value="編輯項目" onClick="edit(this)"/>
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
    <input type="button" style="display:none;" name="backpage" value="回上一頁" onClick="back_activity()"/>
    <p class="activity" style="display:none;">活動項目:
          <input type="text" name="add_acname" value="" ><br/><br/>
    </p>
    <p class="type" style="display:none;">類型:
        <select name="add_actype">
            <option value="1">運動</option>
            <option value="2">輕鬆</option>
            <option value="3">景點</option>
        </select>
        <br/><br/>
    </p>
    <p class="weather" style="display:none;">天氣:
        <select name="add_acweather">
            <option value="不拘">不拘</option>
            <option value="晴天">晴天</option>
            <option value="晴天、陰天">晴天、陰天</option>
        </select>
        <br/><br/>
    </p>
    <p class="drive" style="display:none;">車程(小時):
        <select name="add_acdrive">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>小時
        <br/><br/>
    </p>
    <p class="carry" style="display:none;">攜帶物品:
          <input type="text" name="add_accarry" value="無" ><br/><br/>
    </p>
    <p class="spend" style="display:none;">花費:
          <input type="text" name="add_acspend" value="0" >元<br/><br/>
    </p>
    <p class="hours" style="display:none;">時間(小時):
        <select name="add_achours">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>小時
        <br/><br/>
    </p>
    <input type="hidden" name="add_acid" value=""/>
    <input type="button" style="display:none;" name="addactivity" value="新增" onClick="insert()" />
    <input type="button" style="display:none;" name="upactivity" value="送出" onClick="update()" />
    <input type="hidden" name="add_activitys"/>
    </form>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        $('#example').DataTable();
        if($("input[name='admin']").val()=="Y"){
            $("input[name='add']").show();
        }
    } );

    function show(page){
        if($("input[name='admin']").val()=="Y" && page!="activity" && page!="sign_out"){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }

    function go_plan(){
        var objName = "",objType = "",objHour = "",objSpend = "";
        var trs=$("table#example tr");
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
        $('#example_wrapper').hide()
        $("input[name='add']").hide();
        $("input[name='backpage']").show();
        $(".activity").show();
        $(".type").show();
        $(".weather").show();
        $(".drive").show();
        $(".carry").show();
        $(".spend").show();
        $(".hours").show();
        $("input[name='addactivity']").show();
    }

    function back_activity(){
        $('#example_wrapper').show()
        $("input[name='add']").show();
        $("input[name='backpage']").hide();
        $(".activity").hide();
        $(".type").hide();
        $(".weather").hide();
        $(".drive").hide();
        $(".carry").hide();
        $(".spend").hide();
        $(".hours").hide();
        $("input[name='addactivity']").hide();
        $("input[name='upactivity']").hide();
    }

    function insert(){
        var add_acname = $("input[name='add_acname']").val();
        var carry = $("input[name='carry']").val();

        if(add_acname==""){
            return alert("請輸入活動項目!");
        }

        if(carry==""){
            return alert("請輸入攜帶物品!");
        }

        document.showForm.action="insert.php"; 
        document.showForm.submit();
    }

    function edit(obj){
        var tr = $(obj).closest('tr');
        var ac_id = $(tr).find(".ac_id").text().trim();
        var ac_name = $(tr).find(".ac_name").text().trim();
        var ac_type = $(tr).find(".ac_type").text().trim();  
        var ac_weather = $(tr).find(".ac_weather").text().trim();
        var ac_drive = $(tr).find(".ac_drive").text().trim();
        var ac_carry = $(tr).find(".ac_carry").text().trim();
        var ac_spend = $(tr).find(".ac_spend").text().trim();
        ac_spend = ac_spend.substring(0, ac_spend.length-1);
        var ac_hours = $(tr).find(".ac_hours").text().trim();
        
        $("input[name='add_acid']").val(ac_id);
        $("input[name='add_acname']").val(ac_name);
        $("select[name='add_actype'] option[value="+ac_type+"]").attr("selected",true); 
        $("select[name='add_acweather'] option[value="+ac_weather+"]").attr("selected",true); 
        $("select[name='add_acdrive'] option[value="+ac_drive+"]").attr("selected",true); 
        $("input[name='add_accarry']").val(ac_carry);
        $("input[name='add_acspend']").val(ac_spend);
        $("select[name='add_achours'] option[value="+ac_hours+"]").attr("selected",true); 

        add_activity();
        $("input[name='addactivity']").hide();
        $("input[name='upactivity']").show();
    }

    function update(){
        var add_acname = $("input[name='add_acname']").val();
        var carry = $("input[name='carry']").val();

        if(add_acname==""){
            return alert("請輸入活動項目!");
        }

        if(carry==""){
            return alert("請輸入攜帶物品!");
        }

        document.showForm.action="update_activity.php"; 
        document.showForm.submit();
    }
  </script>
</html>

