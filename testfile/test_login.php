<html>
<head></head>
<script src="jquery-3.3.1.js"></script>
<?php include("test_score.php");?>
  <body>
    <table id="example">
        <tr>
          <td>學號</td>
          <td>姓名</td>
          <td>成績</td>
        </tr>
      <?php foreach($row as $key => $value){?>
        <tr>
          <td class="ts_no"><?=$value['ts_no']?></td>
          <td><input type="text" name="ts_name[]" value="<?=$value['ts_name']?>"/></td>
          <td><input type="text" name="ts_grade[]" value="<?=$value['ts_grade']?>" size="3"/></td>
        </tr>
      <?php }?>
    </table>
    <input type="button" name="ts_update" value="更新" onclick="update()"/>
  </body>
  <script language="JavaScript">
    function update(){
      var ts_no="",ts_name="",ts_grade="";
      
      $('#example .ts_no').each(function(i) {
        ts_no = ts_no + $(this).text() + ",";
      });

      $("input[name='ts_name[]']").each(function(i) {
        ts_name = ts_name + $(this).val() + ",";
      });

      $("input[name='ts_grade[]']").each(function(i) {
        ts_grade = ts_grade + $(this).val() + ",";
      });

      ts_no = ts_no.substring(0, ts_no.length-1);
      ts_name = ts_name.substring(0, ts_name.length-1);
      ts_grade = ts_grade.substring(0, ts_grade.length-1);

      var data = {
          'isStatus':'update',
          'ts_no': ts_no, 
          'ts_name': ts_name, 
          'ts_grade': ts_grade, 
        };

      $.ajax({
        url: "test_score.php",
        type: "POST",
        async: true, 
        dataType: "json",
        data: data, 
        success: function(msg){
          if(msg.success==true){
            alert("修改成功!")
          }
        },
        error:function(xhr, status, error){
          alert(xhr.responseText);
        }
      });
    }
  </script>
</html>

