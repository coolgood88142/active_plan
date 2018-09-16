<?php
    session_start();
?>
<input type="button" value="活動列表" onClick="show('activity')"/>
    <input type="button" value="行程列表" onClick="show('plan')"/>
    <input type="button" value="隨機行程" onClick="show('random')"/>
    <input type="button" value="設定" onClick="show('setting')"/>
    &nbsp&nbsp
    Hi!<?php echo $_SESSION['us_name'];?>
    <input type="button" value="登出" onClick="show('sign_out')"/>
    <br/><br/>