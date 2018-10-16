<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <script src="./assets/js/jquery-3.2.1.slim.min.js"></script>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
 
<style>
    /* .container{
        position: relative;
    top:50%;
    left:50%;
    transform:translateY(-50%);
    } */

    .vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center; 
}

.jumbotron{
  background: url("background.png") no-repeat center center; 
  height:100%;
  width:100%;
}

#title{
  font-family:'微軟正黑體';
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

<div class="jumbotron vertical-center">
    <div class="container" style="width: 500px;">
      <h2 id="title" class="text-center font-weight-bold">規劃行程系統</h2>
      <div class="row align-items-center">
      <div id="accordion">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button id="sign_in" class="btn btn-primary btn-lg btn-block ">
                登入
              </button>
             </h5>
        </div>

      <div id="login" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card bg-light">
          <div class="card-body">
            <form class="card-text" name="loginForm" method="post" >
              帳號: <input type="text" name="us_account" /><br/><br/>

              密碼: <input type="password" name="us_password" /><br/><br/>

              <input type="checkbox" name="us_remember" />&nbsp 記住我<br/><br/>
            </form>
          </div>
        </div>
      </div>
      
      <div class="row justify-content-md-center">
        <div class="col-sm-auto">
          <h3>-----------------</h3>
        </div>
        <div class="col-sm-auto">
          <img src="icons.png">
        </div>
        <div class="col-sm-auto">
          <h3>------------------</h3>
        </div>
      </div>
      <div id="setup" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card bg-light">
          <div class="card-body">
            <form  class="card-text" name="setupForm" method="post">
              請輸入帳號: <input type="text" name="us_account" /><br/><br/>

              請輸入密碼: <input type="password" name="us_password" /><br/><br/>

              <input type="hidden" name="setup_user"/>       
            </form>
          </div>
        </div>
      </div>

      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button id="registered" class="btn btn-warning btn-lg btn-block " >
             註冊
          </button>
        </h5>
      </div>
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

