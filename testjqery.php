<script src="./assets/js/jquery-3.3.1.js"></script>
<link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- <script type="text/javascript" src="./assets/js/gijgo.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <script type="text/javascript" src="./assets/js/bootstrap-datetimepicker.zh-CN.js"locale charset="UTF-8"></script> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="./bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
    <script type="text/javascript" src="./bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="./bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.zh-TW.js" charset="UTF-8"></script>
    <!-- <link rel="stylesheet/less" type="text/css" href="./bootstrap-datetimepicker-master/less/datetimepicker.less" /> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script> -->
<input type="text" class="form-control" name="begin_date">

<script language="JavaScript">
$(document).ready(function() {
    $("input[name='begin_date']").datetimepicker({
    format: 'yyyy-mm-dd',
    language:'zh-TW',
    weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
});
</script>