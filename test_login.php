<html>
  <head>
    <title>規劃行程系統</title>
  </head>
     <!-- jQuery v1.9.1 -->
<script src="jquery-3.3.1.js"></script>
<!-- DataTables v1.10.16 -->
<link href="jquery.dataTables.min.css" rel="stylesheet" />
<script src="jquery.dataTables.min.js"></script>
<style>
    .login,.setup{
        position: relative;
    top:50%;
    left:50%;
    transform:translateY(-50%);
    }

</style>
  <body background="background.png">
  <?php
    if(!empty($_COOKIE['us_account'])&& !empty($_COOKIE['us_password'])){
      echo '<meta http-equiv=REFRESH CONTENT=0;url=sign_in.php>';
    }
    $error = false;
    $errorMessage = "";
    if(isset($_GET['error'])){
      $error = $_GET['error'];
    }

    if(isset($_GET['errorMessage'])){
      $errorMessage = $_GET['errorMessage'];
    }
  ?>
    <input type="hidden" name="error" value="<?php echo $error ?>"/>
    <input type="hidden" name="errorMessage" value="<?php echo $errorMessage ?>"/>

    <div class="login">
      <input type="button" style="background-color:#00FFFF;" value="登入" onClick="sign_in()"/>
    <form name="loginForm" method="post" >
        帳號: <input type="text" name="us_account" /><br/><br/>

        密碼: <input type="password" name="us_password" /><br/><br/>

        <input type="checkbox" name="us_remember" />&nbsp 記住我<br/><br/>

    </form>
    </div>

     <div class="setup">
      <input type="button" value="建立" onClick="setup()"/>
    <form action="<?php echo "insert.php" ?>" name="setupForm" method="post">
        請輸入帳號: <input type="text" name="us_account" /><br/><br/>

        請輸入密碼: <input type="password" name="us_password" /><br/><br/>

        <input type="hidden" name="setup_user"/>       
    </form> 
    </div>
 

  </body>
  <script language="JavaScript">
    $(document).ready(function() {
      var error = $("input[name='error']").val();
      var errorMessage = $("input[name='errorMessage']").val();
      if(errorMessage!=""){
        alert(errorMessage);
      }else if(error=="true"){
        alert("帳號密碼輸入錯誤!");
      }
    });

    function sign_in(){
      document.loginForm.action="sign_in.php"; 
	    document.loginForm.submit();
    }

    function setup(){
      document.loginForm.action="setup.php"; 
	    document.loginForm.submit();
    }
  </script>
</html>

