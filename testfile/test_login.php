<html>
<head></head>
<script src="jquery-3.3.1.js"></script>
  <body>
    <form name="loginForm" method="post">
        帳號: <input type="text" name="us_account" /><br/><br/>

        密碼: <input type="password" name="us_password" /><br/><br/>

　      <input type="button" value="登入" onClick="sign_in()"/>
    </form>  
  </body>
  <script language="JavaScript">
    function sign_in(){
      var us_account = $("input[name='us_account']").val();
      var us_password = $("input[name='us_password']").val();
      var data = {
          'us_account': us_account, 
          'us_password': us_password
        };
      $.ajax({
        url: "select.php",
        type: "POST",
        async: true, 
        dataType: "json",
        data: data, 
        success: function(msg){
          if(msg.success==true){
            alert("登入成功!")
          }
        },
        error:function(xhr, status, error){
          alert(xhr.responseText);
        }
      });
    }
  </script>
</html>

