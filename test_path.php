<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <?php session_start();
        $islogin=false;$us_admin = "";$setting = "";
        include("checklogin.php");
        include("mysql.php");
        if($islogin){
            if(isset($_SESSION["us_admin"])){
                $us_admin = $_SESSION['us_admin'];
                include("select_setting.php");
            }
        }else{
            exit;
        }

        $us_account = $_SESSION['us_account'];
        $us_name = $_SESSION['us_name'];
        $us_gender = "";
        $us_email = "";
        $us_status = "";
        $add_account = "";
        $us_headshot_path = "";
        $headshot_path = "";

        if($us_admin=="Y"){
          if(isset($_POST['us_account'])){
            $us_account = $_POST['us_account'];
          }
          if(isset($_POST['us_name'])){
            $us_name = $_POST['us_name'];
          }     
          if(isset($_POST['us_gender'])){
            $us_gender = $_POST['us_gender'];
          }
          if(isset($_POST['us_email'])){
            $us_email = $_POST['us_email'];
          }
          if(isset($_POST['us_status'])){
            $us_status = $_POST['us_status'];
          }
          if(isset($_POST['add_account'])){
            $add_account = $_POST['add_account'];
          }
          if(isset($_POST['us_headshot_path'])){
            $headshot_path = $_POST['us_headshot_path'];
            $headshot_path = $headshot_path;
          }
        }else{
          foreach ($setting as $key => $value) {
            $us_gender = $value["us_gender"];
            $us_email = $value["us_email"];
            $headshot_path = $value['us_headshot_path'];
            $headshot_path = $headshot_path;
          }
        }
        if($headshot_path!=""){
          $us_headshot_path = str_replace("assets/images/upload_file/","",$headshot_path );
        }

  ?>
  <style>
  .img-thumbnail{
    width:150px;
    height:150px;
  }
  .vertical-center {
    min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
    display: flex;
    align-items: center; 
  }
  .jumbotron{
    height:100%;
    width:100%;
    font-family:'微軟正黑體';
  }
  .container{
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
  }
  @media screen and (max-width: 768px) {
    .jumbotron,.btn{
      font-size:14px;
    }
    #title{
      font-size:28px;
    }
  }
  </style>
  <body>
  <div id="navbar"></div>
  <div class="jumbotron container bg-Light side-collapse-container-left">
    <form action="<?php echo "update.php" ?>" name="showForm" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12" style="top: 20px;">
                <div class="form-group row headshot_file">
                    <label class="col-sm-2 control-label">絕對路徑:</label>
                    <div id="headshot_file" class="col">
                      <img src="http://localhost/active_plan/assets/images/admin0000.png" alt="" class="img-thumbnail">
                      <p><strong>路徑為：http://localhost/active_plan/assets/images/admin0000.png</strong></p>
                    </div>
                </div>
                <br/><br/>

                <div class="form-group row headshot_file">
                    <label class="col-sm-2 control-label">相對路徑:</label>
                    <div id="headshot_file" class="col">
                      <img src="assets/images/usertest.png" alt="" class="img-thumbnail">
                      <p><strong>路徑為：assets/images/usertest.png</strong></p>
                    </div>
                </div>
                <br/><br/>
            </div>
        </div>
    </form>
  </div> 
  </body>
</html>

