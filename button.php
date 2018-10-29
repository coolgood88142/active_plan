<?php
    session_start();
    $admin="";
    if(isset($_SESSION["us_admin"]) && $_SESSION["us_admin"]=='Y'){
      $admin = "_admin";
    }
?>
<!-- <input type="button" value="活動列表" onClick="show('activity')"/>
<input type="button" value="活動類型" onClick="show('activity_type')"/>
<input type="button" value="行程列表" onClick="show('plan')"/>
<input type="button" value="隨機行程" onClick="show('random')"/>
<input type="button" value="設定" onClick="show('setting')"/>
<input type="button" value="分析表" onClick="show('analysis')"/>
<input type="button" value="Q&A" onClick="show('question')"/>
&nbsp&nbsp
Hi!<?php echo $_SESSION['us_name'];?>
<input type="button" value="登出" onClick="show('sign_out')"/>
<br/><br/> -->

<div class="nav navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a data-toggle="tab" href="activity.php">活動列表</a></li>
            <li><a data-toggle="tab" href="activity_type.php">活動類型</a></li>
            <li><a data-toggle="tab" href="plan.php">行程列表</a></li>
            <li><a data-toggle="tab" href="random.php">隨機行程</a></li>
            <li><a data-toggle="tab" href="setting<?=$admin;?>.php">設定</a></li>
            <li><a data-toggle="tab" href="analysis.php">分析表</a></li>
            <li><a data-toggle="tab" href="question<?=$admin;?>.php">Q&A</a></li>
            <li>Hi!<?php echo $_SESSION['us_name'];?></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="sign_out.php"><span class="glyphicon glyphicon-log-in"></span>登出</a></li>
        </ul>
    </div>
</div><br/><br/>

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> -->