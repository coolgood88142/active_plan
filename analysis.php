<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <!-- jQuery v1.9.1 -->
<script src="jquery-3.3.1.js"></script>
<!-- DataTables v1.10.16 -->
<link href="jquery.dataTables.min.css" rel="stylesheet" />
<script src="jquery.dataTables.min.js"></script>
<script src="highcharts.js"></script>
<script src="series-label.js"></script>
<script src="exporting.js"></script>
<script src="export-data.js"></script>
<?php session_start();
    include("mysql.php");

    $us_admin = $_SESSION['us_admin'];
    if(!empty($us_admin)){
        include("select_activity.php"); 
    }

 ?>
  <body>
    <style>
        #container {
            min-width: 310px;
            max-width: 800px;
            height: 400px;
            margin: 0 auto
        }
    </style>
    <form name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <H2>分析表</H2>
        <br/><br/>
        <div id="container"></div>
    </form>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        

Highcharts.chart('container', {

title: {
  text: '活動項目比例'
},

xAxis: {
  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
},
yAxis: {
  title: {
    text: 'Number of Employees'
  }
},
legend: {
  layout: 'vertical',
  align: 'right',
  verticalAlign: 'middle'
},

plotOptions: {
  series: {
    label: {
      connectorAllowed: false
    },
    enableMouseTracking:false
  }
},

series: [{
  name: 'Installation',
  data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
}, {
  name: 'Manufacturing',
  data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
}, {
  name: 'Sales & Distribution',
  data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
}, {
  name: 'Project Development',
  data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
}, {
  name: 'Other',
  data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
}],

responsive: {
  rules: [{
    condition: {
      maxWidth: 500
    },
    chartOptions: {
      legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
      }
    }
  }]
}

});
        
    });

    function show(page){
        if($("input[name='admin']").val()=="Y" && page=="setting"){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }

    function go_plan(){
        var objName = "",objType = "",objHour = "",objSpend = "";
        var trs=$("table#example tr");
        $("input[name='add']:checked").each(function(){
            var obj = $(this).closest("tr");
            objName = objName + obj.find(".ac_name").text().trim() + ",";
            objType = objType + obj.find(".ac_type").text().trim() + ",";
            objHour = objHour + obj.find("select[name='hour']").val() + ",";
            objSpend = objSpend + obj.find("input[name='spend']").val() + ","; 
        });
        objName = objName.substring(0, objName.length-1);
        objType = objType.substring(0, objType.length-1);
        objHour = objHour.substring(0, objHour.length-1);
        objSpend = objSpend.substring(0, objSpend.length-1);

        $("input[name='objName']").val(objName);
        $("input[name='objType']").val(objType);
        $("input[name='objHour']").val(objHour);
        $("input[name='objSpend']").val(objSpend);

        document.showForm.action="plan.php"; 
        document.showForm.submit();
    }

    function add_activity(){
        $('#example_wrapper').hide()
        $("input[name='add']").hide();
        $("input[name='backpage']").show();
        $(".activity").show();
        $(".type").show();
        $(".weather").show();
        $(".drive").show();
        $(".carry").show();
        $(".spend").show();
        $(".hours").show();
        $("input[name='addactivity']").show();
    }

    function back_activity(){
        $('#example_wrapper').show()
        $("input[name='add']").show();
        $("input[name='backpage']").hide();
        $(".activity").hide();
        $(".type").hide();
        $(".weather").hide();
        $(".drive").hide();
        $(".carry").hide();
        $(".spend").hide();
        $(".hours").hide();
        $("input[name='addactivity']").hide();
        $("input[name='upactivity']").hide();
    }

    function insert(){
        var add_acname = $("input[name='add_acname']").val();
        var carry = $("input[name='carry']").val();

        if(add_acname==""){
            return alert("請輸入活動項目!");
        }

        if(carry==""){
            return alert("請輸入攜帶物品!");
        }

        document.showForm.action="insert.php"; 
        document.showForm.submit();
    }

    function edit(obj){
        var tr = $(obj).closest('tr');
        var ac_id = $(tr).find(".ac_id").text().trim();
        var ac_name = $(tr).find(".ac_name").text().trim();
        var ac_type = $(tr).find(".ac_type").text().trim();  
        var ac_weather = $(tr).find(".ac_weather").text().trim();
        var ac_drive = $(tr).find(".ac_drive").text().trim();
        var ac_carry = $(tr).find(".ac_carry").text().trim();
        var ac_spend = $(tr).find(".ac_spend").text().trim();
        ac_spend = ac_spend.substring(0, ac_spend.length-1);
        var ac_hours = $(tr).find(".ac_hours").text().trim();
        
        $("input[name='add_acid']").val(ac_id);
        $("input[name='add_acname']").val(ac_name);
        $("select[name='add_actype'] option[value="+ac_type+"]").attr("selected",true); 
        $("select[name='add_acweather'] option[value="+ac_weather+"]").attr("selected",true); 
        $("select[name='add_acdrive'] option[value="+ac_drive+"]").attr("selected",true); 
        $("input[name='add_accarry']").val(ac_carry);
        $("input[name='add_acspend']").val(ac_spend);
        $("select[name='add_achours'] option[value="+ac_hours+"]").attr("selected",true); 

        add_activity();
        $("input[name='addactivity']").hide();
        $("input[name='upactivity']").show();
    }

    function update(){
        var add_acname = $("input[name='add_acname']").val();
        var carry = $("input[name='carry']").val();

        if(add_acname==""){
            return alert("請輸入活動項目!");
        }

        if(carry==""){
            return alert("請輸入攜帶物品!");
        }

        document.showForm.action="update_activity.php"; 
        document.showForm.submit();
    }
  </script>
</html>

