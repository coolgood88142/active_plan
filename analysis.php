<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  
<?php include("link.php");?>
<!---*** Start: JQuery 3.3.1 version. ***--->
<script language="javascript" src="jquery.min.js"></script>
<!---*** End: JQuery 3.3.1 version. ***--->
<!---*** Start: Bootstrap 3.3.7 version files. ***--->
<script language="javascript" src="bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!---*** End: Bootstrap 3.3.7 version files. ***--->

<script language="javascript" src="moment.js"></script>
<script language="javascript" src="bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="bootstrap-datetimepicker.min.css">
<script src="zh-cn.js"></script>
<?php session_start();
    include("mysql.php");
    $us_admin = $_SESSION['us_admin'];
    
    $chart_type = "";$begin_date="";$end_date="";$activity_text="";
    $name_array=[];$month_array=[];$time_array=[];
    $namecount="";$monthcount="";$timecount="";
    if(isset($_POST['post_chart_type'])){
        $chart_type = $_POST['post_chart_type'];
    }else if(!empty($us_admin)){
        date_default_timezone_set('Asia/Taipei');
        $today_year = date ("Y");
        include("select_activity.php"); 
    }

    if(isset($_POST['post_begin_date']) && isset($_POST['post_end_date'])){
      $begin_date = $_POST['post_begin_date'];
      $end_date = $_POST['post_end_date'];
    }

    if($chart_type=='1' && isset($_POST['post_activity_text'])){
      $activity_text = $_POST['post_activity_text'];
    }else if($chart_type=='2' && isset($_POST['post_name_array']) && isset($_POST['post_month_array'])){
      $name_array = $_POST['post_name_array'];
      $month_array = $_POST['post_month_array'];
    }else if($chart_type="3" && isset($_POST['post_time_array'])){
      $time_array = $_POST['post_time_array'];
    }  
 ?>
  <body>
    <style>
        #ac_name,#ac_type {
            min-width: 310px;
            margin: 0 auto
        }
        tspan{
          font-size:20px;
        }
    }
    </style>
    <form action="analysis.php" name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <H2>分析表</H2>
        <br/><br/>
        <input type="button" name="acivity_name" value="活動項目統計表" onClick="show_chart('1')"/>
        <input type="button" name="acivity_type" value="活動類型統計表" onClick="show_chart('2')"/>
        <input type="button" name="time_type"value="時段統計表"  onClick="show_chart('3')"/>
        <br/><br/>

        <div id="select_date" style="hight: 150px;">
          <div>起始年月:</div>
          <div class="input-group datepick" style="width: 150px;">
            <input type="text" class="form-control" name="begin_date" value="" size="16"  required readonly/>
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </div>
          </div> ~ 
          <div class="input-group datepick" style="width: 150px;">
            <input type="text" class="form-control" name="end_date" value="" size="16"  required readonly/>
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </div>
          </div>
          <br/>
        </div>
        
        <input type="button" name="query_data" value="查詢" onClick="query_chart()"/>
        <input type="hidden" name="chart_type" value=""/>
        <div id="ac_name" style="display_none;"></div>
        <div id="ac_type" style="display_none;"></div>
        <div id="ty_type" style="display_none; height: 400px"></div>
    </form>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        var chart_type = $("input[name='post_chart_type']").val();
        if(chart_type!="" && chart_type!=undefined){
          var begin_date = $("input[name='post_begin_date']").val();
          var end_date = $("input[name='post_end_date']").val();

          $("input[name='begin_date']").val(begin_date);
          $("input[name='end_date']").val(end_date);
          show_chart(chart_type);
        }else{
          acivity_name();
        }

        $(".datepick").datetimepicker({
        format: "YYYY-MM-DD",
        ignoreReadonly: true,
        locale: moment.locale('zh-cn')
      });
    });

    function openDate(name){
      $(name).datetimepicker({
          format: "yy-mm-dd",
          ignoreReadonly: true,
          language:  'zh-CN',  //日期
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0

      });
    }
    
    function query_chart(){
      var from = $("form[name='showForm']");
      var admin = $("input[name='admin']").val();
      var begin_date = $("input[name='begin_date']").val();
      var end_date = $("input[name='end_date']").val();

      if(begin_date=="" || end_date==""){
        return alert("請輸入起始年月!");
      }

      if($('#ac_name').is(':visible')){
        $("input[name='chart_type']").val('1');
      }else if($('#ac_type').is(':visible')){
        $("input[name='chart_type']").val('2');
      }else if($('#ty_type').is(':visible')){
        $("input[name='chart_type']").val('3');
      }

      var chart_type = $("input[name='chart_type']").val();
 
      var data = {
          'admin': admin, 
          'chart_type': chart_type,
          'begin_date': begin_date,
          'end_date': end_date,
          'today_year': 'Y'
        };
      $.ajax({
			  url: "select_activity.php",
			  type: "POST",
        async: true, 
        dataType: "json",
			  data: data, 
			  success: function(info){
            if(chart_type=='1'){
              acivity_name(info);
            }else if(chart_type=='2'){
              acivity_type(info);
            }else if(chart_type=='3'){
              time_type(info);
            }
               
			  }
      });
    }

    function show_chart(chart){
      $("input[name='begin_date']").val("");
      $("input[name='end_date']").val("");
      if(chart=='1'){
        acivity_name();
      }else if(chart=='2'){
        acivity_type();
      }else if(chart=='3'){
        time_type();
      }
    }

    function acivity_name(obj){
      $("#ac_name").show();
      $("#ac_type").hide();
      $("#ty_type").hide();
      var activity_text = "";
      if(obj!="" && obj!=undefined){
        activity_text = obj.activity_text;
      }else{
        activity_text = "<?php echo $activity_text;?>";
      }
      var lines = activity_text.split(/[,. ]+/g),
        data = Highcharts.reduce(lines, function (arr, word) {
        var obj = Highcharts.find(arr, function (obj) {
          return obj.name === word;
        });
        if (obj) {
          obj.weight += 1;
        } else {
          obj = {
            name: word,
            weight: 1
          };
          arr.push(obj);
        }
        return arr;
      }, []);

      Highcharts.chart('ac_name', {
        series: [{
          type: 'wordcloud',
          data: data,
          name: '數量'
        }],
        title: {
          text: '活動項目統計表'
        }
      }); 
    }

    function acivity_type(obj){
      $("#ac_name").hide();
      $("#ac_type").show();
      $("#ty_type").hide();
      var name_array ="";month_array ="";month=[];series_array="";month_data=[];month_count="";
      if(obj!="" && obj!=undefined){
        month_count = obj.month;
        for(var i=0;i<month_count.length;i++){
          month.push(parseInt(month_count[i])+"月");
        }

        name_array = obj.name_array;
        month_array = obj.month_array;
        
        var json = "";json_value = "";       
        $.each(month_array, function(index, value){
          var arr = { name: [],data:[] };
            arr.name.push(index);
            for(var i=0;i<value.length;i++){
              arr.data.push(parseInt(value[i]));
            }
            month_data.push(arr);
        });
        series_array = month_data;
      }else{
        month = ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
        series_array = [
        <?php 
            $namecount = count($name_array);
            for($i=0;$i<$namecount;$i++){
          ?>
            { name: '<?=$name_array[$i]?>',
              data: [
              <?php 
                $monthcount = count($month_array[$name_array[$i]]);
                for($j=0;$j<$monthcount;$j++){
              ?>
                <?=$month_array[$name_array[$i]][$j]?>,
              <?php
                }
              ?>
              ]
            },
          <?php
            }
          ?>
      ];
      }
      Highcharts.chart('ac_type', {
        title: {
          text: '活動類型統計表'
        },

        xAxis: {
          categories: month
        },
        yAxis: {
          title: {
            text: '數量'
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
            pointStart: 0
          }
        },

        series: series_array,

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
    }

    function time_type(obj){
      $("#ac_name").hide();
      $("#ac_type").hide();
      $("#ty_type").show();
      var data_array="";time_array="";time_name="";time_count="";
      if(obj!="" && obj!=undefined){
        time_array = obj.time_array;

        $.each(time_array, function(index, value){
          if(index=="time_name"){
            time_name = time_name + value;
          }else if(index=="time_count"){
            time_count = time_count + value;
          }
        });

        var name_array = time_name.split(",");
        var count_array = time_count.split(",");
        data_array = [];
        if(name_array!="" && name_array!=null && count_array!="" && count_array!=null){
          for(var i=0; i<name_array.length; i++){
            data_array[i] = [String(name_array[i]) ,  parseInt(count_array[i])];
          }
        }
      }else{
        data_array = [
          <?php 
            $timecount = count($time_array['time_name']);
            for($i=0;$i<$timecount;$i++){
          ?>
              ['<?=$time_array['time_name'][$i]?>', <?=$time_array['time_count'][$i]?>],
        <?php
            }
        ?>
        ];
      }
      Highcharts.chart('ty_type', {
       
  chart: {
    type: 'pie',
    options3d: {
      enabled: true,
      alpha: 45,
      beta: 0
    }
  },
  title: {
    text: '時段統計表'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      depth: 35,
      dataLabels: {
        enabled: true,
        format: '{point.name}'
      }
    }
  },
  series: [{
    type: 'pie',
    name: '時段',
    data: data_array
  }]
});
    }

    function data_array(time_array){
      var data="";
      for(var i=0;i<time_array['time_name'].length;i++){
        data = data + ["'"+time_array['time_name'][i]+"','"+time_array['time_count'][i]+"'"]+",";
      }
      return data.substring(0,data.length-1);
    }

    function show(page){
        if($("input[name='admin']").val()=="Y" && page=="setting"){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

