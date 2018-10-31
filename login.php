<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <script src="./assets/js/jquery-3.2.1.slim.min.js"></script>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
 
<style>
  .vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center; 
}

.jumbotron{
  background: url("./assets/images/background.png") no-repeat center center; 
  height:100%;
  width:100%;
}

#title{
  font-family:'微軟正黑體';
}

#login,#setup{
  margin-top:10;
  margin-bottom:10;
}

.checkbox-inline{
  float: right;
}

</style>
  <body background="./assets/images/background.png">
  <?php session_start();
      $us_admin = "";
      include("mysql.php");

      if(isset($_SESSION["us_admin"])){
        $us_admin = $_SESSION['us_admin'];
        include("select_activity.php"); 
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

<div class="jumbotron vertical-center">
    <div class="container" style="width: 500px;">
      <h2 id="title" class="text-center text-white font-weight-bold">規劃行程系統</h2>
      <div class="row align-items-center">
      <div id="accordion">       
        <button id="sign_in" class="btn btn-primary btn-lg btn-block" style="margin-bottom:10px;">
          登入
        </button>      

      <div id="login" class="collapse show">
        <div class="card bg-light text-secondary"  style="text-align:center;">
          <div class="card-body">
            <form name="loginForm" method="post" >
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">帳號:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="us_account">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">密碼:</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="us_password">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="checkbox-inline">
                    <label class="checkbox-inline" for="us_remember">
                      <input type="checkbox" name="us_remember" />&nbsp 記住我
                    </label>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <div class="row justify-content-md-center">
        <div class="col-sm-auto">
          <h3>-----------------</h3>
        </div>
        <div class="col-sm-auto">
          <img src="./assets/images/icons.png">
        </div>
        <div class="col-sm-auto">
          <h3>------------------</h3>
        </div>
      </div>

      <div id="setup" class="collapse">
        <div class="card bg-light text-secondary"  style="text-align:center;">
          <div class="card-body">
            <form name="setupForm" method="post">
              <div class="form-group row">
                <label for="us_account" class="col-sm-4 col-form-label">請輸入帳號:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="us_account" name="us_account">
                </div>
              </div>
              <div class="form-group row">
                <label for="us_password" class="col-sm-4 col-form-label">請輸入密碼:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="us_password" name="us_password">
                </div>
              </div>
              <input type="hidden" name="setup_user"/>       
            </form>
          </div>
        </div>
      </div>

        <button id="registered" class="btn btn-warning btn-lg btn-block" style="margin-top:10px;">
            註冊
        </button>
    </div>
  </div>
  </div>
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

      $("#sign_in").click(function(){
        var us_account = $("form[name='loginForm'] input[name='us_account']").val();
        var us_password = $("form[name='loginForm'] input[name='us_password']").val();
        if($("#login").is(':visible')==true){
          if(us_account==""){
            alert("請輸入帳號!");
          }else if(us_password==""){
            alert("請輸入密碼!");
          }else{
            document.loginForm.action="sign_in.php"; 
	          document.loginForm.submit();
          }
        }else{
          $("#login").collapse('show');
        }
        $("#setup").collapse('hide');
      });
      $("#registered").click(function(){
        var us_account = $("form[name='setupForm'] input[name='us_account']").val();
        var us_password = $("form[name='setupForm'] input[name='us_password']").val();
        if($("#setup").is(':visible')==true){
          if(us_account==""){
            alert("請輸入帳號!");
          }else if(us_password==""){
            alert("請輸入密碼!");
          }else if(!us_password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)){
            alert("請輸入8個以上數字或英文!");
          }else{
            document.setupForm.action="insert.php"; 
	          document.setupForm.submit();
          }
        }else{
          $("#setup").collapse('show');
        }
        $("#login").collapse('hide'); 
      });    
    });
  </script>
</html>

