<?php
    session_start();
    $us_admin = $_SESSION['us_admin'];
    include("select_plan.php");
?>
<script language="JavaScript">
    location.href = "plan_admin.php";
</script>