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
<!-- <nav class="navbar navbar-inverse easy-sidebar">
  <div class="container-fluid"> 
    <ul class="nav navbar-nav">
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
        <a class="nav-link" href="setting<?= $admin;?>.php">設定</a>
      </li>
      <?php
        }
      ?>
      <li class="nav-item ">
        <a class="nav-link" href="analysis.php">分析表</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="question<?= $admin;?>.php">Q&A</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <button type="button" class="btn btn-danger easy-sidebar-toggle">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="mx-2">
    <ul class="nav">
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
</div> -->

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
        <a class="nav-link" href="setting<?= $admin;?>.php">設定</a>
      </li>
      <?php
        }
      ?>
      <li class="nav-item ">
        <a class="nav-link" href="analysis.php">分析表</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="question<?= $admin;?>.php">Q&A</a>
      </li>
    </ul>
  </div>
  <div class="mx-2">
    <ul class="nav">
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

<!-- <div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>行程規劃系統</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                    <li>
                        <a href="activity.php">活動列表</a>
                    </li>
                    <li>
                        <a href="activity_type.php">活動類型</a>
                    </li>
                    <li>
                        <a href="plan.php">行程列表</a>
                    </li>
                    <li>
                        <a href="random.php">隨機行程</a>
                    </li>
                    <?php
                      if($admin!=""){
                    ?>
                    <li>
                        <a href="setting<?= $admin;?>.php">設定</a>
                    </li>
                    <?php
                      }
                    ?>
                    <li>
                        <a href="analysis.php">分析表</a>
                    </li>
                    <li>
                        <a href="question<?= $admin;?>.php">Q&A</a>
                    </li>
            </li>
        </ul>
    </nav>
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">          
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="nav">
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
        </div>
      </nav>
    </div>
</div> -->

<script language="JavaScript">
$(document).ready(function () {

// $('#sidebarCollapse').on('click', function () {
//         $('#sidebar').toggleClass('active');
//     });

 //easy-sidebar-toggle-right
 $('.easy-sidebar-toggle').click(function(e) {
    e.preventDefault();
//$('body').toggleClass('toggled-right');
$('body').toggleClass('toggled');
//$('.navbar.easy-sidebar-right').removeClass('toggled-right');
$('.navbar.easy-sidebar').removeClass('toggled');
});

});
</script>