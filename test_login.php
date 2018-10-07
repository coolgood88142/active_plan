<html>
  <head>
    <title>規劃行程系統</title>
  </head>
     <!-- jQuery v1.9.1 -->
<script src="jquery-3.3.1.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
<style>
    /* .container{
        position: relative;
    top:50%;
    left:50%;
    transform:translateY(-50%);
    } */

    .vertical-center {
  position: relative;
  top: 50%;
  margin: 0 auto;
  transform: translateY(-50%);
}
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


    <div class="container" style="width: 500px;">
      <div class="row align-items-end">
      <div id="accordion">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-primary btn-lg btn-block " data-toggle="collapse" data-target="#login" aria-expanded="true" aria-controls="login">
                登入
              </button>
             </h5>
        </div>

      <div id="login" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <form name="loginForm" method="post" >
            帳號: <input type="text" name="us_account" /><br/><br/>

            密碼: <input type="password" name="us_password" /><br/><br/>

            <input type="checkbox" name="us_remember" />&nbsp 記住我<br/><br/>
          </form>
        </div>
      </div>
      <h3>-----------------------------------------</h3>
      <div id="setup" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <form  name="setupForm" method="post">
            請輸入帳號: <input type="text" name="us_account" /><br/><br/>

            請輸入密碼: <input type="password" name="us_password" /><br/><br/>

            <input type="hidden" name="setup_user"/>       
          </form>
        </div>
      </div>

      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-warning btn-lg btn-block " data-toggle="collapse" data-target="#setup" aria-expanded="false" aria-controls="setup">
             註冊
          </button>
        </h5>
      </div>
    </div>
  </div>
  </div>

    <!-- <div class="container">
      <div class="row">
        <div class="col">
          <button class="btn btn-primary btn-lg btn-block " type="button" data-toggle="collapse" data-target="#login" aria-expanded="false" aria-controls="login">登入</button>
            <div class="collapse" id="login">
              <div class="card card-body">
                <form name="loginForm" method="post" >
                  帳號: <input type="text" name="us_account" /><br/><br/>

                  密碼: <input type="password" name="us_password" /><br/><br/>

                  <input type="checkbox" name="us_remember" />&nbsp 記住我<br/><br/>
                </form>
              </div>
            </div>
            <div class="collapse" id="setup">
              <div class="card card-body">
                <form action="<?php echo "insert.php" ?>" name="setupForm" method="post">
                  請輸入帳號: <input type="text" name="us_account" /><br/><br/>

                  請輸入密碼: <input type="password" name="us_password" /><br/><br/>

                  <input type="hidden" name="setup_user"/>       
                </form>
              </div>
            </div>
          <button class="btn btn-warning btn-lg btn-block " type="button" data-toggle="collapse" data-target="#setup" aria-expanded="false" aria-controls="setup">註冊</button>
        </div>
      </div>
    </div> -->

    
 

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

