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

    @media screen and (max-width: 768px) {
    /*left*/  .side-collapse-container-left{
      position:relative;
      left:0;
      transition:left .4s;
    }
    .side-collapse-container-left.out{
      left:30%;
    }
    .side-collapse-left {
       top:50px;
       bottom:0;
       left:0;
       width:30%;
       position:fixed;
       overflow:hidden;
       transition:width .4s;
       font-size:20px;
     }
      .side-collapse-right {
      top:50px;
      bottom:0;
      right:0;
      width:30%;
      position:fixed;
      overflow:hidden;
      transition:width .4s;
    }
     .side-collapse-left.in {
        width:0;
      }
/*      .navbar-inverse{
        background-color: #00BBFF;
        border-radius-color: #00BBFF;
      }*/
    }
    /* @media (max-width: 768px) and (max-width: 1024px) {
      .navbar-toggler .pull-left{
        display:none;
      }
      .side-collapse-left .in{

      }

    } */
      .navbar-light .navbar-nav .nav-link{
        color:#fff;
      }
      .navbar-toggler .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(63,169,221)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
      }
      .nav-item{
        margin-left:20px;
      }
</style>

<nav class="navbar navbar-expand-md navbar-light navbar-dark bg-dark fixed-top navbar-inverse">
  <button  class="navbar-toggler pull-left" type="button" data-toggle="collapse-side" data-target-sidebar=".side-collapse-left" data-target-content=".side-collapse-container-left" >
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-inverse bg-dark side-collapse-left in test-color" id="navbarNav">
    <nav role="navigation" class="navbar-collapse">
      <ul class="nav navbar-nav navbar-left">
        <li class="nav-item">
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
    </nav>
  </div>
  <div class="ml-auto">
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

<script language="JavaScript">
$(document).ready(function () {


var sideslider = $('[data-toggle=collapse-side]');
    var get_sidebar = sideslider.attr('data-target-sidebar');
    var get_content = sideslider.attr('data-target-content');
    sideslider.click(function(event){
      $(get_sidebar).toggleClass('in');
      $(get_content).toggleClass('out');
   });

});
</script>