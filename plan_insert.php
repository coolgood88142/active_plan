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
        <input type="button" value="活動列表" onClick="show('activity')"/>
        <input type="button" value="行程列表" onClick="show('plan')"/>
        <input type="button" value="設定" onClick="show('setting')"/>
        &nbsp&nbsp
        Hi!<?php echo $_SESSION['us_name'];
        echo $_SESSION['us_account'];?>
        <input type="button" value="登出" onClick="show('sign_out')"/>
        <br/><br/>

        <!-- <table  width="600" hight="300" >
            <tr>
                <td bgcolor="#00FFFF">活動行程</td>
                <td bgcolor="#00FFFF">類型</td>
                <td bgcolor="#00FFFF">時間(小時)</td>
                <td bgcolor="#00FFFF">花費</td>
                <td bgcolor="#00FFFF">動作</td>
            </tr>
            <tr>
            </tr>
        </table> -->
        <table id="example">
	<thead>
        <tr>
            <td bgcolor="#00FFFF">活動項目</td>
            <td bgcolor="#00FFFF">類型</td>
            <?php 
                if($us_admin != 'Y'){
            ?>
            <td bgcolor="#00FFFF">時間(小時)</td>
            <td bgcolor="#00FFFF">花費</td>
            <td bgcolor="#00FFFF">動作</td> 
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
            <td class="ac_type">
                    <?php echo $value["ac_type"]?>
            </td>
            <?php 
                if($us_admin != 'Y'){
            ?>
            <td>
                <select name="hour">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </td>
            <td>
                <input type="text" name="spend" size=4 value="0">元</input>
            </td>
            <td>
                <input type="checkbox" name="add" >加入</input>
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
        <input type="hidden" name="objName"/>
        <input type="hidden" name="objType"/>
        <input type="hidden" name="objHour"/>
        <input type="hidden" name="objSpend"/>

        <input type="submit" value="送出" onClick="go_plan()"/>      
    </form>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    function show(page){
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }

    function go_plan(){
        var objName = "",objType = "",objHour = "",objSpend = "";
        var trs=$("table#example tr");
        $("input[name='add']:checked").each(function(){
            var obj = $(this).closest("tr");
            objName = objName + obj.find(".ac_name").text() + ",";
            objType = objType + obj.find(".ac_type").text() + ",";
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
  </script>
</html>

