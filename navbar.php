<?php
    session_start();
    include("mysql.php");
    $us_account="";$admin="";$headshot="";
    if(isset($_SESSION["us_account"])){
      $us_account = $_SESSION['us_account'];
    }else if(!empty($_COOKIE['us_account'])){
      $us_account = $_COOKIE['us_account'];
    }

    if($us_account!=""){
      $sql = "SELECT us_headshot_path FROM user WHERE us_account IN ('$us_account')";
      $query = $conn->query($sql);
      $headshot = $query->fetch(PDO::FETCH_ASSOC);
    }

    if((isset($_SESSION["us_admin"]) && $_SESSION["us_admin"]=='Y') || (empty($_COOKIE['us_admin']) && $_COOKIE['us_admin']=='Y')){
      $admin = "_admin";
    }
?>
<style>
  .dropdown-menu li img.avatar{
    height:40px;
    border-radius: 50em;
    -webkit-border-radius: 50em;
    -moz-border-radius: 50em;
    border: 1px solid #d4d4d4;
    margin: 0px 10px 0 -5px;
    float: left;
  }

  .dropdown-menu li.avatar {
    min-width: 250px;
    height: 50px;
    padding: 0px 15px;
    border-bottom: 1px solid #eeeeee;
}
  .nav-link img.avatar{
    height:40px;
    border-radius: 50em;
    -webkit-border-radius: 50em;
    -moz-border-radius: 50em;
  }
  .navbar{
    position：fixed;
    font-family:'微軟正黑體';
  }

</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="activity.php">活動列表</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="activity_type.php">活動類型</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="plan.php">行程列表</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="random.php">隨機行程</a>
      </li>
      <?php
        if($admin!=""){
      ?>
      <li class="nav-item ">
        <a class="nav-link" href="setting<?=$admin;?>.php">設定</a>
      </li>
      <?php
        }
      ?>
      <li class="nav-item ">
        <a class="nav-link" href="analysis.php">分析表</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="question<?=$admin;?>.php">Q&A</a>
      </li>
    </ul>
  </div>
  <div class="mx-2">
    <ul class="nav">
      <!-- <li><a href="sign_out.php"><span class="glyphicon glyphicon-log-out"></span>登出</a></li> -->
      <!-- <li><i class="fa fa-user" style="font-size:24px;color:blue"></i></li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="avatar" src="<?=$headshot['us_headshot_path']!="" ? $headshot['us_headshot_path'] : "./assets/images/default.png";?>" alt="">
        </a>
        <ul class="dropdown-menu" style="right: 0; left: auto;">
          <li class="avatar">
            <img class="avatar" src="<?=$headshot['us_headshot_path']!="" ? $headshot['us_headshot_path'] : "./assets/images/default.png";?>" alt="">
              <div><div class="point point-primary point-lg"></div><?php echo $_SESSION['us_name'];?></div>
              <span><small><?php echo $_SESSION['us_account'];?></small></span>
              <span><small><a href="setting.php">帳號資料</a></small></span>
              <span><small><a href="sign_out.php">登出</a></small></span>
          </li>
        </ul>
      </li>
    </ul>
</div>
</nav>