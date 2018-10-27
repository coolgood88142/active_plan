<?php
    session_start();
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
            <li><a data-toggle="tab" onClick="show('activity')">活動列表</a></li>
            <li><a data-toggle="tab" onClick="show('activity_type')">活動類型</a></li>
            <li><a data-toggle="tab" onClick="show('plan')">行程列表</a></li>
            <li><a data-toggle="tab" onClick="show('random')">隨機行程</a></li>
            <li><a data-toggle="tab" onClick="show('setting')">設定</a></li>
            <li><a data-toggle="tab" onClick="show('analysis')">分析表</a></li>
            <li><a data-toggle="tab" onClick="show('question')">Q&A</a></li>
            <li><a data-toggle="tab" onClick="show('sign_out')">登出</a></li>
            <li>Hi!<?php echo $_SESSION['us_name'];?></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</div><br/><br/>