<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <body>
    <form action="<?php echo "insert.php" ?>" name="setupForm" method="post">
        請輸入帳號: <input type="text" name="us_account" /><br/><br/>

        請輸入密碼: <input type="password" name="us_password" /><br/><br/>

        <input type="hidden" name="setup_user"/>
　      <input type="button" value="建立" onClick="set()"/>         
    </form>  
    <script language="JavaScript">
    function set(){
      // var us_password=$("input[name='us_password']").val();
      // var pass = us_password.match("^.*(?=.{8,15})(?=.*\d)(?=.*[a-zA-Z]).*$");
      // if(us_password.match("^.*(?=.{8,15})(?=.*\d)(?=.*[a-zA-Z]).*$")==null){
      //   return alert("密碼錯誤!");
      // }
	    document.setupForm.submit();
    }
      
    </script>
    

  </body>
</html>