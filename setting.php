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
  }
  </style>
  <body>
  <div class="jumbotron vertical-center bg-Light">
    <div class="container">
    <div id="navbar"></div>
    <h2 id="title" class="text-center text-dark font-weight-bold">帳號資料</h2>
    <form action="<?php echo "update.php" ?>" name="showForm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <input type="hidden" name="add_account" value="<?=$add_account?>"/>

        帳號: 
        <?php
          if(!empty($add_account)){           
        ?>
          <input type="text" name="us_account" value=""/><br/><br/>
        <?php
          }else{
            echo $us_account
        ?>
          <br/><br/>
          <input type="hidden" name="us_account" value="<?= $us_account ?>"/>
        <?php
          }
          ?>

        密碼: <input type="password" name="us_password" value=""/>(請輸入8-15數字和英文)<br/><br/>

        請在輸入一次密碼: <input type="password" name="agree_us_password" value=""/>(請輸入8-15數字和英文)<br/><br/>

        姓名: 
        <?php
          if(!empty($add_account)){           
        ?>
          <input type="text" name="us_name" value=""/><br/><br/>
        <?php
          }else{
        ?>
          <input type="text" name="us_name" value="<?php echo $us_name!="未填寫"?$us_name:"" ?>"/><br/><br/>
        <?php
          }
          ?>

        性別: <input type="radio" name="us_gender" value="R" checked>男&nbsp
        <input type="radio" name="us_gender" value="S">女<br/><br/>
        <input type="hidden" name="gender" value="<?php echo $us_gender!="未填寫"?$us_gender:"" ?>"/>

        電子信箱: <input type="text" name="us_email" value="<?php echo $us_email!="未填寫"?$us_email:"" ?>"/><br/><br/>

        大頭照檔名: <p id="headshot_file"><?= $us_headshot_path ?></p>
        <img src="<?=$headshot_path?>" alt="" class="img-thumbnail">
        <p><strong>建議圖片格式為長寬相同，副檔名為gif,jpg,png</strong></p>

        <input type="file" name="headshot_img" accept="image/gif, image/jpg, image/png">
        <br/><br/>

        <p class="status" style="display:none;">狀態:
          <input type="radio" name="us_status" value=1 checked>正常&nbsp
          <input type="radio" name="us_status" value=2>停用<br/><br/>
          <input type="hidden" name="status" value="<?php echo $us_status ?>"/>
        </p>

        <input type="button" value="確定" onClick="check()"/>
        <input type="hidden" name="update_user"/>
    </form>
    </div>
  </div> 
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
      $('#navbar').load('navbar.php');
      var admin = $("input[name='admin']").val();
      var status = $("input[name='status']").val();
      if(admin=='Y'){
        $(".status").show();
        $("input[name='us_status'][value='" + status + "']").prop("checked", true); 
        $("input[name='us_password']").val("0000");
        $("input[name='agree_us_password']").val("0000");
      }

      var gender = $("input[name='gender']").val();
      $("input[name='us_gender'][value='" + gender + "']").prop("checked", true); 

      //上傳圖片即時更換
      $("input[name='headshot_img']").change(function(){
        if(this.files && this.files[0]){
          var reader = new FileReader();
          reader.onload = function (e) {
            $(".img-thumbnail").attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0]);

          var fronData = new FormData();
          fronData.append('headshot_img',this.files[0]);
          fronData.append('us_account',$("input[name='us_account']").val());
          fronData.append('admin',$("input[name='admin']").val());
          update_img(fronData);
          
        }
      });
      
      function update_img(fronData){
        $.ajax({
          url: "select_setting.php",
          type: "POST",
          async: true, 
          dataType: "json",
          data:  fronData,
          contentType: false,
          cache: false,
          processData:false,
          success: function(info){
            if(info.success==true){
              $("#headshot_file").text(info.file_name);
              $(".img-thumbnail").attr('src', info.datetime_file);
              if($("input[name='admin']").val()!='Y'){
                $('#navbar').load('navbar.php');
              }
            }
          },
          error:function(xhr, status, error){
            alert(xhr.statusText);
          }
        });
      }
    });

    function check(){
      var us_account = $("input[name='us_account']").val();
      var us_password = $("input[name='us_password']").val();
      var agree_us_password = $("input[name='agree_us_password']").val();
      var us_name = $("input[name='us_name']").val();
      var us_email = $("input[name='us_email']").val();
      var us_gender = $("input[name='us_gender']:checked").val();

      if(us_account==""){
        return alert("請輸入帳號!");
      }
      // if(us_password==""){
      //   return alert("請輸入密碼!");
      // }
      // if(us_password.match("^.*(?=.{8,15})(?=.*\d)(?=.*[a-zA-Z]).*$")){
      //   return alert("密碼格式錯誤!");
      // }
      // if(agree_us_password==""){
      //   return alert("請輸入密碼!");
      // }
      // if(agree_us_password.match("^.*(?=.{8,15})(?=.*\d)(?=.*[a-zA-Z]).*$")){
      //   return alert("密碼格式錯誤!");
      // }
      if(us_password!=agree_us_password){
        return alert("請輸入密碼錯誤!");
      }
      
      // if(us_name==""){
      //   return alert("請輸入姓名!");
      // }
      
      // if(us_email==""){
      //   return alert("請輸入電子信箱!");
      // }
      
      // if(!us_email.match("^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$")){
      //   return alert("電子信箱格式錯誤!");
      // }

      var add_account = $("input[name='add_account']").val();
      if(add_account!=""){
        document.showForm.action="insert.php"; 
      }
      document.showForm.submit();
    }

    function show(page){
        if($("input[name='admin']").val()=="Y" && (page=="setting" || page=="question")){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

