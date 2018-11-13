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
        timeout:1,
        success: function(msg){
          if(msg.success==true){
            alert("修改成功!")
          }
        },
        error:function(xhr, status, error){
          alert(xhr.responseText);
        }
      });

//        var currentRequest = null;    

// currentRequest = $.ajax({
//     type: 'POST',
//     data: data,
//     url: 'test_score.php',
//     beforeSend : function()    {           
//         if(currentRequest != null) {
//             currentRequest.abort();
//         }
//     },
//     success: function(data) {
//         // Success
//     },
//     error:function(e){
//       // Error
//     }
// });

// var currentAjax = null;
// 	//方法就是将XHR对象指向currentAjax，再调用currentAjax的.abort()来中止请求
// 	currentAjax = $.ajax({
// 		   type:'POST',
// 		   beforeSend:function(){},
// 		   url:'test_score.php',
// 		   data:data,
// 		   dataType:'JSON',
// 		   error:function(xhr, status, error){
//           alert(xhr.responseText);
//         },
// 		   success:function(data){alert(data)}
// 	});


// 	//如若上一次AJAX请求未完成，则中止请求
// 	if(currentAjax) {currentAjax.abort();}



//     }
  </script>
</html>

